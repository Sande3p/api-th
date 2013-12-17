<?php
/* TC API functions for TC theme*/

function get_contest_type($userKey = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_contest_type( $userKey );	
}

function get_active_contests($contestType = '', $contestID = '30000000', $page = 1, $post_per_page = 30, $userKey = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_active_contests($contestType, $contestID, $page, $post_per_page, $userKey);
}

function get_past_contests($userKey = '', $contestType = '', $page = 1, $post_per_page = 30){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_past_contests($userKey, $contestType, $page, $post_per_page);
}

function search_contest($userKey = '', $keyword = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> search_contest($userKey, $keyword);
}

function get_contest_detail($userKey = '', $contestID = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_contest_detail($userKey, $contestID);
}

function get_raw_coder($handle = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_raw_coder($handle);
}

function get_handle($handle = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_coder('',$handle);
}

function get_activity_summary($key=''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_activitySummary('',$key);
}

function get_top_rank($key='',$topRankContestType){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_top_rank('',$topRankContestType);
}



?>