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
    }
    public function update($id,Request $request){
        if($this->startValidationProcess($request)){
            $dataUpdate = Category::FindOrFail($id);
            $dataUpdate->update([
                'name'=>$request->name
            ]);
            return redirect()->route('category.index')->withToastSuccess(" $this->modelName Updated Successfully!");
        }
    }
}
