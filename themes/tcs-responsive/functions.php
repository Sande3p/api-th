<?php 
// add featured image
add_theme_support ( 'post-thumbnails' );
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 55, 55 ); // default Post Thumbnail dimensions
}

// enables tags on pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'tags_support_all');
?>
<?php
$includes_path = TEMPLATEPATH . '/lib';
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
function tcapi_query_vars($query_vars) {
	$query_vars [] = 'contest_type';
	$query_vars [] = 'contestID';
	$query_vars [] = 'page';
	$query_vars [] = 'pages';
	$query_vars [] = 'post_per_page';
	$query_vars [] = 'handle';
	$query_vars [] = 'slug';
	$query_vars [] = 'num';
	return $query_vars;
}
add_filter ( 'query_vars', 'tcapi_query_vars' );

 
// Active Contest
add_rewrite_rule ( '^'.ACTIVE_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=challenges&contest_type=$matches[1]', 'top' );
add_rewrite_rule ( '^'.ACTIVE_CONTESTS_PERMALINK.'/([^/]*)/([0-9]*)/?$', 'index.php?pagename=active-contests&contest_type=$matches[1]&pages=$matches[2]', 'top' );


add_rewrite_rule ( '^'.DESIGN_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=$matches[1]&contest_type=design', 'top' );
add_rewrite_rule ( '^'.DEVELOP_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=$matches[1]&contest_type=develop', 'top' );
add_rewrite_rule ( '^'.DATA_CONTESTS_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=$matches[1]&contest_type=data', 'top' );

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
add_rewrite_rule ( '^'.BLOG_PERMALINK.'/([^/]*)/page/([0-9]*)/?$', 'index.php?pagename=blog-page&slug=$matches[1]&page=$matches[2]', 'top' );

// Case studies Category
//add_rewrite_rule ( '^'.CASE_STUDIES_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=case-studies&slug=$matches[1]', 'top' );
//add_rewrite_rule ( '^'.CASE_STUDIES_PERMALINK.'/([^/]*)/?$', 'index.php?pagename=case-studies&page=$matches[1]', 'top' );
//add_rewrite_rule ( '^case-studies/([^/]*)/page/([^/]*)/?$', 'index.php?pagename=case-studies&slug=$matches[1]&page=$matches[2]', 'top' );
add_rewrite_rule ( '^case-studies/page/([^/]*)/?$', 'index.php?pagename=case-studies&num=$matches[1]&slug=page', 'top' );

// challenges
add_rewrite_rule( '^challenge-details/([^/]*)/?$', 'index.php?pagename=challenge-details&contestID=$matches[1]', 'top');
/* flush */
flush_rewrite_rules ();
?>

<?php 
/* commonly used functions
 -----------------------------------*/
/* excerpt */
function new_excerpt_more( $more ) {
	return '...<br/>'.'<a href="'. get_permalink( get_the_ID() ) . '" class="more">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 27;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt($new_length = 20, $new_more = '...') {
	add_filter('excerpt_length', function () use ($new_length) {
		return $new_length;
	}, 999);
	add_filter('excerpt_more', function () use ($new_more) {
		return $new_more;
	});
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = $output;
	echo $output;
}

function custom_content($new_length = 55, $content = "" ) {	
	$output = $content;
	$output = apply_filters('wptexturize', $output);
	$output = substr($output, 0 , $new_length).'...';
	return  $output;
}

/* singnup function from given theme */
function get_cookie() {
	global $_COOKIE;
	// $_COOKIE['main_user_id_1'] = '22760600|2c3a1c1487520d9aaf15917189d5864';
	$hid = explode ( "|", $_COOKIE ['main_tcsso_1'] );
	$handleName = $_COOKIE ['handleName'];
	// print_r($hid);
	$hname = explode ( "|", $_COOKIE ['direct_sso_user_id_1'] );
	$meta = new stdclass ();
	$meta->handle_id = $hid [0];
	$meta->handle_name = $handleName;
	return $meta;
}

?>

<?php

// add menu support
add_theme_support ( 'menus' );

//remove_filter( 'the_content', 'wpautop' );


/* Promo Module Post Type */
add_action ( 'init', 'promo_register' );
function promo_register() {
	$strPostName = 'Promo Module';

	$labels = array (
			'name' => _x ( $strPostName . 's', 'post type general name' ),
			'singular_name' => _x ( $strPostName, 'post type singular name' ),
			'add_new' => _x ( 'Add New', $strPostName . ' Post' ),
			'add_new_item' => __ ( 'Add New ' . $strPostName . ' Post' ),
			'edit_item' => __ ( 'Edit ' . $strPostName . ' Post' ),
			'new_item' => __ ( 'New ' . $strPostName . ' Post' ),
			'view_item' => __ ( 'View ' . $strPostName . ' Post' ),
			'search_items' => __ ( 'Search ' . $strPostName ),
			'not_found' => __ ( 'Nothing found' ),
			'not_found_in_trash' => __ ( 'Nothing found in Trash' ),
			'parent_item_colon' => ''
	);

	$args = array (
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => false,
			'show_in_nav_menus' => true,
			'taxonomies' => array (
					'category' 
			),
			'supports' => array (
					'title',
					'editor',
					'thumbnail',
					'page-attributes'
			)
	);

	register_post_type ( 'promo', $args );
	flush_rewrite_rules ( false );
}

/* Case studies Module Post Type */
add_action ( 'init', 'case_studies_register' );
function case_studies_register() {
	$strPostName = 'Case Studies';

	$labels = array (
			'name' => _x ( $strPostName , 'post type general name' ),
			'singular_name' => _x ( $strPostName, 'post type singular name' ),
			'add_new' => _x ( 'Add New', $strPostName . ' Post' ),
			'add_new_item' => __ ( 'Add New ' . $strPostName . ' Post' ),
			'edit_item' => __ ( 'Edit ' . $strPostName . ' Post' ),
			'new_item' => __ ( 'New ' . $strPostName . ' Post' ),
			'view_item' => __ ( 'View ' . $strPostName . ' Post' ),
			'search_items' => __ ( 'Search ' . $strPostName ),
			'not_found' => __ ( 'Nothing found' ),
			'not_found_in_trash' => __ ( 'Nothing found in Trash' ),
			'parent_item_colon' => ''
	);

	$args = array (
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => false,
			'show_in_nav_menus' => true,
			'supports' => array (
					'title',
					'editor',
					'thumbnail'
			)
	);

	register_post_type ( 'case-studies', $args );
	flush_rewrite_rules ( false );
}

/**
 * Start of Theme Options Support
 */
function themeoptions_admin_menu() {
	add_theme_page ( "Theme Options", "Theme Options", 'edit_themes', basename ( __FILE__ ), 'themeoptions_page' );
}
add_action ( 'admin_menu', 'themeoptions_admin_menu' );
function themeoptions_page() {
	if ($_POST ['update_themeoptions'] == 'true') {
		themeoptions_update ();
	} // check options update
	// here's the main function that will generate our options page
	?>

<div class="wrap">
	<div id="icon-themes" class="icon32">
		<br />
	</div>
	<h2>TCS Theme Options</h2>

	<form method="POST" action="" enctype="multipart/form-data">
		<input type="hidden" name="update_themeoptions" value="true" />
		<h3>TopCoder API settings</h3>
		<table width="100%">
			<tr>
				<?php $field = 'api_user_key'; ?>
				<td width="150"><label for="<?php echo $field; ?>">API user key <i>(Enter TopCoder API user key)</i>:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
			<tr>
				<?php $field = 'case_studies_per_page'; ?>
				<td width="150"><label for="<?php echo $field; ?>">Case studies post per page:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
		</table>
		<br />
		<h3>Social Media Links</h3>
		<table width="100%">
			<tr>
				<?php $field = 'facebookURL'; ?>
				<td width="150"><label for="<?php echo $field; ?>">Facebook URL:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
			<tr>
				<?php $field = 'twitterURL'; ?>
				<td><label for="<?php echo $field; ?>">Twitter URL:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
			<tr>
				<?php $field = 'linkedInURL'; ?>
				<td><label for="<?php echo $field; ?>">LinkedIn URL:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
			<tr>
				<?php $field = 'gPlusURL'; ?>
				<td><label for="<?php echo $field; ?>">Google Plus URL:</label></td>
				<td><input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" size="100" value="<?php echo get_option($field); ?>" /></td>
			</tr>
		</table>
		<br />

		<p>
			<input type="submit" name="submit" value="Update Options" class="button button-primary" />
		</p>
	</form>

</div>
<?php
}

// Set default options
if (is_admin () && isset ( $_GET ['activated'] ) && $pagenow == 'themes.php') {
	// others 
	update_option ( 'case_studies_per_page', '16' );
	// Social Media
	update_option ( 'facebookURL', 'http://www.facebook.com/topcoderinc' );
	update_option ( 'twitterURL', 'http://www.twitter.com/topcoder' );
	update_option ( 'linkedInURL', 'http://www.youtube.com/topcoderinc' );
	update_option ( 'gPlusURL', 'https://plus.google.com/u/0/b/104268008777050019973/104268008777050019973/posts' );
}

// Update options function
function themeoptions_update() {
	// Other Options
	update_option ( 'api_user_key', $_POST ['api_user_key'] );
	update_option ( 'case_studies_per_page', $_POST ['case_studies_per_page'] );
	
	// Social Media
	update_option ( 'facebookURL', $_POST ['facebookURL'] );
	update_option ( 'twitterURL', $_POST ['twitterURL'] );
	update_option ( 'linkedInURL', $_POST ['linkedInURL'] );
	update_option ( 'gPlusURL', $_POST ['gPlusURL'] );
}
// END OF THEME OPTIONS SUPPORT

/* Register widgets */
include_once 'widget.php';

if (function_exists ( 'register_sidebar' )) {

	/*
	 * Sidebar community
	*/
	register_sidebar ( array (
			'name' => 'Sidebar Community',
			'id' => 'community_sidebar',
			'description' => 'Sidebar widget on community page',
			'before_widget' => '',
			'after_widget' => ''
	) );
	
	register_sidebar ( array (
	'name' => 'BottomBar Community',
	'id' => 'community_bottombar',
	'description' => 'Bottom bar widget on community page',
	'before_widget' => '',
	'after_widget' => ''
			) );	
	
	
}

// header menu walker
class nav_menu_walker extends Walker_Nav_Menu {
	
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array('child');
		$class_names = implode( ' ', $classes );
	
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	
	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '">';
	
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="' . (! empty ( $item->post_name ) ? esc_attr($item->post_name) : '') . '"';
	
		$item_output = sprintf( '%1$s<a%2$s><i></i>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
		);
	
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// footer menu walker
class footer_menu_walker extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array('child');
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$deptClass = "";
		if($depth == 0){
			$deptClass = "rootNode";
		}
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="'.$deptClass.'">';
		
		

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="' . (! empty ( $item->post_name ) ? esc_attr($item->post_name) : '') . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
?>
<?php
/* comments */
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS ['comment'] = $comment;
	extract ( $args, EXTR_SKIP );
	if ('div' == $args ['style']) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 90 ); ?>

	</div>
	<div class="commentText">
		<span class="arrow"></span>
		<div class="userRow">
			<a href="<?php get_comment_author_url();?>">
				<?php echo get_comment_author_link();?>
			</a>
			<span class="commentTime"> <?php printf( __('%1$s '), get_comment_date('F j, Y'))?>
			</span>
			<?php	
			if ($comment->comment_parent) {
				$parent_comment = get_comment ( $comment->comment_parent );
				echo 'to <a href="' . get_comment_author_url () . '" >' . $parent_comment->comment_author . '</a>';
			}
			?>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?> </em>
		<?php endif; ?>
		<div class="commentData">
			<?php comment_text(); ?>
		</div>
		<!-- /.commentBody -->
		<div class="actionRow">
			<?php if(get_edit_comment_link(__('Edit'),'  ','' ) !=  "" ):?>
			<span class="comment-meta commentmetadata"> <?php edit_comment_link(__('Edit'),'  ','' );?>
			</span>
			<?php endif;?>
			<span class="reply"> <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
			</span>
		</div>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
</div>


<?php endif;
}
?>