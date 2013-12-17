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
// hardcoded 30036134 for now
$contest = get_contest_detail('',$contestID);
#print_r($contest);
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
                             	<a class="btn btnRegisterDeac" href="javascript:;"><span>1</span> <strong>Register For This Contest</strong></a>
                                <a class="btn btnSubmit" href="javascript:;"><span>2</span> <strong>Submit Your Entries</strong></a> 
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
                                        <span class="CEDate"><?php echo $contest->currentPhaseName;?></span>
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
											<li><a href="#contest-overview" class="active link">Contest Overview</a></li>
											<!-- <li><a href="#winner" class="link">Winner</a></li> -->
										</ul>
									</nav>
							  <div id="contest-overview" class="tableWrap tab">
								
                                <article id="contestOverview">
                                <h1>Contest Overview</h1>
                                         <h2>Detailed Requirements</h2>

<h3>Project Overview</h3>
<p><?php echo $contest->detailedRequirements;?></p>
<h3>Final Submission Guidelines</h3>
<?php echo $contest->finalSubmissionGuidelines;?>

</article>
 
							  </div>
                              
                              <div id="winner" class="tableWrap hide tab">
										 
                                         
                                         <article>
                                         <h1>Submission Deliverables</h1>
                                         <h2>Submission Deliverables</h2>
                                         <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                         
                                         <h3>Submission Deliverables</h3>
                                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                          
                                           <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                           
                                            <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                            
                                             <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                             
                                              <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                              
                                               <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                                               </article>
                                         
									</div>
                              
                              </section>
                              </div>
									 
									  
                                 
							</div>
							<!-- /.mainStream -->
							<aside class="sideStream  grid-1-3">
								  
                            <div class="topRightTitle"> 
                            	<a href="#" class="contestForumIcon">Contest Forum</a> 
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