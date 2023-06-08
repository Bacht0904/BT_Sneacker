<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    //DS danh mục
    public function getAllCategory()
    {
        $categories = Category::with(['product_types'])
        ->select(['*', DB::raw('CONCAT("assets/img/categories/", icon) AS icon')])
        ->where('status', '=', 1)
        ->orderBy('category_name')
        ->get();
        
        return response()->json(['status'=>0, 'data'=>$categories, 'message'=>'']);
    }
}
