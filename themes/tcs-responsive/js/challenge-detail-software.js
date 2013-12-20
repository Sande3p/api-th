var sliderActive = false;
var slider;

function createSlider() {
	slider = jQuery('.columnSideBar .slider > ul:first-child').bxSlider({
		minSlides: 1,
		maxSlides: 1,
		responsive: !ie7,
		adaptiveHeight: false,
        swipeThreshold: 40,
        controls: false 
	  });
	  return true;
}  
			
//create slider if page is wide
$(document).ready(function(){
    if (window.innerWidth < 1019) {
		
		$(".rightColumn").insertAfter('.leftColumn');
		$('.grid-1-3').insertBefore('#contest-overview');
		$('.scroll-pane').jScrollPane({ autoReinitialise: true }); 
		 
		sliderActive = createSlider(); 
		
		$('#stepBox .rightColumn .nextBox .allDeadlineNextBoxContent p:nth-child(3)').addClass('moveRight');
    }
});

//create/destroy slider based on width
$(window).resize(function () {
 
    if (window.innerWidth < 1019 && sliderActive == false) { 
	
		$(".rightColumn").insertAfter('.leftColumn');
		$('.grid-1-3').insertBefore('#contest-overview');
		$('.scroll-pane').jScrollPane({ autoReinitialise: true }); 
        
		sliderActive = createSlider();  
    }
 
    if (window.innerWidth > 1019 && sliderActive == true){
		$(".rightColumn").insertAfter('.middleColumn');
		$('.grid-1-3').insertAfter('.rightSplit');
		$('.scroll-pane').jScrollPane({ autoReinitialise: true }); 
		
		slider.destroySlider(); 
        sliderActive = false;
		
		/*$('.slider > ul:first-child').removeAttr("style");
		$('.slider li.slide').removeAttr("style");*/
		 
		
    } 
});

$(window).bind('orientationchange', function(event) {
  //alert('new orientation:' + event.orientation);
  $('.scroll-pane').jScrollPane({ autoReinitialise: true }); 
});

//getClassName
var getElementsByClassName = function(searchClass,node,tag) {
    if(document.getElementsByClassName){
        return  document.getElementsByClassName(searchClass)
    }else{    
        node = node || document;
        tag = tag || '*';
        var returnElements = []
        var els =  (tag === "*" && node.all)? node.all : node.getElementsByTagName(tag);
        var i = els.length;
        searchClass = searchClass.replace(/\-/g, "\\-");
        var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
        while(--i >= 0){
            if (pattern.test(els[i].className) ) {
                returnElements.push(els[i]);
            }
        }
        return returnElements;
    }
} 

function hasClass(obj, cls) {
    return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}

function addClass(obj, cls) {
    if (!this.hasClass(obj, cls)) obj.className += " " + cls;
}

function removeClass(obj, cls) {
    if (hasClass(obj, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        obj.className = obj.className.replace(reg, ' ');
    }
}

var tooltipTimeout;

function showTooltip(source, num) {
    getElementsByClassName('tip' + num)[0].style.display = 'block';
    getElementsByClassName('tip' + num)[0].style.top = source.getBoundingClientRect().top + (document.documentElement.scrollTop || document.body.scrollTop) + 2 + 'px';
    if(hasClass(getElementsByClassName('tip' + num)[0], 'reviewStyleTip')) {
        getElementsByClassName('tip' + num)[0].style.left = source.getBoundingClientRect().left + (document.documentElement.scrollLeft || document.body.scrollLeft) - 210 + 'px';
    } else {
        getElementsByClassName('tip' + num)[0].style.left = source.getBoundingClientRect().left + (document.documentElement.scrollLeft || document.body.scrollLeft) + 32 + 'px';
    }
}

function hideTooltip(num) {
    tooltipTimeout = setTimeout(function(){
        getElementsByClassName('tip' + num)[0].style.display = 'none';  
    }, 200);
}

function enterTooltip(num) {
    clearTimeout(tooltipTimeout);
    getElementsByClassName('tip' + num)[0].style.display = 'block';
}

function ieHack(){
    var browser=navigator.appName 
    var b_version=navigator.appVersion 
    var version=b_version.split(";");
    if(version[1]){
        var trim_Version=version[1].replace(/[ ]/g,""); 
    }
    if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE7.0"){ 
        for(i=0;i<getElementsByClassName('shadow').length;i++){
            getElementsByClassName('shadow')[i].style.marginTop = '-1px';
        }
    } 
}
  
   
$(function(){ 
	$('.scroll-pane').jScrollPane();
	//switch the view all deadline and view next deadline
	$(".viewAllDeadLineBtn").click(function(){
		$(".nextDeadlinedeadlineBoxContent").addClass("hide");
		$(".allDeadlinedeadlineBoxContent").removeClass("hide");
		$(".nextDeadlineNextBoxContent").addClass("hide");
		$(".allDeadlineNextBoxContent").removeClass("hide");
		$(".contestEndedBox").addClass("hide");
		
	});
	//switch the view all deadline and view next deadline
	$(".viewNextDeadLineBtn").click(function(){
		$(".contestEndedBox").addClass("hide");
		$(".allDeadlinedeadlineBoxContent").addClass("hide");
		$(".nextDeadlinedeadlineBoxContent").removeClass("hide");
		$(".allDeadlineNextBoxContent").addClass("hide");
		$(".nextDeadlineNextBoxContent").removeClass("hide");
	}); 
	
}); 