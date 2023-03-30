<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        $this->setModel(Category::class);
        $this->resourceName='categories';
        $this->modelName='Category';
        $this->views = [
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'edit' => 'admin.category.edit',
        ];
        $this->validateRule = [
            'name'=>'string|required|max:30|bail|unique:categories',
        ];
        $this->middleware(['permission:Category_list'], ['only' => ['index']]);
        $this->middleware(['permission:Category_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Category_show'], ['only' => ['show']]);
        $this->middleware(['permission:Category_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Category_delete'], ['only' => ['destroy']]);
    }
    public function update($id,Request $request){
        if($this->startValidationProcess($request)){
            $dataUpdate = Category::FindOrFail($id);
            $dataUpdate->update([
                'name'=>$request->name
            ]);
            return redirect()->route('category.index')->withToastSuccess("Danh mục sản phẩm cập nhật thành công!");
        }
    }
}
