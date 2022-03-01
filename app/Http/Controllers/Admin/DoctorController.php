<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests\backend\DoctorRequest;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{

    public function index(){
        $doctors = Doctor::all();
        return view('backend.doctor.index', compact('doctors'));

    }

    // add
    public function add(){
        $model = new Doctor();
        return view('backend.doctor.form', compact('model'));
    }

    public function edit($id){
        $model = Doctor::find($id);
        if(!$model) return view('backend.404');
        return view('backend.doctor.form', compact('model'));
    }


    public function save(DoctorRequest $request){
        if($request->id){
            $model = Doctor::find($request->id);
            if(!$model) return view('backend.404');
        }else{
            $model = new Doctor();
        }

        $model->fill($request->all());
        if($request->hasFile('avatar')){
            $file = $request->file('avatar')->move('img', uniqid() . '-' . $request->avatar->getClientOriginalName());
            $model->avatar = $file;
        }
        $model->save();
        return redirect(route('doctor.index'));
    }

    // remove
    public function remove($id){
        $model = Doctor::find($id);
        if(!$model) return view('backend.404');
        if(File::exists($model->avatar)) {
            File::delete($model->avatar);
        }
        $model->delete();
        return redirect()->route('doctor.index')->with('success', 'Xóa thành công');
    }

}
