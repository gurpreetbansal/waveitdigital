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

	Route::group(['domain' => $domain], function() {

		Route::group(["namespace" => "Test"], function($account) {
			Route::group(['middleware' => ['auth', 'Vendor']], function() {
				
			});
		});
	});
	Route::get('/display-pdf','Test\PdfController@display_pdf');	
	Route::get('/display-pdf-index','Test\PdfController@display_pdf_index');	

	Route::get('/display-test','Test\PdfController@display_test');	
	Route::get('/display-pdf-test','Test\PdfController@display_pdf_test');