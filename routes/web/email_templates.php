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


Route::get('/subscription_trial_invoice','EmailTemplateController@subscription_trial_invoice');
Route::get('/admin_subscription_trial_invoice','EmailTemplateController@admin_subscription_trial_invoice');
Route::get('/subscription_invoice','EmailTemplateController@subscription_invoice');
Route::get('/admin_subscription_invoice','EmailTemplateController@admin_subscription_invoice');
Route::get('/welcome_email','EmailTemplateController@welcome_email');
Route::get('/activate_account','EmailTemplateController@activate_account');
Route::get('/recover_password','EmailTemplateController@recover_password');
Route::get('/vanity_url','EmailTemplateController@vanity_url');
Route::get('/removed_access','EmailTemplateController@removed_access');
Route::get('/access_added','EmailTemplateController@access_added');
Route::get('/access_updated','EmailTemplateController@access_updated');
Route::get('/notification_alerts','EmailTemplateController@notification_alerts');
Route::get('/subscription_cancellation','EmailTemplateController@subscription_cancellation');
Route::get('/admin_subscription_cancellation','EmailTemplateController@admin_subscription_cancellation');