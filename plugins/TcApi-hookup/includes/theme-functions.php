<?php
/* TC API functions for TC theme*/

function get_contest_type($userKey = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_contest_type( $userKey );	
}

function get_active_contests($contestType = '', $page = 1, $post_per_page = 30){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_active_contests( $contestType, $page, $post_per_page);
}

function get_past_contests($userKey = '', $contestType = '', $page = 1, $post_per_page = 30){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_past_contests($userKey, $contestType, $page, $post_per_page);
}

function search_contest($userKey = '', $keyword = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> search_contest($userKey, $keyword);
}

function get_contest_detail($userKey = '', $contestID = '',$contestType=''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_contest_detail($userKey, $contestID,$contestType);
}

function get_raw_coder($handle){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->tcapi_get_raw_coder($handle);
}

function get_handle($handle = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_coder('',$handle);
}

function get_activity_summary($key=''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> tcapi_get_activitySummary('',$key);
}

function get_member_statistics($handle, $track){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->tcapi_get_member_stats($handle, $track);
}

function get_json_from_url( $url ){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->get_json_from_url( $url );
}

function get_most_recent_contest($contestType = ''){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin-> get_most_recent_contest( $contestType);
}

function get_member_badges( $handle ){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->get_member_badges($handle);
}

function get_member_achievements( $handle){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->tcapi_get_member_achievements( $handle);
}

function get_forum_posts(){
	global $TCHOOK_plugin;
	return $TCHOOK_plugin->tcapi_get_forum_posts();
}

?>