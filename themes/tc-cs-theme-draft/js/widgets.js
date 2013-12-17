jQuery(function($) {
	/* GET ALL TOPCODER */
    
	/*
	mktoMunchkin("237-ZTN-648");

	// JavaScript Document
	function associateLead(email){
	  // a function to process the form submit and send all but the password data to Marketo's Munchkin AssociateLead function
	  var hash = new Object();
	 	  
	  // the AJAX call to our SHA-1 webservice
	  jQuery.ajax({
		type:    'GET',
		url:     siteURL,
		data:     "mode=subscribe&email=" + email,
		async:    false,
		cache:    false,
		success:  (function(jsdata){
		mktoMunchkinFunction(
		  "associateLead", {
			'Email': email,
			}, jsdata.hash);
		//alert("'"+jsdata.hash+"'");	
		$(".rssWidget .content").html("<div class='msg'> Thank You for Subscribing! </div>"); 	
		}),
		error:   (function(jsObj, textStatus, errorThrown){
		  hash.key       = '';
		  hash.response  = jsObj.responseText;
		  hash.status    = jsObj.status;
		  hash.error     = true;
		})
	  }); 
	  return false;
	}
	*/

	$("a.btnSubscribe").click(function(){
        var email = $(".rssWidget .inputBox input").val();
        var reg = /^([a-zA-Z0-9_\.-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        if(!reg.test(email)){
            $(".rssWidget .content .error").remove();
            $(".rssWidget .content .error").show();
            $("<div/>",{
                "class":"error",
                "text":"Invalid Email!"
            }).appendTo($(this).parent());
        }
		else{
			// call our AJAX function and serialize the data before send (and remove any password field)
			$('.fieldArea').hide();
			$('.pleaseWait').show();
			$('#mktForm_1012').submit();
			}
        return false;
    })
	
    $(".rssWidget .inputBox input").focus(function(){
        $(".rssWidget .content .error").remove();   
    })
	
	/* contact us */	
	function contactus(name,email){
	  // a function to process the form submit and send all but the password data to Marketo's Munchkin AssociateLead function
	  // the AJAX call to our SHA-1 webservice
	  jQuery.ajax({
		type:    'GET',
		url:     siteURL,
		data:     "mode=contactus&name="+name+"&email=" + email,
		async:    false,
		cache:    false,
		success:  (function(jsdata){			
			if (jsdata.status == "OK")
			$(".commonWidget.contactUs h4").html("<div class='msg'> Thank You for Contacting Us! </div>"); 	
			else
			$(".commonWidget.contactUs .content").html("<div class='msg'> Something Errors </div>"); 
		}),
		error:   (function(){
			$(".commonWidget.contactUs .content").html("<div class='msg'> Something Errors </div>"); 
		})
	  }); 
	  return false;
	}
	
	$(".rightRail .contactUs li.action a").click(function(){
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        var name = $(".rightRail .contactUs .inputBox input:eq(0)");
        var email = $(".rightRail .contactUs .inputBox input:eq(1)");
        $(".rightRail .contactUs .error").remove();
        if(name.val() == ""){
            name.parents("li").append($("<div/>",{
                "class":"error",
                "text":"Name is required"
            }));
        }
        if(!reg.test(email.val())){
            email.parents("li").append($("<div/>",{
                "class":"error",
                "text":"Invalid Email!"
            }));
        }
        if(name.val() != "" && reg.test(email.val()) )
		{ 
			$('.fieldArea').hide();
			$('.pleaseWait').show();
			$('#mktForm_1004').submit();
		}	
        return false;
    })
    $(".rightRail .contactUs .inputBox input").focus(function(){
        $(this).parents("li").find(".error").remove();
    })

    /*e book widget*/
    $("#txtName, #txtEmail").focus(function(){
        var val = $(this).val();
        var def = $(this).attr("default");

        if(val==def){
            $(this).val("").removeClass("grayWords").addClass("blackWords");
        }else{
            if(val=="Enter Job Name" && $("select[name='searchSelect']").val() == "Job Name"){
                $(this).val("").removeClass("grayWords").addClass("blackWords");
            }
        }
    }).blur(function(){
            var val = $(this).val();
            var def = $(this).attr("default");
            if(val==""){

                if(def==null && $("select[name='searchSelect']").val() == "Job Name"){

                    $(this).val("Enter Job Name").removeClass("blackWords").addClass("grayWords");
                }else{

                    $(this).val(def).removeClass("blackWords").addClass("grayWords");
                }
            }
        });
    $(".chkWrapper").click(
        function(){
            if($(this).hasClass("checked")){
                $(this).removeClass("checked").addClass('unchecked');
            } else if($(this).hasClass("unchecked")){
                $(this).removeClass("unchecked").addClass('checked');
            } else if($(this).hasClass("checkError")){
                $(this).removeClass("checkError").addClass('checked');
            }
        }
    );

    $("#btnGetEBook").click(
        function(){
            var error =false;
            $(".errorText").hide();
            $("#txtName").removeClass("errorInput");
            $("#txtEmail").removeClass("errorInput");
            if( $("#txtName").attr('default') == $("#txtName").val() ){
                $("#txtName").addClass("errorInput");
                $(".errorText").show();
                error = true;
            }
            if( $("#txtEmail").attr('default') == $("#txtEmail").val() ){
                $("#txtEmail").addClass("errorInput");
                $(".errorText").show();
                error = true;
            } else if( !validateEmail($("#txtEmail").val()) ){
                $("#txtEmail").addClass("errorInput");
                $(".errorText").show();
                error = true;
            }
			/*
            if( !$(".chkWrapper").hasClass('checked')){
                $(".chkWrapper").removeClass("unchecked").addClass("checkError");
                $(".errorText").show();
                error = true;
            }
			*/
            if(!error){
                var values = {
                    FirstName : $("#txtName").val(),
                    Email : $("#txtEmail").val(),
                    newsLetters: $(".chkWrapper").hasClass('checked')
                };
				
				$(".ebookWidget .body").hide();
				$(".ebookWidget .result").show().empty().append('Submitting data, please wait'); 
                $.ajax({
                    url: ajaxUrl+"?action=ajax-subscribe-ebook",
                    type: "post",
                    data: values,
                    success: function(data){
                        $(".ebookWidget .result").empty().append(data.result);
						$(".ebookWidget .body").hide();
                        $(".ebookWidget .result").show();
                    },
                    error:function(){
                        alert("failure");
                    }
                });

            }
        }
    );
	
	
});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}



$(function() {
	//$.cookie("subscription","");
	
	$(".preContent").focus(function() {
		var hint = $(this);
		var val = $(this).val();
		if ($(this).hasClass("preContent")) {
			$(this).val("");
			$(this).removeClass("preContent");
			$(this).blur(function() {
				if (hint.val() == "" || hint.val() == val) {
					hint.addClass("preContent");
					hint.val(val);
				}
			})
		}
	})

	var flag = true;
	var subFN = true;
	var subLN = true;
	var emailReg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	$('#subsWidgetForm').submit(function(e) {
		e.preventDefault();
		if ($('#subFN').val() == 'First Name') {
			$('#subFN').siblings('.invalidInfo').css('display', 'inline-block');
			subFN = false;
		} else {
			$('#subFN').siblings('.invalidInfo').css('display', 'none');
			subFN = true;
		}
		if ($('#subLN').val() == 'Last Name') {
			$('#subLN').siblings('.invalidInfo').css('display', 'inline-block');
			subLN = false;
		} else {
			$('#subLN').siblings('.invalidInfo').css('display', 'none');
			subLN = true;
		}
		if ($('#emailAdd').val() == 'Email') {
			$('#emailAdd').siblings('.requiredEmailAdd').css('display', 'inline-block');
			flag = false;
		} else {
			$('#emailAdd').siblings('.requiredEmailAdd').css('display', 'none');
			flag = true;
		}
		if (!emailReg.test($('#emailAdd').val()) && $('#emailAdd').val()) {
			$('#emailAdd').siblings('.invalidEmailAdd').css('display', 'inline-block');
			flag = false;
		} else {
			flag = true;
		}

		if (flag && subFN && subLN) {
			$('#subFN').siblings('.invalidInfo').css('display', 'none');
			$('#subLN').siblings('.invalidInfo').css('display', 'none');
			$('#emailAdd').siblings('.requiredEmailAdd').css('display', 'none');
		
			var form = $('#subsWidgetForm');			
			var values = $(this).find('input:text').serialize();
			modalApp.show('#successSubs');
			$('#successSubs .des').html('Sending your data, Please wait ');
			$.ajax({
				type : "POST",
				url : ajaxUrl+"?action=ajax-subscribe-blog",
				data : values,
				success : function(data) {
					modalApp.hideModal($('#subscriptionModal'));
					$('#successSubs .des').html(data.result);
					window.setTimeout(function() {
						modalApp.hide($('#successSubs'));
						//$('.subscriptionWidget').hide();
					}, '3000');
					
					// reset value
					$('#subFN').val('First Name');
					$('#subLN').val('Last Name');
					$('#emailAdd').val('Email');
				}
			});
		}

	});
	$('.subscriptionWidget input').each(function() {
		$(this).focus(function() {
			$(this).siblings('.invalidInfo').css('display', 'none');
		});
	});
	// submit function
	$('.subscriptionModal').submit(function(e) {
		e.preventDefault();
		var flag = true;
		var mSubFN = true;
		var mSubLN = true;
		if ($('#mSubFN').val() == 'First Name') {
			$('#mSubFN').siblings('.invalidInfo').css('display', 'inline-block');
			mSubFN = false;
		} else {
			$('#mSubFN').siblings('.invalidInfo').css('display', 'none');
			mSubFN = true;
		}
		if ($('#mSubLN').val() == 'Last Name') {
			$('#mSubLN').siblings('.invalidInfo').css('display', 'inline-block');
			mSubLN = false;
		} else {
			$('#mSubLN').siblings('.invalidInfo').css('display', 'none');
			mSubLN = true;
		}
		if ($('#mEmailAdd').val() == 'Email') {
			$('#mEmailAdd').siblings('.requiredEmailAdd').css('display', 'inline-block');
			flag = false;
		} else {
			$('#mEmailAdd').siblings('.requiredEmailAdd').css('display', 'none');
			flag = true;
		}
		if (!emailReg.test($('#mEmailAdd').val()) && $('#mEmailAdd').val()) {
			$('#mEmailAdd').siblings('.invalidEmailAdd').css('display', 'inline-block');
			flag = false;
		} else {
			flag = true;
		}

		if (flag && mSubFN && mSubLN) {
			$('#mSubFN').siblings('.invalidInfo').css('display', 'none');
			$('#mSubLN').siblings('.invalidInfo').css('display', 'none');
			$('#mEmailAdd').siblings('.requiredEmailAdd').css('display', 'none');
			$('#mEmailAdd').siblings('.invalidEmailAdd').css('display', 'none');
		
			var form = $(this);
			var values = $(this).find('input:text').serialize();
			modalApp.hideModal($('#subscriptionModal'));
			modalApp.show('#successSubs');
			var action = $('input[name=action]').val(); 
			abtest.trackGoal(7); // see ab testing backend
			$('#successSubs .des').html('Sending your data, Please wait ');
			$.ajax({
				type : "POST",
				url : ajaxUrl+"?action=ajax-"+action,
				data : values,
				success : function(data) {
					// use data.FirstName, data.LastName & data.Email to
					// retrieve form data
					modalApp.hideModal($('#subscriptionModal'));
					modalApp.show('#successSubs');
					$('#successSubs .des').html(data.result);
					window.setTimeout(function() {
						modalApp.hide($('#successSubs'));
						//$('.subscriptionWidget').hide();						
						
					}, '3000');
					
					
				}
			});
		}
	});
	$('.modal .btnClose').click(function() {
		modalApp.hide($(this).parents('.modal'));
	});
	$(window).scroll(function() {
	 if( $.cookie("subscription") != "displayed" && $('.subscriptionModal form').html() != null ){
		var ht = $(window).height();
		var scroll = $(window).scrollTop();
		if (scroll > 2 * ht / 3 ) {
			modalApp.show('#subscriptionModal');
			$.cookie("subscription","displayed");
		}
	 }
	});

});

var modalApp = {
	show : function(modal) {
		var docheight = $(document).height();
		var docwidth = $(document).width();
		var screenwidth = $(window).width();
		var screenheight = $(window).height();
		popWinPosTop = screenheight / 2 - $(modal).height() / 2;
		popWinPosLeft = screenwidth / 2 - $(modal).width() / 2;
		mytop = $(document).scrollTop();
		$("#greybackground").css({
			"position" : 'absolute',
			"left" : 0,
			"top" : 0,
			"height" : docheight,
			"width" : docwidth,
			'z-index' : 900
		});
		$("#greybackground").show();
		$(modal).css({
			"left" : (popWinPosLeft > 0) ? popWinPosLeft : 0,
			"top" : (popWinPosTop > 0) ? (popWinPosTop) : mytop
		});
		$(modal).fadeIn("fast");
		return false;
	},
	hide : function(modal) {
		$('#greybackground').hide();
		if (modal == "all") {
			$('.modal').fadeOut('fast');
		} else {
			modal.fadeOut('fast');
		}
	},
	hideModal : function(modal) {
		modal.hide();
	}
}


