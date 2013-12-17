var showLoading = "true";
var angle = 0;
var angle2 = 0;
var startWatchVideo = false;
var numberCounterArray;
var counterCount=0;
var countDownTimer = 0;	
$(document).ready(function(){
	
  
  var seconds = 0;
  function timer() {setInterval(function() {
    $('#progress').text(seconds++/100);
  }, 10);
 }
	
	
	numberCounterArray = new Array("04","03","02","01","00","00","00","00","00","00","00","00","00","00","00","00","00","00");
	setInterval(function(){
		if(startWatchVideo==true) {
			var temp = angle+3;
			$("#watchRotate").rotate(angle);
			angle+=3;
		}
	},7);
	$("#watchVideo").hover(
	  function () {
		startWatchVideo = true;	
		$("#watchRotate").rotate(100);
	  }, 
	  function () {
		startWatchVideo = false;
	  }
	);
	cookieInit();
//	$("#jquery_jplayer_1").jPlayer("play");
//	$("#jquery_jplayer_1").jPlayer("pause");
	
	$(".questionnaireCloseButton").click(function(e) {
		$("#jquery_jplayer_1").jPlayer("pause");
		$('#jquery_jplayer_1').html('');
        $(this).parent().hide();
		$("#whiteWrapper").hide();
		if($("#lastStage").val()=="step5") {
			clearCache();
		}
		saveQuestionnaire();
    });
	$('.questionInputDiv').click(function(e) {
		$(".questionsBox").removeClass("active");
		$(this).parent().addClass("active");
		$(this).find(".questionInput").show();
		$(this).find(".questionInput").focus();
		$(this).find(".questionLabel").hide();
	});
	$('.questionInput').blur(function() {
		$(".questionsBox").removeClass("active");
		var value = $(this).val();
		if(value=="") {
			$(this).parent().find(".questionLabel").show();
			$(this).parent().find(".questionInput").hide();
		}
	});
	
	$('#questionTitleInput').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("#questionCompanyInput","#questionTitleInput");
		return false;
	   }
	});
	
	$('#questionCompanyInput').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("#questionTitleInput","#questionCompanyInput");
		return false;
	   }
	});
	
	$('#questionEmailInput').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("#questionPhoneInput","#questionEmailInput");
		return false;
	   }
	});
	
	//login modal
	var screenwidth,screenheight,popWinPosLeft,popWinPosTop,mytop;
	var docheight = $(document).height();
	var docwidth = $(document).width();
	screenwidth = $(window).width();
	screenheight = $(window).height();
	
	$(window).scroll(function(){
		mytop = $(document).scrollTop();
		popWinPosTop = screenheight/2 - $('#questionnaireMainPopup').height()/2;
		popWinPosLeft = screenwidth/2 - $('#questionnaireMainPopup').width()/2;
		if(popWinPosTop<0){
			$('#questionnaireMainPopup').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
			$('#questionnaireLoaderPopup').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
		}
		else{
			$('#questionnaireMainPopup').css({"position":"fixed","top":popWinPosTop});
			$('#questionnaireLoaderPopup').css({"position":"fixed","top":popWinPosTop});
		}
	});
	$(window).resize(function(){
		screenwidth = $(window).width();
		screenheight = $(window).height();
		docheight = $(document).height();
		docwidth = $(document).width();
		$("#greybackground").css({"height":docheight,"width":docwidth});
		popWinPosTop = screenheight/2 - $('#questionnaireMainPopup').height()/2;
		popWinPosLeft = screenwidth/2 - $('#questionnaireMainPopup').width()/2;		
		if(popWinPosTop<0){
			$('#questionnaireMainPopup').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
			$('#questionnaireLoaderPopup').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
		}
		else{
			$('#questionnaireMainPopup').css({"position":"fixed","top":popWinPosTop});
			$('#questionnaireLoaderPopup').css({"position":"fixed","top":popWinPosTop});
		}
		
	});
	
	/*
	$(window).unload(function() {
		clearCache();
	});
	*/
});

function activateInput(input,inputSource) {
	$(""+input).parent().find(".questionInput").hide();
	$(""+input).parent().find(".questionLabel").hide();
	$(""+input).parent().find(".questionInput").show();
	$(".questionsBox").removeClass("active");
	$(""+input).parent().parent().parent().addClass("active");
	$(""+input).focus();
	
	
	var value = $(""+inputSource).val();
	if(value=="") {
		$(""+inputSource).parent().find(".questionLabel").show();
		$(""+inputSource).parent().find(".questionInput").hide();
	}		
}

