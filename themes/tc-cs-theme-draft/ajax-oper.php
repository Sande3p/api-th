<?php
/** 
 * Operation to handle ajax data.
 * Template Name: Ajax
 */
$type = $_POST['a_type'];

if ($type == 'register') {
	
	$email = trim($_POST['emailField']);
	
	if (!is_email($email)) {
		echo 'Invalid email.';
	} else {
		$pid = trim($_POST['pid']);
		$name = trim($_POST['nameField']);
		$username = trim($_POST['usernameField']);
		$email = trim($_POST['emailField']);
		$password = trim($_POST['pwdField']);
		insertUserTable($pid, $name, $username, $email, $password);
		echo 'Register Complete!';
	}
}
if ($type == 'download') {
	
	$email = trim($_POST['mailField']);
	
	if (!is_email($email)) {
		echo 'Invalid email.';
	} else {
		$fname = trim($_POST['fnField']);
		$lname = trim($_POST['lnField']);
		$company = trim($_POST['cField']);
		$title = trim($_POST['tField']);
		insertDownloadTable('', $fname, $lname, $company, $title, $email);
		echo 'Register Complete!';
	}
}

if ($type == 'fetchYDetail') {
	if (isset($_POST['pid'])) {
		$pid = trim($_POST['pid']);
		$res = array();
		$web = get_post($pid);
		$id = $web->ID;
		$title = $web->post_title;
		$webinar['date'] = get_the_time('d F Y', $id);
		$webinar['title'] = $title;
		$webinar['category'] = get_post_meta($id, "Category", true);
		$webinar['schedule'] = get_post_meta($id, "Schedule", true);
		$webinar['videoId'] = get_post_meta($id, "Video ID", true);
		$webinar['desc'] = get_post_meta($id, "Meeting Description", true);
		
		$hosts = get_post_meta($id, "Hosts", true);
		$hostArray = split(',', $hosts);
		$hosts = array();
		foreach($hostArray as $host) {
			$h = array();
			$user = get_user_by('login', $host);
			$h['login'] = $user->display_name;
			$h['url'] = $user->user_url;
			array_push($hosts, $h);
		}
		$webinar['hosts'] = $hosts;
		
		$output = json_encode( $webinar );
		echo $output;
	}
}

if ($type == 'fetchDetail') {
	if (isset($_POST['pid'])) {
		
		$pid = trim($_POST['pid']);
		$res = array();
		$web = get_post($pid);
		$id = $web->ID;
		$title = $web->post_title;
		$webinar = array();
		$webinar['id'] = $id;
		$webinar['date'] = get_the_time('d F Y', $id);
		$webinar['title'] = $title;
		$webinar['category'] = get_post_meta($id, "Category", true);
		$webinar['schedule'] = get_post_meta($id, "Schedule", true);
		$webinar['desc'] = get_post_meta($id, "Meeting Description", true);
		$webinar['duration'] = get_post_meta($id, "Video Duration", true);
		$webinar['post_status'] = $web->post_status ;
		$webinar['url_reg'] = get_post_meta($id, "Register URL", true);
		
		$thumbnailVal = get_post_meta($id,"Video Thumbnail",true);
		
		$thumbnailImg = wp_get_attachment_image_src(get_post_thumbnail_id($id),"thumbnail",true);
		if ( ! preg_match("/includes/i", $thumbnailImg[0] ) ) {
			$webinar['thumbnail'] = $thumbnailImg[0];
		}
		else{
			$webinar['thumbnail'] = get_bloginfo( 'stylesheet_directory' ).'/i/webinar/title.png';
		}
		$videoURL = get_post_meta($id, "Video URL", true); // new version, no upload but full URL 
		$videoURL = "http://www.youtube.com/embed/" . get_post_meta($id, "Video ID", true) . "?wmode=transparent"; // but for now, all to youtube
		if (get_post_meta($id, "Video ID", true) != null or get_post_meta($id, "Video URL", true) !=null ) {
			$webinar['hasvideo'] = true;
			} else {
			$webinar['hasvideo'] = false;
		}
		
		
		$webinar['videoUrl'] = $videoURL;
		
		$hosts = get_post_meta($id, "Hosts", true);
		$hostArray = split(',', $hosts);
		$hosts = array();
		foreach($hostArray as $host) {
			$h = array();
			$user = get_user_by('login', $host);
			$h['login'] = $user->display_name;
			$h['url'] = $user->user_url;
			array_push($hosts, $h);
		}
		$webinar['hosts'] = $hosts;
		
		
		$p = get_post_meta($id, "Prensenter", true);
		$pArray = split(',', $p);
		$pa = array();
		foreach($pArray as $presenter) {
			$pres = array();
			$user = get_user_by('login', $presenter);
			$pres['login'] = $user->display_name;
			$pres['url'] = $user->user_url;
			$pres['description'] = get_user_meta($user->ID, 'description', true);
			$pres['photo'] = userphoto__get_userphoto($user->ID, USERPHOTO_FULL_SIZE, '', '', array(), '');
			array_push($pa, $pres);
		}
		$webinar['presenter'] = $pa;
		
		
		$videoId = get_post_meta($web->ID, "Video", true);
		$videoUrl = wp_get_attachment_url( $videoId );
		$videoPath = get_attached_file($videoId);
		if ($videoUrl) {
        	$webinar['downloadLink'] = esc_url( $videoURL );
		}
		
		$webinar['permalink'] = esc_url( get_permalink($id));
				
		$output = json_encode( $webinar );
		echo $output;
	}
}

