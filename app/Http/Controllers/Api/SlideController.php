<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\SlideDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;

class SlideController extends Controller
{
    //DS slideshow
    public function getAllSlideShow()
    {
        $slides = Slide::select(['*', DB::raw('CONCAT("assets/img/slideshows/",picture) AS picture')])
        ->where('status', '=', 1)
        ->orderBy('id')
        ->get();

        return response()->json(['status'=>0, 'data'=>$slides, 'message'=>'']);
    }

    //Slideshow chi tiết
    public function getAllSlideShowDetail($id)
    {
        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('slide_details', 'slide_details.product_id', '=', 'products.id')
        ->join('slides', 'slides.id', '=', 'slide_details.slide_id')
        ->select('products.*')
        ->where('slides.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('slides.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->get();

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }
}