function cookieInit() {
	showLoading = "true";
	var lastStage = $.cookie('lastStage');
	var showLoadingCookie = $.cookie('showLoading');
	var questionnaireId = $.cookie('questionnaireId');
	var questionNameInput = $.cookie('questionNameInput');
	var questionLastNameInput = $.cookie('questionLastNameInput');
	var questionTitleInput = $.cookie('questionTitleInput');
	var questionCompanyInput = $.cookie('questionCompanyInput');
	var q3 = $.cookie('q3');
	var q3Index = $.cookie('q3Index');
	var q31 = $.cookie('q31');
	var questionEmailInput = $.cookie('questionEmailInput');
	var questionPhoneInput = $.cookie('questionPhoneInput');
	var skip = $.cookie('skip');
	var q5 = $.cookie('q5');

	if(showLoadingCookie!=""&&showLoadingCookie!=null)
		showLoading = showLoadingCookie;
	if(lastStage!=null)
		$("#lastStage").val(lastStage);
	
	if(questionnaireId!=null) $("#questionnaireId").val(questionnaireId);
	if(questionNameInput!=null&&questionNameInput!="") {
		$("#questionNameInput").val(questionNameInput);
		setActiveQuestionInput("#questionNameInput");
	}
	if(questionTitleInput!=null&&questionTitleInput!="") {
		$("#questionTitleInput").val(questionTitleInput);
		setActiveQuestionInput("#questionTitleInput");
	}
	if(questionCompanyInput!=null&&questionCompanyInput!="") {
		$("#questionCompanyInput").val(questionCompanyInput);
		setActiveQuestionInput("#questionCompanyInput");
	}
	if(q3!="") $("#q3").val(q3);
	if(q3Index!="") $("#q3Index").val(q3);
	if(q31!="") $("#q31").val(q31);
	if(questionEmailInput!=null&&questionEmailInput!="") {
		$("#questionEmailInput").val(questionEmailInput);
		setActiveQuestionInput("#questionEmailInput");
	}
	if(questionPhoneInput!=null&&questionPhoneInput!="") {
		$("#questionPhoneInput").val(questionPhoneInput);
		setActiveQuestionInput("#questionPhoneInput");
	}
	if(skip!=null) $("#skip").val(skip);
	if(q5!=null) $("#q5").val(q5);
}

function setActiveQuestionInput(input) {
	$(""+input).parent().find(".questionInput").hide();
	$(""+input).parent().find(".questionLabel").hide();
	$(""+input).parent().find(".questionInput").show();
	$(".questionsBox").removeClass("active");
	$(""+input).parent().parent().parent().addClass("active");
	$(""+input).focus();
}


function showWhiteWrapper() {
	var docheight = $(window).height();
	var docwidth = $(window).width();
	$("#whiteWrapper,#whiteWrapper .bgPopup").css("width",docwidth+"px");
	$("#whiteWrapper,#whiteWrapper .bgPopup").css("height",docheight+"px");
	$("#whiteWrapper").show();
}

function showDialog(dialog,wrapper) {
	$(".questionWrapper").hide();
	$(''+wrapper).show();
	showWhiteWrapper();
	var screenwidth,screenheight,popWinPosLeft,popWinPosTop,mytop;
	screenwidth = $(window).width();
	screenheight = $(window).height();
	popWinPosTop = screenheight/2 - $(''+dialog).height()/2;
	popWinPosLeft = screenwidth/2 - $(''+dialog).width()/2;
	$(""+dialog).css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"top":popWinPosTop,"position":"fixed"});
	$(""+dialog).show();
}

function showStep1() {
	$("#helloQuestion").hide();

	$(".questionPara").hide();
	$("#questionName").hide();
	$("#questionLastName").hide();
	
	$("#questionImg").hide();
	$("#questionWrapper1").hide();
	$("#questionInnerWrapper1").hide();
	
	$("#questionWrapper1").slideDown('slow',function(){	
		$("#questionInnerWrapper1").show();
		$("#questionImg").css("top",85);
		$("#questionImg").css("left",70);
		$("#questionImg").animate({width: "toggle",top:"15px",left:"0px"},1500,function () {
			$('#helloQuestion').show(function() {
				$('.questionPara').fadeIn('slow', function() {
					$('#questionName,#questionLastName').fadeIn('fast', function() {
					});
				});		
			});
		});
	});
}

function showStep2() {
	$(".questionPara").hide();
	$("#questionTitle").hide();
	$("#questionCompany").hide();
	$("#questionWrapper2").show();

	$('.questionPara').fadeIn('slow', function() {
		$('#questionTitle').fadeIn('fast', function() {
			$('#questionCompany').fadeIn('fast', function() {
			
			});
		});
	});
}

