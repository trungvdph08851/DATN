<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setting_system;
use DB;
class SettingSystemController extends Controller
{
    public function index(){
        $data = setting_system::all();
        return view('backend.setting.index',['setting'=>$data]);
    }
    public function add(){
        return view('backend.setting.form');
    }
    public function store(Request $request){
        $setting = new setting_system();
        $setting->fill($request->all());
        if($request->hasFile('logo')){
            $file = $request->file('logo')->move('img', uniqid() . '-' . $request->logo->getClientOriginalName());
            $setting->logo = $file;
        }
        $setting->save();
        return redirect()->route('setting.index')->with('toastrSuccess', 'Thêm thành công');
    }
    public function edit($id){
        $data = setting_system::find($id);
        return view('backend.setting.form',['data'=>$data]);
    }
    public function saveEdit($id, Request $request){
        $setting = setting_system::find($id);
        $setting->fill($request->all());
        if($request->hasFile('logo')){
            $file = $request->file('logo')->move('img', uniqid() . '-' . $request->logo->getClientOriginalName());
            $setting->logo = $file;
        }
        $setting->save();
        return redirect()->route('setting.index')->with('toastrSuccess', 'Sửa thành công');
    }
    public function delete($id){
        $setting = setting_system::find($id);
        $setting->delete();
        return redirect()->route('setting.index')->with('toastrSuccess', 'Xoá thành công');
    }
}
//quang
