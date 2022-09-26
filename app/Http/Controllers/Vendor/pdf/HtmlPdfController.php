<?php

namespace App\Http\Controllers\Vendor\pdf;

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

// use Spipu\Html2Pdf\Html2Pdf;
// use Dompdf\Dompdf;
// use Spatie\Browsershot\Browsershot;
 // use VerumConsilium\Browsershot\Facades\PDF;
// use VerumConsilium\Browsershot\Facades\Screenshot;

use Barryvdh\Snappy\Facade;
use Barryvdh\Snappy\Facades\SnappyPdf;

// use PDF;

class HtmlPdfController extends Controller {

	public function htmlPdfDownload(){

		// $type = 'Google Ads Report';
		$data = null;
		$save_to_file= '/var/www/agency.io/public/test.pdf';

		
		$pdf = \PDF::loadView('vendor.pdf.download.seo');

        $pdf->setOption('disable-javascript', true)
                ->setOption('no-background', true)
                ->setOption('margin-bottom', 15)
                ->setOption('toc', true)
                ->setOption('toc-header-text ', 'Sommaire')
                ->setOption('disable-smart-shrinking', true)
                ->setOption('enable-smart-shrinking', false)
                ->setOption('footer-right', 'Page [page]')
                /*->setOption('footer-html', $footerHtml)*/
                ->setOption('footer-font-size', 10);
        sleep(2);
        return $pdf->download('graph.pdf');

		

		$html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
		
		/*$pdf = \PDF::loadView('vendor.pdf.download.seo');

		return $pdf->download($save_to_file);*/



		
$html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
		// return PDF::loadHTML($html)->save($save_to_file);

		$pdf = PDF::loadView('vendor.pdf.download.seo');
            // download pdf
            return $pdf->download($save_to_file);

		return Screenshot::loadView('vendor.pdf.download.seo')
           ->useJPG()
           ->margins(20, 0, 0, 20)
           ->download();

		$pdfStoredPath = PDF::loadUrl('https://google.com')
                     ->storeAs('pdfs/', 'google.pdf');
         return $pdfStoredPath;
		$pdf = \PDF::loadView('vendor.pdf.download.seo',compact('type'));
		// $pdf = \PDF::loadView('vendor.pdf.download.ppc',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','getGoogleAds','account_id','type'));

		return $pdf->stream('invoice.pdf');

	}

	public function htmlPdfView(){

		$type = 'Google Ads Report';


		return view('vendor.pdf.download.seo',compact('type'));

		// $pdf = \PDF::loadView('vendor.pdf.download.ppc',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','getGoogleAds','account_id','type'));

		return $pdf->stream('invoice.pdf');
	}


	public function index(){

		$html = file_get_contents('https://waveitdigital.com/pdf/ppc/NDktfC05OS18LTE2NTQ1MDMxMDU=');

		$html2pdf = new html2pdf();
		$html2pdf->writeHTML($html); // pass in the HTML
		$html2pdf->output('myPdf.pdf', 'D'); // Generate the PDF and start download

		/*$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream();*/
		dd("here");
	}

	public function ppcPdf($key = null){

		$url = 'https://waveitdigital.com/pdf/ppc/NDktfC05OS18LTE2NTQ1MDMxMDU=';

	   // Create a stream
	   // $opts = [
	   //     "http" => [
	   //         "method" => "GET",
	   //         "header" => "Host: waveitdigital.com\r\n"
	   //             . "User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0\r\n"
	   //             . "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
	   //             . "Accept-Language: en-US,en;q=0.5\r\n"
	   //             . "Accept-Encoding: gzip, deflate, br\r\n"
	   //     ],
	   // ];

	   // $context = stream_context_create($opts);

	   // $data = file_get_contents($url, false, $context);

	   // \Storage::disk('public')->put('filename.pdf', $data);

	   // return 'OK';

   	// 	return true;

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
		$getGoogleAds = $ppc_content['getGoogleAds'];
		$account_id = $ppc_content['account_id'];

		$types = CampaignDashboard::
		where('user_id',$user_id)
		->where('status',1)
		->where('request_id',$campaign_id)
		->orderBy('order_status','asc')
		->orderBy('dashboard_id','asc')
		->pluck('dashboard_id')
		->all();

		
		$type = 'Google Ads Report';


		// $pdf = \PDF::loadView('vendor.pdf.download.ppc',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','getGoogleAds','account_id','type'));

		// return $pdf->download('invoice.pdf');

		// header("Content-Type: application/octet-stream");
		  
		// $file = "demo.pdf";
		  
		// header("Content-Disposition: attachment; filename=" . urlencode($file));   
		// header("Content-Type: application/download");
		// header("Content-Description: File Transfer");            
		// header("Content-Length: " . filesize($file));


		return view('vendor.pdf.download.ppc',compact('user_id','campaign_id','key','all_dashboards','types','data','users','baseUrl','summary','selectedSearch','selected','comparison','backlink_profile_summary','moz_data','getGoogleAds','account_id','type'));
	}

}