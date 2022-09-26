<?php

namespace App\Http\Controllers\ViewKey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SemrushUserAccount;
use Crypt;
use App\User;
use App\CampaignDashboard;
use App\DashboardType;
use App\ModuleByDateRange;
use App\ProjectCompareGraph;
use App\BacklinkSummary;
use App\LiveKeywordSetting;
use App\Http\Controllers\Vendor\CampaignDetailController;

use App\GmbLocation;
use App\SemrushBacklinkSummary;
use App\AuditTask;
use App\SiteAudit;
use App\SiteAuditSummary;

class DashboardController extends Controller
{
	public function saIndex($task_id = null){

		$auditTask = AuditTask::where('task_id',$task_id)->orderBy('id','DESC')->first();
		$sitepanel = "saviewkey";
		if($auditTask == null){
			return abort(404);
		}

		if(isset($auditTask) && !empty($auditTask)){
			$taskId = $auditTask->task_id;

			if($auditTask->summary == null && $auditTask->pages == null && $auditTask->non_indexable == null){
				try {
					$client = $this->DFSAuth();
				} catch (RestClientException $e) {
					return json_decode($e->getMessage(), true);
				}

				try {
					$result = array();
					$id = $taskId;
					$result = $client->get('/v3/on_page/summary/' . $id);

				} catch (RestClientException $e) {
					echo "\n";
					print "HTTP code: {$e->getHttpCode()}\n";
					print "Error code: {$e->getCode()}\n";
					print "Message: {$e->getMessage()}\n";
					print  $e->getTraceAsString();
					echo "\n";
				}

				$summaryTask = $result['tasks'][0]['result'][0];

				$post_array[] = array(
					"id" => $taskId,
					"filters" => [
						["reason", "=", "robots_txt"],
						"and",
						["url", "like", "%go%"]
					],
					"limit" => 5,
				);

				$nonidex = $client->post('/v3/on_page/non_indexable', $post_array);

				$nonidexTask = $nonidex['tasks'][0]['result'][0];

			}else{

				$result = json_decode($auditTask->summary,true);
				$summaryTask = $result['tasks'][0]['result'][0];
				$nonidex = json_decode($auditTask->non_indexable,true);
				$nonidexTask = $nonidex['tasks'][0]['result'][0];

			}

			$issueCount = 0;
			if($summaryTask['domain_info']['checks']['sitemap'] == 0){
				$issueCount++;
			}

			if($summaryTask['domain_info']['checks']['robots_txt'] == 0){
				$issueCount++;
			}
			if($summaryTask['page_metrics']['checks']['no_favicon'] > 0){
				$issueCount++;
			}
			if($summaryTask['page_metrics']['checks']['is_4xx_code'] <> 0){
				$issueCount++;
			}
			if($summaryTask['page_metrics']['checks']['is_http'] <> 0){
				$issueCount++;
			}

			$errorsListing = $this->errorBifurcation($summaryTask);

			$auditLevel = $this->auditLevel();
			
			return view('viewkey.v1.sa-project_detail',compact('sitepanel','task_id','auditTask','summaryTask','nonidexTask','errorsListing','auditLevel','issueCount'));

		}else{
			return abort(404);
		}

	}

