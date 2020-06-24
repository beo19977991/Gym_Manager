<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
View::composer(['*'],function($view)
{
    $user_login=Auth::user();
    $view->with('user_login',$user_login);
});
View::composer(['*'],function($view)
{
    $trainer_login = Auth::guard('trainer')->user();
    $view->with('trainer_login',$trainer_login);
});
View::composer(['*'],function($view)
{
    $staff_login = Auth::guard('staff')->user();
    $view->with('staff_login',$staff_login);
});
Route::get('home', function () {
    return view('pages.index');
});
// ======================Select Login===================================
Route::get('select_option_login','SelectLoginController@getSelectLogin')->name('select_login');
Route::post('select_option_login','SelectLoginController@postSelectLogin')->name('post_select_login');
// ================user dang nhap - dang ky=================
Route::get('login','LoginController@getLogin')->name('login');
Route::post('login','LoginController@postLogin');

Route::get('register','RegisterController@getRegister')->name('register');
Route::post('register','RegisterController@postRegister');

Route::get('logout','LoginController@getLogout')->name('logout');
// ==============================================================
// ================Trainer dang nhap - dang ky=================
Route::get('login_trainer','TrainerController@getLogin')->name('login_trainer');
Route::post('login_trainer','TrainerController@postLogin');

Route::get('register_trainer','TrainerController@getRegister')->name('register_trainer');
Route::post('register_trainer','TrainerController@postRegister');

Route::get('logout_trainer','TrainerController@getLogout')->name('logout_trainer');
// ==============================================================
// ================Staff dang nhap - dang ky=================
Route::get('login_staff','StaffController@getLogin')->name('login_staff');
Route::post('login_staff','StaffController@postLogin');

Route::get('register_staff','StaffController@getRegister')->name('register_staff');
Route::post('register_staff','StaffController@postRegister');

Route::get('logout_staff','StaffController@getLogout')->name('logout_staff');
// ==============================================================
// ==============================Admin - dang nhap -dang ky======================
Route::get('login_admin','AdminController@getLogin')->name('login_admin');
Route::post('login_admin','AdminController@postLogin');

Route::get('logout_admin','AdminController@getLogout')->name('logout_admin');
// ===========================Admin===================================
Route::group(['prefix' => 'admin'], function () {
    Route::get('home', 'AdminController@getHome')->name('admin-home');

    // ======================User===============================
    Route::group(['prefix' => 'user'], function () {
        Route::get('list','AdminController@getListUser')->name('admin-list-user');
        Route::get('add','AdminController@getAddUser')->name('admin-add-user');
        Route::post('add','AdminController@postAddUser')->name('admin_post_add_user');
        Route::get('edit/{id}','AdminController@getEditUser')->name('admin-edit-user');
        Route::post('edit/{id}','AdminController@postEditUser');
        Route::get('delete/{id}','AdminController@getDeleteUser')->name('admin-delete-user');
    });
    // =======================Course Type=========================================
    Route::group(['prefix' => 'course_type'], function () {
        Route::get('list','AdminController@getListCourseType')->name('admin-list-course-type');

        Route::get('add','AdminController@getAddCourseType')->name('admin-add-course-type');
        Route::post('add','AdminController@postAddCourseType')->name('admin-post-add-course-type');

        Route::get('edit/{id}','AdminController@getEditCourseType')->name('admin-edit-course-type');
        Route::post('edit/{id}','AdminController@postEditCourseType');
        Route::get('delete/{id}','AdminController@getDeleteCourseType')->name('admin-delete-course-type');
    });
    // =======================Cours=========================================
    Route::group(['prefix' => 'course'], function () {
        Route::get('list','AdminController@getListCourse')->name('admin-list-course');

        Route::get('add','AdminController@getAddCourse')->name('admin-add-course');
        Route::post('add','AdminController@postAddCourse')->name('admin-post-add-course');

        Route::get('edit/{id}','AdminController@getEditCourse')->name('admin-edit-course');
        Route::post('edit/{id}','AdminController@postEditCourse');

        Route::get('delete/{id}','AdminController@getDeleteCourse')->name('admin-delete-course');
    });
    // ========================Ajax - admin=========================================
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('user/{user_id}','AdminController@getBlockUser');
        Route::get('add-trainer/{id}','AdminController@getTrainer');
    });
});
// ===================================================================