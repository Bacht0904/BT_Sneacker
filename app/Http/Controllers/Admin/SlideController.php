<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Slide;
use App\Models\SlideDetail;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSlideDetailRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        // dd($slides);
        return view('component.slide.list-slide',compact('slides'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $products = DB::table('products')
        ->leftJoin('product_types','product_types.id','=','products.product_type_id')
        ->where([
            ['products.status','=',1],
            ['products.quantity_status','=',1],
            ['product_types.status','=','1']
        ])
        ->orderBy('product_types.product_type_name')
        ->select('products.id','products.product_name','products.price','product_types.product_type_name')
        ->get();
        return view('component.slide.create-slide',compact('products'));
    }

    public function postCreate(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());
            $image = $request->file('picture');
            $namewithextension = $image->getClientOriginalName();
            $fileName = explode('.', $namewithextension)[0];
            $extension = $image->getClientOriginalExtension();
            $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
            $destinationPath = public_path('/assets/img/slideshows/');
            $image->move($destinationPath,$fileNew);

            $slide = Slide::create([
                'picture'=> $fileNew,
                'description'=> $request->description,
                'status'=> 1,
            ]);
            // dd($slide);
            for($i = 0;$i<count($request->product_id);$i++){
                $slide_detail = new SlideDetail();
                $slide_detail->slide_id = $slide->id;
                $slide_detail->product_id = $request->product_id[$i];
                $success = $slide_detail->save();
            }
            DB::commit();
            return view('component.slide.create-slide',compact('success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('Thêm slide thất bại!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSlideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slide::find($id);
        return view('component.slide.slide-detail',compact('slide'));
    }


    public function getEdit($id)
    {
        $slide = Slide::where('id','=',$id)->first();

        $products = DB::select('SELECT products.id, products.product_name, products.price,  product_types.product_type_name  FROM products LEFT JOIN product_types ON product_types.id = products.product_type_id LEFT JOIN slide_details ON slide_details.product_id = products.id  AND slide_details.slide_id = '.$id.' where products.status = 1 AND product_types.status = 1 AND products.quantity_status = 1 AND slide_details.id IS NULL ORDER BY products.created_at DESC');

        $slide_products = DB::select('SELECT products.id, products.product_name, products.price, product_types.product_type_name  FROM products LEFT JOIN product_types ON product_types.id = products.product_type_id LEFT JOIN slide_details ON slide_details.product_id = products.id AND slide_details.slide_id = '.$id.' where products.status = 1 AND slide_details.id IS NOT NULL ORDER BY products.created_at DESC');

        return view('component.slide.edit-slide',compact('slide', 'products', 'slide_products'));
    }
    public function postEdit($id,Request $request)
    {
        DB::beginTransaction();
        try {
            $slide = Slide::find($id);
            if($request->hasFile('picture')){
                unlink(public_path('/assets/img/slideshows/'.$slide->picture));
                $image = $request->file('picture');
                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/slideshows/');
                $image->move($destinationPath,$fileNew);
                $slide->picture = $fileNew;
            }
            $slide->description = $request->description;
            $slide->status=$request->status;

            SlideDetail::where('slide_id', '=', $slide->id)->delete();
            for($i = 0;$i<count($request->product_id);$i++){
                $slide_detail = new SlideDetail();
                $slide_detail->slide_id = $slide->id;
                $slide_detail->product_id = $request->product_id[$i];
                $success = $slide_detail->save();
            }

            $success = $slide->update();
            DB::commit();
            return view('component.slide.edit-slide',compact('slide','success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('Thêm slide thất bại!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SlideDetail::where('slide_id', '=', $id)->delete();
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->route('list-slide')->with('msg','Đã xóa thành công slide ');

    }
}