function showStep3() {
	$(".questionPara").hide();
	$(".linkChoiceRow").hide();
	$("#questionTitle").hide();
	$("#questionCompany").hide();
	$("#questionWrapper3").show();

	$('.questionPara').fadeIn('slow', function() {
		$('#linkChoice1').delay(300).fadeIn('fast', function() {
		});
		$('#linkChoice2').delay(600).fadeIn('fast', function() {
		});
		$('#linkChoice3').delay(900).fadeIn('fast', function() {
		});
		$('#linkChoice4').delay(1200).fadeIn('fast', function() {
		});
		$('#linkChoice5').delay(1500).fadeIn('fast', function() {
		});
		$('#linkChoice6').delay(1800).fadeIn('fast', function() {
		});
	});
}

function showStep4() {
	$(".questionPara").hide();
	$("#questionEmail").hide();
	$("#questionPhone").hide();
	$("#questionWrapper4").show();

	$('.questionPara').fadeIn('slow', function() {
		$('#questionEmail').fadeIn('fast', function() {
			$('#questionPhone').fadeIn('fast', function() {
			
			});
		});
	});
}


function showStepFinal() {
	$("#questionWrapperFinal").show();
	
	var value = $("input[name='radioChoiceLink']:checked").val();
	var selectedIndex = $("input[name='radioChoiceLink']:checked").parent().find(".radioChoiceNumber").val();
	var q3IndexCookie = $.cookie('q3Index');
	var q3 = $.cookie('q3');
	if(q3IndexCookie!=null) {
		value=q3;
		selectedIndex=q3IndexCookie;
	}
	if(value!=""&&typeof value!="undefined") {
	//	showDinamicQuestion(selectedIndex);
		$("#lastStage").val("step31");
	}
	//saveQuestionnaire();
	
	$("#lastStage").val("step5");
	$('.finalAlt2,.finalLinkRow').hide();
	
	$('#questionWrapperFinal .finalAlt1').delay(1500).fadeOut('slow', function() {
		$('#questionWrapperFinal .finalAlt2').fadeIn('slow', function() {			
		});
		$('.finalLinkWrapper'+selectedIndex).show();
		$('.finalLinkWrapper'+selectedIndex+' .finalLinkRow1').delay(1500).fadeIn('fast', function() {
		});
		$('.finalLinkWrapper'+selectedIndex+' .finalLinkRow2').delay(1800).fadeIn('fast', function() {
		});		
		$('.finalLinkWrapper'+selectedIndex+' .finalLinkRow3').delay(2300).fadeIn('fast', function() {
		});
		$('.finalLinkWrapper'+selectedIndex+' .finalLinkRow4').delay(2600).fadeIn('fast', function() {
		});
		$('.finalLinkWrapper'+selectedIndex+' .finalLinkRow5').delay(2800).fadeIn('fast', function() {
		});
		
	});	
	
}

function showLink() {
	$("#questionWrapperLink").show();
}



function gotoStep1() {
	saveQuestionnaire();
	if( showLoading == "true" ) {			
		window.setInterval(function(){
			angle2+=3;
			$(".videoLoaderRotate").rotate(angle2);
		},10);
		showDialog("#questionnaireLoaderPopup");		
		//if ( !$.browser.msie ) { $("#soundCounter").jPlayer("play");	}
		countDownTimer = setInterval(function(){
			var counter = numberCounterArray[counterCount];
			$(".videoNumberCounter").html(counter);
			counterCount++;	
			if (counterCount < 2) {
			  //	$("#soundCounter").jPlayer("play");				
			}			
			if (counterCount > 6){
				clearInterval(countDownTimer);
			}
			
			
		},1000);
		
		$("#questionnaireLoaderPopup").show();
		$("#questionnaireLoaderPopup").delay("5000").hide(
			function() {
				showDialog("#questionnaireMainPopup","#questionWrapper1");
				showStep1();
				/*$("#jquery_jplayer_1").jPlayer("play"); */
				$('#jquery_jplayer_1').html('<iframe width="600" height="338" src="http://www.youtube.com/embed/'+YouTube_ID+'?wmode=transparent&autoplay=1" frameborder="0" allowfullscreen></iframe>');
				$('.jp-interface').remove();
				showLoading="false";
				$("#lastStage").val("step1");
			}
		);
	}
	else {
		showDialog("#questionnaireMainPopup","#questionWrapper1");
		showStep1();
		showLoading="false";
		$("#lastStage").val("step1");
	}
}

