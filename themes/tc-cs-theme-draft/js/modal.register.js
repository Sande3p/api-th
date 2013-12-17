
function handleJsonResult(result, succHandler, failHandler) {
    if (result.jsonData.error) {
        if (failHandler) {
            failHandler(result.jsonData.message);
        }
    } else {
        if (succHandler) {
            succHandler(result.jsonData.result);
        }
    }
}


function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

var ctx = "/present";

function showErrorMessage(errorMessage) {
    alert(errorMessage);
}

$(document).ready(function() {
	$('#registerModal').hide();
	$("#loginLoading").show();
	$("#registerLoading").show();
	$(".whatsThis").hover(
	  function () {
		$(this).find(".handleTooltips").show('fast');
	  }, 
	  function () {
		$(this).find(".handleTooltips").hide('fast');
	  }
	);	
	
	$('.loginRegisterInputText .label').click(function() {
		$(this).hide();
		$(this).parent().addClass("activeInput");
		$(this).parent().find("input").show();
		$(this).parent().find("input").focus();
	});
	$('.loginRegisterInputText input').click(function() {
		$(this).parent().addClass("activeInput");
	});
	$('.loginRegisterInputText input').blur(function() {
		var value = $(this).val();
		$(this).parent().removeClass("activeInput");
		if(value=="") {
			$(this).parent().find(".label").show();
			$(this).parent().find("input").hide();
		}
	});
	//text shadow
	$('#content .banner h1,#content .banner h2').css({'text-shadow':'0px 5px 2px #000'});
	$('#content .banner .stepNum em').css({'text-shadow':'0px 3px 2px #434343'});
	$('.button2,.bigBtn,.button3').css({'text-shadow':'2px 2px 0 #305862'});
	
	//ie fix
	if(jQuery.browser.msie){
		$('#footer .bottomLine').css({'margin-left':'1px'});
		$('#content .mainBody .publicationSec .bottom').css({'margin-top':'35px'});
		if(jQuery.browser.version>7)
			$('#content .mainBody .rightCol .bottom').css({'margin-top':'75px'})
	}
	//firefox fix
	if(jQuery.browser.mozilla){
		$('#footer .bottomLine').css({'margin-left':'1px'})
	}
	
	//login modal
	var screenwidth,screenheight,popWinPosLeft,popWinPosTop,mytop;
	var docheight = $(document).height();
	var docwidth = $(document).width();
	screenwidth = $(window).width();
	screenheight = $(window).height();
	
	$(window).scroll(function(){
		mytop = $(document).scrollTop();
		popWinPosTop = screenheight/2 - $('#registerModal').height()/2;
		popWinPosLeft = screenwidth/2 - $('#registerModal').width()/2;
		if(popWinPosTop<0){
			$('#registerModal').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
		}
		else{
			$('#registerModal').css({"position":"fixed","top":popWinPosTop});
		}
	});
	$(window).resize(function(){
		screenwidth = $(window).width();
		screenheight = $(window).height();
		docheight = $(document).height();
		docwidth = $(document).width();
		$("#greybackground").css({"height":docheight,"width":docwidth});
		popWinPosTop = screenheight/2 - $('#registerModal').height()/2;
		popWinPosLeft = screenwidth/2 - $('#registerModal').width()/2;		
		if(popWinPosTop<0){
			$('#registerModal').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"position":"absolute"});
		}
		else{
			$('#registerModal').css({"position":"fixed","top":popWinPosTop});
		}
		
	});	
	
	//login trigger
	$('.registerBtn').live("click", function(e) {
		if($("#loginModal").css('display') == 'none') {
			$("#loginLoading").hide();			
			$("input[type='password']").val("");
			//clearLoginErrStyle();
			popWinPosTop = 44;
			popWinPosLeft = (screenwidth-960)/2;
			$('#loginModal').css({"position":'absolute',"z-index":10000,"right":(popWinPosLeft>0)?popWinPosLeft:0,"top":(loginPopupTop>0)?(loginPopupTop):0});
			$('#loginModal').show("fast");
		}
		else {
			$("#veriImg").attr("src", "https://www.topcoder.com/present/captchaImage.action?t=" + new Date().getTime());
			$('#loginModal').hide('fast');
		}
		return false;
    });
	$('#content,#header,footer').live("click", function(e) {
		$('#greybackground').hide();
		$('.showcaseModal').hide('fast');
		$('#registerModal').hide('fast');
		$('#loginModal').hide('fast');
	});
	
	// Join Now should trigger the login
	$('#joinNow').click(function(e) {
		$('#loginModal').hide("fast");
		$("#registerLoading").hide();
		$("#veriImg").attr("src", "https://www.topcoder.com/present/captchaImage.action?t=" + new Date().getTime());			
		clearLoginErrStyle();
		popWinPosTop = screenheight/2 - $('#registerModal').height()/2;
		popWinPosLeft = screenwidth/2 - $('#registerModal').width()/2;
		mytop = $(document).scrollTop();
		$("body").append("<div id='greybackground'></div>");
		$("#greybackground").css({"position":'absolute',"left":0,"top":0,"height":docheight,"width":docwidth,'z-index':900,'background':'url(/images/ppt/overlay-bg.png) repeat left top'});
		$('#registerModal').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"top":(popWinPosTop>0)?(popWinPosTop):mytop});
		$('#registerModal').show("fast");
		return false;
	});
	
    $(".tryAnotherCode").click(function() {
        $("#veriImg").attr("src", "https://www.topcoder.com/present/captchaImage.action?t=" + new Date().getTime());
    });
	function clearLoginErrStyle(register){
		$('.loadingbackground').remove();
		if(register!=true) {
			$('.loginRegisterInputText .label').show();
		}
		$('#username').val("");
		$('#username').parent().find(".label").show();
		$('#username').parent().find("input").hide();
		$('#username').parent().removeClass("errorInput");
		$('.handleErr').hide();		
		$('#password').val("");
		$('#password').parent().find(".label").show();
		$('#password').parent().find("input").hide();
		$('#password').parent().removeClass("errorInput");
		$('.passwordErr').hide();
		$('#firstName').parent().removeClass("activeInput");
		$('#firstName').parent().removeClass("errorInput");
		$('.firstNameErr').hide();
		$('#lastName').parent().removeClass("activeInput");
		$('#lastName').parent().removeClass("errorInput");
		$('.lastNameErr').hide();
		$('#handle').parent().removeClass("activeInput");
		$('#handle').parent().removeClass("errorInput");
		$('.handleErr').hide();
		$('#email').parent().removeClass("activeInput");
		$('#email').parent().removeClass("errorInput");
		$('.emailErr').hide();
		$('#regPassword').parent().removeClass("activeInput");
		$('#regPassword').parent().removeClass("errorInput");
		$('.regPasswordErr').hide();
		$('#confirmPassword').parent().removeClass("activeInput");
		$('#confirmPassword').parent().removeClass("errorInput");
		$('.passwordNotMactchErr').hide();
		$('#veriCode').parent().removeClass("activeInput");
		$('#veriCode').parent().removeClass("errorInput");
		$('.veriCodeErr').hide();
        $('.policyErr').hide();
        $('.loginError').hide();
		$('#acceptRow').removeClass("errorAcceptRow");
		$('.error').hide();
	}
	$('#clearRegisterForm').click(function(e) {
		$("#registerModal input").val("");
		clearLoginErrStyle();
		$(".validCheck").hide();
		$(".loginRegisterInputText input").hide();
		$(".loginRegisterInputText .label").show();
	});
	function showLoginErrStyle(e){
		e.parent().addClass("errorInput");
	}
	var users = ["test","admin","demo"];
	var passwords = ["test","admin","demo"];
	//login demo
	$('#loginModal .loginBtn').click(function(e) {
		//clearLoginErrStyle();
		var flag = true;
        var username = $('#username').val();
		var password = $('#password').val();
		if(!username){
			showLoginErrStyle($('#username'));
			flag = false;
		}
		if(!password){
			showLoginErrStyle($('#password'));
			flag = false;
		}
		if(!flag)return;
        var rememberMe = $("#rememberMe").is(":checked");
		//start loading
		//$('#loginModal').append("<div class='loadingbackground'><div class='loadingIndicator'><div class='loadingCover'></div></div><div class='indicatorMsg'>Logging in,please wait...</div></div>");
		loginProcess = 0;
        longProcessorIntervalId = setInterval(loginLoading, 10);
        loginLoading();
        $.ajax({
          type: 'POST',
          url:  loginPath,
          data: {"username":username, "password":password, "rememberMe":rememberMe},
          cache: false,
          dataType: 'json',
          async : false,
          success: function(jsonResult) {
            clearInterval(longProcessorIntervalId);
			$("#loginButton").show();
			$("#loginLoading").hide();
            handleJsonResult(jsonResult,
            function(result) {
                if (result.success) {
                    setCookie('handleName',username,1);
					$('#loginModal .indicatorMsg').html('Login succeeded!')
					setTimeout(function(){
						$('#greybackground').remove();
						$('#loginModal').hide();
						$('#header .welcomeSection').show();
						$('#header .registerSection').hide();	
                        $(".handle").html(username);
        			},500);
                } else {
                    $('#loginModal .loadingbackground').remove();
					showLoginErrStyle($('#username'));
                    showLoginErrStyle($('#password'));
                    $('.loginError').show();
                }
            },
            function(errorMessage) {
                showErrorMessage(errorMessage);
            });
          }
        });
    });
	function loginLoading(){
		loginProcess++;
        if (loginProcess > 100) return;
		$("#loginButton").hide();
		$("#loginLoading").show();
	}
	//logout
	$('#header .logoutLink').click(function(e) {
		$.ajax({
            type: 'GET',
            url:  logoutPath,
            data: "",
            cache: false,
            dataType: 'json',
            async : false,
            success: function(jsonResult) {
            	$('#header .welcomeSection').hide();
				$('#header .registerSection').show();	
            }
		});
    });
	//reset input 
	$('.resetBtn').click(function(e) {
        $('.inputCre').val('');
		clearLoginErrStyle();
    });
	
	$('#handle').keypress(function (e) {
        typedchar = String.fromCharCode(e.keyCode|e.charCode);
		re = /^[A-Za-z0-9]*$/; // block " ' and $ 
		return (re.test(typedchar));
    });
	
	//register submit
	$('#registerModal .submitBtn').click(function(e) {
        clearLoginErrStyle(true);
		var flag = true;
		$('#registerModal input').parent().parent().find(".validCheck").show();
		var firstName = $('#registerModal #firstName').val();
		if(!$('#registerModal #firstName').val()){//first name empty
			showLoginErrStyle($('#firstName'));
			$('#firstName').parent().parent().find(".error").show();
			$('#firstName').parent().parent().find(".validCheck").hide();
			flag = false;
		}
        var lastName = $('#lastName').val();
		if(!$('#lastName').val()){
			showLoginErrStyle($('#lastName'));
			$('#lastName').parent().parent().find(".error").show();
			$('#lastName').parent().parent().find(".validCheck").hide();
			flag = false;
		}
		var handle = $('#handle').val();
		if(!$('#handle').val()){
			showLoginErrStyle($('#handle'));
			$('#handle').parent().parent().find(".error").show();
			$('#handle').parent().parent().find(".validCheck").hide();
			flag = false;
		}
        var emailAddress = $('#email').val();
		if(!$('#email').val()){
			showLoginErrStyle($('#email'));
			$('#email').parent().parent().find(".error").html("Please fill your email");
			$('#email').parent().parent().find(".error").show();
			$('#email').parent().parent().find(".validCheck").hide();
			flag = false;
		}
		else if(!validateEmail( $('#email').val() )) {
			showLoginErrStyle($('#email'));
			$('#email').parent().parent().find(".error").html("Please use valid email");
			$('#email').parent().parent().find(".error").show();
			$('#email').parent().parent().find(".validCheck").hide();
			flag = false;
		}
		if(!$('#regPassword').val()){
			showLoginErrStyle($('#regPassword'));
			$('#regPassword').parent().parent().find(".error").show();
			$('#regPassword').parent().parent().find(".validCheck").hide();
			flag = false;
		}
        var password = $('#regPassword').val();
		if(!$('#confirmPassword').val()){
			showLoginErrStyle($('#confirmPassword'));
			$('#confirmPassword').parent().parent().find(".validCheck").hide();
			$('.passwordNotMactchErr').html('Please fill in your password again');
			$('.passwordNotMactchErr').show();
			flag = false;
		}
        if($('#regPassword').val()!=$('#confirmPassword').val()){
            showLoginErrStyle($('#confirmPassword'));
			$('#confirmPassword').parent().parent().find(".validCheck").hide();
            $('.passwordNotMactchErr').html('Password does not match');
            $('.passwordNotMactchErr').show();
            flag = false;
        }
        if (!$("#accPol").is(":checked")) {
            $('.policyErr').show();
			$('#acceptRow').addClass("errorAcceptRow");
            flag = false;
        }
		if(!$('#veriCode').val()){
			showLoginErrStyle($('#veriCode'));
			$('#veriCode').parent().parent().find(".error").show();
			$('#veriCode').parent().parent().find(".validCheck").hide();
			flag = false;
		}
        var veriCode = $('#veriCode').val();
		if(flag){
			//start loading
			//$('#registerModal').append("<div class='loadingbackground'><div class='loadingIndicator'><div class='loadingCover'></div></div><div class='indicatorMsg'>Creating account,please wait...</div></div>");
			registerProcess = 0;
            registerProcessIntervalId = setInterval(registerLoading, 10);
            $("#registerLoading").show();
			$("#registerModal .submitBtn").hide();
            $.ajax({
              type: 'POST',
              url:  registerPath,
              data: "formData.firstName="+firstName+"&formData.lastName="+lastName+"&formData.handle="+handle+"&formData.email="+emailAddress+"&formData.password="+password+"&formData.verificationCode="+veriCode+"&formData.moduleFrom=home",
              cache: false,
              dataType: 'json',
              async : false,
              success: function(jsonResult) {
				 $("#registerLoading").hide();
				 $("#registerModal .submitBtn").show();
                clearInterval(registerProcessIntervalId);
                handleJsonResult(jsonResult,
                function(result) {
                    if (jsonResult.jsonData.fieldErrors) {
                        var hasError = false;
                        for (var fname in jsonResult.jsonData.fieldErrors) {
                            hasError = true;
                            break;
                        }
                        if (hasError) {
                        	//clearLoginErrStyle();
                        }
                        for (var fname in jsonResult.jsonData.fieldErrors) {
                            hasError = true;
                            showLoginErrStyle($('#' + fname));
                            var errors = jsonResult.jsonData.fieldErrors[fname];
                            var errEle = $(".error", $('#' + fname).parent().parent());
							$('#' + fname).parent().parent().find(".validCheck").hide();
                            errEle.html("");
                            for (var ind = 0; ind < errors.length; ind++) {
                                if (ind > 0) errEle.html("<br/>");
                                errEle.html(errors[ind]);
                            }
                            errEle.show();
                        }
                        if (hasError) {
                            $("#veriImg").attr("src", "https://www.topcoder.com/present/captchaImage.action?t=" + new Date().getTime());
                            return;
                        }
                    }
                    setTimeout(function(){
                      $('#greybackground').remove();
                      $('#registerModal').hide();	
					  $("#registerModal .submitBtn").show();
                    },500);
                    alert("Your account has been created, please check your email and activate it.");
//                    $.ajax({
//                      type: 'POST',
//                      url:  ctx + "/login",
//                      data: {"username":handle, "password":password, "rememberMe":false},
//                      cache: false,
//                      dataType: 'json',
//                      async : false,
//                      success: function(jsonResult) {
//                        handleJsonResult(jsonResult,
//                        function(result) {
//                            if (result.success) {
//                                setTimeout(function(){
//                                    $('#greybackground').remove();
//                                    $('#registerModal').hide();
//                                    $('.nav .welcomeSection').show();
//                                    $('.nav .loginSection').hide();	
//                                    $(".handle").html(handle);
//                                    $(".startNP").removeClass("navLogin").unbind();
//                                    $(".startNP").attr("href", "/direct/createNewProject.action");
//                                },500);
//                            } else {
//                                alert("Can't login");
//                            }
//                        },
//                        function(errorMessage) {
//                            showErrorMessage(errorMessage);
//                        });
//                      }
//                    });
                },
                function(errorMessage) {
                    showErrorMessage(errorMessage);
                });
              }
            });
		}
    });
	function registerLoading(){
		registerProcess++;
        if (registerProcess > 100) return;
		$("#registerLoading").show();
		$("#registerModal .submitBtn").hide();
	}
	$('#loginModal .registerTab').click(function(e) {
		$("#registerLoading").hide();
		$("#registerModal .validCheck").hide();
		$('#loginModal').hide("fast");
		$("#registerModal input").val("");
		clearLoginErrStyle();
		popWinPosTop = screenheight/2 - $('#registerModal').height()/2;
		popWinPosLeft = screenwidth/2 - $('#registerModal').width()/2;
		mytop = $(document).scrollTop();
		$("#greybackground").css({"position":'absolute',"left":0,"top":0,"height":docheight,"width":docwidth,'z-index':900});
		$("#greybackground").show();
		$('#registerModal').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"top":(popWinPosTop>0)?(popWinPosTop):mytop});
		$('#registerModal').show("fast");
		return false;
	});
	$('#registerModal .loginTab').click(function(e) {
		$('#registerModal').hide("fast");
		clearLoginErrStyle();
		popWinPosTop = screenheight/2 - $('#loginModal').height()/2;
		popWinPosLeft = screenwidth/2 - $('#loginModal').width()/2;
		$('#loginModal').css({"left":(popWinPosLeft>0)?popWinPosLeft:0,"top":(popWinPosTop>0)?(popWinPosTop):0});
		$('#loginModal').show("fast");
	});
	

	$('#greybackground,.closeRegister').live('click',function(e) {
        $('#greybackground').hide();
		$('.showcaseModal').hide('fast');
		$('#registerModal,.modal').hide('fast');
		$('#loginModal').hide('fast');
    });
	
	
	$('.loginRegisterInputText .label').click(function() {
		$(this).hide();
		$(this).parent().find("input").show();
		$(this).parent().find("input").focus();
	});
	$('.loginRegisterInputText input').blur(function() {
		var value = $(this).val();
		if(value=="") {
			$(this).parent().find(".label").show();
			$(this).parent().find("input").hide();
		}
	});
	
	/*
	 * Tab Form Functioning
	 */
	$('#username').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("password","username");
		return false;
	   }
	});
	$('#firstName').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("lastName","firstName");
		return false;
	   }
	});
	$('#lastName').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("handle","lastName");
		return false;
	   }
	});
	$('#handle').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("email","handle");
		return false;
	   }
	});
	$('#email').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("regPassword","email");
		return false;
	   }
	});
	$('#regPassword').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("confirmPassword","regPassword");
		return false;
	   }
	});
	$('#confirmPassword').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("veriCode","confirmPassword");
		return false;
	   }
	});
	$('#veriCode').keydown(function(e) {
	   var code = e.keyCode || e.which;
	   if (code == '9') {
		activateInput("","veriCode");
		return false;
	   }
	});
	function activateInput(input,inputSource) {
		$("#"+input).parent().find(".label").hide();
		$("#"+input).parent().addClass("activeInput");
		$("#"+input).show();
		$("#"+input).focus();
		var value = $("#"+inputSource).val();
		$("#"+inputSource).parent().removeClass("activeInput");
		if(value=="") {
			$("#"+inputSource).parent().find(".label").show();
			$("#"+inputSource).hide();
		}		
	}
	function validateEmail(email) { 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	} 
});