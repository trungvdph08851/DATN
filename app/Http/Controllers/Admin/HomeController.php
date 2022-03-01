<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\setting;
use App\Models\booking;
use App\Models\booking_schedule;
use App\Models\booking_services;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use App\SpeedSMSAPI;

class HomeController extends Controller
{
    //
    public function index(){
        $booking = booking::all();
        $services = Services::all();
        $user = User::all();

        $booking_Services = booking_services::where('status', BOOKING_SERVICES_SCHEDULED)->orWhere('status', BOOKING_SERVICES_FINISHED)->get();
        $booking_Schedule = booking_schedule::all();
        $sumBooking = count($booking_Schedule) + count($booking_Services);
        $userDoctor = User::where('role', 2)->get();
        $userDoctor->load(['doctorServices', 'doctorSchedule']);

        $arrDoctor = [];
        foreach ($userDoctor as $key => $value) {
            $abc = (count($value->doctorServices) + count($value->doctorSchedule)) / $sumBooking * 100;
            $arrDoctor[] = [
                "name" => $value->name,
                "sumServices" => count($value->doctorServices) + count($value->doctorSchedule),
                "avatar" => $value->avatar,
                "percent" => floor($abc)  

            ];
        }
        $keys = array_column($arrDoctor, 'sumServices');
        array_multisort($keys, SORT_DESC, $arrDoctor);
        $topDoctor =  array_slice($arrDoctor, 0, 5);

        // $arrDate = [];
        // foreach ($booking as $key => $value) {
        //     $arrDate[] = $value->created_at->format("Y-m-d");
        // }
        // $arrDate = array_unique($arrDate);
        // $arrTopDate = [];
        // foreach ($booking as $item) {
        //     $date = $item->created_at->format("Y-m-d");
        //     foreach ($arrDate as $ad) {
        //         if ($ad == $date) {
        //             $arrTopDate[] = [
        //                 "date" => $ad
        //             ];
        //         }
        //     }
        // }
        
        return view('backend.dashboard.index',compact('booking', 'services', 'user','userDoctor', 'topDoctor'));
    }
}
