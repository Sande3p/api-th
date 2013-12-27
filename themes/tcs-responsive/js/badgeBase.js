/*
 * Copyright (C) 2012 TopCoder Inc., All Rights Reserved.
 */
/**
 * The base js for badges related logic.
 *
 * <p>
 * Version 1.0 (Release Assembly - TopCoder Software Profile Update) Change notes:
 * - Add some base logic for badges.
 * </p>
 *
 * <p>
 * Version 1.1 (Release Assembly - TopCoder Achievement Utility and Badges Update) Change notes:
 * - Added logic for "currently @" and proper date of obtaining the achievement.
 * - Removed unused code.
 * </p>
 *
 * @author TCSASSEMBLER, TrePe
 * @version 1.1
 */

/**
 * The global badge info.
 */
var globalBadgeInfo = {
    categorizedBadgeNames: {
        'progress meters development': [ // used in member profile
            {name: 'Forum Posts', currentlyAtText: 'Forum Post', subBadges: [
                {name: 'Forum Posts: 1'},
                {name: 'Forum Posts: 100'},
                {name: 'Forum Posts: 500'},
                {name: 'Forum Posts: 1000'},
                {name: 'Forum Posts: 5000'}]
            },
            {name: 'Rated SRMs', currentlyAtText: 'SRM', subBadges: [
                {name: 'Rated SRMs: 1'},
                {name: 'Rated SRMs: 5'},
                {name: 'Rated SRMs: 25'},
                {name: 'Rated SRMs: 100'},
                {name: 'Rated SRMs: 300'}]
            },
            {name: 'SRM Room Wins', currentlyAtText: 'Win', subBadges: [
                {name: 'SRM Room Wins: 1'},
                {name: 'SRM Room Wins: 5'},
                {name: 'SRM Room Wins: 20'},
                {name: 'SRM Room Wins: 50'},
                {name: 'SRM Room Wins: 100'}]
            },
            {name: 'Solved SRM Problems', currentlyAtText: 'Problem', subBadges: [
                {name: 'Solved SRM Problems: 1'},
                {name: 'Solved SRM Problems: 10'},
                {name: 'Solved SRM Problems: 50'},
                {name: 'Solved SRM Problems: 200'},
                {name: 'Solved SRM Problems: 500'}]
            },
            {name: 'Successful Challenges', currentlyAtText: 'Challenge', subBadges: [
                {name: 'Successful Challenges: 1'},
                {name: 'Successful Challenges: 5'},
                {name: 'Successful Challenges: 25'},
                {name: 'Successful Challenges: 100'},
                {name: 'Successful Challenges: 250'}]
            },
            {name: 'Marathon Matches', currentlyAtText: 'Match', subBadges: [
                {name: 'Marathon Matches: 1'},
                {name: 'Marathon Matches: 3'},
                {name: 'Marathon Matches: 10'},
                {name: 'Marathon Matches: 20'},
                {name: 'Marathon Matches: 50'}]
            },
            {name: 'Marathon Top-5 Placements', currentlyAtText: 'Placement', subBadges: [
                {name: 'Marathon Top-5 Placements: 1'},
                {name: 'Marathon Top-5 Placements: 2'},
                {name: 'Marathon Top-5 Placements: 4'},
                {name: 'Marathon Top-5 Placements: 8'},
                {name: 'Marathon Top-5 Placements: 16'}]
            },
            {name: 'Passing Submissions', currentlyAtText: 'Submission', subBadges:[
                {name: 'Passing Submissions: 1'},
                {name: 'Passing Submissions: 50'},
                {name: 'Passing Submissions: 100'},
                {name: 'Passing Submissions: 250'},
                {name: 'Passing Submissions: 500'}]
            },
            {name: 'Checkpoint Prizes', currentlyAtText: 'Prize', subBadges: [
                {name: 'Checkpoint Prizes: 1'},
                {name: 'Checkpoint Prizes: 50'},
                {name: 'Checkpoint Prizes: 100'},
                {name: 'Checkpoint Prizes: 250'},
                {name: 'Checkpoint Prizes: 500'}]
            },
            {name: 'Winning Placements', currentlyAtText: 'Placement', subBadges: [
                {name: 'Winning Placements: 1'},
                {name: 'Winning Placements: 25'},
                {name: 'Winning Placements: 50'},
                {name: 'Winning Placements: 100'},
                {name: 'Winning Placements: 250'}]
            },
            {name: 'First-Place Wins', currentlyAtText: 'Win', subBadges: [
                {name: 'First-Place Wins: 1'},
                {name: 'First-Place Wins: 25'},
                {name: 'First-Place Wins: 50'},
                {name: 'First-Place Wins: 100'},
                {name: 'First-Place Wins: 250'}]
            }],

        'merit groups': [ // used in copilot profile
            {name: 'UI and Graphic Design', subBadges: [
                {name: 'Wireframe'},
                {name: 'Desktop App UI'},
                {name: 'Mobile UI'},
                {name: 'Web UI'},
                {name: 'Branding /Marketing /Presentation'}]
            },
            {name: 'Implementation', subBadges: [
                {name: 'UI Development'},
                {name: 'Architecture and Design'},
                {name: 'Component Development'},
                {name: 'Assembly'}]
            },
            {name: 'Business Analysis', subBadges: [
                {name: 'Idea Generation'},
                {name: 'Conceptualization'}]
            },
            {name: 'Testing and QA', subBadges: [
                {name: 'Test Scenarios'},
                {name: 'Bug Hunts'}]
            },
            {name: 'Analytics', subBadges: [
                {name: 'Big Data'}]
            }]
    },
    mapBadge: ['', // badge id to text
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
    ]

};