	public function auditLevel(){

		$auditLevel = [
			'links_external' => 'High External Linking',
			'links_internal' => 'Internal Links',
			'duplicate_title' => 'Duplicate Title',
			'duplicate_description' => 'Duplicate Description',
			'duplicate_content' => 'Duplicate On-page Content',
			'broken_links' => 'Broken links',
			'broken_resources' => 'Broken Resources',
			'links_relation_conflict' => 'Link Relation Conflict ',
			'redirect_loop' => 'Redirect Loops',
			'canonical' => 'Canonical Pages',
			'duplicate_meta_tags' => 'Duplicate Meta Tags',
			'no_description' => 'Description is missing',
			'frame' => 'Frames',
			'large_page_size' => 'Page Size is over 4 MB',
			'irrelevant_description' => 'Irrelevant Descriptions',
			'irrelevant_meta_keywords' => 'Irrelevant Meta Keywords',
			'is_https' => 'Is HTTPS (Secure Pages)',
			'is_http' => 'Is HTTP (Unsecure Pages)',
			'title_too_long' => 'Title Too Long',
			'low_content_rate' => 'Low Content Rate',
			'small_page_size' => 'Small Page Size',
			'no_h1_tag' => 'H1 is empty',
			'recursive_canonical' => 'Recursive Canonical',
			'no_favicon' => 'No Favicon',
			'no_image_alt' => 'Missing Alt text',
			'no_image_title' => 'No Image Title',
			'seo_friendly_url' => 'SEO Friendly URL',
			'seo_friendly_url_characters_check' => 'SEO Friendly URL Character Check',
			'seo_friendly_url_dynamic_check' => 'SEO Friendly URL Dynamic Check',
			'seo_friendly_url_keywords_check' => 'SEO Friendly URL Keyword Check',
			'seo_friendly_url_relative_length_check' => 'SEO Friendly URL Relative Length Check',
			'title_too_short' => 'Title Too Short',
			'no_content_encoding' => 'No Content Encoding',
			'high_waiting_time' => 'High Waiting Time',
			'high_loading_time' => 'Timed Out',
			'is_redirect' => '301 redirects',
			'is_broken' => 'Broken Pages',
			'is_4xx_code' => '4xx client errors',
			'is_5xx_code' => '5xx server errors',
			'is_www' => 'WWW URLs',
			'no_doctype' => 'No Doctype',
			'no_encoding_meta_tag' => 'No Encoding Meta Tags',
			'high_content_rate' => 'High Content Rate',
			'low_character_count' => 'Low Character Count',
			'high_character_count' => 'High Character Count',
			'low_readability_rate' => 'Low Readability Rate',
			'irrelevant_title' => 'Irrelevant Title',
			'deprecated_html_tags' => 'Deprecated HTML Tags',
			'duplicate_title_tag' => 'Duplicate Title Tags',
			'no_title' => 'Title is empty',
			'flash' => 'Flash',
			'lorem_ipsum' => 'Dummy Content',
			'has_misspelling' => 'Has Misspelling',
			'canonical_to_broken' => 'Canonical URLs To Broken Pages',
			'canonical_to_redirect' => 'Canonical URLs to Redirecting Pgaes',
			'has_links_to_redirects' => 'Has Links to Redirect Pages',
			'is_orphan_page' => 'Orphan URLs',
			'has_meta_refresh_redirect' => 'Meta Refresh Redirect',
			'meta_charset_consistency' => 'Meta Charset Consistency',
			'size_greater_than_3mb' => 'Page size is over 2 MB',
			'has_html_doctype' => 'HTML Doctype',
			'https_to_http_links' => 'HTTPS to HTTP redirect',
			'has_render_blocking_resources' => 'Render Blocking Resources',
			'redirect_chain' => 'Redirect Chains',
			'canonical_chain' => 'Canonical Chain',
			'is_link_relation_conflict' => 'Link Relation Conflict',		
		];

		return $auditLevel;

	}

	public function errorBifurcation($errorData = null){

		if($errorData == null){
			return null;
		}

		$errorList = $this->auditErrorKey();

		$criticalResult = array_intersect_key($errorData['page_metrics'],$errorList['critical']);
		$criticalCheckResult = array_intersect_key($errorData['page_metrics']['checks'],$errorList['criticalCheck']);

		$criticaldata = array_merge($criticalResult,$criticalCheckResult);

		$wraningResult = array_intersect_key($errorData['page_metrics'],$errorList['wraning']);
		$wraningCheckResult = array_intersect_key($errorData['page_metrics']['checks'],$errorList['wraningCheck']);

		$wraningdata = array_merge($wraningResult,$wraningCheckResult);

		$noticesResult = array_intersect_key($errorData['page_metrics'],$errorList['notices']);
		$noticesCheckResult = array_intersect_key($errorData['page_metrics']['checks'],$errorList['noticesCheck']);

		$noticedata = array_merge($noticesResult,$noticesCheckResult);

		$finalArr = [
			'critical' => $criticaldata,
			'warning' => $wraningdata,
			'notices' => $noticedata,
		];

		return $finalArr;
	}

