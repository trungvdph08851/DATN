<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\SettingSystemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryArticleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use Illuminate\Support\Facades\Route;

Route::middleware('checklogin')->group(function(){ /**check đăng nhập */
    Route::get('/', [HomeController::class, 'index'])->middleware('checklogin')->name('admin.index')->middleware('checkAdminLogin');

    Route::get('xuat-hoa-don/{id}', [BookingController::class, 'xuathoadon'])->name('xuathoadon')->middleware('checkEmployeeLogin');
    Route::get('gui-tin-nhan/{id}', [BookingController::class, 'gui_tin_nhan'])->name('guitinnhan');
    //:::: booking
    Route::get('list-booking/', [BookingController::class, 'index'])->name('booking.index');
    Route::get('add-booking/', [BookingController::class, 'add'])->name('booking.add')->middleware('checkEmployeeLogin');
    Route::post('add-booking/', [BookingController::class, 'saveAdd'])->middleware('checkEmployeeLogin');
    Route::get('edit-booking/{id}', [BookingController::class, 'edit'])->name('booking.edit')->middleware('checkEmployeeLogin');
    Route::post('edit-booking/{id}', [BookingController::class, 'saveEdit'])->middleware('checkEmployeeLogin');
    Route::get('remove-booking/{id}', [BookingController::class, 'remove'])->name('booking.remove')->middleware('checkEmployeeLogin');
    // hủy đơn
    Route::post('cancel-order', [BookingController::class, 'cancelOrder'])->name('cancel.order')->middleware('checkEmployeeLogin');
    // khôi phục đơn
    Route::get('restore-order/{id}',[BookingController::class, 'restoreOrder'])->name('restore.order')->middleware('checkEmployeeLogin');
    // danh sách đơn đã hủy
    Route::get('list-cancel-order',[BookingController::class, 'listCancelOrder'])->name('list.cancel.order');
    // danh sách chờ khám
    Route::get('waiting-line/', [BookingController::class, 'waitingLine'])->name('booking.waitingLine');
    // danh sách chờ khám trong ngày
    Route::get('waiting-line-today', [BookingController::class, 'waitingLineToday'])->name('booking.waitingLine.today');
    Route::post('Save-waiting-line/', [BookingController::class, 'saveWaitingLine'])->name('booking.waitingLine.save');
    Route::post('Save-waiting-line-schedule/', [BookingController::class, 'saveWaitingLineSchedule'])->name('booking.waitingLine.schedule.save');
    // tạo lịch hẹn khám định kỳ
    Route::get('add-schedule/{id}', [BookingController::class, 'addSchedule'])->name('booking.add.schedule')->middleware('checkEmployeeLogin');
    Route::post('add-schedule', [BookingController::class, 'saveSchedule'])->name('booking.save.schedule')->middleware('checkEmployeeLogin');
    // timeLine
    Route::get('/list-timeline', [TimelineController::class, 'index'])->name('timeline.index');
    Route::post('update-timeline', [TimelineController::class, 'addTimeLine'])->name('timeline.add')->middleware('checkEmployeeLogin');
    Route::get('update_end_date', [TimelineController::class, 'updateEndDate'])->name('timeline.update.endDate')->middleware('checkEmployeeLogin');
    Route::get('cancel-scheduled/{id}', [TimelineController::class, 'cancelScheduled'])->name('cancelScheduled')->middleware('checkEmployeeLogin');
    Route::resource('timeline', 'App\Http\Controllers\Admin\TimelineController');

    //:::: end booking

    Route::middleware('checkAdminLogin')->group(function(){ /*phân quyền admin */
        // setting_system
        Route::get('setting-system', [SettingSystemController::class, 'index'])->name("setting.index");
        Route::get('add-setting-system', [SettingSystemController::class, 'add'])->name('setting.add');
        Route::post('add-setting-system', [SettingSystemController::class, 'store'])->name('setting.store');
        Route::get('edit-setting-system/{id}', [SettingSystemController::class, 'edit'])->name('setting.edit');
        Route::post('edit-setting-system/{id}', [SettingSystemController::class, 'saveEdit'])->name('setting.saveEdit');
        Route::get('delete-setting-system/{id}', [SettingSystemController::class, 'delete'])->name('setting.delete');
        // slider
        Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
        Route::get('change-status-slider', [SliderController::class, 'changeStatus'])->name('slider.changeStatus');
        Route::get('add-slider', [SliderController::class, 'add'])->name('slider.add');
        Route::post('add-slider', [SliderController::class, 'store'])->name('slider.store');
        Route::get('edit-slider/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('edit-slider/{id}', [SliderController::class, 'saveEdit'])->name('slider.saveEdit');
        Route::get('delete-slider/{id}', [SliderController::class, 'deleteEdit'])->name('slider.deleteEdit');
        // danh mục bài viết
        Route::get('list-category-article', [CategoryArticleController::class, 'index'])->name('category.index');
        Route::get('add-category-article', [CategoryArticleController::class, 'add'])->name('category.add');
        Route::post('add-category-article', [CategoryArticleController::class, 'store'])->name('category.store');
        Route::get('edit-category-article/{id}', [CategoryArticleController::class, 'edit'])->name('category.edit');
        Route::post('edit-category-article/{id}', [CategoryArticleController::class, 'editSave'])->name('category.saveEdit');
        Route::get('delete-category-article/{id}', [CategoryArticleController::class, 'deletecate'])->name('category.delete');
        // bài viết
        Route::get('article', [ArticleController::class, 'index'])->name('article.index');
        Route::get('change-status-article', [ArticleController::class, 'changeStatus'])->name('article.changeStatus');
        Route::get('add-article', [ArticleController::class, 'add'])->name('article.add');
        Route::post('add-article', [ArticleController::class, 'store'])->name('article.store');
        Route::get('edit-article/{id}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::post('edit-article/{id}', [ArticleController::class, 'editSave'])->name('article.saveEdit');
        Route::get('delete-article/{id}', [ArticleController::class, 'deleteArticle'])->name('article.delete');
        //Route::post('setting-system', [SettingSystemController::class, 'index']);

        // services
        Route::get('services/list-services/', [ServicesController::class, 'index'])->name('services.index');
        Route::get('services/add-services/', [ServicesController::class, 'add'])->name('services.add');
        Route::post('services/save-services/', [ServicesController::class, 'save'])->name('services.save');
        Route::get('services/remove-services/{id}', [ServicesController::class, 'remove'])->name('services.remove');
        Route::get('services/edit-services/{id}', [ServicesController::class, 'edit'])->name('services.edit');
        Route::get('services/change-status', [ServicesController::class, 'changeStatus'])->name('services.status');

        // Doctor
        Route::get('doctor/list-doctor/', [DoctorController::class, 'index'])->name('doctor.index');
        Route::get('doctor/add-doctor/', [DoctorController::class, 'add'])->name('doctor.add');
        Route::post('doctor/save-doctor/', [DoctorController::class, 'save'])->name('doctor.save');
        Route::get('doctor/remove-doctor/{id}', [DoctorController::class, 'remove'])->name('doctor.remove');
        Route::get('doctor/edit-doctor/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');

        //user
        Route::get('list-user/', [UserController::class, 'index'])->name('user.index');
        Route::get('add-user/', [UserController::class, 'addUser'])->name('user.add');
        Route::post('add-user/', [UserController::class, 'saveAddUser']);
        Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('user.edit');
        Route::post('edit-user/{id}', [UserController::class, 'saveEditUser']);
        Route::get('delete-user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
        // user lấy dịch vụ bác sĩ
        Route::get('get-services-doctor', [UserController::class, 'getServicesDoctor'])->name('user.get.services.doctor');
    });




    Route::fallback(function () {
        return view('backend.404');
    });
});
