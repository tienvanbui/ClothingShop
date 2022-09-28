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
            'size_name'=>"required|string|bail",
        ];
        
    }
    public function edit($id){
        $size = Size::FindOrFail($id);
        return view('admin.size.edit',['size'=>$size]);
    }
    public function update(Request $request,$id){
       
        $validator = $request->validate($this->validateRule);
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