	public function auditErrorKey(){

		$errors['critical'] = [
			'duplicate_title' => 'duplicate_title',
			'duplicate_description' => 'duplicate_description',
			'duplicate_content' => 'duplicate_content',
			'broken_links' => 'broken_links',
			'broken_resources' => 'broken_resources',
		];

		$errors['criticalCheck'] = [
			'canonical' => 'canonical',
			'no_description' => 'no_description',
			'is_http' => 'is_http',
			'low_content_rate' => 'low_content_rate',
			'no_h1_tag' => 'no_h1_tag',
			'recursive_canonical' => 'recursive_canonical',
			'is_broken' => 'is_broken',
			'is_4xx_code' => 'is_4xx_code',
			'is_5xx_code' => 'is_5xx_code',
			'no_title' => 'no_title',
			'canonical_to_broken' => 'canonical_to_broken',
		];

		$errors['wraning'] = [
			//'links_relation_conflict' => 'links_relation_conflict',
			'redirect_loop' => 'redirect_loop',
		];

		$errors['wraningCheck'] = [
			'duplicate_meta_tags' => 'duplicate_meta_tags',
			'frame' => 'frame',
			'irrelevant_description' => 'irrelevant_description',
			'irrelevant_meta_keywords' => 'irrelevant_meta_keywords',
			'title_too_long' => 'title_too_long',
			'no_favicon' => 'no_favicon',
			'no_image_alt' => 'no_image_alt',
			'seo_friendly_url_characters_check' => 'seo_friendly_url_characters_check',
			'seo_friendly_url_keywords_check' => 'seo_friendly_url_keywords_check',
			'no_content_encoding' => 'no_content_encoding',
			'high_waiting_time' => 'high_waiting_time',
			'high_loading_time' => 'high_loading_time',
			'is_redirect' => 'is_redirect',
			'no_doctype' => 'no_doctype',
			'low_character_count' => 'low_character_count',
			'low_readability_rate' => 'low_readability_rate',
			'irrelevant_title' => 'irrelevant_title',
			'deprecated_html_tags' => 'deprecated_html_tags',
			'duplicate_title_tag' => 'duplicate_title_tag',
			'lorem_ipsum' => 'lorem_ipsum',
			'has_misspelling' => 'has_misspelling',
			'canonical_to_redirect' => 'canonical_to_redirect',
			'has_links_to_redirects' => 'has_links_to_redirects',
			'is_orphan_page' => 'is_orphan_page',
			'has_render_blocking_resources' => 'has_render_blocking_resources',
			'redirect_chain' => 'redirect_chain',
			'canonical_chain' => 'canonical_chain',
		];

		$errors['notices'] = [
			'links_external' => 'links_external',
			'links_internal' => 'links_internal'
		];

		$errors['noticesCheck'] = [
			'large_page_size' => 'large_page_size',
			'is_https' => 'is_https',
			'no_image_title' => 'no_image_title',
			'seo_friendly_url' => 'seo_friendly_url',
			'seo_friendly_url_dynamic_check' => 'seo_friendly_url_dynamic_check',
			'seo_friendly_url_relative_length_check' => 'seo_friendly_url_relative_length_check',
			'title_too_short' => 'title_too_short',
			'is_www' => 'is_www',
			'high_content_rate' => 'high_content_rate',
			'high_character_count' => 'high_character_count',
			'flash' => 'flash',
			'has_meta_refresh_redirect' => 'has_meta_refresh_redirect',
			'meta_charset_consistency' => 'meta_charset_consistency',
			'size_greater_than_3mb' => 'size_greater_than_3mb',
			'has_html_doctype' => 'has_html_doctype',
			'https_to_http_links' => 'https_to_http_links',

		];

		return $errors;
	}


