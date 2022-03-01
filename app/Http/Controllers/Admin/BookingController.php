<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\booking_services;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Requests\backend\BookingStoreRequest;
use App\Models\booking_schedule;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //tất cả lịch khám
    public function index(Request $request)
    {
        $searchData = $request->except('page');
        if ($request->has('date')) {
            $start = new DateTime($request->date);
            $end = date_add( new DateTime($request->date) ,date_interval_create_from_date_string( 1 . "day"));
            $end_date =  $end->format("Y-m-d 00:00:00");
            $start_date = $start->format("Y-m-d 00:00:00");
        }

        if(count($request->all()) == 0){
            $booking = booking::orderBy('created_at', 'DESC')->where('status', '!=', BOOKING_REJECTED)->get();
        }else{
            $bookings = booking::orderBy('created_at', 'DESC');
            if($request->has('status') && $request->status != ""){
                $bookings->where('status', $request->status);
            }
            if($request->has('date') && $request->date != ""){
                $bookings->where('created_at', '>=', $start_date)->where('created_at', '<', $end_date);
            }
            $booking = $bookings->get();
        }
        $booking->load('services');
        $booking->load('bookingSchedule');
        $booking->load('bookingServices');
        $user = User::where('role', 2)->get();
        $user->load('services');
        $services = Services::all();
        $bookingSchedule = booking_schedule::orderBy('start_date', 'asc')->get();
        $bookingSchedule->load('doctor');
        return view('backend.booking.index', compact('booking', 'bookingSchedule', 'user' ,'services', 'searchData'));
    }
    public function Add()
    {
        $services = Services::where('status', 1)->get();
        return view('backend.booking.add', compact('services'));
    }

    public function saveAdd(BookingStoreRequest $request)
    {
        // dd($request->all());
        $booking = new booking();
        $booking->fill($request->all());
        $price = [];
        if ($request->has('services_id')) {
            foreach ($request->services_id as $key => $value) {
                $services = Services::where('id', '=', $request->services_id[$key])->first();
                $price[] = $services->price;
            }
        }
        $sum = array_sum($price);
        $booking->price = $sum;
        $booking->status = BOOKING_ACCEPTED;
        $booking->save();
        $booking->booking_code = '#' . $booking->id;
        $booking->save();


        if ($request->has('services_id')) {
            foreach ($request->services_id as $key => $value) {
                $booking_services = new booking_services();
                $booking_services->services_id = $request->services_id[$key];
                $booking_services->booking_id = $booking->id;
                $booking_services->status = BOOKING_SERVICES_ACCEPTED;
                $booking_services->save();
            }
        }

        return redirect()->route('timeline.index')->with('toastrSuccess', 'Tạo đơn khám thành công');
    }
    public function edit($id)
    {
        $booking = booking::find($id);
        if (!$booking) {
            return redirect()->back();
        }
        $booking->load('services');
        $services = Services::where('status', 1)->get();
        return view('backend.booking.edit', compact('booking', 'services'));
    }

    public function saveEdit($id, Request $request)

    {
        $booking = booking::find($id);
        if (!$booking) {
            return redirect()->back();
        }
        $booking->fill($request->all());
        $price = [];
        if ($request->has('services_id')) {
            foreach ($request->services_id as $key => $value) {
                $services = Services::where('id', '=', $request->services_id[$key])->first();
                $price[] = $services->price;
            }
        }
        $sum = array_sum($price);
        $booking->price = $sum;
        $bookingServices = booking_services::where('booking_id', $id)->get();
        $arr = [];
        if ($request->status == BOOKING_PENDING) {
            $booking->status = BOOKING_ACCEPTED;
        }else{
            if (count($bookingServices) > 0 && $request->has('services_id')) {
                foreach ($bookingServices as $key => $value) {
                    $arr[] += $value->services_id;
                }
                $soSanh1 = array_diff( $request->services_id, $arr);
                if(count($soSanh1) > 0){
                    $booking->status = BOOKING_ACCEPTED;
                }
            }
        }
        $booking->booking_code = '#' . $request->id;
        $booking->save();
            if ($request->has('services_id')) {
                if ($request->status == BOOKING_PENDING) {
                    booking_services::where('booking_id', $id)->delete();
                    foreach ($request->services_id as $key => $value) {
                        $booking_services = new booking_services();
                        $booking_services->services_id = $request->services_id[$key];
                        $booking_services->booking_id = $booking->id;
                        $booking_services->status = BOOKING_SERVICES_ACCEPTED;
                        $booking_services->note = $booking->note;
                        $booking_services->save();
                    }
                }else{
                    if (count($bookingServices) > 0 && $request->has('services_id')) {
                        $filter1 = array_diff($arr, $request->services_id);
                        $filter2 = array_diff( $request->services_id, $arr);
                        foreach ($filter1 as $value) {
                            $idServices = booking_services::where('booking_id', $id)->where('services_id', $value)->first();
                            booking_schedule::where('booking_services_id', $idServices->id)->delete();
                            booking_services::where('booking_id', $id)->where('services_id', $value)->delete();
                        }
                        foreach ($filter2 as $value) {
                            $booking_services = new booking_services();
                            $booking_services->services_id = $value;
                            $booking_services->booking_id = $booking->id;
                            $booking_services->status = BOOKING_SERVICES_ACCEPTED;
                            $booking_services->note = $booking->note;
                            $booking_services->save();
                        }
                    }else{
                        if ($request->has('services_id')) {
                            foreach ($request->services_id as $key => $value) {
                                $booking_services = new booking_services();
                                $booking_services->services_id = $request->services_id[$key];
                                $booking_services->booking_id = $booking->id;
                                $booking_services->status = BOOKING_SERVICES_ACCEPTED;
                                $booking_services->note = $booking->note;
                                $booking_services->save();
                            }
                        }
                    }
                }
            }


        // if ($booking->status != BOOKING_FINISHED) {   // Nếu đã khám xong thì không sửa dịch vụ
        // booking_services::where('booking_id', $booking->id)->delete();
        // }

        if ($booking->status == BOOKING_ACCEPTED) {
            return redirect()->route('timeline.index')->with('toastrSuccess', 'Xếp lịch hẹn mới');
        }else{
            return redirect()->route('booking.index')->with('toastrSuccess', 'Cập nhật lịch hẹn thành công');
        }

    }
    // tạo lịch khám định kỳ
    public function addSchedule($id){
        $bookingServices = booking_services::find($id);
        $bookingServices->load('booking');
        $bookingServices->load('services');
        $bookingServices->load('doctor');
        $bookingServices->load('bookingSchedule');
        $user = User::where('role', 2)->get();

        $bookingSchedule = booking_schedule::orderBy('start_date', 'asc')->get();
        return view('backend.booking.add-schedule', compact('bookingServices', 'user' , 'bookingSchedule'));
    }
    public function saveSchedule(Request $request){
        if ($request->has('remove')) {
            booking_schedule::destroy($request->id);
            return response()->json([
                "msg" => ''
            ]);
        }

        // tạo date time
        $date_start_get = new DateTime($request->date . ' ' . $request->time_start);
        $date_end_get = new DateTime($request->date . ' ' . $request->time_end);
        // format dateTime
        $date_start = $date_start_get->format("Y-m-d H:i:00");
        $date_end = $date_end_get->format("Y-m-d H:i:00");
        // format time
        $time_start = $date_start_get->format("H:i");
        $time_end = $date_end_get->format("H:i");




        $bookingServicesAll = booking_services::all();
        $bookingServices = booking_services::find($request->idServices);
        $bookingServices->load('booking');
        $bookingSchedule = booking_schedule::all();

        if ($request->has('id') && $request->has('date') && $request->has('time_start')
            && $request->has('time_end') && $request->has('doctor_id')
            && $request->has('note') && $request->has('status')) {
            // kiểm tra thời gian bỏ trống và thời gian bắt đầu
            if ($request->date == "" || $request->time_start == "" || $request->time_end == "") {
                return response()->json([
                    "msg" => '<div class="error  mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <strong class="error">Lỗi !</strong> Ngày và thời gian không được để trống.
                                </div>'
                ]);
            }
            if ($date_start >= $date_end) {
                return response()->json([
                    "msg" => '<div class="error mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong class="error">Lỗi !</strong> Thời gian bắt đầu phải lớn hơn thời gian kết thúc.
                            </div>'
                ]);
            }
            if ($time_start < "07:30") {
                return response()->json([
                    "msg" => '<div class="error mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong class="error">Lỗi !</strong> Phòng khám mở cửa lúc 7h30 vui lòng chọn lại thời gian khám.
                            </div>'
                ]);
            }
            if ($time_start > "20:00") {
                return response()->json([
                    "msg" => '<div class="error mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong class="error">Lỗi !</strong> Phòng khám đóng cửa lúc 20h00 vui lòng chọn lại thời gian khám.
                            </div>'
                ]);
            }

            // booking
            foreach ($bookingServicesAll as $bs) {
                $date_bsStart_get = new DateTime($bs->start_date);
                $date_bsEnd_get = new DateTime($bs->end_date);
                $date = $date_bsStart_get->format("d-m-Y");
                $timeStart = $date_bsStart_get->format("H:i");
                $timeEnd = $date_bsEnd_get->format("H:i");

                if($bs->doctor_id == $request->doctor_id){
                    if ($date_start > $bs->start_date && $date_start < $bs->end_date
                        || $date_end > $bs->start_date && $date_end < $bs->end_date)
                    {
                        return response()->json([
                            "msg" => '<div class="error mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        </button>
                                        <strong class="error">Lỗi !</strong> Thời gian khám đã trùng với lịch khám.</br>
                                        Ngày: '.$date.' / Thời gian: '.$timeStart.' - '.$timeEnd.'.
                                    </div>'
                        ]);
                    }
                }
            }

            // booking schedule
            foreach ($bookingSchedule as $bs) {
                $date_bsStart_get = new DateTime($bs->start_date);
                $date_bsEnd_get = new DateTime($bs->end_date);
                $date = $date_bsStart_get->format("d-m-Y");
                $timeStart = $date_bsStart_get->format("H:i");
                $timeEnd = $date_bsEnd_get->format("H:i");
                if ($bs->id != $request->id) {
                    if ($date_start >= $bs->start_date && $date_start <= $bs->end_date
                    || $date_end >= $bs->start_date && $date_end <= $bs->end_date)
                        {
                            if($bs->doctor_id == $request->doctor_id){
                                return response()->json([
                                    "msg" => '<div class="error mt-3 alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong class="error">Lỗi !</strong> Thời gian khám đã trùng với lịch khám đặt trước.</br>
                                                Ngày: '.$date.' / Thời gian: '.$timeStart.' - '.$timeEnd.'.
                                            </div>'
                                ]);
                            }
                        }
                }
            }

            $check = booking_schedule::find($request->id);
            if ($check == "") {
                $booking_schedule = new booking_schedule();
                $booking_schedule->booking_services_id = $request->idServices;
                $booking_schedule->booking_id = $bookingServices->booking->id;
                $booking_schedule->doctor_id = $request->doctor_id;
                $booking_schedule->start_date = $date_start;
                $booking_schedule->end_date = $date_end;
                $booking_schedule->note = $request->note;
                $booking_schedule->status = $request->status;
                $booking_schedule->save();
                return response()->json([
                    "msg" => ""
                ]);
            }else{
                $check->booking_services_id = $request->idServices;
                $check->booking_id = $bookingServices->booking->id;
                $check->doctor_id = $request->doctor_id;
                $check->start_date = $date_start;
                $check->end_date = $date_end;
                $check->note = $request->note;
                $check->status = $request->status;
                $check->save();
                return response()->json([
                    "msg" => ""
                ]);
            }
        }
    }
    public function remove($id)
    {
        booking::destroy($id);
        // booking_schedule::where('booking_id' , $id)->delete();
        booking_services::where('booking_id' , $id)->delete();
        booking_schedule::where('booking_id', $id)->delete();
        return redirect()->route('booking.index')->with('toastrWarning', 'Xóa lịch hẹn thành công');
    }

    // hàng chờ khám
    
    public function waitingLine(){
        // hàng chờ theo dịch vụ
        if(Auth::user()->role == 2){
            $bookingServices = booking_services::where('doctor_id', Auth::user()->id)->where('status' , BOOKING_SERVICES_SCHEDULED)->orderBy('start_date', 'asc')->get();
        }else{
            $bookingServices = booking_services::where('status' , BOOKING_SERVICES_SCHEDULED)->orderBy('start_date', 'asc')->get();
        }
        $bookingServices->load('booking');
        $bookingServices->load('services');
        $bookingServices->load('doctor');
        /*Hàng chờ khám định kỳ */
        if(Auth::user()->role == 2){
            $bookingSchedule = booking_schedule::where('doctor_id', Auth::user()->id)->where('status', BOOKING_SCHEDULE_SCHEDULED)->orderBy('start_date', 'asc')->get();
        }else{
            $bookingSchedule = booking_schedule::where('status', BOOKING_SCHEDULE_SCHEDULED)->orderBy('start_date', 'asc')->get();
        }
        $bookingSchedule->load('booking');
        $bookingSchedule->load('bookingServices');
        $bookingSchedule->load('doctor');
        $servicesAll = Services::all();
        return view('backend.booking.waitingLine', compact( 'bookingSchedule', 'bookingServices', 'servicesAll'));
    }

    // đơn khám hôm nay
    public function waitingLineToday(){
        $time = Carbon::now();
        $today = $time->format('Y-m-d 00:00:00');
        $todayEnd = $time->format('Y-m-d 23:59:59');
        if(Auth::user()->role == 2){
            $booking_services = booking_services::where('start_date', '>=', $today)
                                                ->where('start_date', '<=', $todayEnd)
                                                ->where('doctor_id', Auth::user()->id)
                                                ->where('status', BOOKING_SERVICES_SCHEDULED)
                                                ->orderBy('start_date', 'asc')
                                                ->get();
            $booking_schedule = booking_schedule::where('start_date', '>=', $today)
                                                ->where('start_date', '<=', $todayEnd)
                                                ->where('doctor_id', Auth::user()->id)
                                                ->where('status', BOOKING_SCHEDULE_SCHEDULED)
                                                ->orderBy('start_date', 'asc')
                                                ->get();
        }else{
            $booking_services = booking_services::where('start_date', '>=', $today)
                                                    ->where('start_date', '<=', $todayEnd)
                                                    ->where('status', BOOKING_SERVICES_SCHEDULED)
                                                    ->orderBy('start_date', 'asc')
                                                    ->get();
            $booking_schedule = booking_schedule::where('start_date', '>=', $today)
                                                    ->where('start_date', '<=', $todayEnd)
                                                    ->where('status', BOOKING_SCHEDULE_SCHEDULED)
                                                    ->orderBy('start_date', 'asc')
                                                    ->get();
        }
        $booking_services->load(['booking','services','doctor']);
        $booking_schedule->load(['booking','bookingServices','doctor']);
        $servicesAll = Services::all();

        return view('backend.booking.waitingLineToday', compact( 'booking_services', 'booking_schedule','servicesAll'));

    }
    // đơn khám lần đầu
    public function saveWaitingLine(Request $request){
        $bookingSv = booking_services::find($request->id);
        $bookingSv->note = $request->note;
        $bookingSv->status = BOOKING_SERVICES_FINISHED;
        $bookingSv->save();

        $bookingSv->load('booking');
        $count1 = booking_services::where('booking_id', $bookingSv->booking->id)->get();
        $count2 = booking_services::where('booking_id', $bookingSv->booking->id)->where('status', BOOKING_SERVICES_FINISHED)->get();
        if(count($count1) == count($count2)){
            $bk = booking::find($bookingSv->booking->id);
            $bk->status = BOOKING_FINISHED;
            $bk->save();
        }

    }
    // khám định kỳ
    public function saveWaitingLineSchedule(Request $request){
        $bookingSchedule = booking_schedule::find($request->id);
        $bookingSchedule->note = $request->note;
        $bookingSchedule->status = BOOKING_SCHEDULE_FINISHED;
        $bookingSchedule->save();

    }
    // xuất hóa đơn
    public function xuathoadon($id){
        $booking = booking::find($id);
        $booking->load(['bookingServices','services']);
        return view('backend.booking.invoi', compact('booking'));
    }
    // hủy đơn
    public function cancelOrder(Request $request){
        $booking = booking::find($request->id);
        if (!$booking) {
            return redirect()->back();
        }
        $booking->status = BOOKING_REJECTED;
        $booking->note = $request->reason;
        $booking->save();

        booking_schedule::where('booking_id', $request->id)->delete();
        $booking_services = booking_services::where('booking_id', $request->id)->get();
        if (!$booking_services) {
            return redirect()->back();
        }
        foreach ($booking_services as $key => $value) {
            $value->status = BOOKING_REJECTED;
            $value->doctor_id = null;
            $value->start_date = null;
            $value->end_date = null;
            $value->save();
        }
        return response()->json([
            "msg" => ''
        ]);
    }
    // Đơn hủy
    public function listCancelOrder(){
        $booking = booking::where('status', BOOKING_REJECTED)->orderBy('updated_at', 'DESC')->get();
        $booking->load('services');
        return view('backend.booking.cancel-order', compact('booking'));
    }
    // khôi phục đơn
    public function restoreOrder($id){
        $booking = booking::find($id);
        if(!$booking){
            return redirect()->back();
        }
        $booking->status = BOOKING_ACCEPTED;
        $booking->save();

        $booking_services = booking_services::where('booking_id', $id)->get();
        foreach ($booking_services as $key => $value) {
            $value->status = BOOKING_SERVICES_ACCEPTED;
            $value->save();
        }
        return redirect()->route('list.cancel.order')->with('toastrSuccess','Khôi phục đơn khám thành công');
    }
    public function gui_tin_nhan($id){
        $booking = booking::find($id);
        $booking->load(['bookingServices','services']);
        $phone = ltrim( "$booking->phone_number", 0);
        $phonesend = '+84'.$phone;
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
		$sumPrice = 0;
        $msg = '';
        $msg .= "Họ tên khách hàng: ".$booking->name.".";
        $msg .= "Số điện thoại: ".$booking->phone_number.".";
		foreach ($booking->bookingServices as $i => $item) {
            $item->load('doctor');
            $item->load('services');
            $msg .= "*Dịch vụ khám ".$item->services->name.".";
            $msg .= "Bác sĩ :".$item->doctor->name.".";
            $msg .= "Thời gian"."($item->start_date - $item->end_date)".".";
            $sumPrice += $item->services->price;

		}
        $msg .= "Tổng tiền thanh toán: ".$sumPrice."vnd".".";
        $msg .= "Địa chỉ: Hà Nội.";
        $msg .= "Cảm ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi";
        $message = $twilio->messages
            ->create($phonesend, // to
                array(
                    "messagingServiceSid" => "MG1056032c4bdc2b25230c9e9baf456db4",
                    "body" => "Thông tin lịch khám của bạn: ".$msg
                )
            );
        return back()->with('success', 'Gửi tin nhắn cho khách hàng thành công !');
    }
}
//public function gui_tin_nhan($id){
//    $booking = booking::find($id);
//    $booking->load(['bookingServices','services']);
//    $phone = ltrim( "$booking->phone_number", 0);
//    $phonesend = '+84'.$phone;
//    $token = getenv("TWILIO_AUTH_TOKEN");
//    $twilio_sid = getenv("TWILIO_SID");
//    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
//    $twilio = new Client($twilio_sid, $token);
//    $sumPrice = 0;
//    $msg = '';
//    $msg .= "Họ tên khách hàng: ".$booking->name.'</br>';
//    $msg .= "Số điện thoại: ".$booking->phone_number.'</br>';
//    foreach ($booking->bookingServices as $i => $item) {
//        $item->load('doctor');
//        $item->load('services');
//        $msg .= "*Dịch vụ khám ".$item->services->name." :"."</br>"."Bác sĩ :".$item->doctor->name."</br>"."Thời gian"."($item->start_date - $item->end_date)"."</br>";
//        $sumPrice += $item->services->price;
//
//    }
//    $msg .= "Tổng tiền thanh toán: ".$sumPrice."vnd"."</br>";
//    $msg .= "Địa chỉ: Hà Nội"."</br>";
//    $msg .= "Cảm ơn quý khách đã ...";
//    $message = $twilio->messages
//        ->create($phonesend, // to
//            array(
//                "messagingServiceSid" => "MG1056032c4bdc2b25230c9e9baf456db4",
//                "body" => "Thông tin lịch khám của bạn: ".'</br>'.$msg
//            )
//        );
//    return back();
//}
