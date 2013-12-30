<?php
// coder info

$track= "data/srm";
if ($tab == "algo") {
	$track = "data/srm";
}else if ($tab == "develop") {
	$track = "develop";
}else if ($tab == "design") {
	$track = "design";
}
global $coder;
$coder = get_member_statistics ( $handle, $track );
$dev =$coder->Tracks->Development;


// chart
include_once TEMPLATEPATH . '/chart/Highchart.php';


// line chart
$chart = new Highchart ();
$chart->chart = array (
		'renderTo' => 'algoChart',
		'type' => 'line',
		'marginRight' => 20,
		'marginBottom' => 10 
);

$chart->credits = array (
		'enabled' => false 
);

$chart->title = array (
		'text' => null 
);

$chart->yAxis = array (
		'title' => array (
				'text' => null 
		),
		'plotLines' => array (
				array (
						'value' => 0,
						'width' => 1,
						'color' => '#808080' 
				) 
		) 
);
$chart->xAxis = array (
		'labels' => array (
				'enabled' => false 
		) 
);
$chart->legend = array (
		'enabled' => false 
);

$chart->series [] = array (
		'name' => 'SRM 400',
		'data' => array (
				7.0,
				6.9,
				9.5,
				14.5,
				18.2,
				21.5,
				25.2,
				26.5,
				23.3,
				18.3,
				13.9,
				9.6 
		) 
);
$chart->series [] = array (
		'name' => 'SRM 401',
		'data' => array (
				- 0.2,
				0.8,
				5.7,
				11.3,
				17.0,
				22.0,
				24.8,
				24.1,
				20.1,
				14.1,
				8.6,
				2.5 
		) 
);
$chart->series [] = array (
		'name' => 'SRM 402',
		'data' => array (
				- 0.9,
				0.6,
				3.5,
				8.4,
				13.5,
				17.0,
				18.6,
				17.9,
				14.3,
				9.0,
				3.9,
				1.0 
		) 
);
$chart->series [] = array (
		'name' => 'SRM 405',
		'data' => array (
				3.9,
				4.2,
				5.7,
				8.5,
				11.9,
				15.2,
				17.0,
				16.6,
				14.2,
				10.3,
				6.6,
				4.8 
		) 
);

$chart->tooltip->formatter = new HighchartJsExpr ( "function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y ;}" );


?>



<div id="develop" class="tab algoLayout">
	<div class="ratingInfo">
		<header class="head">
			<div class="trackNRating">
				<h4 class="trackName">Development Competitions</h4>
				<div class="rating"><?php echo $dev->rating;?></div>
				<div class="lbl">Rating</div>
			</div>
			<div class="detailedRating">
				<div class="row">
					<label>Percentile:</label>
					<div class="val"><?php echo $dev->percentile;?></div>
				</div>
				<div class="row">
					<label>Volatility:</label>
					<div class="val"><?php echo $dev->volatility;?></div>
				</div>
				<div class="row">
					<label>Rank:</label>
					<div class="val"><?php echo $dev->rank;?> of <?php echo $dev->activeMembers;?></div>
				</div>
				<div class="row">
					<label>Country Rank:</label>
					<div class="val"><?php echo $dev->countryRank;?> of <?php echo $dev->activeCountryMembers;?></div>
				</div>
				<div class="row">
					<label>School Rank:</label>
					<div class="val"><?php echo $dev->schoolRank;?> of <?php echo $dev->activeSchoolMembers;?></div>
				</div>
				<div class="row">
					<label>Competitions:</label>
					<div class="val"><a href="#"><?php echo $dev->competitions;?></a></div>
				</div>
				<div class="row">
					<label>Maximum Rating: </label>
					<div class="val"><?php echo $dev->maximumRating;?></div>
				</div>
				<div class="row">
					<label>Minimum Rating: </label>
					<div class="val"><?php echo $dev->minimumRating;?></div>
				</div>
				<div class="row">
					<label>Reviewer Rating: </label>
					<div class="val"><a href="#"><?php echo $dev->reviewerRating;?></a></div>
				</div>
				<div class="clear"></div>
			</div>
		</header>
		<div class="ratingViews">
			<div id="graphView">
				<div class="subTrackTabs">
					<div class="srm subTrackTab">
						<div class="chartWrap">
							<div id="algoChart" class="chart"></div>
						<?php $chart->printScripts(); ?>   
						<script type="text/javascript">						
							<?php echo $chart->render("algoChart"); ?>
						</script>
						</div>
					</div>
					<nav class="tabNav">
						<ul>
							<li><a href="javascript:;" class="isActive">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
						</ul>
					</nav>
				</div>
				<!-- /.subTrackTabs -->
			</div>
			<!-- /#graphView -->
			<div id="tabularView" class="hide">
				<div class="subTrackTabs">
					<div class="srm subTrackTab">
						<div class="tableView">							
							<article class="mainTabStream">
								<div class="tableWrap">
									<table class="ratingTable">
										<caption>Submissions</caption>
										<thead>
											<tr>
												<th class="colDetails">Details</th>
												<th class="colTotal">Total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="colDetails">Inquiries</td>
												<td class="colTotal"><?php echo $dev->inquiries; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Submissions</td>
												<td class="colTotal"><?php echo $dev->submissions; ?></td>
											</tr>
											
											<tr>
												<td class="colDetails">Submission Rate</td>
												<td class="colTotal"><?php echo $dev->submissionRate; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Passed Screening</td>
												<td class="colTotal"><?php echo $dev->passedScreening; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Screening Success Rate</td>
												<td class="colTotal"><?php echo $dev->screeningSuccessRate; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Passed Review</td>
												<td class="colTotal"><?php echo $dev->passedReview; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Review Success Rate</td>
												<td class="colTotal"><?php echo $dev->reviewSuccessRate; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Maximum Score</td>
												<td class="colTotal"><?php echo $dev->maximumScore; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Minimum Score</td>
												<td class="colTotal"><?php echo $dev->minimumScore; ?></td>
											</tr>											
											<tr class="alt">
												<td class="colDetails">Appeals</td>
												<td class="colTotal"><?php echo $dev->appeals; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Appeal Success Rate</td>
												<td class="colTotal"><?php echo $dev->appealSuccessRate; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Average Score</td>
												<td class="colTotal"><?php echo $dev->averageScore; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Average Placement</td>
												<td class="colTotal"><?php echo $dev->averagePlacement; ?></td>
											</tr>
											<tr class="alt">
												<td class="colDetails">Wins</td>
												<td class="colTotal"><?php echo $dev->wins; ?></td>
											</tr>
											<tr>
												<td class="colDetails">Win Percentage</td>
												<td class="colTotal"><?php echo $dev->winPercentage; ?></td>
											</tr>

										</tbody>
									</table>
								</div>
							</article>
							<!-- /.mainTabStream -->
						</div>
						<!-- /.tableView -->
					</div>
					<nav class="tabNav">
						<ul>
							<li><a href="javascript:;" class="isActive">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
							<li><a href="javascript:;">Loerem ipsum</a></li>
						</ul>
					</nav>
				</div>
				<!-- /.subTrackTabs -->
			</div>
			<!-- /#tabularView -->
		</div>
		<!-- /.ratingViews -->
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