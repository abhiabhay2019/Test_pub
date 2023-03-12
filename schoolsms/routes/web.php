<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentFeesController;
use App\Http\Controllers\StaffAttendanceController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function(){
    //return view('home');
    return redirect('admin');
});

Route::get('/home', function(){
    //return view('home');
    return redirect('admin');
});



Route::get('/contact', function(){
    return view('contact');
});

Route::get('/about-us', function(){
    return view('about-us');
});

Route::get('/course-single', function(){
    return view('course-single');
});

Route::get('/events-archive', function(){
    return view('events-archive');
});

Route::get('/events-single', function(){
    return view('events-single');
});

Route::get('/gallery', function(){
    return view('gallery');
});

Route::get('/scholarship', function(){
    return view('scholarship');
});

Route::get('create-pdf-file', [PDFController::class, 'index']);

/*========= admin rotes  goes here!---------*/
Route::get('/admin',[AdminController::class,'index']);

Route::post('/admin/checklogin',[AdminController::class,'checklogin']);

Route::group(['middleware'=>'admin_auth'],function(){
    
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);
    /*============ manage student ===================*/
    Route::get('admin/add-student',[StudentController::class,'index']);
    Route::post('admin/admission_process',[StudentController::class,'addStudent']);
    Route::get('admin/manage-student',[StudentController::class,'getAllStudent']);
    Route::get('admin/edit-student/{id}',[StudentController::class,'editStudent']);
    Route::get('admin/delete-student/{id}/{action}',[StudentController::class,'deleteStudent']);
    Route::get('admin/active-student/{id}/{action}',[StudentController::class,'deleteStudent']);
    Route::get('admin/deactive-list',[StudentController::class,'deactiveLisst']);
    Route::get('admin/getDeactiveList',[StudentController::class,'getDeactiveLisst']);
    
    Route::get('admin/add-class',function(){
       return view('admin.add_class');
    });
    Route::post('admin/class_manage',[ClassController::class,'manageClass']);
    Route::get('admin/class_list',[ClassController::class,'getClass']);
    
    Route::get('admin/ClassAlllist',[ClassController::class,'getClass']);
    
    Route::get('admin/site-setup',[SiteController::class,'index']);
    Route::get('admin/manage-pages',[PageController::class,'index']);
    Route::get('admin/addpage',[PageController::class,'addPage']);
    Route::post('admin/addpage_info',[PageController::class,'addPageInfo']);
     
    /*============ manage account ===================*/
    Route::get('admin/add-fees',[AccountController::class,'index']);
    Route::get('admin/edit-fees',[AccountController::class,'editFees']);
    Route::get('admin/feesdata',[AccountController::class,'getFeesData']);
    Route::get('admin/getData',[AccountController::class,'getData']);
    Route::post('admin/manage-fees',[AccountController::class,'manageFees']);
    Route::post('admin/update-fees',[AccountController::class,'updateFees']);
    Route::get('admin/fees-reports',[AccountController::class,'getAllFees']);
    Route::post('admin/fees-reports',[AccountController::class,'getAllFees']);
    Route::get('admin/getfees',[AccountController::class,'getAllFeesAjax']);
    Route::get('admin/update_fees_status',[AccountController::class,'getFeesStatus']);
    Route::get('admin/del_fees',[AccountController::class,'delete_fees']);
    
    Route::get('admin/pending-fees',[AccountController::class,'getPendingFees']);
    Route::get('admin/get_pending_fees',[AccountController::class,'getDueFees']);
    
    
    Route::get('admin/fees-master',function(){
        return view('admin/fees_master');
    });
    Route::post('admin/addmaster',[AccountController::class,'addFeesMaster']);
    Route::get('admin/view-fees-type',[AccountController::class,'getAllFeesType']);
    Route::get('admin/edit-fees-type',[AccountController::class,'getFeesType']);
    Route::get('admin/getfeesType',[AccountController::class,'getFeesTypeByID']);
    Route::get('admin/ClassFees',[AccountController::class,'getClassFess']);
    
    Route::get('admin/fees-structure',[AccountController::class,'show_fees_structure']);
    
    /*====================== manage staff ========================*/
    Route::get('admin/add-staff',[StaffController::class,'index']);
    Route::post('admin/addstaff',[StaffController::class,'manageStaff']);
    Route::get('admin/view-staff',[StaffController::class,'staffList']);
    Route::get('admin/remove_staff',[StaffController::class,'removeStaff']);
    
    /*=================== manage role =============*/
    
    Route::get('/admin/role-master',[RoleController::class,'index']);
    Route::post('/admin/manage_role',[RoleController::class,'manage_role']);
    Route::get('/admin/role_list',[RoleController::class,'getAllRole']);
    Route::post('/admin/update_access',[RoleController::class,'update_access_list']);
    Route::get('/admin/getcontrol',[RoleController::class,'getAllControl']);
    
    /*=================== manage user =============*/
    
    Route::get('/admin/user-master',[UserController::class,'index']);
    /*Route::post('/admin/manage_role',[RoleController::class,'manage_role']);
    Route::get('/admin/role_list',[RoleController::class,'getAllRole']);*/
    
    /*============= manage Notices ===================*/
    Route::get('/admin/manage-notices',[NoticeController::class,'index']);
    Route::post('/admin/addnotice',[NoticeController::class,'addNotice']);
    
    /*============= manage Events ===================*/
    Route::get('/admin/manage-events',[EventController::class,'index']);
    Route::post('/admin/addevent',[EventController::class,'addEvent']);
    
    /*================ manage routine =================*/
    Route::get('/admin/time-master',[RoutineController::class,'time_index']);
    Route::post('/admin/addtime',[RoutineController::class,'manage_time']);
    
    Route::get('/admin/day-master',[RoutineController::class,'day_index']);
    Route::post('/admin/addday',[RoutineController::class,'manage_day']);
    
    Route::get('/admin/routine-master',[RoutineController::class,'routine_index']);
    
    Route::get('/admin/show-routine',[RoutineController::class,'class_wise_routine']);
    
    Route::post('/admin/show_routine',[RoutineController::class,'class_wise_routine']);
    
    Route::post('/admin/add_routine',[RoutineController::class,'add_routine']);

    Route::get('/admin/create-pdf-file', [PDFController::class, 'index']);
    Route::get('/admin/send_mail', [PDFController::class, 'send_mail']);
    Route::get('/admin/send_pending_mail', [PDFController::class, 'send_pending_mail']);
    Route::get('/admin/sendNotice', [PDFController::class, 'send_notice_mail']);
    
    Route::get('/admin/student-fees',[StudentFeesController::class,'index']);
    Route::post('/admin/student_wise',[StudentFeesController::class,'get_student_wise']);
    
    /*============== staff manage ==========================*/
    
    Route::get('/admin/staff-attendance',[StaffAttendanceController::class,'index']);
    Route::get('/admin/get_staff',[StaffAttendanceController::class,'get_all_staff']);
    Route::post('/admin/mark_attendance',[StaffAttendanceController::class,'mark_attendance']);
    Route::get('/admin/staff-attendance-report',[StaffAttendanceController::class,'get_attendance']);
    Route::get('/admin/attendance_report',[StaffAttendanceController::class,'view_attendance']);
    
    /*===== navbar setup ======*/
    Route::get('/admin/navbar',[NavbarController::class,'index']);
    Route::get('/admin/manage-header',[NavbarController::class,'manage_header']);
    Route::post('/admin/add-header',[NavbarController::class,'add_header']);
    Route::get('/admin/get-links',[NavbarController::class,'get_header']);
    Route::get('/admin/get-headlist',[NavbarController::class,'get_header_list']);
    Route::get('/admin/get-subhead',[NavbarController::class,'get_subhead_list']);
    
    Route::get('/admin/get_current_url',[NavbarController::class,'get_current_url']);
    Route::get('/admin/edit-subhead',[NavbarController::class,'get_subhead_list']);
    
    Route::get('admin/logout',function(){
        
        session()->forget('ADMIN_LOGIN');
        session()->forget('sName');
        session()->flush();
        session()->flash('msg','Thank You For Visiting');
        
        return redirect('admin');
    });
    
});
