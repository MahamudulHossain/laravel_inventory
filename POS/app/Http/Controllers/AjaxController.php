<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\Units;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getCategory(Request $req){
    	$supId = $req->supId;
    	$getCatData = DB::table('products')
    			  ->join('categories','categories.id' ,'=','products.category_id')
    			  ->select('products.category_id as catId','categories.name as catName')
    			  ->where('supplier_id',$supId)
    			  ->groupBy('category_id')
    			  ->get();
        return response()->json(['data'=>$getCatData]);
    }

    public function getProduct(Request $req){
    	$supId = $req->supId;
    	$catId = $req->catId;
    	$getProData = DB::table('products')
    			  ->select('products.id as proId','products.name as proName')
    			  ->where(['supplier_id'=>$supId,'category_id'=>$catId])
    			  ->get();
        return response()->json(['data'=>$getProData]);
    }
}