if ($type == 'fetchByMonth') {
	// Fetch the webinar by date.
	if (isset($_POST['year']) && isset($_POST['month'])) {
		$year = $_POST['year'];
		$month = $_POST['month'];
		$args = array(
			'post_type'		=> 'webinar',
			'post_status'	=> 'publish+published',
			'year'			=> $year,
			'category_name' => 'webinars',
			'monthnum'			=> $month
		);
		//print_r($args);
		
		query_posts($args);
		$res = array();
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				$id = get_the_ID();
				
				$thumbnailVal = get_post_meta($post->ID,"Video Thumbnail",true);
				$thumbnailImg = wp_get_attachment_image_src( $thumbnailVal, "medium" );
				if ($thumbnailImg) {
                	$thumbnailImg = $thumbnailImg[0];
				}
				
				$videoId = get_post_meta($post->ID, "Video", true);
				$videoUrl = wp_get_attachment_url( $videoId );
				$videoPath = get_attached_file($videoId);
				$videoLink = '';
				if ($videoUrl) {
					$videoLink = esc_url( get_permalink( get_page_by_title( "Download Spec Page" ) ) ) . '?file=' .  $videoId;
				}
				$data = array(
					'id'		=> $id,
					'date'		=> get_the_time('d F Y', $id),
					'title'		=> get_the_title(),
					'excerpt'	=> get_the_excerpt(),
					'thumbnail'	=> $thumbnailImg,
					'link'		=> $videoLink
				);
				$res[] = $data;
			}
		}
		
		
		
		
		$output = json_encode( $res );
		/*
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Length: ' . strlen( $output ) );
		*/
	    echo $output;
	}
		
}

if ($type == 'eventFetchByMonth') {
	// Fetch the webinar by date.
	
	if (isset($_POST['year']) && isset($_POST['month'])) {
		$year = $_POST['year'];
		$month = $_POST['month'];
		
		$args = array(
			'post_type'		=> 'event',
			'post_status'		=> 'publish,future',
			'year'			=> $year,
			'monthnum'			=> $month
		);
		
		query_posts($args);
		$res = array();
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				$id = get_the_ID();
				
				$link = get_post_meta($id,"Link",true) != null ? get_post_meta($id,"Link",true) : "javascript:;";
				$thumbnailImg = wp_get_attachment_url( get_post_thumbnail_id($id) );
				$data = array(
					'id'		=> $id,
					'date'		=> get_the_time('d F Y', $id),
					'title'		=> get_the_title(),
					'excerpt'	=> get_the_excerpt(),
					'thumbnail'	=> $thumbnailImg,
					'link'		=> $link
				);
				$res[] = $data;
			}
		}
		
		
		
		
		$output = json_encode( $res );
		/*
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Length: ' . strlen( $output ) );
		*/
	    echo $output;
	}
		
}
?>