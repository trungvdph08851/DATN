<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_schedule;
use App\Models\booking_services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor_services;
use App\Models\Services;
class UserController extends Controller
{
    //
    public function index(){
        $user = User::all();
        return view('backend.user.index', compact('user'));
    }
    public function addUser()
    {
        $data = Services::get('id','name');
        return view('backend.user.add',['data'=>$data]);
    }
    public function saveAddUser(Request $request){
        $user = new User();
        $user->fill($request->all());
        if($request->hasFile('avatar')){
            $file = $request->file('avatar')->move('img', uniqid() . '-' . $request->avatar->getClientOriginalName());
            $user->avatar = $file;
        }
        $user->password = Hash::make($request->password);
        $user->save();
            if($request->has('services_id')){
                foreach ($request->services_id as $item) {
                    $doctor_services = new Doctor_services();
                    $doctor_services->doctor_id = $user->id;
                    $doctor_services->service_id = $item;
                    $doctor_services->save();
                }
            }
        return redirect()->route('user.index')->with('toastrSuccess', 'Tạo tài khoản thành công !');
    }
    public function editUser($id){
        $user = User::find($id);
        $user->load('services');
        $services = Services::all();
        return view('backend.user.edit', compact('user', 'services'));
    }
    public function saveEditUser($id, Request $request){
        $user = User::find($id);
        if ($user->role == 2 && $request->role != 2) {
            $services = booking_services::where('doctor_id', $id)->get();
            $schedule = booking_schedule::where('doctor_id', $id)->get();
            if (count($services) > 0 || count($schedule) > 0) {
                return redirect()->back()->with('warning', 'Bạn không thể thay đổi quyền của user này !');
            }
        }
        $user->fill($request->all());
        if($request->hasFile('avatar')){
            $file = $request->file('avatar')->move('img', uniqid() . '-' . $request->avatar->getClientOriginalName());
            $user->avatar = $file;
        }
        if($request->newPassword != ""){
            $user->password = Hash::make($request->newPassword);
        }
        
        $user->save();
            if ($request->has('services_id')) {
                Doctor_services::where('doctor_id' , $id)->delete();
                foreach ($request->services_id as $item) {
                    $doctor_services = new Doctor_services();
                    $doctor_services->doctor_id = $user->id;
                    $doctor_services->service_id = $item;
                    $doctor_services->save();
                }
            }
        return redirect()->route('user.index')->with('success', 'Sửa tài khoản thành công !');
    }
    public function deleteUser($id){
        $check = User::find($id);
        if ($check->role == 1) {
            return redirect()->route('user.index')->with('toastrWarning', 'Không thể xóa admin !');
        }
        $checkBookingServices = booking_services::where('doctor_id', $id)->get();
        $checkBookingSchedule = booking_schedule::where('doctor_id', $id)->get();
        if (count($checkBookingServices) > 0 || count($checkBookingSchedule) > 0) {
            return redirect()->route('user.index')->with('toastrWarning', 'Không thể xóa bác sĩ đã được đặt khám !');
        }
        $check->delete();
        return redirect()->route('user.index')->with('toastrSuccess', 'Xóa tài khoản thành công !');
    }

    // lấy dịch vụ khi quyền là bác sĩ
    public function getServicesDoctor(Request $request){
        if ($request->has('id') && $request->id == 2) {
            $services = Services::all();
            $data = [];
            if ($request->has('userId')) {
                $user = User::find($request->userId);
                $user->load('services');
                foreach ($services as $value) {
                    $a = '';
                    foreach ($user->services as $us) {
                        if ($us->id == $value->id) {
                            $a = 'checked';
                        }
                    }
                    $data[] = '<div class="col-2">
                                <label class="m-checkbox m-checkbox--success">
                                        <input type="checkbox" name="services_id[]" '.$a.' value="'.$value->id.'"> '.$value->name.'
                                        <span></span>
                                </label>
                            </div>';
                }
            }else{
                foreach ($services as $value) {
                    $data[] = '<div class="col-2">
                                    <label class="m-checkbox m-checkbox--success">
                                        <input type="checkbox" name="services_id[]" value="'.$value->id.'"> '.$value->name.'
                                        <span></span>
                                    </label>
                                </div>';
                }
            }
            $text = implode(' ', $data);
            return response()->json([
                "data" => '<label for="exampleInputPassword1">Dịch vụ bác sĩ</label>
                            <div class="row">
                                '.$text.'
                            </div>'
            ]);
        }else{
            return response()->json([
                "data" => ''
            ]);
        }
    }

}
