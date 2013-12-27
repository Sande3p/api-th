<?php
class TCHOOK_Public extends TCHOOK_Plugin {
	protected function init() {
		// $this->add_filter( 'pre_get_posts', 'set_post_types' );
	}
	public function set_post_types($query) {
		$query->set ( 'post_type', array (
				'post',
				'my_custom_post_type' 
		) );
		
		return $query;
	}
	
	public function get_json_from_url( $url ) {
		$response = wp_remote_get ( $url );
		#echo $url;
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			return $response ['body'];
		}
		return "Error in processing request";
	}
	
	
	// returns contest type
	// currently v2 api don't support this
	public function get_contest_type($userKey = '') {
		$response = wp_remote_get ( 'http://api.topcoder.com/v2/contestTypes?user_key=' . $userKey );
		
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$contest_list = json_decode ( $response ['body'] );
			$len = count ( $contest_list );
			$cl = array (
					$len 
			);
			for($i = 0; $i < $len; $i ++) {
				$cl [$i] = $contest_list [$i]->contestTypeName;
			}
			return $cl;
		}
		return "Error in processing request";
	}
	
	// returns most recent contest 
	public function get_most_recent_contest($contestType = '') {
		$contestType = str_replace ( "%20", "+", $contestType );
		$url =  "http://api.topcoder.com/v2/$contestType/challenges?pageIndex=1&pageSize=1";
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' )
		);
		if ($contestType == "") {
			return "Error in processing request";
		}
		$response = wp_remote_get ( $url, $args );
	
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$active_contest_list = json_decode ( $response ['body'] );
			return $active_contest_list;
		}
		return "Error in processing request";
	}
	
	// returns active contest list
	public function get_active_contests($contestType = '', $contestID = '', $page = 1, $post_per_page = 30, $userKey = '') {
		$contestType = str_replace ( "%20", "+", $contestType );
		$url =  "http://api.topcoder.com/v2/$contestType/challenges/$contestID";
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' ) 
		);
		if ($contestType == "" || $contestID == "") {
			return "Error in processing request";
		}
		$response = wp_remote_get ( $url, $args );
		
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$active_contest_list = json_decode ( $response ['body'] );
			return $active_contest_list;
		}
		return "Error in processing request";
	}
	
	// returns past contest list
	// currently v2 api don't support this
	public function get_past_contests($userKey = '', $contestType = '', $page = 1, $post_per_page = 30) {
		$contestType = str_replace ( "%20", "+", $contestType );
		$url = "http://api.topcoder.com/v2/contests?user_key=" . $userKey . "&listType=PAST&type=" . $contestType . "&sortOrder=asc";
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' ) 
		);
		$response = wp_remote_get ( $url, $args );
		
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$past_contest_list = json_decode ( $response ['body'] );
			return $past_contest_list;
		}
		return "Error in processing request";
	}
	
	// returns member profile details
	public function get_member_profile($handle = '') {
		$url = "http://api.topcoder.com/v2/users/" . $handle;
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' ) 
		);
		$response = wp_remote_get ( $url, $args );
		
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request or Member dosen't exist";
		}
		if ($response ['response'] ['code'] == 200) {
			$coder_profile = json_decode ( $response ['body'] );
			return $coder_profile;
		}
		return "Error in processing request";
	}
	
	// search contest function
	// currently v2 api don't support this
	public function search_contest($userKey = '', $keyword = '') {
		$url = "http://api.topcoder.com/v2/contests?user_key=$userKey&listType=ACTIVE&contestName=$keyword&sortOrder=asc";
		
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' ) 
		);
		$response = wp_remote_get ( $url, $args );
		
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$search_result = json_decode ( str_replace($response ['body']) );			
			return $search_result;
		}
		return "Error in processing request";
	}
	
	// detail contest
	public function get_contest_detail($userKey = '', $contestID = '', $contestType = '') {

		// This IF isn't working. It's not getting the contestType var. We need to call the design vs. develop api based on the contest type.
		#echo "	contest type ".$contestType;		
		if ($contestType == "design") {
			$url = "http://api.topcoder.com/v2/design/challenges/$contestID";
		} else {
			$url = "http://api.topcoder.com/v2/develop/challenges/$contestID";
		}	
	
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' ) 
		);
		$response = wp_remote_get ( $url, $args );
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			$search_result = json_decode ( $response ['body'] );
			return $search_result;
		}
		return "Error in processing request";
	}
	

	
		
	// handle shortcode
	function tcapi_get_raw_coder($handle = "") {
		$handle = clean_pre ( $handle );
		return get_member_profile ( $handle );
	}
		
	function tcapi_get_coder($atts, $handle = "") {
		$handle = clean_pre ( $handle );
		$coder_profile = get_member_profile ( $handle );
		$coder_ratings = $coder_profile->ratingsSummary;
		$coder_handle = $coder_profile->handle;
		
		if ($coder_handle != "") {
			$coder_color = $coder_ratings [0]->colorStyle;
			$coder_max_rating = 'NA';
			$siteURL = site_url ();
			
			if (count ( $coder_ratings ) > 0) {
				foreach ( $coder_ratings as $coder_rating ) {
					$cur_rating = $coder_rating->rating;
					if ($coder_max_rating == 'NA' || $coder_max_rating < $cur_rating) {
						$coder_max_rating = $cur_rating;
						$coder_color = $coder_rating->colorStyle;
					}
				}
			}
			
			if ($coder_profile->isPM) {
				$coder_color = "color:#FF9900";
			}
			return '<a class="tc_coder coder" href="' . $siteURL . '/member-profile/' . $coder_handle . '" style="' . $coder_color . '">' . $coder_handle . '</a>';
		}
		return $handle;
	}
	
	// Activity Summary
	function tcapi_get_activitySummary($atts, $key="") {
		$url = "http://api.topcoder.com/v2/platform/activitySummary";
		$url = "http://community.topcoder.com/tc?module=BasicData&c=tc_direct_facts&dsid=28&json=true";
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' )
		);
		$response = wp_remote_get ( $url, $args );
	
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing";
		}
		if ($response ['response'] ['code'] == 200) {
			$activity = json_decode ( $response ['body']);
			#print_r($activity);
			$key = clean_pre($key);
			if($key != null && $key != ""){
				return number_format($activity->data[0]->$key);
			}
			return $activity->data[0];
		}
		return "Error in processing request";
	}
	
	
	// Test Member Count
	function tcapi_get_member_count ($atts, $key="") {
		
		return get_activity_summary("member_count");
	}
	
	/* member stastics  */
	function tcapi_get_member_stats($handle, $track){
		$url = "http://api.topcoder.com/v2/$track/statistics/$handle";
		$args = array (
				'httpversion' => get_option ( 'httpversion' ),
				'timeout' => get_option ( 'request_timeout' )
		);
		$response = wp_remote_get ( $url, $args );
		if (is_wp_error ( $response ) || ! isset ( $response ['body'] )) {
			return "Error in processing request";
		}
		if ($response ['response'] ['code'] == 200) {
			return json_decode( $response ['body']);
		}
		return "Error in processing request";
	}
	
}