function gotoStep2() {
	var name = $("#questionNameInput").val();
	if($.trim(name)!="") {
		showDialog("#questionnaireMainPopup","#questionWrapper2");
		showStep2();
		$("#lastStage").val("step2");
	}
	else {
		alert("Please fill your name!");
	}
	saveQuestionnaire();
}

function gotoStep3() {
	var title = $("#questionTitleInput").val();
	var company = $("#questionCompanyInput").val();
	if($.trim(title)!=""&&$.trim(company)!="") {
		showDialog("#questionnaireMainPopup","#questionWrapper3");
		showStep3();
		$("#lastStage").val("step3");
	}
	else {
		alert("Please fill your title and your company!");
	}
	saveQuestionnaire();
}

function gotoStep31() {
	/*
	var value = $("input[name='radioChoiceLink']:checked").val();
	var selectedIndex = $("input[name='radioChoiceLink']:checked").parent().find(".radioChoiceNumber").val();
	var q3IndexCookie = $.cookie('q3Index');
	var q3 = $.cookie('q3');
	if(q3IndexCookie!=null) {
		value=q3;
		selectedIndex=q3IndexCookie;
	}
	if(value!=""&&typeof value!="undefined") {
		showDinamicQuestion(selectedIndex);
		$("#lastStage").val("step31");
	}
	saveQuestionnaire();
	*/
}

function gotoStep4() {
	var value = $("input[name='radioChoiceLink']:checked").val();
	var selectedIndex = $("input[name='radioChoiceLink']:checked").parent().find(".radioChoiceNumber").val();
	var q3IndexCookie = $.cookie('q3Index');
	var q3 = $.cookie('q3');
	if(q3IndexCookie!=null) {
		value=q3;
		selectedIndex=q3IndexCookie;
	}
	if(value!="" && typeof value!="undefined") {
		$("#lastStage").val("step4");
	}
	
	showDialog("#questionnaireMainPopup","#questionWrapper4");
	showStep4();
	
	saveQuestionnaire();
}

function gotoStep5() {
	var email = $("#questionEmailInput").val();
	var phone = $("#questionPhoneInput").val();
	var valid = 0;
	if(!validateEmail( email )) {
		alert("Your email is not valid!");
		valid++;
	}
	else if(!isNumber(phone)) {
		alert("Phone number must be numeric!");
		valid++;
	}
	if(valid==0) {
		showDialog("#questionnaireMainPopup","#questionWrapperFinal");
		showStepFinal();
		$("#lastStage").val("step5");
	}
	saveQuestionnaire();
}


function gotoSkipQuestionnaire(lastStage) {
	showDialog("#questionnaireMainPopup","#skipQuestionnaireWrapper");
	$("#skipQuestionnaireWrapper").show();
	$("#lastStage").val(lastStage);
}

function skipLinkClicked(url) {
	$("#skipQuestionnaire").val(url);
	var name = $("#questionNameInput").val();
	if($.trim(name)!="") {
		saveQuestionnaire();
	}
}

function q31LinkClicked(url) {
	$("#q31").val(url);
	var name = $("#questionNameInput").val();
	if($.trim(name)!="") {
		saveQuestionnaire();
	}
}

function finalLinkClicked(url) {
	$("#q5").val(url);
	var name = $("#questionNameInput").val();
	if($.trim(name)!="") {
		saveQuestionnaire();
	}
}

function skipBackClick() {
	var lastStage = $("#lastStage").val();
	if(lastStage=="step1") {
		showDialog("#questionnaireMainPopup","#questionWrapper1");
		showStep1();
	}
	if(lastStage=="step2") {
		showDialog("#questionnaireMainPopup","#questionWrapper2");
		showStep2();
	}
	if(lastStage=="step3") {
		showDialog("#questionnaireMainPopup","#questionWrapper3");
		showStep3();
	}
	if(lastStage=="step4") {
		showDialog("#questionnaireMainPopup","#questionWrapper4");
		showStep4();
	}
	if(lastStage=="step5") {
		showDialog("#questionnaireMainPopup","#questionWrapperFinal");
		showStepFinal();
	}
}

//openQuestionnaire();

