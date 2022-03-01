<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\booking_services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Services;
use App\Models\article;
use App\Models\CategoryArticle;
use App\Models\Slider;
use Twilio\Rest\Client;
use App\Models\booking;
use App\Models\booking_schedule;
use App\Models\Doctor;
use App\Models\User;
use DB;
class HomeController extends Controller
{
    public function index(){
        $Servicess = Services::where('status',1)->limit(6)->get();
        $Article_new = article::where('status', 1)->where('single_page',0)->where('cate_id', 1)->orderBy('id','desc')->limit(3)->get();
        $Slider = Slider::where('status',1)->get();
        $doctors = Doctor::limit(3)->get();
        return view('frontend.home_front',['Servicess' => $Servicess,'Article_new'=>$Article_new,'slider'=>$Slider,'doctors'=>$doctors]);
    }
    public function singlepage($slug){
        $result = article::where('url',$slug)->first();
        if(empty($result)){
            return back();
        }
        if($result->single_page == 1 ){
            return view('frontend.singlepage', ['single_page' => $result]);
        }else{
            $Related_posts = article::where('cate_id',$result->cate_id)->where('single_page',0)->where('id','!=',$result->id)->get();
            $Categories = CategoryArticle::all();
            return view('frontend.article', ['data_article' => $result, 'Related_posts' => $Related_posts, 'categories' => $Categories]);
        }
//        switch ($slug){
//            case 'gioi-thieu-nha-khoa-dong-anh.html':
//                $data = article::where('url',$slug)->first();
//                if ($slug != $data['url']){
//                    return back();
//                }else {
//                    return view('frontend.singlepage', ['single_page' => $data]);
//                }
//                break;
//            default:
//                $result = article::where('url',$slug)->first();
//                $Related_posts = article::where('cate_id',$result->cate_id)->where('id','!=',$result->id)->get();
//                $Categories = CategoryArticle::all();
//                if (empty($result)){
//                    return back();
//                }else {
//                    return view('frontend.article', ['data_article' => $result, 'Related_posts' => $Related_posts, 'categories' => $Categories]);
//                }
//                break;
//        }
    }
    public function service_detail($id){
        $service = Services::find($id);
        $article = article::limit(3)->get();
        $listServices = Services::limit(6)->get();
        return view('frontend.service_detail',compact('listServices', 'service', 'article'));
    }
    public function article($slug){
        $result = article::where('url',$slug)->first();
        $Related_posts = article::where('cate_id',$result->cate_id)->where('id','!=',$result->id)->get();
        $Categories = CategoryArticle::all();
        return view('frontend.article',['data_article' => $result,'Related_posts'=>$Related_posts,'categories'=>$Categories]);
    }
    public function service(){
        $list_services = Services::all();
        return view('frontend.service',['list_services'=>$list_services]);
    }
    public function baiviet(){
        $list_baiviet = article::where('status', 1)->where('single_page',0)->orderBy('id', 'desc')->get();
        return view('frontend.baiviet',['list_baiviet'=>$list_baiviet]);
    }
    public function baiviet_category ($slug){
        $category = CategoryArticle::where('url_name',$slug)->first();
        if(empty($category)){
            return back();
        }
        else{
            $list_baiviet = article::where('single_page',0)->where('cate_id',$category->id)->orderBy('id', 'desc')->get();
            return view('frontend.baiviet',['list_baiviet'=>$list_baiviet]);
        }
    }
    public function verify_view_search(){
        return view('frontend.verify_search');
    }
    public function search_prescription(Request $request){
        $data = booking::where('phone_number',$request->phone_or_cmnn)->get();
        if(count($data) == 0){
            return back()->with('error','thông tin không chính xác');
        }else {
            $phone = ltrim( "$request->phone_or_cmnn", 0);
            $phonesend = '+84'.$phone;
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $phones = ['number_phone'=>$phonesend,'phone'=>$request->phone_or_cmnn];
            if ($twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phonesend, "sms")){
               return view('frontend.verify_search',['data'=>$phones]);
            }
        }
    }
    public function verify_search(Request $request){
        $keyword = $request->phone;
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone_number']));
        if ($verification->valid) {
            $data = booking::where('phone_number',$request->phone)->get();
            $data->load('services');
            $data->load('bookingServices');
            $data->load('bookingSchedule');
            return view('frontend.booking_oder', ['data_oder' => $data, 'keyword' => $keyword]);
        }
    }
    public function doctor_blog(){
        $data = Doctor::paginate(8);
        return view('frontend.blog',['blogs'=>$data]);
    }
    public function doctor_blog_detail($id){
        $data = Doctor::find($id);
        $recent = Doctor::where('id','!=',$id)->orderBy('id','desc')->limit(5)->get();
        return view('frontend.blog_detail',['blog_detail' => $data,'recent'=>$recent]);
    }

    // doctor
    public function listDoctor(){
        $doctor = Doctor::all();
        return view('frontend.list-doctor', compact('doctor'));
    }
    public function detailDoctor($id){
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return redirect()->back();
        }
        return view('frontend.doctor-detail', compact('doctor'));
    }
}
//quang
