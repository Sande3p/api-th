/*
 * Copyright (C) 2012 TopCoder Inc., All Rights Reserved.
 */
/**
 * TopCoder tooltips JQuery plug-in.
 *
 * <p>
 * Version 1.1 (Release Assembly - TopCoder Achievement Utility and Badges Update) Change notes:
 * - Added logic for "currently @" and proper date of obtaining the achievement.
 * </p>
 *
 * @author TCSASSEMBLER, TrePe
 * @version 1.1
 */

;(function ($) {
    $.fn.badgeTooltips = function (s) {
        s = $.extend({
                         type:'quoteBadgesItemTips',
                         time:'Not Earned Yet'
                     }, s || {});
        if (!window.hover) {
            window.hover =
            $('<div class="toolTips"><h3></h3><div class="tipsContent"><p></p><span class="timeStamp"></span></div><div class="tipsArrow"></div></div>');
            $('body').append(window.hover);
            window.hover.css('display', 'none');
        }
        this.s = s;
        this.data('s', s);
        this.hover(
            function () {
                var el = $(this);
                var s = el.data('s');
                $('h3', window.hover).text(s.title);
                $('p', window.hover).text(s.time);
                window.hover.addClass(s.type);
                // if this is group badge take values from first one
                if (typeof s.firstInGroup != 'undefined') {
                    el = $("."+s.firstInGroup); 
                    s = el.data('s');
                }
                var span = $('span', window.hover);
                span.html('');
                if (s.hasCurrentlyAt == 'true') {
                    if (typeof s.currentlyAtCache == 'undefined') {
                        s = $.extend({currentlyAtCache: '(retrieving...)'}, s);
                        el.data('s', s);
                        span.html('Currently @ (retrieving...)');
                        $.ajax({
                            type: "get",
                            url: '?module=MemberAchievementCurrent&cr=' + userId + '&ruleId=' + s.ruleId,
                            success: function(data){
                                if (typeof data.count != 'undefined') {
                                    s.currentlyAtCache = data.count + ' ' + s.currentlyAtText;
                                    if (data.count != 1) { // plural
                                        if (s.currentlyAtText.substr(s.currentlyAtText.length - 3, 2) == 'ch') s.currentlyAtCache += 'e';
                                        s.currentlyAtCache += 's';
                                    }
                                    span.html('Currently @ ' + s.currentlyAtCache);
                                    el.data('s', s);
                                } else { // error
                                    span.html('');
                                }
                            }
                        });
                    } else {
                        span.html('Currently @ ' + s.currentlyAtCache);
                    }
                }
                window.hover.show();
                var offset = $(this).offset();
                var t = offset.top - window.hover.outerHeight() - 2;
                var l = offset.left - window.hover.outerWidth() + 42 + $(this).outerWidth() / 2;
                window.hover.css({
                                     left:l + 'px',
                                     top:t + 'px'
                                 });
                window.hover.css('display', 'block');
            },
            function () {
                var s = $(this).data('s');
                window.hover.removeClass(s.type);
                window.hover.css('display', 'none');
            }
        );
        return this;
    };
})(jQuery);