	public function index($keyenc = null){
		if($keyenc == null){
			return abort(404);
		}
		$encription = base64_decode($keyenc);
		$encrypted_id = explode('-|-',$encription);
		if(isset($encrypted_id[0]) && isset($encrypted_id[1]) && isset($encrypted_id[2])){
			$campaign_id = $encrypted_id[0];
			$user_id = $encrypted_id[1];
			$current_time = $encrypted_id[2];


			$data = SemrushUserAccount::with('ProfileInfo')->where('id',$campaign_id)->first();
			
			if($data->share_key !== $keyenc){
				return abort(404);
			}

			$check = User::check_subscription($user_id); 
			if($check == 'expired'){
				return view('viewkey.v1.expired_subscription',['user_id'=>$user_id,'campaign_id'=>$campaign_id]);
			}

			

			if($data->status != 0){
				return view('errors.archived_404');
			}

			$users = User::where('id',$user_id)->first();

			$all_dashboards = DashboardType::where('status',1)->pluck('name','id')->all();
			$baseUrl =  'https://' . $users->company_name . '.' . \config('app.DOMAIN_NAME');
			$domain_name = $users->company_name;

			$types = CampaignDashboard::
			where('user_id',$user_id)
			->where('dashboard_status',1)
			->where('request_id',$campaign_id)
			->orderBy('order_status','asc')
			->orderBy('dashboard_id','asc')
			->pluck('dashboard_id')
			->all();

			$audits = SiteAuditSummary::where('user_id',$user_id)->where('campaign_id',$campaign_id)->first();
			
			if($types[0] == 1){
				$table_settings = LiveKeywordSetting::where('viewkey',0)->where('request_id',$campaign_id)->pluck('heading')->all();
				$seo_content = CampaignDetailController::seo_content($domain_name,$campaign_id);
				$search_console = CampaignDetailController::detail_search_console($domain_name,$campaign_id);
				$ga4_data = CampaignDetailController::detail_google_analytics4($domain_name,$campaign_id);

				$compactData['ga4_selected'] = $ga4_data['duration'];
				$compactData['ga4_start_date'] = $ga4_data['start_date'];
				$compactData['ga4_end_date'] = $ga4_data['end_date'];
				$compactData['ga4_compare_start_date'] = $ga4_data['compare_start_date'];
				$compactData['ga4_compare_end_date'] = $ga4_data['compare_end_date'];
				$compactData['ga4_comparison'] = $ga4_data['comparison'];
				$compactData['ga4_compare_to'] = $ga4_data['compare_to'];

				// echo "<pre>";
				// print_r($search_console);
				// die;
				$compactData['summary'] = $seo_content['summary'];
				$compactData['selectedSearch'] = $seo_content['selectedSearch'];
				$compactData['selected_ua'] = $seo_content['selected'];
				$compactData['comparison'] = $seo_content['comparison'];
				$compactData['backlink_profile_summary'] = $seo_content['backlink_profile_summary'];
				$compactData['moz_data'] = $seo_content['moz_data'];
				$compactData['first_moz'] = $seo_content['first_moz'];
				$compactData['display_type'] = $seo_content['display_type'];
				$compactData['table_settings'] = $table_settings;
				$compactData['flag'] = $seo_content['flag'];
				$compactData['selected'] = $search_console['duration'];
				$compactData['start_date'] = $search_console['start_date'];
				$compactData['end_date'] = $search_console['end_date'];
				$compactData['compare_start_date'] = $search_console['compare_start_date'];
				$compactData['compare_end_date'] = $search_console['compare_end_date'];
				$compactData['comparison'] = $search_console['comparison'];
				$compactData['compare_to'] = $search_console['compare_to'];
				$compactData['connected'] = $seo_content['connected'];
				$compactData['connectivity'] = $seo_content['connectivity'];
			}

			if($types[0] == 2){
				$ppc_content = CampaignDetailController::ppc_content($domain_name,$campaign_id);
				$compactData['getGoogleAds'] = $ppc_content['getGoogleAds'];	
				$compactData['account_id'] = $ppc_content['account_id'];	
				$compactData['selectedSearch'] = $ppc_content['selectedSearch'];	
			}

			if($types[0] == 3){
				$gmb_content = CampaignDetailController::gmb_content('',$campaign_id);
				$compactData['data'] = $gmb_content['gtUser'];		
				$compactData['selected_customer_search'] = $gmb_content['selected_customer_search'];	
				$compactData['selected_customer_view'] = $gmb_content['selected_customer_view'];	
				$compactData['selected_customer_action'] = $gmb_content['selected_customer_action'];	
				$compactData['selected_direction_request'] = $gmb_content['selected_direction_request'];	
				$compactData['selected_phone_calls'] = $gmb_content['selected_phone_calls'];	
				$compactData['selected_photo_views'] = $gmb_content['selected_photo_views'];
			}

			if($types[0] == 4){
				$compactData['gtUser'] = $data;
				// $compactData['profile_data'] = $compactData['gtUser'];
			}
			
			$compactData['dashboardStatus'] = true;
			$compactData['keyenc'] = $keyenc;
			$compactData['campaign_id'] = $campaign_id;
			$compactData['user_id'] = $user_id;
			$compactData['all_dashboards'] = $all_dashboards;
			$compactData['types'] = $types;
			$compactData['audits'] = $audits;
			$compactData['profile_data'] = $data;

			return view('viewkey.v1.project_detail',$compactData);
		}else{
			return abort(404);
		}
		
	}

