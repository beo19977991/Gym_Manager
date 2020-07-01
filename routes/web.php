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
    // ======================Trainer===============================
    Route::group(['prefix' => 'traienr'], function () {
        Route::get('list','AdminController@getListTrainer')->name('admin-list-trainer');
        Route::get('add','AdminController@getAddTrainer')->name('admin-add-trainer');
        Route::post('add','AdminController@postAddTrainer')->name('admin-post-add-trainer');

        Route::get('edit/{id}','AdminController@getEditTrainer')->name('admin-edit-trainer');
        Route::post('edit/{id}','AdminController@postEditTrainer');
        Route::get('delete/{id}','AdminController@getDeleteTrainer')->name('admin-delete-trainer');
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

        Route::get('view/schedule-class/{id}','AdminController@getViewScheduleClass')->name('admin-view-schedule-class');
    });
    // =============================Exercise Type ==================================
    Route::group(['prefix' => 'exercise_type'], function () {
        Route::get('list','AdminController@getListExerciseType')->name('admin-list-exercise-type');

        Route::get('add','AdminController@getAddExerciseType')->name('admin-add-exercise-type');
        Route::post('add','AdminController@postAddExerciseType');

        Route::get('edit/{id}','AdminController@getEditExerciseType')->name('admin-edit-exercise-type');
        Route::post('edit/{id}','AdminController@postEditExerciseType');
        Route::get('delete/{id}','AdminController@getDeleteExerciseType')->name('admin-delete-exercise-type');
    });
    // =============================Exercise ==================================
    Route::group(['prefix' => 'exercise'], function () {
        Route::get('list','AdminController@getListExercise')->name('admin-list-exercise');
    
        Route::get('add','AdminController@getAddExercise')->name('admin-add-exercise');
        Route::post('add','AdminController@postAddExercise');
    
        Route::get('edit/{id}','AdminController@getEditExercise')->name('admin-edit-exercise');
        Route::post('edit/{id}','AdminController@postEditExercise');
        Route::get('delete/{id}','AdminController@getDeleteExercise')->name('admin-delete-exercise');
    });
    // =============================Schedule ==================================
    Route::group(['prefix' => 'schedules'], function () {
        Route::get('add-schedule','AdminController@getAddSchedule')->name('admin-add-schedule');
        Route::post('add-schedule-calendar','AdminController@postAddSchedule')->name('admin-post-add-schedule');
        Route::post('delete-schedule-calendar/{id}','AdminController@postDeleteSchedule')->name('admin-post-delete-schedule');
        Route::post('check-date-click/{date}/{time}','AdminController@checkDateClick')->name('admin-check-date-click');
    });
    // =============================Post ==================================
    Route::group(['prefix' => 'post'], function () {
        Route::get('list','AdminController@getListPost')->name('admin-list-post');
    
        Route::get('add','AdminController@getAddPost')->name('admin-add-post');
        Route::post('add','AdminController@postAddPost');
    
        Route::get('edit/{id}','AdminController@getEditPost')->name('admin-edit-post');
        Route::post('edit/{id}','AdminController@postEditPost');
        Route::get('delete/{id}','AdminController@getDeletePost')->name('admin-delete-post');
    });
    // =============================Trainer Post ==================================
        Route::group(['prefix' => 'trainerpost'], function () {
            Route::get('list','AdminController@getListTrainerPost')->name('admin-list-trainer-post');
        
            Route::get('add','AdminController@getAddTrainerPost')->name('admin-add-trainer-post');
            Route::post('add','AdminController@postAddTrainerPost');
        
            Route::get('edit/{id}','AdminController@getEditTrainerPost')->name('admin-edit-trainer-post');
            Route::post('edit/{id}','AdminController@postEditTrainerPost');
            Route::get('delete/{id}','AdminController@getDeleteTrainerPost')->name('admin-delete-trainer-post');
        });
    // =============================ProductType ==================================
    Route::group(['prefix' => 'product_type'], function () {
        Route::get('list','AdminController@getListProductType')->name('admin-list-product-type');
    
        Route::get('add','AdminController@getAddProductType')->name('admin-add-product-type');
        Route::post('add','AdminController@postAddProductType');
    
        Route::get('edit/{id}','AdminController@getEditProductType')->name('admin-edit-product-type');
        Route::post('edit/{id}','AdminController@postEditProductType');

        Route::get('delete/{id}','AdminController@getDeleteProductType')->name('admin-delete-product-type');
    });
    // =============================Product ==================================
    Route::group(['prefix' => 'product'], function () {
        Route::get('list','AdminController@getListProduct')->name('admin-list-product');
    
        Route::get('add','AdminController@getAddProduct')->name('admin-add-product');
        Route::post('add','AdminController@postAddProduct');
    
        Route::get('edit/{id}','AdminController@getEditProduct')->name('admin-edit-product');
        Route::post('edit/{id}','AdminController@postEditProduct');

        Route::get('delete/{id}','AdminController@getDeleteProduct')->name('admin-delete-product');
    });
    // ========================Ajax - admin=========================================
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('user/{user_id}','AdminController@getBlockUser');
        Route::get('add-trainer/{id}','AdminController@getTrainer');
    });
});
// ===================================================================

// ==============================Page==================================
    Route::group(['prefix'=>'page'],function(){
    // =========================ajax=====================================
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('search_course','PageController@getSearchCourse')->name('search-course');
            Route::get('search_trainer','PageController@getSearchTrainer')->name('search-trainer');
            Route::get('search_exercise','PageController@getSearchExercise')->name('search-exercise');
            Route::get('course/{id}', 'PageController@getResultSearchCourse')->name('getCourse');
        });
    // =================Home====================================================================
        Route::get('home','PageController@getHome')->name('page-home');
        Route::get('course','PageController@getCourse')->name('page-course');
        Route::get('schedule','PageController@getSchedule')->name('page-schedule');
        Route::get('trainer','PageController@getTrainer')->name('page-trainer');
        Route::get('news','PageController@getNews')->name('page-news');
        Route::get('exercise','PageController@getExercise')->name('page-exercise');

    // ===============================Course Detail=============================================
        Route::get('course/detail/{id}','PageController@getCourseDetail')->name('page-course-detail');
    // ==============================Register Course============================================
        Route::get('course/register/{id}','UserController@getCourseRegister')->name('page-course-register');
    // ==============================Cancel register course ====================================
        Route::get('course/cancel_register/{id}','UserController@getCancelRegisterCourse')->name('page-course-cancel-register');

        // ================**************************==============================================
    // =====================================Trainer Detail ========================================
        Route::get('trainer/detail/{id}','TrainerController@getTrainerDetail')->name('page-trainer-detail');

});