/**
 * Convert name to corresponding css name.
 *
 * @param name the name.
 * @return converted css name.
 */
function name2cssClass(name) {
    return name.split(/\W+/).join('-');
}

/**
 * Returns text to append to "Currently @ X" (singular form) based on badge name.
 * This is used only for badges that are not group ones (those have this text defined in globalBadgeInfo).
 * @param name the badge name
 * @return string the currently at text or empty string if N/A.
 */
function currentlyAtTextFromName(name) {
    switch (name) {
        case 'SRM Winner Div 1': return 'Win';
        case 'SRM Winner Div 2': return 'Win';
        case 'Marathon Match Winner': return 'Win';
        case 'Algorithm Target': return 'Time';
        case 'Marathon Target': return 'Time';
        case 'Digital Run Top 5': return 'Time';
        case 'Digital Run Winner': return 'Win';
        case 'Solved Hard Div1 Problem in SRM': return 'Problem';
        case 'Solved Hard Div2 Problem in SRM': return 'Problem';
    }
    return '';
}

/**
 * Render badges.
 *
 * @param categoryName the category name.
 * @param groupRenderDiv the group render div.
 * @param singleRenderDiv the single render div.
 * @param badgesDiv all badges.
 */
function renderGroupBadges(categoryName, groupRenderDiv, singleRenderDiv, badgesDiv) {
    // render group badges
    if (typeof globalBadgeInfo.categorizedBadgeNames[categoryName] != 'undefined') {
        $.each(globalBadgeInfo.categorizedBadgeNames[categoryName], function(index, item) {
            if (typeof item['subBadges'] != 'undefined') {
                var groupDiv = $('<div>');

                if (categoryName != 'merit groups') groupDiv.hide(); // hide by default, display later if child badge is actually earned
                groupDiv.addClass('groupBadge');
                groupDiv.addClass(name2cssClass(item.name));

                $.each(item.subBadges, function(ii, it) {
                    var badgeSpan = $('<span>');
                    badgeSpan.addClass('subBadge');
                    badgeSpan.addClass(name2cssClass(it.name));

                    groupDiv.append(badgeSpan);

                    badgeSpan.badgeTooltips({
                        title: it.name,
                        content: it.name,
                        firstInGroup: name2cssClass(item.subBadges[0].name),
                        currentlyAtText: item.currentlyAtText
                    });
                });

                if(categoryName == 'merit groups') {
                    var tmpDiv = $('<div>');
                    tmpDiv.addClass('subBadge bigBadge');
                    tmpDiv.addClass(name2cssClass(item.name)+"-Group");
                    groupDiv.append(tmpDiv);
                }

                groupRenderDiv.append(groupDiv);
            }
        });
    }

    groupRenderDiv.append($('<div class="clear-float">'));

    var singleCount = 0;

    // show badges
    badgesDiv.find('.quoteBadgesItem').each(function(i, it) {
        var id = $(it).find('.achievementId').val();
        var name = $(it).find('.achievementName').val();
        var desc = $(it).find('.achievementDesc').val();
        var time = $(it).find('.achievementDate').val();
        if (time != '') time = 'Earned on ' + time;
        else time = 'Earned on TBD';
        var hasCurrentlyAt = $(it).find('.achievementHasCurrentlyAt').val();

        if (groupRenderDiv.find('.' + name2cssClass(globalBadgeInfo.mapBadge[id])).length > 0) {
            // group badge
            var badgeEl = groupRenderDiv.find('.' + name2cssClass(globalBadgeInfo.mapBadge[id]));
            badgeEl.parent().show(); // display parent group
            badgeEl.addClass('selected');
            badgeEl.badgeTooltips({
                title: name,
                content: desc,
                time: time,
                ruleId: id,
                hasCurrentlyAt: hasCurrentlyAt,
                firstInGroup: badgeEl.data('s').firstInGroup,
                currentlyAtText: badgeEl.data('s').currentlyAtText
            });
        } else {
            // single badge
            if (singleRenderDiv != null) {
                var badge = $('<div>');
                var badgeName = globalBadgeInfo.mapBadge[id];
                badge.addClass('singleBadge');
                badge.addClass(name2cssClass(badgeName));

                if (singleCount % 3 == 0) {
                    badge.addClass('leftMost');
                }
                singleCount++;

                singleRenderDiv.append(badge);

                badge.badgeTooltips({
                    title: name,
                    content: desc,
                    time: time,
                    ruleId: id,
                    hasCurrentlyAt: hasCurrentlyAt,
                    currentlyAtText: currentlyAtTextFromName(badgeName)
                });
            }
        }
    });

    if (singleRenderDiv != null) {
        singleRenderDiv.append('<div class="clear-float"></div>');
    }

    if (categoryName == 'merit groups') {
        $(".groupBadgeDiv .groupBadge").each(function () {
            var allSelected = true;

            $(this).find("span.subBadge").each(function () {
                if (!$(this).hasClass("selected")) {
                    allSelected = false;
                }
            })

            if (allSelected) {
                $(this).find("div.subBadge").addClass("selected");
            } else {
                $(this).find("div.subBadge").removeClass("selected");
            }
        });
    }
}

