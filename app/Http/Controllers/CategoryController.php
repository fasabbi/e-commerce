<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Product;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function category(){
        $categories = Category::all();
        $deletedcategories = Category::onlyTrashed()->get();
        return view('category.index',compact('categories','deletedcategories'));
    }
    function categorypost(Request $request){
         $request->validate([
             'category_name' => 'required|unique:categories,category_name'
         ]);
        // echo $request->category_name;

        $category_id = Category::insertGetId([
        'category_name'=>$request->category_name,    
        'created_at'=>Carbon::now()
        ]);
        subcategory::insert([
        'category_id'        => $category_id,
        
        'subcategory_name'=>$request->subcategory_name,    
        'created_at'          =>Carbon::now(),
        ]);

        return back()->with('status', ' " '   .$request->category_name. ' " Added successfully ');
    }


                function category_delete($category_id){
                Category::where('id',$category_id)->exists();{
                    // age chech korbe
                Category::find($category_id)->delete();}
                
                Product::where('category_id',$category_id)->delete();
                //oi category er product gula o delete hobe
                return back();
                }

                function categoryalldelete(){

                // Category::truncate(); (sob full delete hoye jay)
                Category::whereNull('deleted_at')->delete();
                return back();

                }

            function categoryedit($category_id){
            $category_info = Category::find($category_id);
            return view('category.edit',compact('category_info'));
            }
            //form er data dhorar jonno Request..... same to$POST
            //$request diye object dhora hoitese
            function categoryeditpost(Request $request){


            $request->validate([
            'category_name' => 'unique:categories,category_name'
            ]);

            Category::find($request->category_id)->update([
            'category_name'=>$request->category_name,

            'updated_at'=>Carbon::now()
            ]);

            return redirect('category');
        }


        function categoryrestore($category_id){
        Category::onlyTrashed()->where('id',$category_id)->restore();
        Product::onlyTrashed()->where('category_id',$category_id)->restore();
        return back();


    }
    function categoryforce($category_id){
       Category::onlyTrashed()->where('id',$category_id)->forceDelete();
       return back();
    }

}






// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class CategoryController extends Controller
// {
//     //
// }
