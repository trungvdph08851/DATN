<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\booking_schedule;
use App\Models\booking_services;
use App\Models\Services;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    //

    public function index(Request $request){

        $user = User::where('role', 2)->get();
        $user->load('services');
        $services = Services::all();
        $bookingServices = booking_services::where('status', BOOKING_SERVICES_ACCEPTED)->orWhere('status', BOOKING_SERVICES_REFRESH)->orderBy('created_at', 'asc')->get();
        $bookingServices->load('booking');
        $bookingServices->load('services');

        $doctorData = [];
        foreach ($user as $key => $value) {
            $doctorData[] = [
                "key" => $value->id,
                "label" => $value->name
            ];
        }
        $servicesData = [];
        foreach ($services as $key => $value) {
            $servicesData[] = [
                "key" => $value->id,
                "label" => $value->name
            ];
        }
        $bookingServicesAll = booking_services::where('status', BOOKING_SERVICES_SCHEDULED)
            ->orWhere('status', BOOKING_SERVICES_REFRESH)
            ->orWhere('status', BOOKING_SERVICES_FINISHED)
            ->get();
        $bookingServicesAll->load('booking');
        $bookingServicesAll->load('services');
        $list = [];
        foreach ($bookingServicesAll as $key => $value) {
            $start_time =  date("H:i:s", strtotime($value->start_date));
            $end_time =  date("H:i:s", strtotime($value->end_date));
            $status = "";
            if($value->status == BOOKING_SERVICES_SCHEDULED){
                $status = "Chờ khám";
            }elseif($value->status == BOOKING_SERVICES_REFRESH){
                $status = "Chờ xếp lại lịch";
            }elseif($value->status == BOOKING_SERVICES_FINISHED){
                $status = "Đã khám xong";
            }
            $list[] = [
                "id" => $value->id,
                "start_date" => $value->start_date,
                "end_date" => $value->end_date,
                "text" => $value->booking->booking_code . "<br/>" . "*" . $status  . "<br/>" .
                    'Tên : ' .  $value->booking->name. "<br/>" .
                    'ĐT: '  . $value->booking->phone_number . "<br/>".
                    'DV: '  . $value->services->name . "<br/>".
                    'Start: ' . $start_time . "<br/>" .
                    'End: ' . $end_time . "<br/> *" .
                    'Ghi chú: ' . $value->booking->note
                ,
                "sdt" => $value->booking->phone_number,
                "note" => $value->note,
                "doctor_id" => $value->doctor_id
            ];
        }
        $bookingSchedule = booking_schedule::where('status', BOOKING_SCHEDULE_SCHEDULED)->orWhere('status', BOOKING_SCHEDULE_FINISHED)->get();
        foreach ($bookingSchedule as $key => $value) {
            $start_time =  date("H:i:s", strtotime($value->start_date));
            $end_time =  date("H:i:s", strtotime($value->end_date));
            $bookingServicesData = booking_services::find($value->booking_services_id);
            $bookingServicesData->load('booking');
            $bookingServicesData->load('services');
            $status = "";
            if($value->status == BOOKING_SCHEDULE_SCHEDULED){
                $status = "Chờ khám định kỳ";
            }elseif($value->status == BOOKING_SCHEDULE_FINISHED){
                $status = "Đã khám định kỳ";
            }
            $list[] = [
                "id" => $value->id,
                "start_date" => $value->start_date,
                "end_date" => $value->end_date,
                "text" => '#' . $value->booking_id . " --- " . $status  . "<br/>" .
                    'Tên : ' .  $bookingServicesData->booking->name. "<br/>" .
                    'ĐT: '  . $bookingServicesData->booking->phone_number . "<br/>".
                    'DV: '  . $bookingServicesData->services->name . "<br/>".
                    'Start: ' . $start_time . "<br/>" .
                    'End: ' . $end_time . "<br/> *" .
                    'Ghi chú: ' . $value->note
                ,
                "sdt" => $bookingServicesData->booking->phone_number,
                "note" => $value->note,
                "doctor_id" => $value->doctor_id

            ];

        }
        return view('backend.timeline.index', compact( 'doctorData', 'list', 'servicesData', 'bookingServices', 'user'));
    }
    public function updateEndDate(Request $request){
        $dateTime = new DateTime($request->start_date);
        $dateTimeUpdate = date_add($dateTime ,date_interval_create_from_date_string($request->time . " minutes"));
        $end_date = $dateTimeUpdate->format('Y-m-d H:i:00');
        return response()->json([
            "date" => 'Đến:  <input type="text" class="form-control " id="'.$request->id.'_datepicker_end"
                                value="'. $end_date .'"
                                readonly=""
                                placeholder="Select date &amp; time">'
        ]);

    }
    public function addTimeLine(Request $request){
        
        $dateTime = new DateTime($request->start_date);
        $dateTimeUpdate = date_add($dateTime ,date_interval_create_from_date_string($request->time . " minutes"));
        $end_date = $dateTimeUpdate->format('Y-m-d H:i:00');

        $newTime = new DateTime($request->start_date);
        $startTime = $newTime->format('H:i');
        $endTime = $dateTimeUpdate->format('H:i');

        if ($startTime < "07:30") {
            echo '
            <p class="mt-1" style="color: red">Phòng khám mở cửa lúc 7h30 vui lòng chọn lại thời gian khám</p>
            ';
            die;
        }
        if ($endTime > "20:00") {
            echo '
            <p class="mt-1" style="color: red">Phòng khám đóng cửa lúc 20h00 vui lòng chọn lại thời gian khám</p>
            ';
            die;

        }
        $bookingServices = booking_services::all();
        foreach ($bookingServices as $bs) {
            if ($request->id != $bs->id) {
                if($bs->doctor_id == $request->doctor_id){
                    if ($request->start_date > $bs->start_date && $request->start_date < $bs->end_date
                        || $end_date > $bs->start_date && $end_date < $bs->end_date
                    ) {
                        echo '
                                <p class="mt-1" style="color: red">Thời gian khám bị trùng ! '.$bs->end_date.'</p>
                                ';
                        die;
                    }
                }
            }
        }
        $bookingSchedule = booking_schedule::all();
        $bookingSchedule->load('doctor');
        foreach ($bookingSchedule as $item) {
            if ($request->doctor_id == $item->doctor_id) {
                if ($request->start_date > $item->start_date && $request->start_date < $item->end_date
                    || $end_date > $item->start_date && $end_date < $item->end_date
                ) {
                    echo '
                            <p class="mt-1" style="color: red">Thời gian khám bị trùng với lịch hẹn ! '.$item->end_date.'</p>
                            ';
                    die;
                }
            }
        }
        $booking_services = booking_services::find($request->id);
        $bookingCheck = booking_services::where('booking_id', $booking_services->booking_id)->get();
        if (count($bookingCheck) > 0) {
            foreach ($bookingCheck as $key => $value) {
                if ($value->start_date != "") {
                    if ($request->start_date < $value->end_date) {
                        echo '
                            <p class="mt-1" style="color: red">Thời gian khám phải lớn hơn thời gian kết thúc của dịch vụ trước! '.$value->end_date.'</p>
                            ';
                        die;
                    }
                }
            }
        }
        $booking_services->doctor_id = $request->doctor_id;
        $booking_services->start_date = $request->start_date;
        $booking_services->end_date = $end_date;
        $booking_services->status = BOOKING_SERVICES_SCHEDULED;
        $booking_services->note = $request->note;
        $booking_services->save();

        // chuyển trạng thái khi đã xếp lịch song
        $booking_services->load('booking');
        $bkServices = booking_services::where('booking_id', $booking_services->booking->id)->get();
        $bkServices1 = booking_services::where('booking_id', $booking_services->booking->id)
            ->where('status', BOOKING_SERVICES_SCHEDULED)
            ->orWhere('booking_id', $booking_services->booking->id)
            ->where('status', BOOKING_SERVICES_FINISHED)
            ->get();
        if(count($bkServices) == count($bkServices1)){
            $bk = booking::find($booking_services->booking->id);
            $bk->status = BOOKING_SCHEDULED;
            $bk->save();
        }
    }

    public function update($id,Request $request){
        if (Auth::user()->role == 2) {
            return redirect()->back()->with('toastrWarning', 'Bạn không có quyền sửa !');
        }
        $bookingServices = booking_services::find($id);
        $bookingServices->doctor_id = $request->doctor_id;
        $bookingServices->start_date = $request->start_date;
        $bookingServices->end_date = $request->end_date;
        $bookingServices->note = $request->note;
        $bookingServices->save();
        // if ($booking->status == BOOKING_FINISHED) {
        //     return response()->json([

        //     ]);
        // }else if($booking->status == BOOKING_SCHEDULED){
        //     $booking->doctor_id = $request->doctor_id;
        //     $booking->start_date = $request->start_date;
        //     $booking->end_date = $request->end_date;
        //     $booking->note = $request->note;
        //     $booking->save();

        //     return response()->json([
        //         "action"=> "updated",
        //         "tid" => $booking->id
        //     ]);
        // }

    }

    public function destroy($id){
        if (Auth::user()->role == 2) {
            return redirect()->back()->with('toastrWarning', 'Bạn không có quyền xóa !');
        }
        $bookingServices = booking_services::find($id);
        $bookingServices->status = BOOKING_SERVICES_ACCEPTED;
        $bookingServices->start_date = null;
        $bookingServices->end_date = null;
        $bookingServices->save();

        $bookingServices->load('booking');
        $bookingServices->booking->status = BOOKING_ACCEPTED;
        $bookingServices->booking->save();
        return response()->json([
            "action"=> "deleted"
        ]);
        // $booking = booking::find($id);
        // if ($booking->status == BOOKING_FINISHED) {
        //     return response()->json([

        //     ]);
        // }else if($booking->status == BOOKING_SCHEDULED){
        //     $booking->status = BOOKING_ACCEPTED;
        //     $booking->start_date = null;
        //     $booking->end_date = null;
        //     $booking->save();
        //     return response()->json([
        //         "action"=> "deleted"
        //     ]);
        // }
    }

}
