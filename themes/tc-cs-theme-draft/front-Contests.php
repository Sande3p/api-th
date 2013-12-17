<?php
/*
 * Template Name: Front Contests
 */
get_header ( 'contests' );

$values = get_post_custom ( $post->ID );

$userkey = get_option ( 'api_user_key' );
$siteURL = site_url();
if(have_posts()) : the_post();
?>
<div id="content" class="tcApi">
	<div class="rightLayout">
		<aside class="sidebar">
			&nbsp;
		</aside>
		<!-- End of .rightRail -->
		<div class="mainRail">		
		
			<?php
				$contest_type = get_query_var ( 'contest_type' );
				$contest_type = str_replace("_", " ", $contest_type);
				$postPerPage = get_option("contest_per_page") == "" ? 30 : get_option("contest_per_page");
			?>
			<!-- tc_contest -->
			<h2><?php the_title();?></h2>
			<script>
				var siteurl = "<?php bloginfo('siteurl');?>";
				var activePastContest = "active";
				$(document).ready(function() {
					listActiveContest("activeContest","activeContest","<?php echo $contest_type;?>");
				});
			</script>
			<div id="activeContest" class="tc_contest">
				<input type="hidden" class="contestType" value="activeContest"></input>
				<input type="hidden" class="postPerPage" value="<?php echo $postPerPage;?>"></input>
				<div class="pagingWrapper">
				</div>
				<table class="contestTable">
					<colgroup>
						<col width="315">
						<col width="140">
						<col width="71">
					</colgroup>
					<thead>
						<tr class="head">
							<td height="17">Contest</td>
							<td>Contest Type</td>
							<td align="center">First Prize</td>
							<td align="center">End</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="overlayWrapper">
					<div class="loadingOverlay"><div class="loadingGif"></div></div>
				</div>
			</div>
			<!-- /.tc_contest -->
			
			
		</div>
		<!-- End of .mainRail -->

		<div class="clear"></div>
	</div>
	<!-- End of .contentInner -->
</div>
<!-- End of #content -->
<?php endif; ?>

<?php get_footer(); ?>
