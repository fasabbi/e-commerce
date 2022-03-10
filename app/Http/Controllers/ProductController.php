<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\subcategory;
use Carbon\Carbon;
use Image, Auth;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function product()
    {
        $categories = Category::all();
        $subcategories = subcategory::all();
        $products = Product::where('user_id',Auth::id())->get();
        return view('product.index',compact('categories','subcategories','products'));
    }

    function productpost(Request $request)
    {
    $random_name=Str::random(10).time().".". $request->product_photo->getClientOriginalExtension();
    $product_photo=$request->file('product_photo');


    Image::make($product_photo)->resize(283,293)->save(base_path('public/uploads/product/').$random_name,50);
		// 50% quality baki thakbe
    Product::insert($request->except('_token','product_photo') + [
    'product_photo'=>$random_name,
    'user_id'=> Auth::id(),
    'created_at'=>Carbon::now()
    ]);
    return back(); 
    
    // Product::insert([
    //         'product_name'=>$request->product_name,
    //         'product_price'=>$request->product_price,
    //         'product_quantity'=>$request->product_quantity,
    //         'product_short'=>$request->product_short,
    //         'product_long'=>$request->product_long,
    //         'product_alert'=>$request->product_alert,            
    //         'created_at'=>Carbon::now()
    //         ]);
    }
}
