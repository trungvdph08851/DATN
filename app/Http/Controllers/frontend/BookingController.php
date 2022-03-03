<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\booking_services;
use App\Models\Services;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Http\Requests\frontend\bookingRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\Send_mail_booking;
use App\Models\User;
//require_once '/path/to/vendor/autoload.php';
class BookingController extends Controller
{

    //
    public function index(){
        $services = Services::all();
        return view('frontend.booking', compact('services'));
    }
    public function verify_view(){
        return view('frontend.verify');
    }
    public function saveBooking(bookingRequest $request){
            $booking = new booking();
            $booking->fill($request->all());
            $booking->save();

            if ($request->has('services_id')) {
                $price = [];
                foreach ($request->services_id as $key => $item) {
                    $services = Services::where('id', '=', $item)->first();
                    $price[] = $services->price;
                    $booking_services = new booking_services();
                    $booking_services->services_id = $item;
                    $booking_services->booking_id = $booking->id;
                    $booking_services->status = BOOKING_PENDING;
                    $booking_services->save();
                }

                $bookingSum = booking::find($booking->id);
                $sum = array_sum($price);
                $bookingSum->price = $sum;
                $bookingSum->save();
                $nhan_vien = User::where('role', 0)->get('email');
                $bk = booking_services::where('booking_id', $booking->id)->get('services_id');
                $bksv = $bk->load('services');
                $dataMail = [
                    'nam' => $booking->name,
                    'phone' => $booking->phone_number,
                    'service' => $bksv,
                    'link' => route('booking.edit', ['id' => $booking->id])
                ];
                foreach ($nhan_vien as $nv) {
                    Mail::to($nv->email)->send(new Send_mail_booking($dataMail));
                }
            return redirect()->route('booking')->with('success','Đặt lịch khám thành công');

            }
        // $phone = ltrim( "$request->phone_number", 0);
        // $phonesend = '+84'.$phone;
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio_sid = getenv("TWILIO_SID");
        // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        // $twilio = new Client($twilio_sid, $token);
//        $message = $twilio->messages
//            ->create("+84971052857", // to
//                array(
//                    "messagingServiceSid" => "MG1056032c4bdc2b25230c9e9baf456db4",
//                    "body" => "quang tesst"
//                )
//            );
//
//        print($message); die;
        // $sendOtp = $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verifications
        //     ->create($phonesend, "sms");
        // $request->session()->put('phone_number',$phonesend);
        // $request->session()->put("dataBooking", $request->all());
        // $redirect = "verify";
        // $data = ['code'=> 1,'success'=>'chúng tôi đã gửi 1 mã xác nhận tới số điện thoại đăng ký!','redirect'=>$redirect,'request' =>$request->all()];
        // if($sendOtp){
        //     return response()->json(['data'=>$data]);
        // }
//        return redirect()->route('verify')->with(['phone_number' => $phonesend]);
    }
//     protected function verify(Request $request)
//     {
//         $value = $request->session()->get("dataBooking");
//         $data = $request->validate([
//             'verification_code' => ['required', 'numeric'],
//             'phone_number' => ['required', 'string'],
//         ]);
//         /* Get credentials from .env */
//         $token = getenv("TWILIO_AUTH_TOKEN");
//         $twilio_sid = getenv("TWILIO_SID");
//         $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
//         $twilio = new Client($twilio_sid, $token);
//         $verification = $twilio->verify->v2->services($twilio_verify_sid)
//             ->verificationChecks
//             ->create($data['verification_code'], array('to' => $data['phone_number']));
//         if ($verification->valid) {
//             $booking = new booking();
//             $book = $booking->fill($request->session()->get("dataBooking"));
// //            $book->load('services');
//             $booking->save();

//             if($value['services_id']){
//                 $price = [];
//                 foreach ($value['services_id'] as $key => $item) {
//                     $services = Services::where('id', '=', $item)->first();
//                     $price[] = $services->price;
//                     $booking_services = new booking_services();
//                     $booking_services->services_id = $item;
//                     $booking_services->booking_id = $booking->id;
//                     $booking_services->status = BOOKING_PENDING;
//                     $booking_services->save();
//                 }

//                 $bookingSum = booking::find($booking->id);
//                 $sum = array_sum($price);
//                 $bookingSum->price = $sum;
//                 $bookingSum->save();
//                 $nhan_vien = User::where('role',0)->get('email');
//                 $bk = booking_services::where('booking_id', $booking->id)->get('services_id');
//                 $bksv = $bk->load('services');
//                 $dataMail = [
//                     'nam' => $booking->name,
//                     'phone' => $booking->phone_number,
//                     'service' => $bksv,
//                     'link' => route('booking.edit',['id'=>$booking->id])
//                 ];
//                 foreach ($nhan_vien as $nv){
//                     Mail::to($nv->email)->send(new Send_mail_booking($dataMail));
//                 }
//             }


//             return redirect()->route('booking')->with('success','Đặt lịch khám thành công');
//         }
//         return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Mã xác nhận không dúng. Vui lòng kiểm tra lại!']);

//     }
    public function testmail(){
        $msg = 'Đơn đặt khám mới';
        $emailNv = 'botboyy@gmail.com';
        if (Mail::to($emailNv)->send(new Send_mail_booking($msg))) {
            echo 0; die;
        }else{
            echo 1; die;
        }
    }
//    public function sendSMS_final(){
//        $sid    = "AC2e5d6b10d077d0f0a5658d3fc867c083";
//        $token  = getenv("TWILIO_AUTH_TOKEN");
//        $twilio = new Client($sid, $token);
//        $message = $twilio->messages
//            ->create("+84867543248", // to
//                array(
//                    "messagingServiceSid" => "MG1056032c4bdc2b25230c9e9baf456db4",
//                    "body" => "quang tesst"
//                )
//            );
//
//        print($message); die;
//    }
    // reponse client
    //{
    //"sid": "SMeb234cc1930f4aa38ef234a3ad4975d9",
    //"date_created": "Sun, 21 Nov 2021 07:15:46 +0000",
    //"date_updated": "Sun, 21 Nov 2021 07:15:46 +0000",
    //"date_sent": null,
    //"account_sid": "AC2e5d6b10d077d0f0a5658d3fc867c083",
    //"to": "+84971052857",
    //"from": null,
    //"messaging_service_sid": "MG1056032c4bdc2b25230c9e9baf456db4",
    //"body": "Thông tin dịch vụ khám của ban",
    //"status": "accepted",
    //"num_segments": "0",
    //"num_media": "0",
    //"direction": "outbound-api",
    //"api_version": "2010-04-01",
    //"price": null,
    //"price_unit": null,
    //"error_code": null,
    //"error_message": null,
    //"uri": "/2010-04-01/Accounts/AC2e5d6b10d077d0f0a5658d3fc867c083/Messages/SMeb234cc1930f4aa38ef234a3ad4975d9.json",
    //"subresource_uris": {
    //"media": "/2010-04-01/Accounts/AC2e5d6b10d077d0f0a5658d3fc867c083/Messages/SMeb234cc1930f4aa38ef234a3ad4975d9/Media.json"
    //}
    //}
}
//quang//
