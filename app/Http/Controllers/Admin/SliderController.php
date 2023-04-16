<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(Slider::class);
        $this->modelName = 'Sliders';
        $this->resourceName = 'sliders';
        $this->views = [
            'index' => 'admin.slider.index',
            'create' => 'admin.slider.create',
        ];
        $this->validateRule = [
            'title' => 'required|bail|max:100',
            'slider_image' => 'required|image|bail',
            'description' => 'required|max:255'
        ];
        $this->messageValidate = [
            'title.required' => 'Trường này là bắt buộc',
            'slider_image.required' => 'Trường này là bắt buộc',
            'description.required' => 'Trường này là bắt buộc',
            'description.max' => 'Tối đa 255 ký tự',
            'title.max' => 'Tối đa 100 ký tự',
            'slider_image.image' => 'Trường này phải có định dạng ảnh',
        ];
        $this->middleware(['permission:Slider_list'], ['only' => ['index']]);
        $this->middleware(['permission:Slider_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Slider_show'], ['only' => ['show']]);
        $this->middleware(['permission:Slider_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Slider_delete'], ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
            $dataStore = [
                'title' => $request->title,
                'description' => $request->description,
            ];
            $checkImageHasUploaded = $this->uploadImage('slider_image', $request);
            if (!empty($checkImageHasUploaded)) {
                $dataStore['slider_image'] = $checkImageHasUploaded['filePath'];
            }
        }
        $slider = Slider::create($dataStore);
        return redirect()->route('slider.index')->withToastSuccess("Tạo thành công!");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
            $this->delteOldImageWhenUpdateWithCheckExists($request, 'slider_iamge', $slider);
            $dataUpdate = [
                'title' => $request->title,
                'description' => $request->description,
            ];
            $checkImageHasUploaded = $this->uploadImage('slider_image', $request);
            if (!empty($checkImageHasUploaded)) {
                $dataUpdate['slider_image'] = $checkImageHasUploaded['filePath'];
            }
            $slider->update($dataUpdate);
            return redirect()->route('slider.index')->withToastSuccess("Cập nhật thành công!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (Storage::exists("/public" . str_replace("/storage", '', $slider->slider_image))) {
            unlink(storage_path("/app" . "/public" . str_replace("/storage", '', $slider->slider_image)));
        }
        $slider->delete();
        return redirect()->route('slider.index')->withToastSuccess("Xóa thành công!");
    }
}
