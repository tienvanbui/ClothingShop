<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Traits\uploadFileImage;

class ProductController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(Product::class);
        $this->resourceName = 'products';
        $this->modelName = 'Product';
        $this->views = [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit',
            'show' => 'admin.product.show'
        ];
        $this->validateRule = [
            'product_name' => 'required|unique:products|bail',
            'product_image' => 'required|image|bail',
            'product_image_name' => 'required|bail',
            'price' => 'required|bail',
            'category_id' => 'required|bail',
            'user_id' => 'required|bail',
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::all();
        return view($this->views['create'])->with([
            'sizes' => $sizes,
            'colors' => $colors,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //store data to product table
            $dataProductStore = [
                'product_name' => $request->product_name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'seo_product' => $request->product_seo
            ];
            $checkUploadProductImage = $this->uploadImage('product_image', $request);
            if (!empty($checkUploadProductImage)) {
                $dataProductStore['product_image'] = $checkUploadProductImage['filePath'];
                $dataProductStore['product_image_name'] = $checkUploadProductImage['fileName'];
            }
            $product = Product::create($dataProductStore);
            //store product detail infor 
            $product->productDetail()->create([
                'description' => $request->description,
                'weight' => $request->weight,
                'dimension' => $request->dimension,
                'materials' => $request->materials,
            ]);
            //store multiple product image 
            if ($request->hasFile('img_path')) {
                foreach ($request->file('img_path') as $value) {
                    $dataProductImages = $this->UploadFileMultiple($value, 'img_path');
                    $product->productImages()->create([
                        'img_path_name' => $dataProductImages['fileName'],
                        'img_path' => $dataProductImages['filePath']
                    ]);
                }
            }
            $product->colors()->attach($request->color_id);
            $product->sizes()->attach($request->size_id);
            $array_size_selection = $request->size_selection;
            $array_color_selection = $request->color_selection;
            $quanlities = $request->product_quanlities;
            for ($i = 0; $i < count($request->size_selection); $i++) {
                $product->productColorSizeses()->create([
                    'color_id' => $array_color_selection[$i],
                    'size_id' => $array_size_selection[$i],
                    'quanlities' => $quanlities[$i]
                ]);
            }
            return redirect()->route('product.index')->withToastSuccess( "$this->modelName Stored Successfully!");
        } catch (Exception $exception) {
            return redirect()->back()->withToastError($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view($this->views['show'], [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productHasColor = $product->colors;
        $productHasSize = $product->sizes;
        $number_records = $product->productColorSizeses()->count();
        return view($this->views['edit'], [
            'product' => $product,
            'category' => Category::all(),
            'productHasColor' => $productHasColor,
            'productHasSize' => $productHasSize,
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'number_records' => $number_records
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            //store data to product table
            $dataProductUpdate = [
                'product_name' => $request->product_name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'seo_product' => $request->product_seo
            ];
            //delete old product image 
            $this->delteOldImageWhenUpdateWithCheckExists($request, 'product_image', $product);
            $checkUploadProductImage = $this->uploadImage('product_image', $request);
            if (!empty($checkUploadProductImage)) {
                $dataProductUpdate['product_image'] = $checkUploadProductImage['filePath'];
                $dataProductUpdate['product_image_name'] = $checkUploadProductImage['fileName'];
            }
            $product->update($dataProductUpdate);
            //store product detail infor 
            $product->productDetail()->update([
                'description' => $request->description,
                'weight' => $request->weight,
                'dimension' => $request->dimension,
                'materials' => $request->materials,

            ]);
            //delete all old image when update product
            foreach ($product->productImages as  $value) {
                $this->delteOldImageWhenUpdateWithoutCheckExists('img_path', $value);
            }
            //update multiple product image 
            if ($request->hasFile('img_path')) {
                $product->productImages()->delete();
                foreach ($request->file('img_path') as $value) {
                    $dataProductImages = $this->UploadFileMultiple($value, 'img_path');
                    $product->productImages()->create([
                        'img_path_name' => $dataProductImages['fileName'],
                        'img_path' => $dataProductImages['filePath']
                    ]);
                }
            }
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
            $product->productColorSizeses()->delete();
            $array_size_selection = $request->size_selection;
            $array_color_selection = $request->color_selection;
            $quanlities = $request->product_quanlities;
            for ($i = 0; $i < count($request->size_selection); $i++) {
                $product->productColorSizeses()->create([
                    'color_id' => $array_color_selection[$i],
                    'size_id' => $array_size_selection[$i],
                    'quanlities' => $quanlities[$i]
                ]);
            }
            return redirect()->route('product.index')->withToastSuccess("$this->modelName Updated Successfully!");
        } catch (Exception $exception) {
            return redirect()->back()->withToastError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete all product detail image
        foreach ($product->productImages as $item) {
            $this->delteOldImageWhenUpdateWithoutCheckExists('img_path', $item);
        }
        //delete product image
        $this->delteOldImageWhenUpdateWithoutCheckExists('product_image', $product);
        $product->productImages()->delete();
        $product->productDetail()->delete();
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->delete();
        $product->productColorSizeses()->delete();
        return redirect()->route('product.index')->withToastSuccess("$this->modelName Deleted Successfully!");
    }
    public function manageQuanlities(Request $request)
    {
        if ($request->ajax()) {
            $colors = DB::table('colors')->whereIn('id', array_values($request->colors))->get();
            $sizes = DB::table('sizes')->whereIn('id', array_values($request->sizes))->get();
            return view(
                'admin.product.manage-quanlities',
                [
                    'colors' => $colors,
                    'sizes' => $sizes,
                    'count_number_color_selected' => $request->color_length,
                    'count_number_size_selected' => $request->size_length
                ]
            );
        }
    }
}
