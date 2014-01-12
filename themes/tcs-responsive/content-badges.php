<?php

/**
 * Enqueue scripts and styles exclusive to this template
 */
wp_register_script ( 'badgeBase.js', get_bloginfo ( 'stylesheet_directory' ) . '/js/badgeBase.js' );
wp_enqueue_script ( 'badgeBase.js' );
wp_register_script ( 'badge-tooltips.js', get_bloginfo ( 'stylesheet_directory' ) . '/js/badge-tooltips.js' );
wp_enqueue_script ( 'badge-tooltips.js' );
?>

<?php 
	//$handle = get_query_var('handle');  
	// handle hard coded for now
	$handle = "iRabbit";
	$badges = get_member_badges($handle);
	
	$mapBadge= array('', // badge id to text
        /*   1 */ 'Forum Posts: 1',
        /*   2 */ 'Forum Posts: 100',
        /*   3 */ 'Forum Posts: 500',
        /*   4 */ 'Forum Posts: 1000',
        /*   5 */ 'Forum Posts: 5000',
        /*   6 */ 'Passing Submissions: 1',
        /*   7 */ 'Passing Submissions: 50',
        /*   8 */ 'Passing Submissions: 100',
        /*   9 */ 'Passing Submissions: 250',
        /*  10 */ 'Passing Submissions: 500',
        /*  11 */ 'Checkpoint Prizes: 1',
        /*  12 */ 'Checkpoint Prizes: 50',
        /*  13 */ 'Checkpoint Prizes: 100',
        /*  14 */ 'Checkpoint Prizes: 250',
        /*  15 */ 'Checkpoint Prizes: 500',
        /*  16 */ 'Winning Placements: 1',
        /*  17 */ 'Winning Placements: 25',
        /*  18 */ 'Winning Placements: 50',
        /*  19 */ 'Winning Placements: 100',
        /*  20 */ 'Winning Placements: 250',
        /*  21 */ 'First-Place Wins: 1',
        /*  22 */ 'First-Place Wins: 25',
        /*  23 */ 'First-Place Wins: 50',
        /*  24 */ 'First-Place Wins: 100',
        /*  25 */ 'First-Place Wins: 250',
        /*  26 */ 'Studio Forum Posts: 1',
        /*  27 */ 'Studio Forum Posts: 100',
        /*  28 */ 'Studio Forum Posts: 500',
        /*  29 */ 'Studio Forum Posts: 1000',
        /*  30 */ 'Studio Forum Posts: 5000',
        /*  31 */ 'Studio Passing Submissions: 1',
        /*  32 */ 'Studio Passing Submissions: 50',
        /*  33 */ 'Studio Passing Submissions: 100',
        /*  34 */ 'Studio Passing Submissions: 250',
        /*  35 */ 'Studio Passing Submissions: 500',
        /*  36 */ 'Studio Checkpoint Prizes: 1',
        /*  37 */ 'Studio Checkpoint Prizes: 50',
        /*  38 */ 'Studio Checkpoint Prizes: 100',
        /*  39 */ 'Studio Checkpoint Prizes: 250',
        /*  40 */ 'Studio Checkpoint Prizes: 500',
        /*  41 */ 'Studio Winning Placements: 1',
        /*  42 */ 'Studio Winning Placements: 25',
        /*  43 */ 'Studio Winning Placements: 50',
        /*  44 */ 'Studio Winning Placements: 100',
        /*  45 */ 'Studio Winning Placements: 250',
        /*  46 */ 'Studio First-Place Wins: 1',
        /*  47 */ 'Studio First-Place Wins: 25',
        /*  48 */ 'Studio First-Place Wins: 50',
        /*  49 */ 'Studio First-Place Wins: 100',
        /*  50 */ 'Studio First-Place Wins: 250',
        /*  51 */ 'Digital Run Winner',
        /*  52 */ 'Digital Run Top 5',
        /*  53 */ 'Studio Cup Winner',
        /*  54 */ 'Studio Cup Top 5',
        /*  55 */ 'Wireframe',
        /*  56 */ 'Desktop App UI',
        /*  57 */ 'Mobile UI',
        /*  58 */ 'Web UI',
        /*  59 */ 'Branding /Marketing /Presentation',
        /*  60 */ 'UI Development',
        /*  61 */ 'Architecture and Design',
        /*  62 */ 'Component Development',
        /*  63 */ 'Assembly',
        /*  64 */ 'Idea Generation',
        /*  65 */ 'Conceptualization',
        /*  66 */ 'Test Scenarios',
        /*  67 */ 'Bug Hunts',
        /*  68 */ 'Big Data',
        /*  69 */ 'TCO On-Site Competitor',
        /*  70 */ 'TCO Finalist',
        /*  71 */ 'TCO Champion',
        /*  72 */ 'Member of the Month',
        /*  73 */ 'TopCoder Event Trip Winner',
        /*  74 */ 'TCO On-Site Competitor',
        /*  75 */ 'TCO Finalist',
        /*  76 */ 'TCO Champion',
        /*  77 */ 'Member of the Month',
        /*  78 */ 'TopCoder Event Trip Winner',
        /*  79 */ 'TCCC On-Site Competitor',
        /*  80 */ 'TCCC Finalist',
        /*  81 */ 'TCCC Champion',
        /*  82 */ 'Studio Spec Reviewer',
        /*  83 */ 'Studio Screener',
        /*  84 */ 'TopCoder Reviewer',
        /*  85 */ 'Studio Spirit',
        /*  86 */ 'Studio Mentor',
        /*  87 */ 'TopCoder Spirit',
        /*  88 */ 'TopCoder Mentor',
        /*  89 */ 'Rated SRMs: 1',
        /*  90 */ 'Rated SRMs: 5',
        /*  91 */ 'Rated SRMs: 25',
        /*  92 */ 'Rated SRMs: 100',
        /*  93 */ 'Rated SRMs: 300',
        /*  94 */ 'SRM Room Wins: 1',
        /*  95 */ 'SRM Room Wins: 5',
        /*  96 */ 'SRM Room Wins: 20',
        /*  97 */ 'SRM Room Wins: 50',
        /*  98 */ 'SRM Room Wins: 100',
        /*  99 */ 'Solved SRM Problems: 1',
        /* 100 */ 'Solved SRM Problems: 10',
        /* 101 */ 'Solved SRM Problems: 50',
        /* 102 */ 'Solved SRM Problems: 200',
        /* 103 */ 'Solved SRM Problems: 500',
        /* 104 */ 'Successful Challenges: 1',
        /* 105 */ 'Successful Challenges: 5',
        /* 106 */ 'Successful Challenges: 25',
        /* 107 */ 'Successful Challenges: 100',
        /* 108 */ 'Successful Challenges: 200',
        /* 109 */ 'Marathon Matches: 1',
        /* 110 */ 'Marathon Matches: 3',
        /* 111 */ 'Marathon Matches: 10',
        /* 112 */ 'Marathon Matches: 20',
        /* 113 */ 'Marathon Matches: 50',
        /* 114 */ 'Marathon Top-5 Placements: 1',
        /* 115 */ 'Marathon Top-5 Placements: 2',
        /* 116 */ 'Marathon Top-5 Placements: 4',
        /* 117 */ 'Marathon Top-5 Placements: 8',
        /* 118 */ 'Marathon Top-5 Placements: 16',
        /* 119 */ 'SRM Winner Div 1',
        /* 120 */ 'SRM Winner Div 2',
        /* 121 */ 'Marathon Match Winner',
        /* 122 */ 'Algorithm Target',
        /* 123 */ 'Marathon Target',
        /* 124 */ 'Algorithm Problem Writer',
        /* 125 */ 'Marathon Copilot / Problem Writer',
        /* 126 */ 'Solved Hard Div1 Problem in SRM',
        /* 127 */ 'Solved Hard Div2 Problem in SRM',
        /* 128 */ 'NASA Tournament Lab Client Badge',
        /* 129 */ 'CoECI Client Badge'
    );
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
    applyBadgeIds();
    renderGroupBadges(categoryName, groupBadgeDiv, singleBadgeDiv, badges);
});
//-->
</script>
<div class="hidenBadgesDiv hide">
<?php foreach($badges as $badge=>$badge_value)
{
	$date = substr($badge_value->date,0,10);
	$date = str_replace('.','-',$date);
 echo '<div class="quoteBadgesItem">
	<input type="hidden" class="achievementId" value="108">
	<input type="hidden" class="achievementName" value="'.$badge_value->description.'">
	<input type="hidden" class="achievementDesc" value="'.$badge_value->description.'">
	<input type="hidden" class="achievementDate" value="'.$date.'">
	<input type="hidden" class="achievementHasCurrentlyAt" value="true">
</div>';
	//2013-05-19
};?>
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
