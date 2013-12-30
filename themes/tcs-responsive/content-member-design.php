<?php
// coder info
$track = "data/srm";
if ($tab == "algo") {
	$track = "data/srm";
} else if ($tab == "develop") {
	$track = "develop";
} else if ($tab == "design") {
	$track = "design";
}
global $coder;
$coder = get_member_statistics ( $handle, $track );
$WebDesign = $coder->Tracks->WebDesign;
$sumbissionHist = $coder->submissionHistory;
?>



<div id="develop" class="tab algoLayout designLayout">
	<div class="ratingInfo">
		<div class="submissonInfo">
			<figure class="submissionThumb">
				<img alt="" src="<?php echo $WebDesign->recentWinningSubmission; ?>">
			</figure>
			<div class="rwsDetails">
				<header class="head">
					<h4>Recent Winning Submission</h4>
				</header>
				<div class="winInfo">
					<a href="#" class="contestTitle">
						<i></i>TC - CS Storyboard Redesign Lorem Ipsum Dolor sit Amet 2
					</a>
					<div class="badgeImg"></div>
					<div class="prizeAmount">
						<span class="val"><i></i><?php echo $WebDesign->prizeWon; ?></span>
					</div>
					<div class="submittedOn">
						Submitted on: <span class="time"><?php echo $WebDesign->submittedOn; ?></span>
					</div>
				</div>
			</div>
			<!-- /.rwsDetails -->
			<div class="submissionCarousel">
				<div class="carouselWrap">
					<div class="slider">
					<?php 
						$len = count($coder->submissionHistory);
						foreach($sumbissionHist as $submission=>$submission_value)
						  {
							 echo '<div class="slide">
							<figure>
								<img alt="" src="'.get_bloginfo( 'stylesheet_directory' ).$submission_value->desingURL.'" />
							</figure>
							<div class="hide comptetionData">
								<input class="name" type="hidden" value="'.$submission_value->name.'" />
								<input class="prize" type="hidden" value="'.$submission_value->prize.'" />
								<input class="submiissionDate" type="hidden" value="'.$submission_value->submittedOn.'" />
							</div>
						</div>
						';
						  }
					?>
					
						
					</div>
				</div>
			</div>
			<!-- /.submissionCarousel -->
		</div>
		<!-- /.submissonInfo -->

	</div>
	<!-- /.ratingInfo -->
	<aside class="badges">
		<header class="head">
			<h4>Badges Cabinet</h4>
		</header>
		<?php get_template_part('content', 'badges');?>		
	</aside>
	<!-- /.badges -->
</div>
<!-- /.algoLayout -->