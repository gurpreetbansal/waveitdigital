<?php

namespace App\Traits;
// use Illuminate\Http\Request;
// use App\Http\Requests\StoreReportRequest;
// use App\SiteAuditSummary;
// use App\SiteAudit;
// use GuzzleHttp\Client as HttpClient;
// use GuzzleHttp\Exception\RequestException;
// use GuzzleHttp\TransferStats;

use App\Traits\SimpleHtmlDomTrait;

trait GoogleUrlListTrait {

	use SimpleHtmlDomTrait;

    public $DEFAULT_TARGET_CHARSET = 'UTF-8';
    public $DEFAULT_BR_TEXT = "\r\n";
    public $DEFAULT_SPAN_TEXT = ' ';
    public $MAX_FILE_SIZE = 600000;

    public function file_get_html($url,$use_include_path = false,$context = null,$offset = 0,$maxLen = -1,$lowercase = true,$forceTagsClosed = true,$target_charset = null,$stripRN = true,$defaultBRText = null,$defaultSpanText = null)
{
		if($target_charset == null){
			$target_charset = $this->DEFAULT_TARGET_CHARSET;
		}

		if($defaultBRText == null){
			$defaultBRText = $this->DEFAULT_BR_TEXT;
		}
		if($defaultSpanText == null){
			$defaultSpanText = $this->DEFAULT_SPAN_TEXT;
		}

		if($maxLen <= 0) { $maxLen = $this->MAX_FILE_SIZE; }
		
		// $dom = new SimpleHtmlDomTrait(
		// 	null,
		// 	$lowercase,
		// 	$forceTagsClosed,
		// 	$target_charset,
		// 	$stripRN,
		// 	$defaultBRText,
		// 	$defaultSpanText
		// );

		
		$contents = file_get_contents(
			$url,
			$use_include_path,
			$context,
			$offset,
			$maxLen
		);

		
		if (empty($contents) || strlen($contents) > $maxLen) {
			
			// $dom->clear();
			return false;
		}

		$urList = $this->load($contents, $lowercase, $stripRN);
		dd($urList);
		
		return $dom->load($contents, $lowercase, $stripRN);
	}

	public function str_get_html(
		$str,
		$lowercase = true,
		$forceTagsClosed = true,
		$target_charset = null,
		$stripRN = true,
		$defaultBRText = null,
		$defaultSpanText = null)
	{

		if($target_charset == null){
			$target_charset = $this->DEFAULT_TARGET_CHARSET;
		}

		if($defaultBRText == null){
			$defaultBRText = $this->DEFAULT_BR_TEXT;
		}
		if($defaultSpanText == null){
			$defaultSpanText = $this->DEFAULT_SPAN_TEXT;
		}

		// $dom = new SimpleHtmlDomTrait(
		// 	null,
		// 	$lowercase,
		// 	$forceTagsClosed,
		// 	$target_charset,
		// 	$stripRN,
		// 	$defaultBRText,
		// 	$defaultSpanText
		// );

		if (empty($str) || strlen($str) > $this->MAX_FILE_SIZE) {
			$dom->clear();
			return false;
		}
		$urList = $this->load($str, $lowercase, $stripRN);
		dd($urList);
		return $dom->load($str, $lowercase, $stripRN);
	}

	public function dump_html_tree($node, $show_attr = true, $deep = 0)
	{
		$node->dump($node);
	}
}