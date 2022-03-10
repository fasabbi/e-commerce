<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    //subcategory teo add korte hobe
    function setting(){
        $setting=setting::all();
        return view('setting.index',compact('setting'));
    }
    function settingpost(Request $request){
        // dd(setting::all());
        // print_r($request->except('_token')) ;
        // die();
        foreach ($request->except('_token') as $key => $value) {
            setting::where('setting_name',$key)->update([
                'setting_value'  => $value
            ]);
        }
        return back();
     
    }
}
