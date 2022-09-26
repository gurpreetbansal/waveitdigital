<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SemrushUserAccount;
use App\BacklinkSummary;
use App\Traits\ClientAuth;

class AuditTask extends Model {

  use ClientAuth;
  
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'audit_tasks';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id','campaign_id','postback_id','task_id','crawled_url','domain_logo','summary','pages','non_indexable','status'
  	];



    public static function auditGetLogo($url){

        
        $hostUrlFinal = parse_url($url);
        if(isset($hostUrlFinal['scheme'])){
          $domain_nameFinal = preg_replace('/^www\./', '', $hostUrlFinal['host']);
        }else{
          $domain_nameFinal = preg_replace('/^www\./', '', $hostUrlFinal['path']);
        }
        
        $html = self::curl_get_contents($url);
        preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $html, $matches);
        $filename = null;
        
        if(count($matches[1])){
          foreach($matches[1] as $key => $value){
              $fileExists = self::auditLogoExist($value);
              if($fileExists == true){
                $hostUrl = parse_url($value);
                if(isset($hostUrl['scheme'])){
                  $domain_name = preg_replace('/^www\./', '', $hostUrl['host']);
                }else{
                  $domain_name = preg_replace('/^www\./', '', $hostUrl['path']);
                }

                if($domain_name == $domain_nameFinal){
                  $filename = $value;
                  break;
                }
                
               
              }
          }
        }

        return $filename;
    }


    public static function curl_get_contents($url)
    {

      $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
       $html = curl_exec($ch);
       $data = curl_exec($ch);
       curl_close($ch);
       return $data;
    }


    public static function auditLogoExist($rFile){

        // Remote file url
        $ch = curl_init($rFile);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // Check the response code
        if($code == 200){
          return true;
        }else{
          return false;
        }
    }





    public static function createTask($user_id,$campaign_id){

        $domainDetails = SemrushUserAccount::select('id','user_id','domain_url','host_url','url_type')->where('id',$campaign_id)->first();
        
        $client = null;
        try {
          $client = $this->DFSAuth();
        } catch (RestClientException $e) {
          return json_decode($e->getMessage(), true);
        }

        $postback_id = strtotime(date('Y-m-d H:i:s'));

        $post_array[] = array(
           "target" => $domainDetails->host_url,
           "max_crawl_pages" => 50,
           "load_resources" => true,
           "enable_javascript" => true,
           "custom_js" => "meta = {}; meta.url = document.URL; meta;",
           "pingback_url" => url('/postback-siteaudit?campaign_id='.$domainDetails->id.'&postback_id='.$postback_id)
        );


        try {
          $task_post_result = $client->post('/v3/on_page/task_post', $post_array);

          $response['status'] = '1'; // Insert Data Done
          $response['error'] = '0';
          $response['message'] = 'Request sent Successfully';
        } catch (RestClientException $e) {
          $response['status'] = '2'; 
          $response['error'] = '2';
          $response['message'] = $e->getMessage();
        }

        $taskId = isset($task_post_result['tasks'][0]['id']) ? $task_post_result['tasks'][0]['id'] : null;
        if($taskId <> null){
          $create = AuditTask::create([
            'user_id'=>Auth::user()->id,
            'campaign_id'=>$campaign_id,
            'postback_id'=>$postback_id,
            'crawled_url'=>$domainDetails->host_url,
            'task_id'=>$taskId,
          ]);
        }
     
    }

}