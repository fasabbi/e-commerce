<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subcategory;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = Category::all();
        $subcategories = subcategory::all();
        return view('subcategory.index',compact('categories','subcategories'));
    }
    function subcategorypost(Request $request){
    
        subcategory::insert([
            'category_id' => $request -> category_id,
            'subcategory_name' => $request -> subcategory_name,
            'created_at'=> Carbon::now(),
            ]);
            return back();
    }
}
