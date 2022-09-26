<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GoogleSearch;

//require config("app.FILE_PATH").'vendor/serpapi/google-search-results-php/google-search-results.php';
//require config("app.FILE_PATH").'vendor/serpapi/google-search-results-php/restclient.php';

class KeywordTestController extends Controller {

public function keyword_test(){
	//dd(config("app.FILE_PATH"));
	$query = [
	  "engine" => "google",
	  "q" => "fire restoration services",
	  "location" => "Farmington Hills, Michigan, United States",
	  "google_domain" => "google.com",
	  "gl" => "us",
	  "hl" => "en",
	  "num"=>100,
	  //"api_key" => "9a6a652bc4cb37e98c6641a9269ac2091f30f9f33539fc66bda06675dcf2dc6f"
	];

$search = new GoogleSearch('9a6a652bc4cb37e98c6641a9269ac2091f30f9f33539fc66bda06675dcf2dc6f');

$results = $search->get_json($query);

echo '<pre>';
print_r($results);
die;
}
	
} 