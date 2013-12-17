<?php
// Set path to WooFramework and theme specific functions
$includes_path = TEMPLATEPATH . '/lib';
// efine('WP_SITE_URI', ($_SERVER["HTTPS"]?"https://":"http://").$_SERVER["SERVER_NAME"]);
// efine('WP_SITEURI', ($_SERVER["HTTPS"]?"https://":"http://").$_SERVER["SERVER_NAME"]);

require_once (TEMPLATEPATH . '/rewrite-config.php');

$currUrl = curPageURL();
if( strpos($currUrl,ACTIVE_CONTESTS_PERMALINK) !== false ||
	strpos($currUrl,PAST_CONTESTS_PERMALINK) !== false ||
	strpos($currUrl,REVIEW_OPPORTUNITIES_PERMALINK) !== false ) 
{
	if( strpos($currUrl,"%20") !== false ) {
		$redirectUrl = str_replace("%20", "_", $currUrl);
		$redirectString = "Location: $redirectUrl";
		print_r($redirectString);
		header($redirectString);
		exit;
	}
}


function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {	
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/**
 * add filter for query_vars
 */
add_filter ( 'query_vars', 'tcapi_query_vars' );
function tcapi_query_vars($query_vars) {
	$query_vars [] = 'contest_type';
	$query_vars [] = 'contestID';
	$query_vars [] = 'pages';
	$query_vars [] = 'post_per_page';
	$query_vars [] = 'handle';
	$query_vars [] = 'slug';
	return $query_vars;
} 
 
// Active Contest
add_rewrite_rule ( '^'.ACTIVE_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=active-contests&contest_type=$matches[1]', 'top' );
add_rewrite_rule ( '^'.ACTIVE_CONTESTS_PERMALINK.'/([^/]*)/([0-9]*)/?$', 'index.php?pagename=active-contests&contest_type=$matches[1]&pages=$matches[2]', 'top' );

// Past Contest
add_rewrite_rule ( '^'.PAST_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=past-contests&contest_type=$matches[1]', 'top' );
add_rewrite_rule ( '^'.PAST_CONTESTS_PERMALINK.'/([^/]*)/([0-9]*)/?$', 'index.php?pagename=past-contests&contest_type=$matches[1]&pages=$matches[2]', 'top' );

// Past Contest
add_rewrite_rule ( '^'.REVIEW_OPPORTUNITIES_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=review-opportunities&contest_type=$matches[1]', 'top' );
add_rewrite_rule ( '^'.REVIEW_OPPORTUNITIES_PERMALINK.'/([^/]*)/([0-9]*)/?$', 'index.php?pagename=review-opportunities&contest_type=$matches[1]&pages=$matches[2]', 'top' );

// Contest Details
add_rewrite_rule ( '^'.CONTEST_DETAILS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=contest-details&contestID=$matches[1]', 'top' );

// Member Profile
add_rewrite_rule ( '^'.MEMBER_PROFILE_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=member-profile&handle=$matches[1]', 'top' );

// Blog Category
add_rewrite_rule ( '^'.BLOG_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=blog-page&slug=$matches[1]', 'top' );

/* flush */
flush_rewrite_rules ();


/* wrap content */
// add featured image
add_theme_support ( 'post-thumbnails' );
set_post_thumbnail_size ( 158, 155 );

add_image_size ( 'featured-thumb', 374, 198, true ); // 300 pixels wide (and unlimited height)
add_image_size ( 'small-thumb', 64, 39, true );
add_image_size ( 'webinar-featured', 288, 206, true );
add_image_size ( 'webinar-thumbnail', 280, 177, true );

/* added by pemula @2013-01-21 */
function quote_tweet($atts, $content = null) {
	$contentdecode = str_replace ( ' ', '+', $content ) . ' @topcoder';
	$urlTwitter = "https://twitter.com/intent/tweet?text=$contentdecode&source=topcoder";
	
	return "<blockquote class='quotc'>" . $content . " <a href='" . $urlTwitter . "' target='_blank'>[tweet this]</a></blockquote>";
}
add_shortcode ( 'quotc', 'quote_tweet' );
function get_ID_by_slug($page_slug) {
	$page = get_page_by_path ( $page_slug );
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}
add_action ( 'after_setup_theme', 'the_theme_setup' );
function the_theme_setup() {
	global $wpdb;
	$wpdb->query ( "CREATE  TABLE IF NOT EXISTS `questionnaire` (

  `id` BIGINT NOT NULL AUTO_INCREMENT ,

  `name` VARCHAR(255) NULL ,

  `title` VARCHAR(255) NULL ,

  `company` VARCHAR(255) NULL ,

  `email` VARCHAR(255) NULL ,

  `phone` VARCHAR(255) NULL ,

  `skip` VARCHAR(500) NULL ,

  `q3` VARCHAR(500) NULL ,

  `q31` VARCHAR(500) NULL ,

  `q5` VARCHAR(500) NULL ,

  `datetimeRecord` DATETIME NOT NULL ,

  PRIMARY KEY (`id`) );" );
}

function getPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta ( $postID, $count_key, true );
	if ($count == '') {
		delete_post_meta ( $postID, $count_key );
		add_post_meta ( $postID, $count_key, '0' );
		return 0;
	}
	return $count;
}
/**
 * set post views count
 *
 * @param int $postID        	
 */
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta ( $postID, $count_key, true );
	if ($count == '') {
		$count = 0;
		delete_post_meta ( $postID, $count_key );
		add_post_meta ( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta ( $postID, $count_key, $count );
	}
}

/**
 * get 1st image from post content, if it is not existing
 * then use a default image
 *
 * @param string $content
 *        	post content
 * @return string image url
 */
function get_first_image($content) {
	$first_img = '';
	/*
	 * $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches); $first_img = $matches [1][0];
	 */
	if (empty ( $first_img )) { // Defines a default image
		$first_img = get_stylesheet_directory_uri () . '/i/news.jpg';
	}
	return $first_img;
}
function font_resizer($content) {
	$patterns [0] = '/font-size:[ ]*\d+px/i';
	$patterns [1] = '/line-height:[ ]*\d+px/';
	$patterns [2] = '/margin-right:[ ]*\d+px/';
	$patterns [3] = '/margin-left:[ ]*\d+px/';
	$replacements = array ();
	$replacements [0] = '';
	$replacements [1] = '';
	$replacements [1] = '';
	$replacements [3] = '';
	return preg_replace ( $patterns, $replacements, $content );
}

add_filter ( 'the_content', 'font_resizer' );

/* get featured image of each blog */
function get_featured_img($p) {
	// 1. get featured image
	if (has_post_thumbnail ( $p->ID )) {
		$fid = get_post_thumbnail_id ( $p->ID, 'Thumbnail' );
		// if the thumbnail id exist but the file has gone way, go to step 2
		$img = get_img_by_aid ( $fid );
		if (! empty ( $img )) {
			return $img;
		}
	}
	// 2. if not 1, get Thumbnail image
	$aid = get_post_meta ( $p->ID, 'Thumbnail', true );
	$img = get_img_by_aid ( $aid );
	if (! empty ( $img )) {
		// return $img;
	}
	// 3. if not 2, get 1st image in post content
	// 4. if not 3, get default image
	return get_first_image ( $p->post_content );
}

/**
 * get image src by attachment id
 *
 * @param type $aid        	
 * @return string
 */
function get_tc_thumbnail($p, $size) {
	if (get_the_post_thumbnail ( $p->ID )) {
		return get_the_post_thumbnail ( $p->ID, $size );
	} else {
		return "<img src='" . get_stylesheet_directory_uri () . '/i/news.jpg' . "'>";
	}
}
function get_img_by_aid($aid) {
	$thumbnailImg = wp_get_attachment_image_src ( $aid, "medium" );
	$thumbnailImg = $thumbnailImg [0];
	if ($thumbnailImg) {
		return $thumbnailImg;
	} else {
		return '';
	}
}
function sendEmail($to, $title, $msg) {
	$subject = $title;
	$headers = "From: noreply@topcoder.com\r\n" . 'X-Mailer: PHP/' . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=utf-8\r\n" . "Content-Transfer-Encoding: 8bit\r\n\r\n";
	// Send
	// cho $message;
	// mail($to, $title, $msg, $headers);
	add_filter ( 'wp_mail_content_type', create_function ( '', 'return "text/html";' ) );
	wp_mail ( $to, $title, $msg );
	// rint_r($res);
}
function get_cookie() {
	global $_COOKIE;
	// _COOKIE['main_user_id_1'] = '22760600|2c3a1c1487520d9aaf15917189d5864';
	$hid = explode ( "|", $_COOKIE ['main_tcsso_1'] );
	$handleName = $_COOKIE ['handleName'];
	// print_r($hid);
	$hname = explode ( "|", $_COOKIE ['direct_sso_user_id_1'] );
	$meta = new stdclass ();
	$meta->handle_id = $hid [0];
	$meta->handle_name = $handleName;
	return $meta;
}
function wrap_content($string, $length = 160) {
	return substr ( $string, 0, $length ) . ((strlen ( $string ) > $length) ? " ..." : "");
}

/**
 * wrap content to $len length content, and add '...' to end of wrapped conent
 */
function wrap_content_strip_html($content, $len, $strip_html = false, $sp = '\n\r', $ending = '...') {
	if ($strip_html) {
		$content = strip_tags ( $content );
	}
	$c_title_wrapped = wordwrap ( $content, $len, $sp );
	$w_title = explode ( $sp, $c_title_wrapped );
	if (strlen ( $content ) <= $len) {
		$ending = '';
	}
	return $w_title [0] . $ending;
}

/*
 * theme custom functions are here
 */
function filter_next_post_where() {
	global $post, $wpdb;
	return $wpdb->prepare ( "p.post_type = 'post'" );
}
/*
 * function new_excerpt_more($more) { global $post; return ''; } add_filter('excerpt_more', 'new_excerpt_more');
 */
function exc_more($more) {
	global $post;
	return '...';
}
add_filter ( 'excerpt_more', 'exc_more' );
function custom_excerpt_length($length) {
	return 20;
}
add_filter ( 'excerpt_length', 'custom_excerpt_length', 999 );

if (function_exists ( 'register_sidebar' )) {
	

	/*
	 * Blog page featured area
	 */
	register_sidebar ( array (
			'name' => 'Blog page featured area',
			'id' => 'blog_page_featured_area',
			'description' => 'Blog Page Featured Area',
			'before_widget' => '',
			'after_widget' => '' 
	) );
	
	/*
	 * Blog page right sidebar
	 */
	register_sidebar ( array (
			'name' => 'Blog page right sidebar',
			'id' => 'blog_page_right_sidebar',
			'description' => 'Blog page right sidebar',
			'before_widget' => '',
			'after_widget' => '' 
	) );
	
}

/**
 * add concept costom post type
 */
add_action ( 'init', 'create_post_types' );

/**
 * function to create concept custom post type and cutomer custom post type
 */
function create_post_types() {
	
	// blog
	register_post_type ( 'blog', array (
			'labels' => array (
					'name' => __ ( 'TopCoder Blog' ),
					'singular_name' => __ ( 'Blog' ),
					'add_new' => _x ( 'Add New', 'blog' ),
					'add_new_item' => __ ( 'Add New Blog' ),
					'edit_item' => __ ( 'Edit Blog' ),
					'new_item' => __ ( 'new Blog' ),
					'view_item' => __ ( 'View Blog' ),
					'search_item' => __ ( 'Search Blogs' ),
					'not_found' => __ ( 'No Blogs found' ),
					'menu_name' => __ ( 'Blogs' ) 
			),
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array (
					'post_tag',
					'category' 
			),
			'supports' => array (
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'comments',
					'custom-fields',
					'page-attributes' 
			) 
	) );
	
	register_post_type ( 'stars-of-month', array (
			'labels' => array (
					'name' => __ ( 'stars-of-month' ),
					'singular_name' => __ ( 'stars-of-month' ),
					'add_new' => _x ( 'Add New', 'Add New' ),
					'add_new_item' => __ ( 'Add New Stars Of Month' ),
					'edit_item' => __ ( 'Edit  Stars Of Month' ),
					'new_item' => __ ( 'new  Stars Of Month' ),
					'view_item' => __ ( 'View  Stars Of Month' ),
					'search_item' => __ ( 'Search  Stars Of Months' ),
					'not_found' => __ ( 'No  Stars Of Month found' ),
					'menu_name' => __ ( 'Stars Of Month' ) 
			),
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array (
					'post_tag',
					'category'  
			),
			'supports' => array (
					'title',
					'editor',
					'page-attributes',
					'author',
					'thumbnail',
					'excerpt',
					'comments',
					'custom-fields',
					'page-attributes' 	
			) 
	) );
}


function is_only_news_category($cat) {
	$return = true;
	
	$args = array (
			'cat' => $cat->cat_ID,
			'post_type' => 'pressroom' 
	);
	
	$test = new WP_Query ( $args );
	if ($test->found_posts <= 0) {
		$return = false;
	}
	
	return $return;
}

/**
 * get page link by slug
 *
 * @param string $page_slug
 *        	page slug
 * @return string page link
 */
function get_page_link_by_slug($page_slug) {
	$page = get_page_by_path ( $page_slug );
	if ($page) :
		return get_permalink ( $page->ID );
	 else :
		return "#";
	endif;
}
/**
 * get page id by slug
 *
 * @param string $page_slug
 *        	page slug
 * @return int page id
 */
function get_page_id_by_slug($page_slug) {
	$page = get_page_by_path ( $page_slug );
	if ($page) :
		return $page->ID;
	 else :
		return 0;
	endif;
}
/**
 * to determine that the page is a about or its child
 *
 * @param post $post
 *        	WordPress Post
 * @return bool true if is an about page or return false
 */
function is_about($post) {
	$about_id = get_page_id_by_slug ( 'aboutus' );
	
	if ($post->post_parent == $about_id || $post->ID == $about_id) {
		return true;
	} else {
		return false;
	}
}
// enable theme menu feature
if (function_exists ( 'add_theme_support' )) {
	add_theme_support ( 'menus' );
}

/**
 * Start of Theme Options
 */
function themeoptions_admin_menu() {
	add_theme_page ( "Theme Options", "Theme Options", 'edit_themes', basename ( __FILE__ ), 'themeoptions_page' );
}
function themeoptions_page() {
	if ($_POST ['submit'] == 'Update Options') {
		themeoptions_update ();
	} // check options update
	  // here's the main function that will generate our options page
	  // Press Rss Feed
	add_option ( 'event_feed_address', "" );
	
	// Press Room Rss Feed
	add_option ( 'press_room_feed_address', "" );
	
	// News Rss Feed
	add_option ( 'news_feed_address', "" );
	
	// Show x newest article
	add_option ( 'newest_article_count', "" );
	
	// add options to theme
	// Go to Community Portal
	add_option ( 'go-to-community-portal', "Go to Community Portal" );
	add_option ( 'go-to-community-portal-link', "http://community.topcoder.com" );
	
	// add options to theme
	// Go to Community Portal
	add_option ( 'go-to-community-portal', "Go to Community Portal" );
	add_option ( 'go-to-community-portal-link', "http://community.topcoder.com" );
	
	// Go to Platform Portal
	add_option ( 'go-to-platform-portal', "Go to Platform Portal" );
	add_option ( 'go-to-platform-portal-link', "http://apps.topcoder.com" );
	
	// login
	add_option ( 'login', "Login" );
	add_option ( 'login-link', "http://www.topcoder.com/tc?&module=Login" );
	
	// register
	add_option ( 'register', "Register" );
	
	add_option ( 'register-link', "https://www.topcoder.com/reg/" );
	
	// copyright
	add_option ( 'footer-copyright', 'Copyright TopCoder, Inc. 2001-2011' );
	
	// Terms of Use
	add_option ( 'terms-use', "Terms of Use" );
	add_option ( 'terms-use-link', "http://www.topcoder.com/tc?module=Static&d1=about&d2=terms" );
	
	// Privacy Policy
	add_option ( 'privacy-policy', "Privacy Policy" );
	add_option ( 'privacy-policy-link', "http://www.topcoder.com/tc?module=Static&d1=about&d2=privacy" );
	
	add_option ( 'twitter-link', "http://twitter.com/topcoder" );
	
	add_option ( 'linkedin-link', "http://www.linkedin.com/company/topcoder" );
	
	add_option ( 'facebook-link', "http://www.facebook.com/pages/TopCoder/237044886100" );
	add_option ( 'emails_to', "tonyj@topcoder.com,xkurnx@gmail.com" );
	
	add_option ( 'talk_url', "http://www.topcoder.com/tc" );
	
	// API user key
	add_option ( 'api_user_key', "" );
	
	?>
<div class="wrap">
	<div id="icon-themes" class="icon32">
		<br />
	</div>
	<form method="POST" action="">
		<br />
		<p>
			<label for="twitter-link"><strong>Contact Us Email :</strong></label><br />
			<input type="text" name="emails_to" id="emails_to" size="150" value="<?php echo get_option('emails_to'); ?>" />
		</p>
		<p>
			<label for="twitter-link"><strong>Want to Talk Url :</strong></label><br />
			<input type="text" name="talk_url" id="talk_url" size="150" value="<?php echo get_option('talk_url'); ?>" />
		</p>

		<p>
			<label for="api_user_key"><strong>API user key :</strong> <i>(Enter TopCoder dev API user key)</i></label><br />
			<input type="text" name="api_user_key" id="api_user_key" size="150" value="<?php echo get_option('api_user_key'); ?>" />
		</p>

		<p>
			<input type="submit" name="submit" value="Update Options" class="button button-primary" />
		</p>
	</form>

</div>
<?php
}

add_action ( 'admin_menu', 'themeoptions_admin_menu' );

// Update options function
function themeoptions_update() {
	update_option ( 'emails_to', $_POST ['emails_to'] );
	update_option ( 'talk_url', $_POST ['talk_url'] );
	update_option ( 'api_user_key', $_POST ['api_user_key'] );
}
// END of Theme Options

/**
 * Nav custom walker.
 * Needed to customize the navigation styling
 */
class increment_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		static $ctr;
		
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		
		if ($item->menu_item_parent == 0) {
			$ctr ++;
		}
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . ' nav-' . $ctr . '"';
		
		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
// END of Nav walker
function get_pagination($range = 5) {
	$result = '';
	// $paged - number of the current page
	global $paged, $wp_query;
	// How much pages do we have?
	if (! $max_page) {
		$max_page = $wp_query->max_num_pages;
	}
	
	// We need the pagination only if there are more than 1 page
	if ($max_page > 1) {
		if (! $paged) {
			$paged = 1;
		}
		// On the first page, don't put the First page link
		if ($paged != 1) {
			$result .= '<a href="' . get_pagenum_link ( $paged - 1 ) . '" class="buttonAble"><span class="buttonRight"><span class="buttonCenter"><span class="iconLeft">Prev</span></span></span></a>';
		} else {
			$result .= '<a href="javascript:;" class="buttonAble buttonDisable"><span class="buttonRight"><span class="buttonCenter"><span class="iconLeft">Prev</span></span></span></a>';
		}
		// We need the sliding effect only if there are more pages than is the sliding range
		if ($paged >= ($max_page - $range)) {
			for($i = ($max_page - $range) > 0 ? ($max_page - $range) : 1; $i <= $max_page; $i ++) {
				if ($i == $paged)
					$result .= '<a href="javascript:;" class="number disable">' . $i . '</a>';
				else
					$result .= '<a href="' . get_pagenum_link ( $i ) . '" class="number">' . $i . '</a>';
			}
		} else if ($paged >= $range && ($paged % $range != 0)) {
			$paginationPage = ceil ( $paged / $range ) - 1;
			$startPage = $paginationPage * $range;
			$lastPage = ($paginationPage * $range) + $range;
			for($i = $startPage; $i <= $lastPage; $i ++) {
				if ($i == $paged)
					$result .= '<a href="javascript:;" class="number disable">' . $i . '</a>';
				else
					$result .= '<a href="' . get_pagenum_link ( $i ) . '" class="number">' . $i . '</a>';
			}
		} else if ($paged >= $range && ($paged % $range == 0)) {
			$lastPage = ($paged + $range) > $max_page ? $max_page : ($paged + $range);
			for($i = $paged; $i <= $lastPage; $i ++) {
				if ($i == $paged)
					$result .= '<a href="javascript:;" class="number disable">' . $i . '</a>';
				else
					$result .= '<a href="' . get_pagenum_link ( $i ) . '" class="number">' . $i . '</a>';
			}
		} 		// Less pages than the range, no sliding effect needed
		else {
			for($i = 1; $i <= $range; $i ++) {
				if ($i == $paged)
					$result .= '<a href="javascript:;" class="number disable">' . $i . '</a>';
				else
					$result .= '<a href="' . get_pagenum_link ( $i ) . '" class="number">' . $i . '</a>';
			}
		}
		
		// On the last page, don't put the Last page link
		if ($paged != $max_page) {
			$result .= '<a href="' . get_pagenum_link ( $paged + 1 ) . '" class="buttonAble"><span class="buttonRight"><span class="buttonCenter"><span class="iconRight">Next</span></span></span></a>';
		} else {
			
			$result .= '<a href="javascript:;" class="buttonAble buttonDisable"><span class="buttonRight"><span class="buttonCenter"><span class="iconRight">Next</span></span></span></a>';
		}
	} else {
		echo '1';
	}
	
	return $result;
}
function wt_get_category_count($cat) {
	if ($cat != "") {
		$data = query_posts ( array (
				'posts_per_page' => - 1,
				'cat' => '' . $cat . '' 
		) );
		wp_reset_query ();
	}
	return count ( $data );
}
function wt_get_archive_year_count($archiveYear) {
	$newsCatId = get_option ( 'news_feed_address' );
	$eventsCatId = get_option ( 'event_feed_address' );
	$pressCatId = get_option ( 'press_room_feed_address' );
	
	if ($newsCatId != "" || $eventsCatId != "" || $pressCatId != "") {
		$data = query_posts ( array (
				'year' => $archiveYear,
				'posts_per_page' => - 1,
				'cat' => '' . $newsCatId . ',' . $eventsCatId . ',' . $pressCatId . '' 
		) );
		wp_reset_query ();
	}
	return count ( $data );
}
function wt_get_archive_category_count($categoryId) {
	if ($categoryId != "") {
		$data = query_posts ( array (
				'posts_per_page' => - 1,
				'cat' => $categoryId 
		) );
		wp_reset_query ();
	}
	return count ( $data );
}
function wt_get_archive_all() {
	$newsCatId = get_option ( 'news_feed_address' );
	$eventsCatId = get_option ( 'event_feed_address' );
	$pressCatId = get_option ( 'press_room_feed_address' );
	if ($newsCatId != "" || $eventsCatId != "" || $pressCatId != "") {
		$data = query_posts ( array (
				'posts_per_page' => - 1,
				'cat' => '' . $newsCatId . ',' . $eventsCatId . ',' . $pressCatId . '' 
		) );
		wp_reset_query ();
	}
	return count ( $data );
}
function wp_get_rss_permalink($category) {
	$baseUrl = get_bloginfo ( 'url' );
	if (get_option ( "permalink_structure" ) != "")
		return $baseUrl . "/feed/?cat=" . $category;
	else
		return $baseUrl . "/?feed=rss2&amp;cat=" . $category;
}
function grab_img_from_local($content) {
	$baseUrl = get_bloginfo ( 'url' );
	$ret = preg_replace ( '/src="\/wp-content/', 'src="' . $baseUrl . '/wp-content/', $content );
	return $ret;
}
class Portal_walker_nav_menu extends Walker_Nav_Menu {
	
	// add main/sub classes to li's and links
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$classes [] = 'menu-item-' . $item->ID;
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$title = strtolower ( $item->title );
		if ($title == 'webinar' || $title == 'webinar series') {
			$title = 'series';
		}
		$attributes .= ' class="' . $title . '"';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 *
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *       
	 * @param string $output
	 *        	Passed by reference. Used to append additional content.
	 * @param object $item
	 *        	Page data object. Not used.
	 * @param int $depth
	 *        	Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {
		$output .= "\n";
	}
}
class Footer_walker_nav_menu extends Walker_Nav_Menu {
	
	// add main/sub classes to li's and links
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$classes [] = 'menu-item-' . $item->ID;
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 *
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *       
	 * @param string $output
	 *        	Passed by reference. Used to append additional content.
	 * @param object $item
	 *        	Page data object. Not used.
	 * @param int $depth
	 *        	Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {
		$output .= "\n";
	}
}
function generate_title_tag() {
	if (is_single ()) :
		wp_title ( '&raquo;', true, 'right' );
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	elseif (is_page () || is_paged ()) :
		wp_title ( '&raquo;', true, 'right' );
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	elseif (is_author ()) :
		wp_title ( 'Archives for ', true, 'left' );
		echo (' &raquo; ');
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	elseif (is_archive ()) :
		wp_title ( 'Archives for ', true, 'left' );
		echo (' &raquo; ');
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	elseif (is_search ()) :
		wp_title ( 'Search Results ', true, 'left' );
		echo (' &raquo; ');
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	elseif (is_404 ()) :
		wp_title ( '404 Error Page Not Found ', false, 'left ' );
		echo ('');
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	 

	else :
		wp_title ( '&raquo', true, 'left' );
		bloginfo ( 'name' );
		echo (' - ');
		echo bloginfo ( 'description' );
	endif;
	
	// wp_title( '', true, 'right' );
}
class Top_walker_nav_menu extends Walker_Nav_Menu {
	
	/**
	 *
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *       
	 * @param string $output
	 *        	Passed by reference. Used to append additional content.
	 * @param int $depth
	 *        	Depth of page. Used for padding.
	 */
	function start_lvl(&$output, $depth) {
		$indent = str_repeat ( "\t", $depth );
		if($depth==1)
			$output .= "\n$indent<div class=\"thirdMenus\">\n";
		else
			$output .= "\n$indent<div class=\"subMenus\">\n";
	}
	function end_lvl(&$output, $depth) {
		$indent = str_repeat ( "\t", $depth );
		$output .= "\n$indent</div>\n";
	}
	
	// add main/sub classes to li's and links
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$classes [] = 'menu-item-' . $item->ID;
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		if ($depth < 1) {
			$output .= $indent . '<li>';
		}
		else if($depth == 1 ) {
			$output .= $indent . '<div class="subMenu">';
		}
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		if ($depth < 1) {
			$attributes .= ' class="menu ' . strtolower ( $item->title ) . '"';
		}
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 *
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *       
	 * @param string $output
	 *        	Passed by reference. Used to append additional content.
	 * @param object $item
	 *        	Page data object. Not used.
	 * @param int $depth
	 *        	Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {
		if ($depth < 1) {
			$output .= "</li>\n";
		}
		else if($depth == 1 ) {
			$output .= "</div>\n";
		}
	}
}
function add_custom_fields_to_rss() {
	if (get_post_type () == 'customer_carousel' && $thumbnailVal = get_post_meta ( get_the_ID (), 'Image', true )) {
		$thumbnailImg = wp_get_attachment_image_src ( $thumbnailVal, "full" );
		$thumbnailImg = $thumbnailImg [0];
		?>
<img_url><?php echo $thumbnailImg; ?></img_url>
<?php
	}
}
add_action ( 'rss2_item', 'add_custom_fields_to_rss' );

add_filter ( 'the_content', 'grab_img_from_local' );

add_theme_support ( 'post-thumbnails' );

if (! function_exists ( 'tdav_css' )) {
	function tdav_css($wp) {
		$wp .= ',' . get_template_directory_uri () . '/css/layout_eoi.css';
		return $wp;
	}
}
add_filter ( 'mce_css', 'tdav_css' );

/* e shortcodes */
function table_shortcode($atts, $content = null) {
	$content = clean_pre ( $content );
	$content = str_replace ( '||V', '|| <span class="true"></span>', $content );
	$content = str_replace ( '||X', '|| ', $content );
	$return = '<tbody>';
	$return .= str_replace ( '||', '</td><td><div>', $content );
	$return = str_replace ( '~~', '</td><td class="tooltip"><div>', $return );
	$return = str_replace ( '\\\\*', '</div></td></tr><tr class="rowAlt"><td><div>', $return );
	
	$ftr = strpos ( $return, '\\\\' );
	$return = substr_replace ( $return, '<tr><td><div>', $ftr, 2 );
	$return = str_replace ( '\\\\', '</div></td></tr><tr><td><div>', $return );
	
	$return .= '</td></tr></tbody>';
	return $return;
}

add_shortcode ( 'table', 'table_shortcode' );


?>