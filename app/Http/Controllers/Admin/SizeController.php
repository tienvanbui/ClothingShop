<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
class SizeController extends Controller
{
    
    public function __construct()
    {
        $this->setModel(Size::class);
        $this->resourceName = 'sizes';
        $this->modelName = 'Size';
        $this->views = [
            'index'=>'admin.size.index',
            'create'=>'admin.size.create',

        ];
        $this->validateRule = [
            'size_name'=>"required|max:255|unique:sizes",
        ];
        $this->messageValidate = [
            'size_name.required' => 'Tên kích thước không được để trống.',
            'size_name.max' => 'Tên kích thước tối đa 255 ký tự.',
            'size_name.unique' => 'Tên kích thước đã tồn tại'
        ];
        $this->middleware(['permission:Size_list'], ['only' => ['index']]);
        $this->middleware(['permission:Size_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Size_show'], ['only' => ['show']]);
        $this->middleware(['permission:Size_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Size_delete'], ['only' => ['destroy']]);
        
    }
    public function edit($id){
        $size = Size::FindOrFail($id);
        return view('admin.size.edit',['size'=>$size]);
    }
    public function update(Request $request,$id){
       
        $validator = $request->validate([
            'size_name'=>"required|max:255",
        ],[
            'size_name.required' => 'Tên kích thước không được để trống.',
            'size_name.max' => 'Tên kích thước tối đa 255 ký tự.',
        ]);
        if($validator){
            $size = Size::FindOrFail($id);
            $size->update(
                [
                    'size_name'=>$request->size_name,
                ]
            );
            return redirect()->route('size.index')->withToastSuccess("$this->modelName Updated Successfully!");
        }
        
    }
}
