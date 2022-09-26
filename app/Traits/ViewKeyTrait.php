<?php
namespace App\Traits;
use Crypt;
trait ViewKeyTrait {

	public function keySplit($key = null){

		$encription = base64_decode($key);
		$encrypted_id = explode('-|-',$encription);
		if(isset($encrypted_id[1])){
			$user_id = $encrypted_id[1];
			$campaign_id = $encrypted_id[0];
		}else{
			$user_id = $campaign_id = '';
		}
		
		return array('campaign_id' => $campaign_id, 'user_id'=>$user_id);
	}
}