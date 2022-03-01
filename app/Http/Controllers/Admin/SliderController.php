<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\article;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\backend\SliderRequest;
use App\Http\Requests\backend\SliderUpdateRequest;
class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('backend.slider.index',['sliders'=>$sliders]);
    }
    public function add(){
        return view('backend.slider.add');
    }
    public function store(SliderRequest $request)
    {
        $slider = new Slider();
        $slider->fill($request->all());
        if($request->hasFile('image')){
            $file = $request->file('image')->move('img', uniqid() . '-' . $request->image->getClientOriginalName());
            $slider->image = $file;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Thêm slider thành công');
    }
    public function edit($id){
        $slider = Slider::find($id);
        return view('backend.slider.edit',['slider'=>$slider]);
    }
    public function saveEdit($id, SliderUpdateRequest $request){
        $slider = Slider::find($id);
        $slider->fill($request->all());
        if($request->hasFile('image')){
            $file = $request->file('image')->move('img', uniqid() . '-' . $request->image->getClientOriginalName());
            $slider->image = $file;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Sửa slider thành công');
//        return view('backend.slider.edit',['slider'=>$slider]);
    }
    public function deleteEdit($id){
        $slider = Slider::find($id);
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Xoa slider thành công');
    }
    public function changeStatus(Request $request){
        $slider = Slider::find($request->id);
        $slider->status = $request->status;
        $slider->save();
        return response()->json(['success'=>'cập nhật thành công']);
    }
}
//quang
//1
