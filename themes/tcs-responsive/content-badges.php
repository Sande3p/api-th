<?php

/**
 * Enqueue scripts and styles exclusive to this template
 */
wp_register_script ( 'badgeBase.js', get_bloginfo ( 'stylesheet_directory' ) . '/js/badgeBase.js' );
wp_enqueue_script ( 'badgeBase.js' );
wp_register_script ( 'badge-tooltips.js', get_bloginfo ( 'stylesheet_directory' ) . '/js/badge-tooltips.js' );
wp_enqueue_script ( 'badge-tooltips.js' );
?>

<script type="text/javascript">
<!--
var userId = 22923055;
var previewPath = null;
var originalFile = null;

$(document).ready(function(){
    var categoryName = 'progress meters development';
    var groupBadgeDiv = $('.groupBadgeDiv');
    var singleBadgeDiv = $('.footer-badges');
    var badges = $('.hidenBadgesDiv');

    renderGroupBadges(categoryName, groupBadgeDiv, singleBadgeDiv, badges);
});
//-->
</script>
<div class="hidenBadgesDiv hide">

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="108">
	<input type="hidden" class="achievementName" value="Two Hundred Successful Challenges">
	<input type="hidden" class="achievementDesc" value="Two Hundred Successful Challenges">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="127">
	<input type="hidden" class="achievementName" value="Solved Hard Div2 Problem in SRM">
	<input type="hidden" class="achievementDesc" value="Solved Hard Div2 Problem in SRM">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="108">
	<input type="hidden" class="achievementName" value="Two Hundred Successful Challenges">
	<input type="hidden" class="achievementDesc" value="Two Hundred Successful Challenges">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="127">
	<input type="hidden" class="achievementName" value="Solved Hard Div2 Problem in SRM">
	<input type="hidden" class="achievementDesc" value="Solved Hard Div2 Problem in SRM">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="126">
	<input type="hidden" class="achievementName" value="Solved Hard Div1 Problem in SRM">
	<input type="hidden" class="achievementDesc" value="Solved Hard Div1 Problem in SRM">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="126">
	<input type="hidden" class="achievementName" value="Solved Hard Div1 Problem in SRM">
	<input type="hidden" class="achievementDesc" value="Solved Hard Div1 Problem in SRM">
	<input type="hidden" class="achievementDate" value="2013-05-19">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="120">
	<input type="hidden" class="achievementName" value="SRM Winner Div 2">
	<input type="hidden" class="achievementDesc" value="SRM Winner Div 2">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="119">
	<input type="hidden" class="achievementName" value="SRM Winner Div 1">
	<input type="hidden" class="achievementDesc" value="SRM Winner Div 1">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="122">
	<input type="hidden" class="achievementName" value="Algorithm Target">
	<input type="hidden" class="achievementDesc" value="Algorithm Target">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="1">
	<input type="hidden" class="achievementName" value="First Forum Post">
	<input type="hidden" class="achievementDesc" value="First forum post">
	<input type="hidden" class="achievementDate" value="2013-04-01">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="6">
	<input type="hidden" class="achievementName" value="First Passing Submission">
	<input type="hidden" class="achievementDesc" value="First passing submission">
	<input type="hidden" class="achievementDate" value="2013-03-23">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="6">
	<input type="hidden" class="achievementName" value="First Passing Submission">
	<input type="hidden" class="achievementDesc" value="First passing submission">
	<input type="hidden" class="achievementDate" value="2013-03-23">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="16">
	<input type="hidden" class="achievementName" value="First Placement">
	<input type="hidden" class="achievementDesc" value="First placement">
	<input type="hidden" class="achievementDate" value="2013-03-17">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="16">
	<input type="hidden" class="achievementName" value="First Placement">
	<input type="hidden" class="achievementDesc" value="First placement">
	<input type="hidden" class="achievementDate" value="2013-03-17">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="52">
	<input type="hidden" class="achievementName" value="Digital Run Top Five">
	<input type="hidden" class="achievementDesc" value="Digital run top five">
	<input type="hidden" class="achievementDate" value="2013-03-01">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="21">
	<input type="hidden" class="achievementName" value="First Win">
	<input type="hidden" class="achievementDesc" value="First win">
	<input type="hidden" class="achievementDate" value="2013-02-20">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="21">
	<input type="hidden" class="achievementName" value="First Win">
	<input type="hidden" class="achievementDesc" value="First win">
	<input type="hidden" class="achievementDate" value="2013-02-20">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="2">
	<input type="hidden" class="achievementName" value="One Hundred Forum Posts">
	<input type="hidden" class="achievementDesc" value="One hundred forum posts">
	<input type="hidden" class="achievementDate" value="2013-02-09">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="2">
	<input type="hidden" class="achievementName" value="One Hundred Forum Posts">
	<input type="hidden" class="achievementDesc" value="One hundred forum posts">
	<input type="hidden" class="achievementDate" value="2013-02-09">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="100">
	<input type="hidden" class="achievementName" value="Ten Solved Algorithm Problems">
	<input type="hidden" class="achievementDesc" value="Ten Solved Algorithm Problems">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="99">
	<input type="hidden" class="achievementName" value="First Solved Algorithm Problem">
	<input type="hidden" class="achievementDesc" value="First Solved Algorithm Problem">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="90">
	<input type="hidden" class="achievementName" value="Five Rated Algorithm Competitions">
	<input type="hidden" class="achievementDesc" value="Five Rated Algorithm Competitions">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="89">
	<input type="hidden" class="achievementName" value="First Rated Algorithm Competition">
	<input type="hidden" class="achievementDesc" value="First Rated Algorithm Competition">
	<input type="hidden" class="achievementDate" value="2012-09-28">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="17">
	<input type="hidden" class="achievementName" value="Twenty Five Placements">
	<input type="hidden" class="achievementDesc" value="Twenty five placements">
	<input type="hidden" class="achievementDate" value="2012-08-29">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="17">
	<input type="hidden" class="achievementName" value="Twenty Five Placements">
	<input type="hidden" class="achievementDesc" value="Twenty five placements">
	<input type="hidden" class="achievementDate" value="2012-08-29">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="3">
	<input type="hidden" class="achievementName" value="Five Hundred Forum Posts">
	<input type="hidden" class="achievementDesc" value="Five hundred forum posts">
	<input type="hidden" class="achievementDate" value="2012-03-12">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="3">
	<input type="hidden" class="achievementName" value="Five Hundred Forum Posts">
	<input type="hidden" class="achievementDesc" value="Five hundred forum posts">
	<input type="hidden" class="achievementDate" value="2012-03-12">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="7">
	<input type="hidden" class="achievementName" value="Fifty Passing Submissions">
	<input type="hidden" class="achievementDesc" value="Fifty passing submissions">
	<input type="hidden" class="achievementDate" value="2012-03-04">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="7">
	<input type="hidden" class="achievementName" value="Fifty Passing Submissions">
	<input type="hidden" class="achievementDesc" value="Fifty passing submissions">
	<input type="hidden" class="achievementDate" value="2012-03-04">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="22">
	<input type="hidden" class="achievementName" value="Twenty Five First Placement Win">
	<input type="hidden" class="achievementDesc" value="Twenty five first placement win">
	<input type="hidden" class="achievementDate" value="2011-11-05">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="22">
	<input type="hidden" class="achievementName" value="Twenty Five First Placement Win">
	<input type="hidden" class="achievementDesc" value="Twenty five first placement win">
	<input type="hidden" class="achievementDate" value="2011-11-05">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="18">
	<input type="hidden" class="achievementName" value="Fifty Placements">
	<input type="hidden" class="achievementDesc" value="Fifty placements">
	<input type="hidden" class="achievementDate" value="2011-11-05">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="18">
	<input type="hidden" class="achievementName" value="Fifty Placements">
	<input type="hidden" class="achievementDesc" value="Fifty placements">
	<input type="hidden" class="achievementDate" value="2011-11-05">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="8">
	<input type="hidden" class="achievementName" value="One Hundred Passing Submissions">
	<input type="hidden" class="achievementDesc" value="One hundred passing submissions">
	<input type="hidden" class="achievementDate" value="2011-10-04">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="8">
	<input type="hidden" class="achievementName" value="One Hundred Passing Submissions">
	<input type="hidden" class="achievementDesc" value="One hundred passing submissions">
	<input type="hidden" class="achievementDate" value="2011-10-04">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="4">
	<input type="hidden" class="achievementName" value="One Thousand Forum Posts">
	<input type="hidden" class="achievementDesc" value="One thousand forum posts">
	<input type="hidden" class="achievementDate" value="2011-10-03">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="4">
	<input type="hidden" class="achievementName" value="One Thousand Forum Posts">
	<input type="hidden" class="achievementDesc" value="One thousand forum posts">
	<input type="hidden" class="achievementDate" value="2011-10-03">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="53">
	<input type="hidden" class="achievementName" value="Studio Cup Winner">
	<input type="hidden" class="achievementDesc" value="Studio cup winner">
	<input type="hidden" class="achievementDate" value="2009-04-30">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="54">
	<input type="hidden" class="achievementName" value="Studio Cup Top Five">
	<input type="hidden" class="achievementDesc" value="Studio cup top five">
	<input type="hidden" class="achievementDate" value="2009-01-31">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>
<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="53">
	<input type="hidden" class="achievementName" value="Studio Cup Winner">
	<input type="hidden" class="achievementDesc" value="Studio cup winner">
	<input type="hidden" class="achievementDate" value="2009-04-30">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="54">
	<input type="hidden" class="achievementName" value="Studio Cup Top Five">
	<input type="hidden" class="achievementDesc" value="Studio cup top five">
	<input type="hidden" class="achievementDate" value="2009-01-31">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>
<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="53">
	<input type="hidden" class="achievementName" value="Studio Cup Winner">
	<input type="hidden" class="achievementDesc" value="Studio cup winner">
	<input type="hidden" class="achievementDate" value="2009-04-30">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>

<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="54">
	<input type="hidden" class="achievementName" value="Studio Cup Top Five">
	<input type="hidden" class="achievementDesc" value="Studio cup top five">
	<input type="hidden" class="achievementDate" value="2009-01-31">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>


</div>
<div class="badgeGroups">
<div class="achiv groupBadgeDiv">
</div>
</div>
<div class="clear-float"></div>
<div class="footer-badges">	
	
</div>
<!-- /.footer-badges -->
