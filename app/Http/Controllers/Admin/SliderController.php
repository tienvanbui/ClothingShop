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
            'title' => 'required|string|bail|max:100',
            'slider_image' => 'required|image|bail',
            'description' => 'required'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request)) {
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
        return redirect()->route('slider.index')->withToastSuccess("$this->modelName Stored Successfully!");
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
        if ($this->startValidationProcess($request)) {
            $this->delteOldImageWhenUpdate($request, 'slider_iamge', $slider);
            $dataUpdate = [
                'title' => $request->title,
                'description' => $request->description,
            ];
            $checkImageHasUploaded = $this->uploadImage('slider_image', $request);
            if (!empty($checkImageHasUploaded)) {
                $dataUpdate['slider_image'] = $checkImageHasUploaded['filePath'];
            }
            $slider->update($dataUpdate);
            return redirect()->route('slider.index')->withToastSuccess("$this->modelName  Updated Successfully!");
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
        return redirect()->route('slider.index')->withToastSuccess("$this->modelName  Deleted Successfully!");
    }
}
