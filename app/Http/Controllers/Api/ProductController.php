<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Rate;
use App\Models\Like;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductDetail;
use App\Models\PictureRate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;

class ProductController extends Controller
{
    //DS sản phẩm mới
    public function getAllNewProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //DS sản phẩm nổi bật
    public function getAllPopularProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.popular', '=', 1)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //DS sản phẩm bán chạy
    public function getAllSellingProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->rightJoin('invoice_details', 'invoice_details.product_id', '=', 'products.id') 
        ->rightJoin('invoices' , 'invoice_details.invoice_id', '=', 'invoices.id') 
        ->where('invoices.status', '<>', 0)
        ->where('products.status', '=', 1)
        ->select(DB::raw('products.*, count(*) as COUNT'))
        // ->distinct()
        ->groupBy('id', 'product_name', 'price', 'product_type_id', 'product_barcode', 'brand_id', 'popular', 'quantity_status', 'num_like', 'num_rate', 'description', 'status', 'created_at', 'updated_at', 'deleted_at')
        ->orderBy('COUNT', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Chi tiết sản phẩm
    public function getProductDetailById($id)
    {
        $color = Color::select(['*', DB::raw('CONCAT("assets/img/product_colors/",picture) AS picture')])
        ->where('status', '=', 1)
        ->where('product_id', '=', $id)
        ->get();

        $size = Size::where('status', '=', 1)
        ->where('product_id', '=', $id)
        ->get();

        // $quantityOfType = ProductDetail::where('product_id', '=', $id)
        // ->get();
        
        $numOrder = Invoice::rightJoin('invoice_details', 'invoice_details.invoice_id', '=', 'invoices.id') 
        ->where('invoice_details.product_id', '=', $id)
        ->where('invoices.status', '<>', 0)
        ->select('invoices.id')
        ->distinct()
        ->count();

        // $productDetail = array('colors' => $color, 'sizes' => $size, 'quantityOfType' => $quantityOfType, ' numOrder' => $numOrder);

        $productDetail = array('colors' => $color, 'sizes' => $size, 'numOrder' => $numOrder);

        return response()->json(['status'=>0, 'data'=>$productDetail, 'message'=>'']);
    }

    //DS sản phẩm theo tất cả loại trong danh mục
    public function getProductByProductCategory(HttpRequest $request, $id)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
        ->select('products.*')
        ->where('categories.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->where('categories.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //DS sản phẩm theo loại
    public function getProductByProductType(HttpRequest $request, $id)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->select('products.*')
        ->where('product_types.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Tìm kiếm sản phẩm
    public function searchProduct(HttpRequest $request, $key_search)
    {
        $num = (int) $request->num;

        $validator = Validator::make($request->all(), [
            'product_type_id' => 'nullable',
            'from_price' => 'nullable',
            'to_price' => 'nullable',
            'new_sort' => 'nullable',
            'price_sort' => 'nullable',
        ]);
            // dd($request->to_price);
        if($request->new_sort){
            if($request->product_type_id && $request->from_price > -1 && $request->to_price > 0){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                ->whereBetween('products.price', [$request->from_price, $request->to_price])
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->orderBy('products.id', 'DESC')
                ->paginate($num);
            }else if($request->product_type_id){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->orderBy('products.id', 'DESC')
                ->paginate($num);
            }else if($request->from_price > -1 && $request->to_price > 0){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->whereBetween('products.price', [$request->from_price, $request->to_price])
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->orderBy('products.id', 'DESC')
                ->paginate($num);
            }else{
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->orderBy('products.id', 'DESC')
                ->paginate($num);
            }
        }else if($request->price_sort != 0){
            if($request->price_sort == 1){
                if($request->product_type_id && $request->from_price > -1 && $request->to_price > 0){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                    ->whereBetween('products.price', [$request->from_price, $request->to_price])
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'ASC')
                    ->paginate($num);
                }else if($request->product_type_id){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'ASC')
                    ->paginate($num);
                }else if($request->from_price > -1 && $request->to_price > 0){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->whereBetween('products.price', [$request->from_price, $request->to_price])
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'ASC')
                    ->paginate($num);
                }else{
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'ASC')
                    ->paginate($num);
                }
            }else{
                if($request->product_type_id && $request->from_price > -1 && $request->to_price > 0){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                    ->whereBetween('products.price', [$request->from_price, $request->to_price])
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'DESC')
                    ->paginate($num);
                }else if($request->product_type_id){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'DESC')
                    ->paginate($num);
                }else if($request->from_price > -1 && $request->to_price > 0){
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->whereBetween('products.price', [$request->from_price, $request->to_price])
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'DESC')
                    ->paginate($num);
                }else{
                    $products = Product::with(['pictures'  => function($query) {
                        $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                    }])
                    ->with(['likes'])
                    ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                    ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                    ->select('products.*')
                    ->where(function ($query) use ($key_search) {
                        $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                            ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                    })
                    ->where('products.status', '=', 1)
                    ->where('product_types.status', '=', 1)
                    ->where('categories.status', '=', 1)
                    ->orderBy('products.price', 'DESC')
                    ->paginate($num);
                }
            }
        }else{
            if($request->product_type_id && $request->from_price > -1 && $request->to_price > 0){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                ->whereBetween('products.price', [$request->from_price, $request->to_price])
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->paginate($num);
            }else if($request->product_type_id){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->Where('products.product_type_id', '=', (int) $request->product_type_id)
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->paginate($num);
            }else if($request->from_price > -1 && $request->to_price > 0){
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->whereBetween('products.price', [$request->from_price, $request->to_price])
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->paginate($num);
            }else{
                $products = Product::with(['pictures'  => function($query) {
                    $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
                }])
                ->with(['likes'])
                ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
                ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
                ->select('products.*')
                ->where(function ($query) use ($key_search) {
                    $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
                })
                ->where('products.status', '=', 1)
                ->where('product_types.status', '=', 1)
                ->where('categories.status', '=', 1)
                ->paginate($num);
            }
        }
        

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Tìm kiếm loại phẩm
    public function searchProductType(HttpRequest $request, $key_search)
    {
        $products = Product::join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
        ->select('product_types.*')
        ->where(function ($query) use ($key_search) {
            $query->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
                ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
                ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%');
        })
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->where('categories.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->distinct()
        ->get();

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Yêu thích sản phẩm
    public function likeProduct(HttpRequest $request)
    {
        try {
            $product_id = (int) $request->product_id;

            $user = Auth::user();

            $like = Like::where('user_id', '=', $user->id)
            ->where('product_id', '=', $product_id)
            ->first();

            $product = Product::where('id', $product_id)->first();

            if($like == null){
                Like::insert([
                    'product_id'=> $product_id,
                    'user_id'=> $user->id,
                ]);
                $product->update(['num_like' => $product->num_like + 1]);
            }else{
                $like->delete();
                $product->update(['num_like' => $product->num_like - 1]);
            }

            return response()->json(['status'=>0, 'data'=>'', 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }

    }

    //Danh sách sản phẩm yêu thích
    public function getAllProductLike()
    {
        try {
            $user = Auth::user();

            $products = Like::with(['product'])
            ->where('likes.user_id', '=', $user->id)
            ->orderBy('likes.id', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }

    }
}
