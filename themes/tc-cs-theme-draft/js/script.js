
var publisher = "topcoder";

function onScrollTarget() {
	
	var gl = $('.onTarget:last');
	var t = gl.offset().top;
	$('html, body').animate({scrollTop: t}, 400, function() {
		gl.find('.webarback').effect("highlight", {}, 3000);
	});
}
$(document).ready(function(){
	$('.jumper').click(function(){
		el = '.' + $(this).attr('href') + 'jump';	
		$('html, body').animate({scrollTop: $(el).offset().top}, 400);
		return false;		
	})
	
	if ($('.onTarget').length > 0) {
		window.setTimeout('onScrollTarget()', 1000);
	}
	
	try {
		Cufon.replace('.myriad_pro_bold_condensed',  { fontFamily: 'Myriad Pro Bold Condensed', hover: true }); 
		Cufon.replace('.myriad_pro_condensed', { fontFamily: 'Myriad Pro Condensed', hover: true }); 
	} catch (e) {
	}
	
	$('a.closePopBtn, a.backFromPopBtn').click(function() {
		unloadModal();
	});

	
	$('.bigRegBtn').click(function() {
		
		// window.currentId = $(this).attr('id').replace('rbtn', '');
		
		$('#registerForm input').val('');
		
		if ( $(this).attr('href') !='javascript:;' && $(this).attr('href') !='')
		{
			return true;
		}	
		
		var id = $(this).attr('id').replace('rbtn', '');
		// alert(id);
		window.currentId = id;
		var url = $('#postDataUrl').attr('href');
		var obj = {
			'a_type': 'fetchDetail',
			'pid': id
		}
		$.post(url, obj, function(data) {
			
			data = $.parseJSON(data);
			
			var modal = $('#registerForm');
			
			
			
			modal.find('h3.myriad_pro_condensed').text(data.title);
			modal.find('.dateLine').text(data.date);
			
			
			var schedule = data.schedule;
			
			var scheduleData = schedule.split('|');
			var label = modal.find('.infoLine').eq(0);
			label.empty();
			for (var i = 0; i < scheduleData.length; i++) {
				var scheduled = scheduleData[i];
				
				var span = $('<span class="lineSep">' + scheduled + '</span>');
				if (i == scheduleData.length - 1) {
					span = $('<span>' + scheduled + '</span>');
				}
				label.append(span);
				
			}
			label.append($('<span> Duration :' + data.duration + '</span>'));
			try {
				Cufon.replace('#registerForm .myriad_pro_bold_condensed',  { fontFamily: 'Myriad Pro Bold Condensed', hover: true }); 
				Cufon.replace('#registerForm .myriad_pro_condensed', { fontFamily: 'Myriad Pro Condensed', hover: true }); 
			} catch (e) {
			}
			loadModal('registerForm');
		});
		
	return false;
	});
	
	$('.regBtn').click(function() {
		
		var form = $('#rForm');
		
		var inputs = $('input:text, input:password', form);
		var empty = false;
		var text = '';
		for (var i = 0; i < inputs.length; i++) {
			var input = inputs.eq(i);
			var value = input.val();
			if (!value || value == '') {
				empty = true;
				text = 'Please fill all the fields.';
				break;
			}
		}
		
		if (!empty) {
			var pwds = $('input:password');
			var pwd1 = pwds.eq(0);
			var pwd2 = pwds.eq(1);
			if (pwd1.val() != pwd2.val()) {
				text = 'Make sure the password are typed twice with the same.';
				empty = true;
			}
		}
		if (!empty) {
			var chk = $('#registerForm input:checkbox').get(0);
			if (!chk.checked) {
				empty = true;
				text = 'Please check the agreement check.';
			} 
		}
		
		if (empty) {
			$('.infoError', form).removeClass('hide').text(text);
			$('#registerForm .infoComplete').addClass('hide');
		} else {
		
			var url = $('#postDataUrl').attr('href');
			
			datepickerData = {};
			$('input[name="a_type"]', form).attr('value', "register").val("register");
			$('input[name="pid"]', form).attr('value', window.currentId).val(window.currentId);
			$.post(url, form.serialize(), function(data) {
				if (data == 'Invalid email.') {
					$('#registerForm .infoError').removeClass('hide');
					$('#registerForm .infoComplete').addClass('hide');
					$('#registerForm .infoError').text('You input an invalid email.');
				}
				if (data == 'Register Complete!') {
					$('#registerForm .infoError').addClass('hide');
					$('#registerForm .infoComplete').removeClass('hide').text('Register Complete');
					
					unloadModal();
				}
			});
		}
	});
	
    if (window.memberProxyUrl != undefined && window.memberProxyUrl) {		
		$.get(memberProxyUrl, function(data) {
			var regexp = /\<member_count\>([0-9]+)\<\/member_count\>/;
			var res = regexp.exec(data);
			if (res && res.length > 1) {
				var num = parseInt(res[1], 10);
				
				var text = '';
				while (num > 0) {
					
					var n = num % 1000;
					if (n < 10) {
						n = '00' + n;
					} else if (n < 100) {
						n = '0' + n;
					}
					if (text == '') {
						text = n;
					} else {
						text = n + ',' + text;
					}
					num = Math.floor(num / 1000);
				}				
				$('.memberCount').text(text);
			}
		});
	}
	
	var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i);

    /* Header submenus */
    if(isMobile){
        $("#header nav li:not('.last')").click(function(){
            $(this).parent().find("li").removeClass("expand");
            $(this).addClass("expand");   
        })
        $(document).click(function(event){
            if($(event.target).parents("#header nav ul").length == 0){
                $("#header nav li").removeClass("expand");
            }    
        })
    }else{
        $("#header nav li:not('.last')").hover(function(){
            $(this).addClass("expand");
        },function(){
            $(this).removeClass("expand");
        }); 
    }

    $(".searchBox input,.rssWidget .inputBox input").inputTips();
    $(".commentBox .addComment textarea").css("resize","none").inputTips();

	
    /* post pagination

    $(".commonWidget header li a").click(function(){
        if($(this).parent().hasClass("current")) return false;
        $(this).parents("ul").find("li").removeClass("current");
        $(this).parent().addClass("current");
        var index = $(this).parents("ul").find("a").index($(this));
        $(this).parents(".commonWidget").find(".content").hide();
        $(this).parents(".commonWidget").find(".content:eq(" + index + ")").show();
        return false;
    })
	
	 */
    
    $(".rightRail .posts .content").each(function(){
        $(this).find("figure:lt(6)").show();
        var pagers = Math.ceil($(this).find("figure").length/6);
        var navi = $(this).find(".pagers");
        for(var i = pagers;i>1;i--){ 
            navi.find("a.current").after( $("<a/>",{
                "href":"javascript:;",
                "text":i
            }))
        }
    })
     $(".rightRail .posts .pagers a").live("click",function(){
         if($(this).hasClass("current") || $(this).hasClass("disabled")) return false;
         var pagers = $(this).parent();
         var current = parseInt(pagers.find("a.current").text());
         pagers.find("a").removeClass("current");
         var goto1 = $(this).text();
         if($(this).hasClass("prev")){
            goto1 = current-1;
         }else if($(this).hasClass("next")){
            goto1 = current+1;
         } 
 
         pagers.find("a:eq(" + goto1 +")").addClass("current")
         
         if(goto1 == 1){
            pagers.find(".prev").addClass("disabled"); 
         }else{
            pagers.find(".prev").removeClass("disabled");    
         }
         if(goto1 == pagers.find("a").length-2){
            pagers.find(".next").addClass("disabled");
         }else{
            pagers.find(".next").removeClass("disabled");
         }

         $(this).parent().parent().find("figure").each(function(index,item){
             if(index>=(goto1-1)*6 && index<goto1*6){
                 $(this).show();
             }else{
                 $(this).hide();
             }
         })
         
         return false;
     })

	
	
	/* case studies */
	$('.imgWrapper').each(function() {
		if ($('img', $(this)).length <= 0) {
			$(this).hide();
		}
	});

	
	try {
		$('form.formCon').jqTransform();
		
		$('button:submit').val('Submit');
	} catch (e) {
		// console.log(e);
	}

	if ($('#menu-secondary_menu li.current_page_item').length < 1) {
		var text = $('.secondaryMenuHolder').text();
		$('#menu-secondary_menu li').each(function() {
			if ($.trim($(this).text()) == text) {
				$(this).addClass('current_page_item');
			}
		});
	};


  
  // add the controller triggers to the right panel in contest statistics
    var controllers = $(".palisade div.controller");
    var contents = $(".palisade .right-area table");
    controllers.click(function() {
        $(this).blur();
        contents.hide();
        controllers.removeClass("active");
        $(this).addClass("active");
        $(".palisade .right-area table." + $(this).attr("id")).show();
        return false;
    })
    $(controllers[0]).trigger("click");

});





