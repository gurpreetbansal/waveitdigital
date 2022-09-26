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

	Route::group(["namespace" => "Vendor\goolgeAd"], function($account) {
		Route::group(['middleware' => ['auth', 'Vendor']], function() {
			
			/********** Connect & Refesh accounts ************/

			
			

		});
		
	});
});

Route::group(["namespace" => "Vendor\pdf"], function($account) {	
		
	Route::get('/pdf/html2pdf','HtmlPdfController@index');
	Route::get('/pdf/ppc/{id}','HtmlPdfController@ppcPdf');


	Route::get('/pdf/html2pdf/download','HtmlPdfController@htmlPdfDownload');
	Route::get('/pdf/seo/view','HtmlPdfController@htmlPdfView');
});				