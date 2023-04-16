<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BannerController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(Banner::class);
        $this->resourceName = 'banners';
        $this->modelName = 'Banner';
        $this->views = [
            'index' => 'admin.banner.index',
            'create' => 'admin.banner.create',
        ];
        $this->validateRule = [
            'title' =>'required|max:255|bail',
            'content' =>'required|max:255|bail',
            'banner_image' =>'required|image|bail'
        ];
        $this->messageValidate = [
            'title.required' => 'Tiêu đề không được trống.',
            'title.max' => 'Tiêu đề tối đa 255 ký tự',
            'content.required' => 'Nội dung không được trống.',
            'content.max' => 'Nội dung tối đa 255 ký tự',
            'banner_image.required' => 'Ảnh không được trống.',
            'banner_image.image' => 'Phải là định dạng ảnh',
        ];
        $this->middleware('auth');
        $this->middleware(['permission:Banner_list'], ['only' => ['index']]);
        $this->middleware(['permission:Banner_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Banner_show'], ['only' => ['show']]);
        $this->middleware(['permission:Banner_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Banner_delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Banner::latest()->paginate($this->itemInPerPgae);
        return view($this->views['index'])->with('banners',$list);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->startValidationProcess($request,$this->messageValidate)){
            $dataStore = [
                'title' =>$request->title,
                'content' =>$request->content,
            ];
            $checkBannerImage = $this->uploadImage('banner_image',$request);
            if(!empty($checkBannerImage)){
                $dataStore['banner_image'] = $checkBannerImage['filePath'];
            }
            $banner = Banner::create($dataStore);
            return redirect()->route('banner.index')->withToastSuccess('Tạo mới thành công!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        if($this->startValidationProcess($request,$this->messageValidate)){
            $this->delteOldImageWhenUpdateWithCheckExists($request,'banner_image',$banner);
            $dataUpdate = [
                'title'=>$request->title,
                'content'=>$request->content,

            ];
            $checkBannerImage = $this->uploadImage('banner_image',$request);
            if(!empty($checkBannerImage)){
                $dataUpdate['banner_image'] = $checkBannerImage['filePath'];
            }
            $banner->update($dataUpdate);
            return redirect()->route('banner.index')->withToastSuccess('Cập nhật thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        if(Storage::exists("/public". str_replace("/storage",'',$banner->banner_image))){
            unlink(storage_path("/app"."/public". str_replace("/storage",'',$banner->banner_image)));
         }
         $banner->delete();
         return redirect()->route('banner.index')->withToastSuccess('Xóa thành công');
    }
}