function openQuestionnaire() {
	var lastStage = $("#lastStage").val();
	lastStage = 3;
	
	if(showLoading=="false") {
		/* $("#jquery_jplayer_1").jPlayer("play");	*/
		$('#jquery_jplayer_1').html('<iframe width="600" height="338" src="http://www.youtube.com/embed/'+YouTube_ID+'?wmode=transparent&autoplay=1" frameborder="0" allowfullscreen></iframe>');
		$('.jp-interface').remove();
				
	}
	if(lastStage=="step1") {
		gotoStep1();
	}
	else if(lastStage=="step2") {
		showDialog("#questionnaireMainPopup","#questionWrapper2");
		gotoStep2();
	}
	else if(lastStage=="step31") {
		var q31 = $("#q31").val();
		showDialog("#questionnaireMainPopup","#questionWrapperLink"+q31);
		gotoStep31();
	}
	else if(lastStage=="step3") {
		showDialog("#questionnaireMainPopup","#questionWrapper3");
		gotoStep3();
	}
	else if(lastStage=="step4") {
		showDialog("#questionnaireMainPopup","#questionWrapper4");
		gotoStep4();
	}
	else if(lastStage=="step5") {
		showDialog("#questionnaireMainPopup","#questionWrapperFinal");
		showStepFinal();
	}
	else {
		gotoStep1();
	}
}

function saveQuestionnaire() {
	var id = $("#questionnaireId").val();
	var name = $("#questionNameInput").val();
	var lastname = $("#questionLastNameInput").val();
	var title = $("#questionTitleInput").val();
	var company = $("#questionCompanyInput").val();
	var q3 = $("input[name='radioChoiceLink']:checked").val();
	var q3Index = $("input[name='radioChoiceLink']:checked").parent().find(".radioChoiceNumber").val();
	var q31 = $("#q31").val();
	
	var q3IndexCookie = $.cookie('q3Index');
	var q3Cookie = $.cookie('q3');
	if(q3Cookie!=null) {
		q3=q3Cookie;
	}
	if(q3IndexCookie!=null) {
		q3Index=q3IndexCookie;
	}
	var email = $("#questionEmailInput").val();
	var phone = $("#questionPhoneInput").val();
	var skip = $("#skipQuestionnaire").val();
	var q5 = $("#q5").val();
	var lastStage = $("#lastStage").val();
	
	$.cookie('showLoading', showLoading);
	$.cookie('lastStage', lastStage);
	$.cookie('questionnaireId', id);
	$.cookie('questionNameInput', name);
	$.cookie('questionTitleInput', title);
	$.cookie('questionCompanyInput', company);
	$.cookie('q3', q3);
	$.cookie('q3Index', q3Index);
	$.cookie('q31', q31);
	$.cookie('questionEmailInput', email);
	$.cookie('questionPhoneInput', phone);
	$.cookie('skip', skip);
	$.cookie('q5', q5);
	
	if($.trim(name)!="") {
		$.ajax({
			url: ajaxUrl+"?action=ajax-save-questionnaire",
			cache: false, 
			data:{id:id,name:name,lastname:lastname,title:title,company:company,email:email,phone:phone,skip:skip,q3:q3,q31:q31,q5:q5},
			dataType: "json",
			success: function(data) {
				if(id==null||id=="") {
					var lastInsertId = data.lastInsertId;
					$("#questionnaireId").val(lastInsertId);
				}
			}, 
			error: function(request, textStatus, error) {
				alert(error);
			}
		});		
	}
}

function clearCache() {
	$.cookie('showLoading', null);
	$.cookie('lastStage', null);
	$.cookie('questionnaireId', null);
	$.cookie('questionNameInput', null);
	$.cookie('questionTitleInput', null);
	$.cookie('questionCompanyInput', null);
	$.cookie('q3', null);
	$.cookie('q3Index', null);
	$.cookie('q31', null);
	$.cookie('questionEmailInput', null);
	$.cookie('questionPhoneInput', null);
	$.cookie('skip', null);
	$.cookie('q5', null);
	$("#questionnaireId").val("");
	$("#questionNameInput").val("");
	$("#questionTitleInput").val("");
	$("#questionCompanyInput").val("");
	//$("input[name='radioChoiceLink']:checked").val();
	//$("input[name='radioChoiceLink']:checked").parent().find(".radioChoiceNumber").val();
	$("#q31").val("");
	$("#questionEmailInput").val("");
	$("#questionPhoneInput").val("");
	$("#skipQuestionnaire").val("");
	$("#q5").val("");
	$("#lastStage").val("");
	$(".questionInput").parent().find(".questionLabel").show();
	$(".questionInput").parent().find(".questionInput").hide();
	$(".questionsBox").removeClass("active");
}

function validateEmail(email) { 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
} 
function isNumber(n) {
  var num = /^(\d+-?)+\d+$/;
  return num.test(n);  
}
/*if ( isNumber('1234-7') ){alert(1);} */
