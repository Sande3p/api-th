<?php

/*
 * Template Name: Contact Us
 */
#echo "<div style='display:none'>";
#print_r($_SERVER);
#echo "</div>";
 

?>
<?php 
    get_header('secondary');
    
    $values = get_post_custom($post->ID);
	
	$hasError = false;
	$emailError = '';
	$emailSent = 'o';
	$user_name = '';
	$user_email = '';
	$mails = '';
	$temp = trim($_POST['uname']);
	$submits = trim($_POST['submit']);
	if ($submits == 'Submit') {
		if ($temp == '') {
			$emailError = 'You forgot to enter your name.';
			$hasError = true;
		}
		if ($hasError == false) {
			$user_name = $temp;
			$temp = trim($_POST['mails']);
			$user_email = $temp;
			if( strlen($temp) <= 0 )  {
				$emailError = 'You forgot to enter your mails address.';
				$hasError = true;
			} else if ( ! is_email( $temp ) ) {
				$emailError =  'You entered an invalid mails address.';
				$hasError = true;
			} else {
				$mails = $temp;
				//$emailTo = get_post_meta(get_the_ID(), "Mail List", true);
				$emailTo = get_option('emails_to');
				$emailArray = explode(',', $emailTo);
				$subject = 'Consultant Request from ' . $user_name;
				$body = "Name: $user_name \n\nEmail: $mails";
				
				foreach($emailArray as $address) {
					wp_mail( $address, $subject, $body, '' );
				}
				$emailSent = 'Your request is raised!';
				$user_email = '';
				$user_name = '';
			}
		}
	} else {
		$emailSent = '';
	}
?>
	
    <div id="mainContent">
		<div id="content">
			<div id="main" class="contactUs">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="contactUsContent">
                    <?php echo the_content();?>
                    <div class="clear"></div>
                </div>
                <div class="consultant">
                	<h4>Request a Consultant</h4>
                    <?php
						if ($hasError) {
					?>
                    <div class="error"><?php echo $emailError; ?></div>
                    <?php
						} else {
					?>
                    <div class="succ"><?php echo $emailSent; ?></div>
                    <?php
						}
					?>
                    <div class="req">
					<?php
						echo '<iframe scrolling="no" style="overflow:hidden;width:380px;height:165px" src="'.get_bloginfo('siteurl').'/?mode=iContactForm"></iframe>';
					?>
                    </div>
                    <div class="others">
                    	<h4>Customer Support</h4>
                        <?php 
						$value = get_post_meta(get_the_ID(), "Customer Support", true);
						echo $value;
						?>
                    </div>
                    <div class="others">
                    	<h4>Member Questions</h4>
                        <?php 
						$value = get_post_meta(get_the_ID(), "Member Questions", true);
						echo $value;
						?>
                    </div>
                    <div class="others">
                    	<h4>Press/ Media/ Blogger Information</h4>
                        <?php 
						$value = get_post_meta(get_the_ID(), "Press/ Media/ Blogger Information", true);
						echo $value;
						?>
                    </div>
                </div>
                <div class="clear"></div>
              	<?php endwhile; endif;?>
			</div>
		</div>
	</div>

<?php get_footer('event'); ?>