add_shortcode ( 'h', array (
		'TCHOOK_Public',
		'tcapi_get_coder' 
) );
add_shortcode ( 'activitySummary', array (
	'TCHOOK_Public',
	'tcapi_get_activitySummary'
) );


add_shortcode ( 'membercount', array (
	'TCHOOK_Public',
	'tcapi_get_member_count'
) );

/**
 * Enqueue scripts and styles
 */
add_action ( 'wp_enqueue_scripts', 'TCHOOK_inc_style' );
function TCHOOK_inc_style() {
	wp_register_style ( 'tchook-style', plugins_url ( 'css/tcapi.css', __FILE__ ) );
	wp_register_style ( 'tchook-selectyze-style', plugins_url ( 'css/Selectyze.jquery.css', __FILE__ ) );
	wp_enqueue_style ( 'tchook-style' );
	wp_enqueue_style ( 'tchook-selectyze-style' );
	wp_register_script ( 'tchook-jquery', plugins_url ( 'js/jquery.js', __FILE__ ) );
	wp_register_script ( 'tchook-script', plugins_url ( 'js/tcapi.js', __FILE__ ) );
	wp_register_script ( 'tchook-selectyze', plugins_url ( 'js/Selectyze.jquery.js', __FILE__ ) );
	wp_enqueue_script ( 'tchook-jquery' );
	wp_enqueue_script ( 'tchook-selectyze' );
	wp_enqueue_script ( 'tchook-script' );
}

/* Register widgets */
include_once 'search_contests_widget.php';

add_action ( 'widgets_init', 'load_widgets' );
function load_widgets() {
	return register_widget ( "Search_contests_widget" );
}