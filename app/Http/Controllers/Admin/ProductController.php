<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Picture;
use App\Models\ProductDetail;
use App\Models\ProductType;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpRequest $request)
    {
        $title = 'Danh sách sản phẩm';
        // $products = DB::select('SELECT * FROM products ORDER BY created_at DESC');

        // Lọc sản phẩm
        $filter = $request->filters;
        if($request->filters != null){
            if($filter == 1){
                // Các sp đang hoạt động
                $products = DB::table('products')->where('status','=',1)->get();
            }else if($filter == 2){
                // Các sp ngung hoạt động
                $products = DB::table('products')->where('status','=',0)->get();
            }else if($filter == 3){
                // sp con hang
                $products = DB::table('products')->where('quantity_status','=',1)->get();
            }else if($filter == 4){
                // sp het hang
                $products = DB::table('products')->where('quantity_status','=',0)->get();
            }else if($filter == 5){
                // sp noi bat
                $products = DB::table('products')->where('popular','=',1)->get();
            }else if($filter == 6){
                // sp noi bat
                $products = DB::table('products')->where('popular','=',0)->get();
            }else{
                $products = DB::table('products')->orderBy('created_at','desc')->get();
            }
        }
        else{
            $products = DB::table('products')->orderBy('created_at','desc')->get();
            $filter = -1;
        }
        // dd($products);
        return view('component.product.products',compact('title','products','filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCreate()
    {
        $title = 'Thêm sản phẩm mới';
        $category = Category::all();
        $product_type =  DB::select('SELECT product_types.* FROM product_types,categories WHERE product_types.categorie_id = categories.id and categories.status=1 and product_types.status =1  ORDER BY product_types.categorie_id DESC');
        $product = Product::all()->count();
        $brand = Brand::where('status','=',1)->get();
        $count = $product++;
        $dt = Carbon::now();
        $dt->format('Y-MM-DD');
        $code = $dt->year.(($dt->month>=10)?$dt->month:'0'.$dt->month).(($dt->day>=10)?$dt->day:'0'.$dt->day);
        if($count<10){
            $productCode = $code.'00'.$count;
        }else if($count>=10 && $count<100){
            $productCode = $code.'0'.$count;
        }else{
            $productCode = $code.$count;
        }
        return view('component.product.add-product', compact('title','category','product_type','productCode','brand'));
    }
    public function postCreate( HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(),[
                'product_name'=> 'required',
                'brand'=>'required',
                'price'=>'required',
                'product_type'=>'required',
                'description'=>'required',
            ],[
                'required'=>':attribute không được bỏ trống'
            ],[

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }


            // dd($request->all());

            $product = Product::create([
                'product_barcode'=> $request->product_code,
                'product_name'=> $request->product_name,
                'brand_id'=> $request->brand,
                'price'=>$request->price,
                'product_type_id'=>$request->product_type,
                'description'=>$request->description,
            ]);

            // dd($request->image_colors[0]->getClientOriginalName());
            $product->save();
            if($request->hasFile('images')){
                foreach ($request->file('images') as $image){
                    // dd('vào for');
                    $pics = new Picture();

                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/products/');
                    $image->move($destinationPath,$fileNew);

                    $pics->product_id = $product->id;
                    $pics->picture_value = $fileNew;
                    $pics->save();
                }

            }

            //nhap size
            for($i = 0;$i<count($request->size_name);$i++){
                $size = new Size();
                $size->size_name = $request->size_name[$i];
                $size->product_id = $product->id;
                $size->status = $request->size_status[$i];
                $size->save();
            }
            //nhap ten mau va hinh sp cua mau
            for($i = 0;$i<count($request->color_name);$i++){
                //luu hinh
                $color = new Color();
                if($request->image_colors[$i]){
                    // foreach ($request->file('image_colors') as $image){
                        // dd('vào for');
                        $image = $request->image_colors[$i];
                        $namewithextension = $image->getClientOriginalName();
                        $fileName = explode('.', $namewithextension)[0];
                        $extension = $image->getClientOriginalExtension();
                        $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                        $destinationPath = public_path('/assets/img/product_colors/');
                        $image->move($destinationPath,$fileNew);

                        $color->picture = $fileNew;
                    // }

                }
                //luu ten mau
                $color->color_name = $request->color_name[$i];
                $color->product_id = $product->id;
                $color->status = $request->color_status[$i];
                $color->save();
            }
            DB::commit();
            return redirect()->route('products')->with('msg','Tạo thành công sản phẩm '.$request->product_name);

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->withErrors('Thêm sản phẩm thất bại!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Chi tiết sản phẩm';
        $product = Product::with(['pictures'])->find($id);
        $pics = DB::select("SELECT picture_value FROM pictures,products WHERE products.id = pictures.product_id and product_id ={$id}");
        // dd($pics);
        return view('component.product.product-detail',compact('title','product','pics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($id)
    {
        $product = DB::table('products')->find($id);
        $sizes = DB::select("SELECT sizes.size_name, sizes.status, sizes.id FROM sizes WHERE product_id = {$id}");
        // dd($size);
        $category = Category::all();
        $product_type = ProductType::all();
        $brand = Brand::all();
        $colors = DB::select("SELECT colors.color_name, colors.picture, colors.status, colors.id from colors WHERE colors.product_id = {$id}");
        $pics = DB::select("SELECT pictures.picture_value from pictures WHERE pictures.product_id ={$id}");
        // dd($pics);

        return view('component.product.edit-product', compact('brand','category','product_type','product','sizes','colors','pics'));
    }
    public function postEdit($id,HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(),[
                'product_name'=> 'required','min:2',
                'price'=>'required',
                'description'=>'required',
            ],
            [
                'product_name.required'=>'Vui lòng nhập tên sản phẩm.',
                'product_name.min'=>'Tên sản phẩm quá ngắn',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $product = Product::find($id);

            // ->update([
            //     'product_barcode'=> $request->product_code,
            //     'product_name'=> $request->product_name,
            //     'stock'=> $request->stock,
            //     'brand_id'=> $request->brand,
            //     'import_price'=> $request->import_price,
            //     'price'=>$request->price,
            //     'discount_price'=>$request->discount_price,
            //     'product_type_id'=>$request->product_type,
            //     'description'=>$request->description,
            //     'status'=>$request->status,
            // ]);

            // dd($request->all());
            for($i = 0;$i<count($request->size_name);$i++){
                $size = Size::find($request->size_id[$i]);
                if ($size) {
                    $size->size_name = $request->size_name[$i];
                    $size->status = $request->size_status[$i];
                    $size->update();
                } else {
                    $size = new Size();
                    $size->size_name = $request->size_name[$i];
                    $size->product_id = $product->id;
                    $size->status = $request->size_status[$i];
                    $size->save();
                }
            }
            // dd($size);
            //nhap ten mau va hinh sp cua mau
            for($i = 0;$i<count($request->color_name);$i++){
                //luu hinh
                $color = Color::find($request->color_id[$i]);
                if ($color) {
                    // dd($request->image_colors);
                    // if($request->image_colors){
                    //     if($request->image_colors[$i]){
                    //         $image = $request->image_colors[$i];
                    //         unlink(public_path('/assets/img/product_colors/'.$color->picture));
                    //         $namewithextension = $image->getClientOriginalName();
                    //         $fileName = explode('.', $namewithextension)[0];
                    //         $extension = $image->getClientOriginalExtension();
                    //         $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    //         $destinationPath = public_path('/assets/img/product_colors/');
                    //         $image->move($destinationPath,$fileNew);
                    //         $color->picture = $fileNew;
                    //     }
                    // }
                    $color->color_name = $request->color_name[$i];
                    $color->status = $request->color_status[$i];
                    $color->update();
                }else{
                    $color = new Color();
                    // if($request->hasFile('image_colors')){
                    //     foreach ($request->file('image_colors') as $image){
                    //         // dd('vào for');
                    //         $namewithextension = $image->getClientOriginalName();
                    //         $fileName = explode('.', $namewithextension)[0];
                    //         $extension = $image->getClientOriginalExtension();
                    //         $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    //         $destinationPath = public_path('/assets/img/product_colors/');
                    //         $image->move($destinationPath,$fileNew);

                    //         $color->picture = $fileNew;
                    //     }

                    // }
                    // //luu ten mau
                    // $color->color_name = $request->color_name[$i];
                    // $color->product_id = $product->id;
                    // $color->status = $request->color_status[$i];
                    // $color->save();
                    if($request->image_colors[$i]){
                        // foreach ($request->file('image_colors') as $image){
                            // dd('vào for');
                            $image = $request->image_colors[$i];
                            $namewithextension = $image->getClientOriginalName();
                            $fileName = explode('.', $namewithextension)[0];
                            $extension = $image->getClientOriginalExtension();
                            $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                            $destinationPath = public_path('/assets/img/product_colors/');
                            $image->move($destinationPath,$fileNew);

                            $color->picture = $fileNew;
                        // }

                    }
                    //luu ten mau
                    $color->color_name = $request->color_name[$i];
                    $color->product_id = $product->id;
                    $color->status = $request->color_status[$i];
                    $color->save();
                }
            }

            if($request->hasFile('images')){
                $pictures = Picture::where('product_id','=',$id)->get();
                foreach ($pictures as $picture){
                    unlink(public_path('/assets/img/products/'.$picture->picture_value));
                    $picture->delete();
                }
                foreach ($request->file('images') as $image){
                    // dd('vào for');
                    $pics = new Picture();

                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/products/');
                    $image->move($destinationPath,$fileNew);

                    $pics->product_id = $product->id;
                    $pics->picture_value = $fileNew;
                    $pics->save();
                }
            }
            $product->product_name = $request->product_name;
            $product->brand_id = $request->brand;
            $product->product_type_id = $request->product_type;
            $product->price = $request->price;
            $product->status = $request->status;
            $success = $product->update();
            DB::commit();
            return view('component.product.edit-product',compact('success'));
            // return view('component.product.edit-product')->withErrors('Chỉnh sửa thành công');
        }
        catch (\Throwable $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->back()->withErrors('Sửa sản phẩm thất bại!');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $name = $product->product_name;
        $product->update();
        return redirect()->route('products')->with('msg','Đã ngưng hoạt động thành công sản phẩm '.$name);
    }

    public function popular($id)
    {
        $product = Product::find($id);
        if($product->popular == 0)
        {
            $product->popular = 1;
        }else {
            $product->popular = 0;
        }
        $product->update();

        return redirect()->route('products');
    }
    public function quantityStatus($id)
    {
        $product = Product::find($id);
        if($product->quantity_status == 0)
        {
            $product->quantity_status = 1;
        }else {
            $product->quantity_status = 0;
        }
        $product->update();

        return redirect()->route('products');
    }
}