/* ============================ jQuery $.fn ======================== */
(function($) { 
		
	 // Input Tips
   $.fn.inputTips = function(){
        return this.each(function(){
            var currentVal = $.trim($(this).val());
            if(currentVal == "" || currentVal == $(this).attr("data-placeholder")){
                $(this).val($(this).attr("data-placeholder"));
            }
             $(this).data("tips",$(this).attr("data-placeholder"));
             $(this).unbind("focusin.inputtips");
             $(this).unbind("focusout.inputtips");
             $(this).bind("focusin.inputtips",function(){
                var value = $.trim($(this).val());
                if(value == "" || value == $(this).attr("data-placeholder")){
                    $(this).removeClass("tipIt").val("");
                }
             });
             $(this).bind("focusout.inputtips",function(){
                 var value = $.trim($(this).val());
                 if(value == "" || value == $(this).attr("data-placeholder")){
                    $(this).addClass("tipIt").val($(this).attr("data-placeholder"));
                 }
             });
            $(this).trigger("focusout.inputtips");
        })
   };
})(jQuery);

jQuery.fn.serializeObject = function() {
  var arrayData, objectData;
  arrayData = this.serializeArray();
  objectData = {};

  $.each(arrayData, function() {
    var value = (this.value != null ? this.value : '');
    if (this.name.search(/password/i) == -1) {
      if (objectData[this.name] != null) {
        if (!objectData[this.name].push) {
          objectData[this.name] = [objectData[this.name]];
        }
        objectData[this.name].push(value);
      } else {
        objectData[this.name] = value;
      }
    }
  });
  return objectData;
};

