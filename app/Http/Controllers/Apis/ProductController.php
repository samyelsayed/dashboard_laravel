<?php

namespace App\Http\Controllers\Apis;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json(compact('products'),200);
    }


    public function create(){
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        return response()->json(compact('brands', 'Subcategories'),200);
    }

    public function edit($id){
        // $products = Product::where('id',$id)->first();
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        // $products = Product::findOrFail($id);       //لو ما لقاها يرمي ايرور
        $products = Product::find($id);             //فايند يعني واحد بس

        return response()->json(compact('products', 'brands', 'Subcategories'),200);
    }
}
