<?php
/**
 * Template Name: Challenge details
 */
?>
<?php

$isChallengeDetails = true;

get_header('challenge'); 


$values = get_post_custom ( $post->ID );

$userkey = get_option ( 'api_user_key' );
$siteURL = site_url ();


$contestID = get_query_var('contestID');
//$contestType = get_query_var ( 'type' );
$contestType = $_GET['type'];
$contest = get_contest_detail('',$contestID, $contestType);
?>

<?php
// get contest details
	$contest_type = get_query_var ( 'contest_type' );
	$contest_type = str_replace("_", " ", $contest_type);
	$postPerPage = get_option("contest_per_page") == "" ? 30 : get_option("contest_per_page");
?>

<div class="content" >
	<div id="main">
	
	<div class="container">
					<header class="pageHeading aboutPage">
						<h1><?php echo $contest->challengeName;?></h1>
                        <h2>CONTEST TYPE: <span><?php echo $contest->challengeType;?></span></h2>
					</header>
                    
                    <div id="stepBox"> 
						<div class="container">
							 
                             <div class="leftColumn">
                             	<a class="btn btnRegisterDeac" href="http://community.topcoder.com/tc?module=ProjectDetail&pj=<?php echo $contest->challengeId ;?>"><span>1</span> <strong>Register For This Contest</strong></a>
                                <a class="btn btnSubmit" href="http://community.topcoder.com/tc?module=ProjectDetail&pj=<?php echo $contest->challengeId ;?>"><span>2</span> <strong>Submit Your Entries</strong></a> 
                             </div>
                             
                             <div class="middleColumn">
                             	<table> 
                                  <tbody><tr>
                                    <td class="fifty">
                                    	<h2>1st PLACE</h2>
                                        <h3><small>$</small><?php if( $contest->prize[0] !== null){echo number_format($contest->prize[0]);}?></h3>
                                    </td>
                                    <td class="fifty">
                                    	<h2>2nd PLACE</h2>
                                        <h3><small>$</small><?php if( $contest->prize[1] !== null){echo number_format($contest->prize[1]);}?></h3>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                    	<p class="realibilityPara">Reliability Bonus <span>$<?php echo $contest->reliabilityBonus;?></span></p>
                                    </td>
                                    <td>
                                    	<p class="drPointsPara">DR Points <span><?php echo $contest->digitalRunPoints;?></span></p>
                                    </td>
                                  </tr>
                                </tbody></table>
                             </div>
                             
                             <div class="rightColumn">
 
                            <div class="nextBox "> 
                    
                                <div class="nextBoxContent nextDeadlineNextBoxContent">
                                	<div class="icoTime">
                                        <span class="nextDTitle">Current Phase</span>
                                        <span class="CEDate"><?php echo $contest->currentStatus;?></span>
                                    </div>
                                    <span class="timeLeft">3<small>Days</small> 11<small>Hours</small> 5<small>Mins</small></span>
                                </div>
                                <!--End nextBoxContent-->
                                <div class="nextBoxContent allDeadlineNextBoxContent hide">
                                    <p><label>Posted On:</label><span><?php echo $contest->postingDate;?></span></p>
                    
                                    
                                        <p><label>Register By:</label>
                                           <span><?php echo $contest->registrationEndDate ;?>
                                           </span>
                                        </p>
                                    <p class="last"><label>Submit By:</label><span><?php echo $contest->submissionEndDate ;?></span></p>
                    
                                </div>
                                <!--End nextBoxContent-->
                            </div>
                    
                            <!--End nextBox-->
                            <div class="deadlineBox"> 
                    
                                <div class="deadlineBoxContent nextDeadlinedeadlineBoxContent ">
                                    <a class="viewAllDeadLineBtn" href="javascript:">View all deadlines +</a>
                                </div>
                                <!--End deadlineBoxContent-->
                                <div class="deadlineBoxContent allDeadlinedeadlineBoxContent hide">
                                    <a class="viewNextDeadLineBtn" href="javascript:">View next deadline +</a>
                                </div>
                                <!--End deadlineBoxContent-->
                            </div>
                            <!--End deadlineBox-->
                        </div>
                             
						</div> 
				</div>
				<!-- /#hero -->
                    
				</div>
<!-- /.pageHeading -->


		<article id="mainContent" class="splitLayout ">
					<div class="container">
					  <div class="rightSplit  grid-3-3">
							<div class="mainStream partialList">
								 
                                 <section class="tabsWrap"> 
									<nav class="tabNav">
										<ul>
											<li><a href="#contest-overview" class="active link">Challenge Overview</a></li>
											<li><a href="#winner" class="link">Results</a></li>
										</ul>
									</nav>
							  <div id="contest-overview" class="tableWrap tab">
								
                                <article id="contestOverview">
                                <h1>Challenge Overview</h1>
									<p><?php echo $contest->detailedRequirements;?></p>

