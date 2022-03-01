<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Requests\backend\ServicesRequest;
use Illuminate\Support\Facades\File;
use App\Models\booking_services;

class ServicesController extends Controller
{

    public function index(Request $request){
        $services = Services::all();
        return view('backend.services.index', compact('services'));

    }

    // add
    public function add(){
        $model = new Services();
        return view('backend.services.form', compact('model'));
    }

    public function edit($id){
        $model = Services::find($id);
        if(!$model) return view('backend.404');
        return view('backend.services.form', compact('model'));
    }


    public function save(ServicesRequest $request){
        if($request->id){
            $model = Services::find($request->id);
            if(!$model) return view('backend.404');
        }else{
            $model = new Services();
        }

        $model->fill($request->all());
        if($request->hasFile('image')){
            $file = $request->file('image')->move('img', uniqid() . '-' . $request->image->getClientOriginalName());
            $model->image = $file;
        }

        $model->status = $request->status == 1 ? 1 : 0;
        $model->save();
        return redirect(route('services.index'));
    }

    // remove
    public function remove($id){
        $model = Services::find($id);
        if(!$model) return view('backend.404');

        /// có ng book dv k được xóa
        $booking = booking_services::all();
        foreach ($booking as $b) {
            if($b->services_id == $id){
                return redirect()->back() ->with('alert', 'Không thể xóa do có người đặt dịch vụ !');
            }
        }

        if(File::exists($model->image)) {
            File::delete($model->image);
        }
        $model->delete();
        return redirect()->route('services.index')->with('success', 'Xóa thành công');
    }

    public function changeStatus(Request $request){
        $model = Services::find($request->id);
        $model->status = $request->status;
        $model->save();
        return response()->json(['success'=>'cập nhật thành công']);
    }
}
