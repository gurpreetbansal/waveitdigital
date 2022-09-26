<?php

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
	$domain = '{account}.'.\config('app.DOMAIN_NAME');

	Route::group(["namespace" => "Admin"], function() {
		Route::group(['middleware' => ['Admin'], 'prefix' => 'admin'], function () {
			Route::get('/dashboard', 'AuthController@dashboard');
			Route::get('/logout', function() {
				Session::flush();
				Auth::logout();
				return Redirect::to("/login");
			});
			Route::get('/ajax_fetch_account_data','DashboardController@ajax_fetch_account_data');
			Route::get('/ajax_fetch_account_pagination','DashboardController@ajax_fetch_account_pagination');

			Route::get('/login_as_client','DashboardController@login_as_client');
			Route::get('/profile-settings','AuthController@get_profile');
			Route::post('/post_profile_settings','AuthController@post_profile_settings');
			Route::post('/ajax_remove_profile_picture','AuthController@ajax_remove_profile_picture');
			Route::post('/update_change_password','AuthController@update_change_password');
			Route::get('/agency-account-details/{agency_id}','AgencyAccountController@agency_account_details');
			Route::get('/ajax_fetch_agency_account_data','AgencyAccountController@ajax_fetch_agency_account_data');
			Route::get('/ajax_fetch_agency_account_pagination','AgencyAccountController@ajax_fetch_agency_account_pagination');

			Route::get('/feedbacks','FeedbackController@index');
			Route::get('/ajax_fetch_feedback_data','FeedbackController@ajax_fetch_feedback_data');
			Route::get('/ajax_fetch_feedback_pagination','FeedbackController@ajax_fetch_feedback_pagination');
			Route::get('/ajax_fetch_client_feedback/{feedback_id}','FeedbackController@ajax_fetch_client_feedback');
		});
	});
	Route::get('/admin/dashboard/{id}', 'Admin\AuthController@dashboard')->name('dashboard');
	Route::get('/back_to_admin','Vendor\LoginController@back_to_admin');