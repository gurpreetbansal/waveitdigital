<?php


namespace App\Traits;

use App\Traits\ReportTrait;
use App\Traits\SitemapGenerator;

use App\Http\Requests\StoreReportRequest;

use Auth;
use App\User;
use App\SemrushUserAccount;
use App\SiteAudit;
use App\SiteAuditSummary;

use App\AuditErrorList;
use URL;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


trait SiteAuditTrait
{

	use SitemapGenerator {
        SitemapGenerator::GenerateSitemap insteadof ReportTrait;
        SitemapGenerator::GenerateSitemap AS Sitemap;
    }

    use ReportTrait {
        ReportTrait::reportStore AS ReportTraitModel;
    }

    public function siteAuditRun(Request $request){

		file_put_contents(dirname(__FILE__).'/logs/runAudit.txt',print_r($request->all(),true));

		ini_set('max_execution_time', 7200);
		
		$user_id = @$request->user_id;
		$campaign_id = @$request->campaign_id;
		$url = $request->url;

		$limit = 50;
		$companyName = null;
		if($campaign_id <> null){
			$auditLimit = SemrushUserAccount::where('id',$campaign_id)->first();
			$limit = $auditLimit->audit_crawl_pages <> null ? $auditLimit->audit_crawl_pages : 50;
			$companyName = $auditLimit->company_name;
		}
		
		$domain = parse_url(str_replace(['https://www.', 'http://www.'], ['https://', 'http://'], $request->url), PHP_URL_HOST);
		if(!$domain){
			$domain = $url;
		}

		$httpStatus = SiteAudit::getIp($url);

		if($httpStatus['http_code'] == 301 || $httpStatus['http_code'] == 302){
			$url = $httpStatus['redirect_url'];
		}
		
		// $summaryAudit = SiteAuditSummary::where('user_id',$user_id)->where('project',$domain)->first();
		if($campaign_id <> null){
			$summaryAudit = SiteAuditSummary::where('user_id',$user_id)->where('campaign_id',$campaign_id)->where('project',$domain)->first();
		}else{
			$summaryAudit = SiteAuditSummary::where('user_id',$user_id)->where('project',$domain)->first();
		}
		
		$request->url = $url;
		$list = $this->GenerateSitemap($request,$limit);
		// $this->findranking($url);
		// $list = $this->curlPost($request,$limit);
		if($summaryAudit){
		// echo strtotime($summaryAudit->updated_at);
		

			// if(strtotime($summaryAudit->updated_at) < strtotime(date('Y-m-d',strtotime(' -1 month')))){
			
			// if(strtotime($summaryAudit->updated_at) < strtotime(date('Y-m-d'))){
				
				$this->updateAuditRefresh($request,$companyName,$summaryAudit->id);
			// }
			
			return [
				'status'=>true
			];
		}else{
			
			$ip = $httpStatus['primary_ip'];

			$sslStatus = SiteAudit::getSslStatus($url);
			
			$isSsl = @$sslStatus == true ? 1:0;
			$isWww = strpos(parse_url($url,PHP_URL_HOST), "www.") === 1 ? 1:0;

			$shareKey = \Uuid::generate()->string;
			
			$create = SiteAuditSummary::create([
				'user_id'=>$user_id,
				'campaign_id'=>$campaign_id,
				'url'=>$url,
				'project'=>$domain,
				'ip'=>$ip,
				'is_ssl'=>$isSsl,
				'is_www'=>$isWww,
				'share_key'=>$shareKey,
			]);
			sleep(1);
			if($create){
				$audit_id = $create->id;
				$request->request->add(['audit_id' => $audit_id]);
				
				$list = $this->curlPost($request,$limit);
				
				return [
					'status'=>true,
					'list'=>$list
				];
			}else{
				return [
					'status'=>false
				];
			}

		}
	}

	public function updateAuditRefresh(Request $request,$domain = null,$id = null){

		file_put_contents(dirname(__FILE__).'/logs/refreshAudit.txt',print_r($request->all(),true));

		ini_set('max_execution_time', 7200);
		
		$summaryAuditSummary = SiteAuditSummary::where('id',$id)->first();
		
		$httpStatus = SiteAudit::getIp($summaryAuditSummary->url);
		
		if($httpStatus['http_code'] !== 301 && $httpStatus['http_code'] !== 302 && $httpStatus['http_code'] !== 200){

			return [
				'status'=>false,
				'failer_type'=>'expire',
				'message'=>'The url does not exists.'
			];
			
		}
		
		if($summaryAuditSummary){
			$limit = $summaryAuditSummary->crowl_pages > 0 ? $summaryAuditSummary->crowl_pages : 50;
			$request->request->add(['url' => $summaryAuditSummary->url]);
			$request->request->add(['audit_id' => $summaryAuditSummary->id]);
			$request->request->add(['user_id' => $summaryAuditSummary->user_id]);

			$summaryAuditSummary->result = $summaryAuditSummary->total_tests = $summaryAuditSummary->criticals = $summaryAuditSummary->warnings = $summaryAuditSummary->notices = $summaryAuditSummary->title = $summaryAuditSummary->title = $summaryAuditSummary->meta_description = $summaryAuditSummary->headings = $summaryAuditSummary->content_keywords = $summaryAuditSummary->image_keywords = $summaryAuditSummary->seo_friendly_url = $summaryAuditSummary->seo_friendly_url = $summaryAuditSummary->noindex = $summaryAuditSummary->in_page_links = $summaryAuditSummary->favicon = $summaryAuditSummary->text_compression = $summaryAuditSummary->load_time = $summaryAuditSummary->page_size = $summaryAuditSummary->http_requests = $summaryAuditSummary->defer_javascript = $summaryAuditSummary->dom_size = $summaryAuditSummary->https_encryption = $summaryAuditSummary->plaintext_email = $summaryAuditSummary->structured_data = $summaryAuditSummary->meta_viewport = $summaryAuditSummary->meta_viewport = $summaryAuditSummary->sitemap = $summaryAuditSummary->content_length = $summaryAuditSummary->text_html_ratio = $summaryAuditSummary->inline_css = $summaryAuditSummary->inline_css = 0;
			$summaryAuditSummary->audit_status = 'process';

			if($request->limit <> null){
				$summaryAuditSummary->crowl_pages = $request->limit;
				$limit = $request->limit;
			}
			
			$summaryAuditSummary->save();

			SiteAudit::where('audit_id',$summaryAuditSummary->id)->delete();
			$list = $this->curlPost($request,$limit);
			return [
					'status'=>true,
					'list'=>$list
				];

		}else{
			return [
				'status'=>false
			];
		}
		

	}

	public function curlPost(Request $request,$limit){
		
		$endpoint = 'https://waveitdigital.com/public/crawler/index.php';
		$cURLConnection = curl_init($endpoint);
		curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, ['url' => $request->url, 'limit' => $limit]);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
		$apiResponse = curl_exec($cURLConnection);
		curl_close($cURLConnection);
		
		$urlList = json_decode($apiResponse,true);
		if($urlList  !== null){
			if(count($urlList) > 0){
				foreach ($urlList as $key => $uri) {
					$request['url'] = $uri;
					$this->reportStore($request);
				}
			}
		}
		SiteAuditSummary::updateSummaryScore($request->audit_id,'completed');
		return $urlList;
		

	}

}