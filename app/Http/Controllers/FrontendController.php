<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cupon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_details;
use Carbon\Carbon;
use Hash;
use Auth;

class FrontendController extends Controller
{
      function home()
    {
        $categories=Category::all();
        $products=Product::latest()->limit(4)->get();
        return view('welcome',compact('categories','products'));
    }
      function productdetails($product_id)
    {
      $product_category_id=Product::find($product_id)->category_id;
      $product_info=Product::find($product_id);
      $related_products=Product::where('category_id',$product_category_id)->where('id','!=',$product_id)->get();
        $products=Product::all();
        return view('product.details',compact('product_info','products','related_products'));
    }
    function shop(){
        $all_product=Product::inRandomOrder()->get();
        $categories=Category::all();
      return view('shop',compact('all_product','categories'));
    }
    function categorywise($category_id){
      $products=Product::where('category_id',$category_id)->get();
      return view('categorywise',compact('products'));
    }


    function cart($cupon_name = ""){
      $cupon_discount = 0;
      if ($cupon_name == "") {
        $cupon_discount =0;
      }
      else{
        // echo $cupon_name;
        // echo  Cupon::all();
        // die();
        if (Cupon::where('cupon_name',$cupon_name)->exists()) {

          if( Carbon::now()->format('Y-m-d') >
          Cupon::where('cupon_name',$cupon_name)->first()->expire_date){
              return back()->with('error','cupon date expired');                   
          }
          else{
            if (Cupon::where('cupon_name',$cupon_name)->first()->usage_limit > 0) {
              $cupon_discount = Cupon::where('cupon_name',$cupon_name) ->first()->discount_amount;
          }
            else{
              return back()->with('error','limit expired');                   
            }
              }
        }
          else{
            return back()->with('error','cupon not found');
          }
        }
          
     
      return view('cart',[
      'carts'=>Cart::where('ip_address',request()->ip())->get(),
      'cupon_discount' =>  $cupon_discount,
      'cupon_name' =>  $cupon_name,
      ]);
    }


    function updatecart(Request $request){
      foreach($request->quantity as  $cart_id=>$quantity){
        if (Product::find(Cart::find($cart_id)->product_id)->product_quantity>=$quantity) {
          Cart::find($cart_id)->update([
          'quantity'=>$quantity
        ]);
        }
      }
      // dd($request->quantity);
      return back();
    }
    
    
    function checkout(){
      // foreach($request->quantity as  $cart_id=>$quantity){
      //   if (Product::find(Cart::find($cart_id)->product_id)->product_quantity>=$quantity) {
      //     Cart::find($cart_id)->update([
        //     'quantity'=>$quantity
      //   ]);
      //   }
      // }
      return view('checkout');
    }
    
    function customerregister(){
      return view('customerregister');
    }
    
    function customerregisterpost(Request $request){
    //  dd($request);
     User::insert([
       'name' => $request->name,
       'email' => $request->email,
       'password' => bcrypt($request->password),
       'role' => 2,
       'created_at' => Carbon::now(),
       ]);
       return back();
      // return view('customerregisterpost');
    }    
    
    function customerlogin(){
      return view('customerlogin');
    }    
    
    function customerloginpost(Request $request){
    
      if (User::where('email',$request->email)->exists()) {

     $db_password = User::where('email',$request->email)->first()->password;

       if (Hash::check($request->password , $db_password)) {
      
      //  return view('customer.dashboard');
        if (Auth::attempt($request->except('_token'))) {
          return redirect()->intended('/home');
        }
         
       }  

       else {
             return back()->with('cus_login_err','404');
       }
      

      }
      else {
            return back()->with('cus_login_err','404');
      }
    
      
    }    

    function checkoutpost(Request $request){
     
      if ($request->payment_option == 1) {

      if ($request->payment_option == 2) {
        $order_id = Order::insertGetId( $request->except('_token')+[
                    'payment_option' =>('credit, cash on delivery'),
           ]);
          }
          else{
          $order_id = Order::insertGetId( $request->except('_token')+[
                      'payment_option' => ('credit'),  
             ]);
        }
      }
      if ($request->payment_option == 2) {

      if ($request->payment_option == 1) {
        $order_id = Order::insertGetId( $request->except('_token')+[
                    'payment_option' =>('credit, cash on delivery'),

           ]);
          }
          else{
          $order_id = Order::insertGetId( $request->except('_token')+[
                      'payment_option' => ('cash on delivery'),
  
             ]);
        }
      }

      else {
           $order_id = Order::insertGetId( $request->except('_token')+[
                    'user_id' => Auth::id(),
                    'payment_status' => 1,
                    'discount'  => session('session_cupon_discount'),
                    'subtotal'  => session('session_subtotal'),
                    'total'  => session('session_total'),
                    'created_at'=> Carbon::now()
           ]);
          $carts = Cart::where('ip_address',request()->ip())->select('id','product_id','quantity')->get();

            foreach ($carts as $ccc) {            
              Order_details::insert([
              'order_id'=>$order_id,
              'product_id'=>$ccc->product_id,
              'quantity'=>$ccc->quantity,
              'created_at'=>Carbon::now()
            ]);
                Product::find($ccc->product_id)->decrement('product_quantity',$ccc->quantity);
                Cart::find($ccc->id)->delete();
          }
          return back();
          }
    }

}