	public function sidebar($key=null,$dashtype=null,$active=null)
	{
		
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$user_id = $encrypted_id[0];
		$campaign_id = $encrypted_id[1];
		return view('includes.viewkey.sidebar_menu',compact('user_id','campaign_id','key','dashtype','active'));
	}

	public function tabs($key='')
	{
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$user_id = $encrypted_id[0];
		$campaign_id = $encrypted_id[1];

		return view('includes.viewkey.tabs',compact('user_id','campaign_id','key'));
	}

	public function breadcrumb($key='')
	{
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$user_id = $encrypted_id[0];
		$campaign_id = $encrypted_id[1];

		return view('includes.viewkey.sidebar_menu',compact('user_id','campaign_id','key'));
	}

	public function seoVisibility($key = null){
		$campaign_id = $key;
		//$selected = 3;
		// $moduleStatus = ModuleByDateRange::getModuleDateRange($campaign_id,'search_console');
		// if(!empty($moduleStatus)){
		// 	$selected = $moduleStatus->duration;
		// }
		$profile_data = SemrushUserAccount::with('ProfileInfo')->where('id',$campaign_id)->first();

		$search_console = CampaignDetailController::detail_search_console('',$campaign_id);
		$selected = $search_console['duration'];
		$start_date = $search_console['start_date'];
		$end_date = $search_console['end_date'];
		$compare_start_date = $search_console['compare_start_date'];
		$compare_end_date = $search_console['compare_end_date'];
		$comparison = $search_console['comparison'];
		$compare_to = $search_console['compare_to'];

		
		
		return view('viewkey.dashboards.visibility',compact('key','campaign_id','profile_data','selected','start_date','end_date','compare_start_date','compare_end_date','comparison','compare_to'));
	}

	public function seoRankings($key = null){
		$campaign_id = $key;
		$table_settings = LiveKeywordSetting::where('viewkey',0)->where('request_id',$campaign_id)->pluck('heading')->all();
		return view('viewkey.dashboards.rankings',compact('key','campaign_id','table_settings'));
	}

