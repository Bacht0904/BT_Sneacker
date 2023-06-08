<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ProductType;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách loại sản phẩm';
        $product_type = DB::select('SELECT product_types.*,categories.category_name FROM product_types,categories WHERE product_types.categorie_id = categories.id and categories.status=1  ORDER BY categories.category_name ASC');
        return view('component.product_type.list-product-type',compact('title','product_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCreate()
    {
        $categories = Category::where('status','=',1)->get();
        return view('component.product_type.create-product-type',compact('categories'));
    }

    public function postCreate(Request $request)
    {
        $product_type = new ProductType();
        $product_type->product_type_name = $request->product_type_name;
        $product_type->categorie_id = $request->category_id;
        $product_type->status = 1;
        $success = $product_type->save();
        return view('component.product_type.create-product-type',compact('success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $categories = Category::where('status','=',1)->get();
        $product_type = ProductType::find($id);
        return view('component.product_type.edit-product-type',compact('product_type','categories'));
    }

    public function postEdit($id,Request $request)
    {
        $product_type = ProductType::find($id);
        $product_type->product_type_name = $request->product_type_name;
        $product_type->categorie_id = $request->categorie_id;
        $product_type->status = $request->status;

        $success = $product_type->update();
        return view('component.product_type.edit-product-type',compact('success'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTypeRequest  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_type = ProductType::find($id);
        $product_type->status = 0;
        $name= $product_type->product_type_name;
        $product_type->update();
        return redirect()->route('list-productType')->with('msg','Đã xóa thành công '.$name);
    }
}
