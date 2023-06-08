<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách thương hiệu';
        $brand = Brand::orderBy('id','DESC')->get();
        return view('component.brand.list-brand',compact('title','brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('component.brand.create-brand');
    }
    public function postCreate(Request $request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->company = $request->company;
        $brand->company_code = $request->company_code;
        $brand->bank_name = $request->bank_name;
        $brand->bank_num = $request->bank_num;
        $brand->bank_account_name = strtoupper($request->bank_account_name);
        $brand->phone_number = $request->phone_number;
        $brand->email = $request->email;
        $brand->status= 1;
        $success = $brand->save();
        return view('component.brand.create-brand',compact('success'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('component.brand.detail-brand',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $brand = Brand::find($id);
        return view('component.brand.edit-brand',compact('brand'));
    }
    public function postEdit($id,Request $request)
    {
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->company = $request->company;
        $brand->company_code = $request->company_code;
        $brand->bank_name = $request->bank_name;
        $brand->bank_num = $request->bank_num;
        $brand->bank_account_name = strtoupper($request->bank_account_name);
        $brand->phone_number = $request->phone_number;
        $brand->email = $request->email;
        $brand->status = $request->status;
        $success = $brand->update();
        return view('component.brand.edit-brand',compact('success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->status = 0;
        $name=$brand->brand_name;
        $brand->update();
        return Redirect::route('list-brand')->with('msg','Đã xóa thành công thương hiệu '.$name);

    }
}
