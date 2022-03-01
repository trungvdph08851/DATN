<?php

use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test-mail',[BookingController::class, 'testmail']);
Route::get('/', [HomeController::class, 'index'])->name('home');
// booking

Route::get('booking/', [BookingController::class, 'index'])->name('booking');
Route::post('booking/', [BookingController::class, 'saveBooking']);
// test speed sms
Route::get('/verify', [BookingController::class, 'verify_view']);
Route::get('/verify-search', [HomeController::class, 'verify_view_search'])->name('book.verify');
Route::post('/verify', [BookingController::class, 'verify'])->name('verify');
Route::post('/verify-search', [HomeController::class, 'verify_search'])->name('verify_search');
//end test
// end booking
// service layout
Route::get('service/{id}',[HomeController::class, 'service_detail'])->name('service_detail');
//


// login
Route::get('login/',[LoginController::class, 'index'])->name('login.index');
Route::post('login/',[LoginController::class, 'postLogin']);
Route::any('logout', function(){
    Auth::logout();
    return redirect(route('login.index'));
})->name('logout');
Route::get('fake-password/{mk?}',function($mk = '12345678'){
    return Hash::make($mk);
});

Route::get('tin-tuc-chuyen-khoa', [HomeController::class, 'doctor_blog'])->name('doctor_blog');

Route::get('tin-tuc-chuyen-khoa/{id}', [HomeController::class, 'doctor_blog_detail'])->name('doctor_blog_detail');

Route::get('bai-viet', [HomeController::class, 'baiviet'])->name('baiviet_list');

Route::get('bai-viet/{slug}', [HomeController::class, 'baiviet_category'])->name('baiviet_category');

Route::get('dich-vu', [HomeController::class, 'service'])->name('service_list');
// chi tiết bác sĩ
Route::get('list-doctor', [HomeController::class, 'listDoctor'])->name('list.doctor');
Route::get('detail-doctor/{id}', [HomeController::class, 'detailDoctor'])->name('detail.doctor');


Route::get('{slug}', [HomeController::class, 'singlepage'])->name('singlepage');
//Route::get('test-mail',[BookingController::class, 'testmail']);


Route::get('{slug}', [HomeController::class, 'singlepage'])->name('singlepage');
//Route::get('bai-viet/{slug}', [HomeController::class, 'article'])->name('article');
//1
Route::post('search-prescription', [HomeController::class, 'search_prescription'])->name('search.prescription');