<article id="technologies">
	<h1>Technologies</h1>
    <ul>
    	<li><strong>Tech</strong></li>
    </ul>
</article>

<h3>Final Submission Guidelines</h3>
<?php echo $contest->finalSubmissionGuidelines;?>

<article id="payments">
	<h1>Payments</h1>
    <p>TopCoder will compensate members with first and second place submissions. Initial payment for the winning member will be distributed in two installments. The first payment will be made at the closure of the approval phase. The second payment will be made at the completion of the support period.</p>

<h2>Reliability Rating and Bonus</h2>
<p>The reliability bonus for each particular project depends on the reliability rating at the moment of registration for that project. A participant with no previous projects is considered to have no reliability rating, and therefore gets no bonus.
Reliability bonus does not apply to Digital Run winnings. Since reliability rating is based on the past 15 projects, it can only have 15 discrete values.<br>
<a href="http://apps.topcoder.com/wiki/x/MQD9Ag">Read more.</a></p>
</article>

</article>
 
							  </div>
                              
                              <div id="winner" class="tableWrap hide tab">
										 
                                         
                                         <article>
                                         Coming Soon...
                                         </article>
                                         
									</div>
                              
                              </section>
                              </div>
									 
									  
                                 
							</div>
							<!-- /.mainStream -->
							<aside class="sideStream  grid-1-3">
								  
                            <div class="topRightTitle"> 
                            	<a href="http://apps.topcoder.com/forums/?module=Category&categoryID=<?php echo $contest->forumId;?>" class="contestForumIcon" target="_blank">Contest Forum</a>  
							</div>
                            
                            <div class="columnSideBar"> 
                            
                            <div class="slider">
									<ul>
										<li class="slide">
											 
                                             <div class="reviewStyle slideBox">
                                                <h3>Review Style:</h3>
                                                <div class="inner">
                                                    <p><strong>Final Review: </strong><span>Community Review Board</span>
                                                            <a onmouseout="hideTooltip('FinalReview');" onmouseover="showTooltip(this, 'FinalReview');" class="tooltip" href="javascript:;"> </a></p>
                                                       <p><strong>Approval: </strong><span>User Sign-Off</span>
                                                            <a onmouseout="hideTooltip('Approval');" onmouseover="showTooltip(this, 'Approval');" class="tooltip" href="javascript:;"> </a>
                                                        </p> 
                                                </div>
                                                
                                            </div>
                                            <!-- End review style section -->
                                             
										</li>
										<li class="slide">
											 
                                             <div class="contestLinks slideBox">
                                                <h3>Contest Links:</h3>
                                                <div class="inner">
                                                    <p><a href="https://software.topcoder.com/review/actions/ViewScorecard.do?method=viewScorecard&scid=<?php echo $contest->screeningScorecardId;?>">Screening Scorecard</a></p>
                                                   <p><a href="http://software.topcoder.com/review/actions/ViewScorecard.do?method=viewScorecard&scid=<?php echo $contest->reviewScorecardId;?>">Review Scorecard</a></p> 
                                                </div>
                                                
                                            </div>
                                             
										</li>
										
										<li class="slide">
											 <div class="forumFeed slideBox">&nbsp;<br />
                                         <!--                    
                                
								<h3>Forums Feed:</h3> 
								<div class="inner">
                                	<div class="scroll-pane jspScrollable" style="overflow: hidden; padding: 0px; width: 263px;" tabindex="0">
                                    
                                    
                                        
                                    <div class="jspContainer" style="width: 263px; height: 400px;"><div class="jspPane" style="padding: 0px; width: 256px; top: 0px;"><div class="forumItemWrapper">
                                    <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                       </div>
                                       <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                       </div>
                                       <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        </div>
                                        <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        <div class="forumItem">
                                        </div>
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        </div>
                                        <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        </div>
                                        <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        </div>
                                        <div class="forumItem">
                                        	<p class="forumTitle"><a href="#">Forum title lorem ipsum</a></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu eros id nunc</p>
                                            <p class="forumInfo">
                                            Post by <a href="#">Someone</a> |  12/13/13  07:00 ET
                                            </p>
                                        </div>
                                        </div></div><div class="jspVerticalBar"><div class="jspCap jspCapTop"></div><div class="jspTrack" style="height: 400px;"><div class="jspDrag" style="height: 214px;"><div class="jspDragTop"></div><div class="jspDragBottom"></div></div></div><div class="jspCap jspCapBottom"></div></div></div></div>
                                </div>
								-->
                                
                            </div>
										</li>
										
									</ul>
								</div>
                            
                            </div>
                                
							</aside>
							<!-- /.sideStream -->
							<div class="clear"></div>
						</div>
						<!-- /.rightSplit -->   
                    </article>
		<!-- /#mainContent -->
		
<?php get_footer('tooltip'); ?>