var playerList = {};

function unloadModal() {
	
	for (var label in playerList) {
		var player = playerList[label];
		player.pause();
	}
	$("#greybackground").remove();
	$('#youtubeFrame').attr('src', '');
	$('#videoFrame').attr('src', '');
	$('.popup, .popMask').hide();
}

var scrollList = {};

function loadModal(id) {
	
	var obj = $('#' + id);
	var docheight = $(document).height();
	var docwidth = $(document).width();
	$("#greybackground").remove();
	$("body").append("<div id='greybackground'></div>");
	$("#greybackground").css({"position":'absolute',"left":0,"top":0,"height":docheight,"width":docwidth,'z-index':900});
	
	
	$('.popup').hide();
	obj.show();	
	
	screenwidth = $(window).width();
	screenheight = $(window).height();
	docheight = $(document).height();
	docwidth = $(document).width();
	popWinPosLeft = screenwidth/2 - $('.popup:visible').width()/2;
	popWinPosTop = screenheight/2 - $('.popup:visible').height()/2;
	$("#greybackground").css({"height":docheight,"width":docwidth});
	if(popWinPosTop<0)
		$('.popMask').css({"height":docheight,"position": 'absolute'}).show();
	else
		$('.popMask').css({"height":docheight,"position": 'fixed'}).show();
	
	var h = obj.height();
	var w = obj.width();
	var ww = $(window).width();
	var wh = $(window).height();
	obj.css({
		position: 'relative',
		top: Math.max(0,(wh - h) / 2),
		left:  	Math.max(0, (ww - w) / 2)
	});	
	
	/* updated by pemula */
	$('html, body').animate({scrollTop: 0},'slow');

	/*
	 * var scrollWrapper = obj.find('.detailsArea');
	 * 
	 * if (scrollWrapper.find('.scrollArea').length > 0) { var sid =
	 * scrollWrapper.attr('id'); var scrollP = scrollList[id]; if (scrollP) {
	 * scrollP.refresh(); } else { scrollList[id] = new iScroll(sid); } }
	 */
	
	
	
}


/*
 * updated by pemula @for social plugin
 */

(function($){
$.addthis = function(code,url,title){
 
function init(){
 try{
  // determine whether to include the normal or SSL version
  var addthisurl = (location.href.indexOf('https') == 0 ? 'https://' : 'http://') + 's7.addthis.com/js/250/addthis_widget.js?pub=' + code;
 
  // include the script
  $.getScript(addthisurl, function(){
   $('a.shareBtn').html('<img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/>').attr('href', 'http://www.addthis.com/bookmark.php?v=250').mouseover(
    function(){
     return addthis_open(this, '', url, title);
    }).mouseout(
    function(){
     addthis_close();
    }).click(
    function(){
     return addthis_sendto();
    });
  });
 } catch(err) {
  // log any failure
 // console.log('Failed to load AddThis Script:' + err);
 }
}
 
init();
}
})(jQuery);

/* init tooltip in table */
function initTooltip(id){
	if(id.length>0){
		$('tr', id).each(function(){
			var tt = '<div class="tooltip"><div class="ttBottom"><div class="ttBody">' + $('.tooltip', $(this)).html() + '</div></div></div>';
			$('td:first div', $(this)).append(tt);
			$('td.tooltip', $(this)).remove();
			$('td:last',$(this)).addClass('last');
			$('td',$(this)).eq(2).addClass('odd');
		});
		$('tr:last', id).addClass('last');
	}
}


