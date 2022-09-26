<?php

namespace App\Traits;

require config("app.FILE_PATH").'api/RestClient.php';

trait ClientAuth {
	
	
	public function DFSAuth(){
		$base_uri = config('app.DFS_URI');
		$user = config('app.DFS_USER');
		$pass = config('app.DFS_PASS');
		$client = new \RestClient($base_uri, null, $user, $pass);
		return $client;
	}
	
	public function locations($client){
		try {
			$result = $client->get('/v3/keywords_data/google/locations');
			return $result;
		} catch (RestClientException $e) {
			
			return json_decode($e->getMessage(), true);
		}
	}


	public static function DFSAuthConfig(){
		$base_uri = config('app.DFS_URI');
		$user = config('app.DFS_USER');
		$pass = config('app.DFS_PASS');
		$client = new \RestClient($base_uri, null, $user, $pass);
		return $client;
	}

	public function bifurcationPages($errorData = null){

        if($errorData == null){
          return null;
        }

        $criticalMetrics = [
          'duplicate_title' => 'duplicate_title',
          'duplicate_description' => 'duplicate_description',
          'duplicate_content' => 'duplicate_content',
          'broken_links' => 'broken_links',
          'broken_resources' => 'broken_resources',
        ];

        $criticalMetricsCheck = [
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

        $wraningMetrics = [
          'links_external' => 'links_external',
          'links_internal' => 'links_internal',
          'links_relation_conflict' => 'links_relation_conflict',
          'redirect_loop' => 'redirect_loop',
        ];

        $wraningMetricsCheck = [
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

        $notices = [
          'large_page_size' => 'large_page_size',
            'is_https' => '    is_https',
            'small_page_size' => '    small_page_size',
            'no_image_title' => '    no_image_title',
            'seo_friendly_url' => '    seo_friendly_url',
            'seo_friendly_url_dynamic_check' => '    seo_friendly_url_dynamic_check',
            'seo_friendly_url_relative_length_check' => '    seo_friendly_url_relative_length_check',
            'title_too_short' => '    title_too_short',
            'is_www' => '    is_www',
            'high_content_rate' => '    high_content_rate',
            'high_character_count' => '    high_character_count',
            'flash' => '    flash',
            'has_meta_refresh_redirect' => '    has_meta_refresh_redirect',
            'meta_charset_consistency' => '    meta_charset_consistency',
            'size_greater_than_3mb' => '    size_greater_than_3mb',
            'has_html_doctype' => '    has_html_doctype',
            'https_to_http_links' => '    https_to_http_links',
            'is_link_relation_conflict' => '    is_link_relation_conflict',
        ];
        
        $criticalMetricsResult = array_intersect_key($errorData,$criticalMetrics);
        $criticalMetricsCheckResult = array_intersect_key($errorData['checks'],$criticalMetricsCheck);


        $wraningMetricsResult = array_intersect_key($errorData,$wraningMetrics);
        $wraningMetricsCheckResult = array_intersect_key($errorData['checks'],$wraningMetricsCheck);

        
        $noticesResult = array_intersect_key($errorData['checks'],$notices);



        $finalArr = [
          'critical' => $criticalMetricsResult,
          'criticalCheck' => $criticalMetricsCheckResult,
          'warning' => $wraningMetricsResult,
          'warningCheck' => $wraningMetricsCheckResult,
          'notices' => $noticesResult,
        ];

        return $finalArr;

    }
	
	
}