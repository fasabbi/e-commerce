<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;

class cartController extends Controller
{
    function addtocart(REQUEST $request,$product_id){
        if (Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->exists()) {

        Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->increment('quantity',$request->quantity);
      
        } else {
            
            Cart::insert([
                'product_id'=>$product_id,
                'quantity'=>$request->quantity,
                'ip_address'=>request()->ip(),
                'created_at'=>Carbon::now(),
            ]);
        }
        
        return back(); 
    }
     
    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back(); 
    }
}
