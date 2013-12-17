<?php
/*
 * Template Name: Member Profile
 */
get_header ();

$values = get_post_custom ( $post->ID );

$userKey = get_option ( 'api_user_key' );
$handle = get_query_var ( 'handle' );
$siteURL = site_url ();
?>
<script>
	$(document).ready(function() {
		get_member_details("<?php echo $handle;?>");
	});
</script>			
<div id="content" class="contestContent">
	<div id="memberProfileContainer" class="container">
		<div class="mainRail">

			<div id="memberQuote" class="memberQuote">Member of the world largest global competitive community.</div>
			<div id="copilotStats">
				<h3 class="copilotAchievementsTitle copilotAchivementAjax">Copilot Achievements</h3>
				<div class="copilot-pool copilotAchivementAjax"><div class="charts">
					<div class="palisade">
						<div class="palisade-control">
							<div class="left-control">
								<div class="leftControlMask">
																							
								</div>
							</div>
							<div class="right-area">
								
								

																					
							</div>
						</div>
					</div>
				</div></div>
			</div>
			
		</div>
		<!-- End of .mainRail -->
			
		<aside class="rightRail">
			
			<div class="memberProfilePicture"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/member-placeholder.png" alt="" width="141" height="140" /></div>
			<p class="memberProfile"><span class="handle" id="handle">handle</span></p>
			<p id="memberSince" class="memberProfile"><label>Member Since</label><span class="alignRight"></span></p>
			<p id="country" class="memberProfile"><label>Country</label><span class="alignCenter"></span></p>
			
			<div class="coderAchievementTop">Coder Achievements</div>
			<table class="coderAchievementTable">
				<thead>
					<tr>
						<th width="30%">Date</th>
						<th width="70%">Description</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</aside>
			
		<div class="clear"></div>
		
		<div class="loadingOverlay"><div class="loadingGif"></div></div>
	
	</div>
	<!-- End of .contentInner -->
	
	
	
</div>
<!-- End of #content -->
<?php get_footer(); ?>