	public function seoTraffic($key = null){
		$campaign_id = $key;
		$comparison = 0; $selected = 3;
		$display_type = 'day';
		$moduleTrafficStatus = ModuleByDateRange::getModuleDateRange($campaign_id,'organic_traffic');

		if(!empty($moduleTrafficStatus)){
			$selected = $moduleTrafficStatus->duration;
			$display_type = ($moduleTrafficStatus->display_type)?:'day';
		}

		$AnalyticsCompare = ProjectCompareGraph::where('request_id',$campaign_id)->first();
		if(!empty($AnalyticsCompare)){
			$comparison = $AnalyticsCompare->compare_status;
		}

		$profile_data = SemrushUserAccount::with('ProfileInfo')->where('id',$campaign_id)->first();

			$connected = false; $connectivity = ['ua' => false, 'ga4' => false];
	        if($profile_data->google_analytics_id !== null && $profile_data->google_analytics_id !== ''){
	            $connected = true; $connectivity['ua'] = true;
	        }
	        if($profile_data->ga4_email_id !== null && $profile_data->ga4_email_id !== ''){
	            $connected = true; $connectivity['ga4'] = true;
	        }

        $users = User::where('id',$profile_data->user_id)->first();
		$domain_name = $users->company_name;

		$ga4_data = CampaignDetailController::detail_google_analytics4($domain_name,$campaign_id);

		$ga4_selected = $ga4_data['duration'];
		$ga4_start_date = $ga4_data['start_date'];
		$ga4_end_date = $ga4_data['end_date'];
		$ga4_compare_start_date = $ga4_data['compare_start_date'];
		$ga4_compare_end_date = $ga4_data['compare_end_date'];
		$ga4_comparison = $ga4_data['comparison'];
		$ga4_compare_to = $ga4_data['compare_to'];

		return view('viewkey.dashboards.traffic',compact('key','campaign_id','selected','comparison','display_type','profile_data','connected','connectivity','ga4_selected','ga4_start_date','ga4_end_date','ga4_compare_start_date','ga4_compare_end_date','ga4_comparison','ga4_compare_to'));
	}

	public function seoBacklinks($key = null){
		$campaign_id = $key;
		//$backlink_profile_summary = BacklinkSummary::where('request_id',$campaign_id)->whereDate('created_at','<=',date('Y-m-d'))->orderBy('id','desc')->first();

		$backlink_profile_summary = SemrushBacklinkSummary::where('request_id',$campaign_id)->whereDate('created_at','<=',date('Y-m-d'))->orderBy('id','desc')->first();
	    $flag = 0;
	    if(!isset($backlink_profile_summary) && $backlink_profile_summary ===  null){
	      $backlink_profile_summary = BacklinkSummary::where('request_id',$campaign_id)->whereDate('created_at','<=',date('Y-m-d'))->orderBy('id','desc')->first();
	      $flag = 1;
	    }
		return view('viewkey.dashboards.backlinks',compact('key','campaign_id','backlink_profile_summary','flag'));
	}
	public function seoGoals($key = null){
		$campaign_id = $key;
		$comparison = 0; $selected = 3;
		$display_type = 'day';
		$data = SemrushUserAccount::select('ecommerce_goals')->where('id',$campaign_id)->first();
		
		$moduleTrafficStatus = ModuleByDateRange::getModuleDateRange($campaign_id,'organic_traffic');

		if(!empty($moduleTrafficStatus)){
			$selected = $moduleTrafficStatus->duration;
			$display_type = ($moduleTrafficStatus->display_type)?:'day';
		}

		$AnalyticsCompare = ProjectCompareGraph::where('request_id',$campaign_id)->first();
		if(!empty($AnalyticsCompare)){
			$comparison = $AnalyticsCompare->compare_status;
		}
		$profile_data = SemrushUserAccount::with('ProfileInfo')->where('id',$campaign_id)->first();

		$connected = false; $connectivity = ['ua' => false, 'ga4' => false];
        if($profile_data->google_analytics_id !== null && $profile_data->google_analytics_id !== ''){
            $connected = true; $connectivity['ua'] = true;
        }
        if($profile_data->ga4_email_id !== null && $profile_data->ga4_email_id !== ''){
            $connected = true; $connectivity['ga4'] = true;
        }

        $users = User::where('id',$profile_data->user_id)->first();
		$domain_name = $users->company_name;

		$ga4_data = CampaignDetailController::detail_google_analytics4($domain_name,$campaign_id);

		$ga4_selected = $ga4_data['duration'];
		$ga4_start_date = $ga4_data['start_date'];
		$ga4_end_date = $ga4_data['end_date'];
		$ga4_compare_start_date = $ga4_data['compare_start_date'];
		$ga4_compare_end_date = $ga4_data['compare_end_date'];
		$ga4_comparison = $ga4_data['comparison'];
		$ga4_compare_to = $ga4_data['compare_to'];

		return view('viewkey.dashboards.goals',compact('key','campaign_id','selected','comparison','display_type','data','profile_data','connected','connectivity','ga4_selected','ga4_start_date','ga4_end_date','ga4_compare_start_date','ga4_compare_end_date','ga4_comparison','ga4_compare_to'));
	}

