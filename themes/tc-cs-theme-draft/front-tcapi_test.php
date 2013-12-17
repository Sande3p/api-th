<?php
/*
 * Template Name: Front API test
 */
get_header ( 'contests' );

$values = get_post_custom ( $post->ID );

$userkey = get_option ( 'api_user_key' );
$siteURL = site_url ();
?>

<div id="content" class="tcApi">
	<div class="rightLayout">
		<div class="sidebar">
			<ul>
				<li><a href="<?php echo $siteURL .'/plugin-test-page/'?> ">Plugin Test Page</a></li>
				<li><p>&nbsp;</p></li>
				<li><a href="<?php echo $siteURL .'/active-contests/'?> ">Active Contests</a></li>
				<li><a href="<?php echo $siteURL .'/active-contests/UI Prototype Competition/1/'?> "> -- UI Prototype Competition</a></li>
				<li><a href="<?php echo $siteURL .'/active-contests/Assembly Competition/1/'?> "> -- Assembly Competition</a></li>
				<li><p>&nbsp;</p></li>
				<li><a href="<?php echo $siteURL .'/past-contests/'?> ">Past Contests</a></li>
				<li><a href="<?php echo $siteURL .'/past-contests/UI Prototype Competition/1/'?> "> -- UI Prototype Competition</a></li>
				<li><a href="<?php echo $siteURL .'/past-contests/Assembly Competition/1/'?> "> -- Assembly Competition</a></li>
				<li><p>&nbsp;</p></li>
				<li><a href="<?php echo get_option ( 'lorem' )?>"> <?php echo get_option ( 'lorem' )?></a></li>
			</ul>

		</div>
		<div class="mainRail">



			<h2>Search widget</h2>
			<div class="contest_search">
			
			<?php the_widget('Search_contests_widget'); ?>
			</div>
			<br />
			<h2>Contest Type Demo: get_contest_type()</h2>
				<?php
				// demo contest type
				$userkey = get_option ( 'api_user_key' );
				$contest_type = get_contest_type ( $userkey );
				
				?>
				<ul>
					<?php
					foreach ( $contest_type as $contest ) {
						echo '<li>' . $contest . '</li>';
					}
					?>				
				</ul>

			<br />

			<h2>the_content</h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	
	<?php endwhile; endif;?>
		</div>
		<!-- End of .mainRail -->

	</div>
	<!-- End of .rightRail -->
	<div class="clear"></div>
</div>
<!-- End of #content -->

<?php get_footer(); ?>