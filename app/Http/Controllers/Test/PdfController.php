<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Crypt;
use App\SemrushUserAccount;
use App\User;
use App\CampaignDashboard;
use App\DashboardType;
use App\ModuleByDateRange;
use App\ProjectCompareGraph;
use App\BacklinkSummary;
use App\ApiBalance;
use App\LiveKeywordSetting;
use App\Http\Controllers\Vendor\CampaignDetailController;
use App\Http\Controllers\Vendor\LiveKeywordController;
use Http;
use App\Traits\ClientAuth;

use App\GmbLocation;
use App\AuditTask;
use App\SiteAudit;
use App\SiteAuditSummary;

use PDF;

class PdfController extends Controller
{

	public function display_pdf(){
		set_time_limit(0);
		ini_set('max_execution_time', '0');

		// try{
		$key = 'MTAwNS18LTk5LXwtVmMycDZheFVDYQ==';
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$campaign_id = $encrypted_id[0];
		$user_id = $encrypted_id[1];

		$data = SemrushUserAccount::where('user_id',$user_id)->where('id',$campaign_id)->first();
		$users = User::where('id',$user_id)->first();
		$all_dashboards = DashboardType::where('status',1)->pluck('name','id')->all();
		$baseUrl =  'https://' . $users->company_name . '.' . \config('app.DOMAIN_NAME');
		$domain_name = $users->company_name;
		$seo_content = CampaignDetailController::seo_content($domain_name,$campaign_id);
		$ppc_content = CampaignDetailController::ppc_content($domain_name,$campaign_id);


		$summary = $seo_content['summary'];
		$selectedSearch = $seo_content['selectedSearch'];
		$selected = $seo_content['selected'];
		$comparison = $seo_content['comparison'];
		$backlink_profile_summary = $seo_content['backlink_profile_summary'];
		$moz_data = $seo_content['moz_data'];
		$first_moz = $seo_content['first_moz'];
		$getGoogleAds = $ppc_content['getGoogleAds'];
		$account_id = $ppc_content['account_id'];
		$flag = $seo_content['flag'];

		$types = CampaignDashboard::
		where('user_id',$user_id)
		->where('status',1)
		->where('request_id',$campaign_id)
		->orderBy('order_status','asc')
		->orderBy('dashboard_id','asc')
		->pluck('dashboard_id')
		->all();

		$role_id = $users->role_id;

		$live_keywords = LiveKeywordController::ajax_live_keyword_listpdf('All',$campaign_id,'currentPosition','asc','','');
		$table_settings = LiveKeywordSetting::where('pdf',0)->where('request_id',$campaign_id)->pluck('heading')->all();
		$type = 'Google SEO Report';
		$share_key = $data->share_key;

		$auditTask = AuditTask::where('campaign_id',$campaign_id)->latest()->first();
		if($auditTask <> null){
			$sa_link = url('/sa/project-detail/'.$auditTask->task_id);
		}else{
			$sa_link = 'javascript:;';
		}

		
		$pdf = PDF::loadView('test.dashboard',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','first_moz','getGoogleAds','account_id','live_keywords','table_settings','type','role_id','flag','share_key','sa_link'));

		return $pdf->stream('disney.pdf');
	// 	}catch(\Exception $e){
	// 		return $e->getMessage();
	// 	}
	}

	public function display_pdf_index(){
		set_time_limit(0);
		ini_set('max_execution_time', '0');

		// try{
		$key = 'MTAwNS18LTk5LXwtVmMycDZheFVDYQ==';
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$campaign_id = $encrypted_id[0];
		$user_id = $encrypted_id[1];

		$data = SemrushUserAccount::where('user_id',$user_id)->where('id',$campaign_id)->first();
		$users = User::where('id',$user_id)->first();
		$all_dashboards = DashboardType::where('status',1)->pluck('name','id')->all();
		$baseUrl =  'https://' . $users->company_name . '.' . \config('app.DOMAIN_NAME');
		$domain_name = $users->company_name;
		$seo_content = CampaignDetailController::seo_content($domain_name,$campaign_id);
		$ppc_content = CampaignDetailController::ppc_content($domain_name,$campaign_id);


		$summary = $seo_content['summary'];
		$selectedSearch = $seo_content['selectedSearch'];
		$selected = $seo_content['selected'];
		$comparison = $seo_content['comparison'];
		$backlink_profile_summary = $seo_content['backlink_profile_summary'];
		$moz_data = $seo_content['moz_data'];
		$first_moz = $seo_content['first_moz'];
		$getGoogleAds = $ppc_content['getGoogleAds'];
		$account_id = $ppc_content['account_id'];
		$flag = $seo_content['flag'];

		$types = CampaignDashboard::
		where('user_id',$user_id)
		->where('status',1)
		->where('request_id',$campaign_id)
		->orderBy('order_status','asc')
		->orderBy('dashboard_id','asc')
		->pluck('dashboard_id')
		->all();

		$role_id = $users->role_id;

		$live_keywords = LiveKeywordController::ajax_live_keyword_listpdf('All',$campaign_id,'currentPosition','asc','','');
		$table_settings = LiveKeywordSetting::where('pdf',0)->where('request_id',$campaign_id)->pluck('heading')->all();
		$type = 'Google SEO Report';
		$share_key = $data->share_key;

		$auditTask = AuditTask::where('campaign_id',$campaign_id)->latest()->first();
		if($auditTask <> null){
			$sa_link = url('/sa/project-detail/'.$auditTask->task_id);
		}else{
			$sa_link = 'javascript:;';
		}

		return view('test.dashboard',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','first_moz','getGoogleAds','account_id','live_keywords','table_settings','type','role_id','flag','share_key','sa_link'));
		
	// 	}catch(\Exception $e){
	// 		return $e->getMessage();
	// 	}
	}


	public function display_test(){
set_time_limit(0);
		ini_set('max_execution_time', '0');
		$key = 'MTAwNS18LTk5LXwtVmMycDZheFVDYQ==';
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$campaign_id = $encrypted_id[0];
		$user_id = $encrypted_id[1];

		$data = SemrushUserAccount::where('user_id',$user_id)->where('id',$campaign_id)->first();
		$users = User::where('id',$user_id)->first();
		$all_dashboards = DashboardType::where('status',1)->pluck('name','id')->all();
		$baseUrl =  'https://' . $users->company_name . '.' . \config('app.DOMAIN_NAME');
		$domain_name = $users->company_name;
		$seo_content = CampaignDetailController::seo_content($domain_name,$campaign_id);
		$ppc_content = CampaignDetailController::ppc_content($domain_name,$campaign_id);


		$summary = $seo_content['summary'];
		$selectedSearch = $seo_content['selectedSearch'];
		$selected = $seo_content['selected'];
		$comparison = $seo_content['comparison'];
		$backlink_profile_summary = $seo_content['backlink_profile_summary'];
		$moz_data = $seo_content['moz_data'];
		$first_moz = $seo_content['first_moz'];
		$getGoogleAds = $ppc_content['getGoogleAds'];
		$account_id = $ppc_content['account_id'];
		$flag = $seo_content['flag'];

		$types = CampaignDashboard::
		where('user_id',$user_id)
		->where('status',1)
		->where('request_id',$campaign_id)
		->orderBy('order_status','asc')
		->orderBy('dashboard_id','asc')
		->pluck('dashboard_id')
		->all();


		$role_id = $users->role_id;

		$live_keywords = LiveKeywordController::ajax_live_keyword_listpdf('All',$campaign_id,'currentPosition','asc','','');
		$table_settings = LiveKeywordSetting::where('pdf',0)->where('request_id',$campaign_id)->pluck('heading')->all();
		$type = 'Google SEO Report';
		$share_key = $data->share_key;

		$auditTask = AuditTask::where('campaign_id',$campaign_id)->latest()->first();
		if($auditTask <> null){
			$sa_link = url('/sa/project-detail/'.$auditTask->task_id);
		}else{
			$sa_link = 'javascript:;';
		}

		
		$pdf = PDF::loadView('test.html', ['types'=>$types,'data','user_id'=>$user_id,'campaign_id'=>$campaign_id,'key'=>$key,'all_dashboards'=>$all_dashboards,'users'=>$users,'baseUrl'=>$baseUrl,'summary'=>$summary,'selectedSearch'=>$selectedSearch,'selected'=>$selected,'comparison'=>$comparison,'backlink_profile_summary'=>$backlink_profile_summary,'moz_data'=>$moz_data,'first_moz'=>$first_moz,'getGoogleAds'=>$getGoogleAds,'account_id'=>$account_id,'live_keywords'=>$live_keywords,'table_settings'=>$table_settings,'type'=>$type,'role_id'=>$role_id,'flag'=>$flag,'share_key'=>$share_key,'sa_link'=>$sa_link]);
		return $pdf->stream('disney.pdf');
	}

	public function display_pdf_test(){

		$key = 'MTAwNS18LTk5LXwtVmMycDZheFVDYQ==';
		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		$campaign_id = $encrypted_id[0];
		$user_id = $encrypted_id[1];

		$data = SemrushUserAccount::where('user_id',$user_id)->where('id',$campaign_id)->first();
		$users = User::where('id',$user_id)->first();
		$all_dashboards = DashboardType::where('status',1)->pluck('name','id')->all();
		$baseUrl =  'https://' . $users->company_name . '.' . \config('app.DOMAIN_NAME');
		$domain_name = $users->company_name;
		$seo_content = CampaignDetailController::seo_content($domain_name,$campaign_id);
		$ppc_content = CampaignDetailController::ppc_content($domain_name,$campaign_id);


		$summary = $seo_content['summary'];
		$selectedSearch = $seo_content['selectedSearch'];
		$selected = $seo_content['selected'];
		$comparison = $seo_content['comparison'];
		$backlink_profile_summary = $seo_content['backlink_profile_summary'];
		$moz_data = $seo_content['moz_data'];
		$first_moz = $seo_content['first_moz'];
		$getGoogleAds = $ppc_content['getGoogleAds'];
		$account_id = $ppc_content['account_id'];
		$flag = $seo_content['flag'];

		$types = CampaignDashboard::
		where('user_id',$user_id)
		->where('status',1)
		->where('request_id',$campaign_id)
		->orderBy('order_status','asc')
		->orderBy('dashboard_id','asc')
		->pluck('dashboard_id')
		->all();

		$role_id = $users->role_id;

		$live_keywords = LiveKeywordController::ajax_live_keyword_listpdf('All',$campaign_id,'currentPosition','asc','','');
		$table_settings = LiveKeywordSetting::where('pdf',0)->where('request_id',$campaign_id)->pluck('heading')->all();
		$type = 'Google SEO Report';
		$share_key = $data->share_key;

		$auditTask = AuditTask::where('campaign_id',$campaign_id)->latest()->first();
		if($auditTask <> null){
			$sa_link = url('/sa/project-detail/'.$auditTask->task_id);
		}else{
			$sa_link = 'javascript:;';
		}

		return view('test.html',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','first_moz','getGoogleAds','account_id','live_keywords','table_settings','type','role_id','flag','share_key','sa_link'));
		//return view('test.html');
	}	

}