	public function seoActivity($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.activity',compact('campaign_id','key'));
	}

	public function seoAudit($key = null){
		$campaign_id = $key;
		$project_detail = SemrushUserAccount::where('id',$campaign_id)->first();
		return view('viewkey.site_audit.audit',compact('campaign_id','key','project_detail'));
	}

	public function saSeoAudit(){
		
		return view('viewkey.site_audit.sa-audit');
	}

	public function seoAuditPages($key = null){

		$campaign_id = $key;
		$filter = '';
		$project_detail = SemrushUserAccount::where('id',$campaign_id)->first();
		return view('viewkey.site_audit.audit-pages',compact('campaign_id','key','project_detail','filter'));
	}

	public function seoAuditDetails($key = null,$page = null){
		$campaign_id = $key;
		$project_detail = SemrushUserAccount::where('id',$campaign_id)->first();
		return view('viewkey.site_audit.audit-details',compact('campaign_id','key','page','project_detail'));
	}

	public function campaign_gmb_content($key = null){
		$campaign_id = $key;

		$dashboardStatus = CampaignDetailController::dashboardStatus('GMB',$campaign_id);
		
		$data = SemrushUserAccount::with('ProfileInfo')->where('id',$campaign_id)->first();

		$gmb_content = CampaignDetailController::gmb_content('',$campaign_id);
		$data = $gmb_content['gtUser'];		
		$selected_customer_search = $gmb_content['selected_customer_search'];	
		$selected_customer_view = $gmb_content['selected_customer_view'];	
		$selected_customer_action = $gmb_content['selected_customer_action'];	
		$selected_direction_request = $gmb_content['selected_direction_request'];	
		$selected_phone_calls = $gmb_content['selected_phone_calls'];	
		$selected_photo_views = $gmb_content['selected_photo_views'];	

		$gmb_location_data = GmbLocation::where('id',$data->gmb_id)->first();
		$profile_data = $data;

		return view('viewkey.dashboards.gmb',compact('key','campaign_id','data','selected_customer_search','selected_customer_view','selected_customer_action','selected_direction_request','selected_phone_calls','selected_photo_views','dashboardStatus','gmb_location_data','profile_data'));
	}

	public function campaign_social_content($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.social',compact('key','campaign_id'));
	}

	public function ppcCampaign($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.campaign',compact('key','campaign_id'));
	}

	public function ppcKeywords($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.keywords',compact('key','campaign_id'));
	}

	public function ppcAds($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.ads',compact('key','campaign_id'));
	}

	public function ppcPerformance($key = null){
		$campaign_id = $key;
		return view('viewkey.dashboards.performance',compact('key','campaign_id'));
	}

	public function seoKeywordExplorer($key = null){
		$user_id = $key;
		return view('viewkey.dashboards.keyword_explorer',compact('user_id','key'));
	}
}