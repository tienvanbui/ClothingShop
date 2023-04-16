<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;


class ColorController extends Controller
{
    public function __construct()
    {
        $this->setModel(Color::class);
        $this->resourceName = 'colors';
        $this->modelName = 'Color';
        $this->views = [
            'index' => 'admin.color.index',
            'create'=> 'admin.color.create',
        ];
        $this->validateRule = [
            'color_name'=>"required|max:255|bail|unique:colors",
        ];
        $this->messageValidate = [
            'color_name.required' => 'Tên màu sắc không được để trống.',
            'color_name.max' => 'Tên màu sắc tối đa 255 ký tự.',
            'color_name.unique' => 'Tên màu sắc đã tồn tại'
        ];
        $this->middleware(['permission:Color_list'], ['only' => ['index']]);
        $this->middleware(['permission:Color_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Color_show'], ['only' => ['show']]);
        $this->middleware(['permission:Color_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Color_delete'], ['only' => ['destroy']]);
    }
    public function edit($id){
        $color = Color::FindOrFail($id);
        return view('admin.color.edit',['color'=>$color]);
    }
    public function update(Request $request,$id){
       
        $validator = $request->validate([
            'color_name'=>"required|max:255",
        ],[
            'color_name.required' => 'Tên màu sắc không được để trống.',
            'color_name.max' => 'Tên màu sắc tối đa 255 ký tự.',
        ]);
        if($validator){
            $color = Color::FindOrFail($id);
            $color->update(
                [
                    'color_name'=>$request->color_name,
                ]
            );
            return redirect()->route('color.index')->withToastSuccess('Cập nhật thành công!');
        }
        
    }
}
