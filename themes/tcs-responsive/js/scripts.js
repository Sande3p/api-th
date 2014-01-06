var ev = 'click';
if ($.support.touch) {
    ev = 'tap'
}
var ie7 = false;

var ajax = {
    data: '',
	postPerPage: '10'
}

var xhr= "";


// application functions
var app = {
    init: function() {
        if (navigator.userAgent.indexOf('MSIE 7.0') >= 0) {
            $('body').addClass('ie7');
            ie7 = true;
        }

        // init slider
        var bannerSlider = $('#banner .slider').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            controls: false,
            auto: true,
            pause: 5000,
            onSlideAfter: function() {
                bannerSlider.startAuto()
            }
        
        });
        
        $('.dataTable.challenges tbody, .layChallenges .dataTable tbody').html(null);
        $('#gridView .contestGrid').html(null);
        // challenges list init
        if ($('.layChallenges').length > 0) {
        //app.challenges.init();
        }
        if ($('.community').length > 0) {
        //app.community.init();
        }
		//Overview page init 
		if ($('.overviewPage').length > 0) {
			app.overview.init();
		}
		
		//Case page init 
		if ($('.casePage').length > 0) {
			app.casestudy.init();
		}
		
		//Resource init 
		if ($('.resourceList').length > 0) {
			app.resource.init();
		}
		
		//Story init 
		if ($('.storyPage').length > 0) {
			app.story.init();
		}
        
        if ($('#whatsHappening .slider').length > 0) {
            
            $('#whatsHappening .slider').each(function() {
                $('ul', $(this)).bxSlider({
                    minSlides: 1,
                    maxSlides: 1,
                    responsive: !ie7,
                    controls: false
                });
            })
        }
        
        app.setPlaceholder($('.connected .email'));
        
        
        
        $('body').on(ev, function() {
            $('.btnMyAcc').removeClass('isActive');
            $('.userWidget:visible').hide();
        });
        
        $('.userWidget').on(ev, function(e) {
            e.stopPropagation();
        })
    
    },
    // event bindings
    initEvents: function() {
		
		/* post email data */
		$('#emailForm .btnSubmit').on(ev,function(){
			$.get($('#emailForm').attr('action'),$('#emailForm').serialize());
		});
		
        $('.btnMyAcc').on(ev, function() {
            var widg = $('.userWidget', $(this).closest('.container'));
            if ($(this).hasClass('isActive')) {
                widg.stop().slideUp();
                $(this).removeClass('isActive');
            } else {
                widg.stop().slideDown();
                $(this).addClass('isActive');
            }
            
            return false;
        
        });
		
		// register demo 
		$('.dataTable').on(ev, '.btnAlt',function(){
			$(this).replaceWith('<a href="javascript:;" class="btn">Submit</a>');
		});

        // login
        $('.actionLogout').on(ev, function() {
            $('#navigation, .sidebarNav').addClass('newUser')
            $('#navigation .userWidget').hide();
            $('#navigation .isActive').removeClass('isActive');
            $('.btnRegWrap').show();
            $('.btnAccWrap').hide();
        });
        $('.actionLogin_Del').on(ev, function() {
            $('#navigation, .sidebarNav').removeClass('newUser');
            $('.btnRegWrap').hide();
            $('.btnAccWrap').show();
        });
        
        
        $('.sidebarNav a i').on(ev, function() {
            var root = $(this).closest('.root');
            if ($(this).closest('li').hasClass('isActive')) {
                $(this).closest('li').removeClass('isActive');
            } else {
                $(this).closest('li').addClass('isActive');
            }
            return false;
        })

        // main Nav
       	$('#mainNav').on(ev, function() {
			$('.sidebarNav').css('opacity', 1);
			$('.content, #navigation').toggleClass('moving');
			window.setTimeout(function(){$('body').toggleClass('stop-scrolling');},1);
		});
        $('#mainNav .root').on(ev, function(e) {
            e.stopPropagation();
        });
        
        $('#mainNav .root > li').mouseenter(function(){
			$('.child',$(this)).stop().slideDown('fast');
		});
		$('#mainNav .root > li').mouseleave(function(){
			$('.child',$(this)).stop().slideUp('fast');
		});

        // footer navigation
        $(' #footer .rootNode > a').on(ev, function() {
            if (!($('.onMobi.linkLogout').is(':visible') || $('.onMobi.linkLogin').is(':visible'))) {
                return false;
            }
            var ul = $('ul', $(this).closest('.rootNode'));
            ul.toggleClass('show');
            return false;
        });

        // tab navs
        $('.tabNav a').on(ev, function() {
            var id = $(this).attr('href');
            $('.tab', $(this).closest('.tabsWrap')).hide();
            $(id).fadeIn();
            $('.active', $(this).closest('nav')).removeClass('active');
            $(this).addClass('active');
            return false;
        });
    },
    
    setLoading: function() {
        if ($('.loading').length <= 0) {
            $('body').append('<div class="loading">Loading...</div>');
        } else {
            $('.loading').show();
        }
    },
    buildRequestData: function(actionType, contestType, contest_track, sortColumn, sortOrder, pageIndex, pageSize) {
        var action = "";
        //	switch contest type 
        switch (actionType) 
        {
            case "activeContest":
                action = "get_active_contest";
                break;
            case "pastContest":
                action = "get_past_contest";
                break;
            case "reviewOpportunities":
                action = "get_review_opportunities";
                break;
        }
		if(pageIndex==null || pageIndex ==""){
			pageIndex = 1;
		}
        ajax.data = {"action": action,"contest_type": contestType,"contest_track" : contest_track,"sortColumn": sortColumn,"sortOrder": sortOrder, "pageIndex":pageIndex,"pageSize":pageSize};
    },
    /*
	 * community page functions
	 * --------------------------------------------------------------
	 */
    community: {
        init: function() { 
            // list partial challenges table data
				app.community.getAllPartialContests(ajax.postPerPage);            
			
            $('.dataChanges .viewAll').on(ev, function() {
                ajax.data["pageIndex"] = 1;
                app.community.getAllPartialContests(1000);   
               
                $('.rt', $(this).closest('.dataChanges')).hide();
                $(this).parent().hide();
                app.ie7Fix2();
            });
			
			/* table short */
			$('.dataTable.challenges thead th').click(function(){
				if($(this).hasClass('disabled')){ return false;}
				var shortCol = $(this).text().toLowerCase();
				shortCol = shortCol.replace(' ','');
				if(shortCol==""){return false;}
				
				ajax.data["sortColumn"] = shortCol;
				if($(this).hasClass('asc')){
					ajax.data["sortOrder"] = 'desc';
					$(this).removeClass('asc');
				}else{
					ajax.data["sortOrder"] = 'asc';
					$(this).addClass('asc');
				}
				/* build url and requtest data using ajax */
				//if(conType==null || conType==""){
					app.community.getAllPartialContests();       
				
			});
        },			
		
		getAllPartialContests: function(nRecords){
			/*
			* get all contests data
			*/
			app.getPartialContests(ajaxUrl,$('.challenges'), 2, 'design',false, function(){
				app.getPartialContests(ajaxUrl,$('.challenges'), 2, 'develop',true, function(){
					app.getPartialContests(ajaxUrl,$('.challenges'), 1, 'data-marathon',true, function(){
						app.getPartialContests(ajaxUrl,$('.challenges'), 1, 'data-srm',true);
					});
				});
			});
			
		}
    
    },
	// get contests tableView & gridView data
	getPartialContests: function(url, table, pageSize, challenge_type, isAppend, callback) {
	if (url == null || url == "") {
		return false;
	}
	ajax.data["contest_type"] = challenge_type;
	ajax.data["pageSize"] = pageSize;
	app.setLoading();
	if(xhr != ""){
		xhr.abort();
	}
	
	
	
	xhr = $.getJSON(url, ajax.data, function(data) {
			app.getPartialContestTable(table, data, pageSize, isAppend);			
		}).always(function(){
			if(callback != null && callback !=""){
				callback();
			}
		});
	},
	
    /*
	 * challenges page functions
	 * --------------------------------------------------------------
	 */
    challenges: {
        init: function() {
            // add table and gird data			
			var conType=ajax.data["contest_type"];
			if(conType==null || conType==""){
            	app.challenges.getAllContests();       
			}else{				
				$('.challengeType .active').removeClass('active');
				$('.challengeType .'+conType).addClass('active');
				
				if(conType == "data"){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',false,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
					});
				}else{					
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, conType,false);
				}
				
			}
            
            /* view all records */
            $('.dataChanges .viewAll').on(ev, function() {
				ajax.data["pageIndex"] = 1;
                app.getContests(ajaxUrl, $('.dataTable'), 1000, ajax.data["contest_type"]);
                $('.rt', $(this).closest('.dataChanges')).hide();
                $(this).parent().hide();
            });
            
            /* view next */
            $('.dataChanges').on(ev, '.nextLink', function(e) {
                $('.prevLink', $(this).parent()).show();
                var _this = $(e.currentTarget);
				
				ajax.data["pageIndex"] = ajax.data["pageIndex"]+1;	
				var pageCount = 3; //dummy data as current api do not return number of pages in current track
                if (ajax.data["pageIndex"] >= pageCount) {
                    _this.hide();
                }
				var conType = ajax.data.contest_type;
				if(conType == "data" || conType == "data-srm" || conType == "data-marathon"){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',false,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
					});
				}else{					
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, conType,false);
				}	
				
                return false;
            });
            $('.dataChanges').on(ev, '.prevLink', function(e) {
                $('.nextLink', $(this).parent()).show();
                var _this = $(e.currentTarget);
               
                ajax.data["pageIndex"] = ajax.data["pageIndex"]-1;				
                if (ajax.data["pageIndex"] <= 1 ) {
                    _this.hide();
					ajax.data["pageIndex"] = 1;
                }
                var conType = ajax.data.contest_type;
				if(conType == "data" || conType == "data-srm" || conType == "data-marathon"){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',false,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
					});
				}else{					
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, conType,false);
				}	
				
                return false;
            });
            
            $('.views a').on(ev, function(e) {
                if ($(this).hasClass('isActive')) {
                    return false;
                }
                $('.viewTab').hide();
                id = $(this).attr('href');
                $(id).fadeIn('fast');
                $('.isActive', $(this).parent()).removeClass('isActive');
                $(this).addClass('isActive');
                app.ie7Fix();
                return false;
            });
            
            $('.ddWrap').on(ev, '.val', function() {
                $(this).closest('.ddWrap').toggleClass('on');
            });
            $('.ddWrap').mouseleave(function() {
                $(this).closest('.ddWrap').removeClass('on');
            });
            $('.ddWrap .list li').on(ev, function() {
                var dd = $(this).closest('.ddWrap');
                $('.active', dd).removeClass('active');
                $(this, dd).addClass('active');
                $('.val', dd).html($(this).text() + '<i></i>');
                dd.removeClass('on');
               // app.getContests('data/challenges-2.json', $('.dataTable'), ajax.postPerPage);
            });

            // challengeType
            $('.challengeType a').on(ev, function() {
                if ($(this).hasClass('active'))
                    return false;
					
                var href = $(this).attr('href');				
				var url = $('#navigation .logo a').attr('href')+ '/'+href+'/challenges';
				if(href=="all"){
					url = $('#navigation .logo a').attr('href')+ '/challenges';
				}
				window.location = url;
				return false;
            });
			
			/* table short */
			$('.layChallenges .dataTable thead th').click(function(){
				if($(this).hasClass('disabled')){ return false;}
				var shortCol = $(this).text().toLowerCase();
				shortCol = shortCol.replace(' ','');
				if(shortCol==""){return false;}
				
				if($('.challengeType .active').text()=="All"){
					ajax.data["contest_type"] = "";
				}
				
				//if($('.challengeType .active').length > 0){
					//ajax.data["contest_type"] = $('.challengeType active').text().toLowerCase();
				//}
				ajax.data["sortColumn"] = shortCol;
				if($(this).hasClass('asc')){
					ajax.data["sortOrder"] = 'desc';
					$(this).removeClass('asc');
				}else{
					ajax.data["sortOrder"] = 'asc';
					$(this).addClass('asc');
				}
				var conType = ajax.data.contest_type;
				/* build url and requtest data using ajax */
				if(conType==null || conType==""){
					app.challenges.getAllContests();       
				}else{				
					$('.challengeType .active').removeClass('active');
					$('.challengeType .'+conType).addClass('active');
					
					if(conType == "data" || conType == "data-srm" || conType == "data-marathon"){
							app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',false,function(){
							app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
						});
					}else{					
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, conType,false);
					}				
				}
			});
        },
		
		initTableNGrid: function(callback){
			var conType=ajax.data["contest_type"];
			if(conType==null || conType==""){
            	app.challenges.getAllContests(callback);       
			}else{				
				$('.challengeType .active').removeClass('active');
				$('.challengeType .'+conType).addClass('active');
				
				if(conType == "data"){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',false,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true, callback);
					});
				}else{					
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, conType,false, callback);
				}
				
			}			
		},
		
		getAllContests: function(callback){
			/*
			* get all contests data
			*/
			app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'design',false,
			function(){
				app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'develop', true,function(){
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',true,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
					});
				});	
				if(typeof(callback)!='undefined'){
					callback();
				}
			});
		},
		
		getActiveContestsList: function(callback){
			/*
			* get all contests data
			*/
			app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'design',false,
			function(){
				app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'develop', true,function(){
					app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-marathon',true,function(){
						app.getContests(ajaxUrl, $('.dataTable'), ajax.postPerPage, 'data-srm',true);
					});
				});	
				callback();
			});
		}
		
    },

	/*
	 * 0verview page functions
	 * --------------------------------------------------------------
	 */
	overview : {
		init : function() {
			
			//Equalize height
			$(".csRealResults .realResult").height(""); 
			var fw = parseInt($(".csRealResults").width()/2);
			var w = parseInt($(".realResult").eq(0).width());
			if ( (w < fw) && ( $(".realResult").length > 0 )){
				//desktop view, need equalize
				$(".csRealResults .grid-3-1:nth-child(2n)").each(function() {
					var prevObj = $(this).prev(".grid-3-1");
					var h1 = parseInt(prevObj.height()) - 42;
					var h2 = parseInt($(this).height()) - 42;
					var newH = Math.max(h1, h2, 0);
					$(".realResult", $(this)).height( newH );
					$(".realResult", prevObj).height( newH );	
				});
			}
			$(window).resize(function() {
				$(".csRealResults .realResult").height(""); 
				var fw = parseInt($(".csRealResults").width()/2);
				var w = parseInt($(".realResult").eq(0).width());
				if ( (w < fw) && ( $(".realResult").length > 0 )){
					//desktop view, need equalize
					$(".csRealResults .grid-3-1:nth-child(2n)").each(function() {
						var prevObj = $(this).prev(".grid-3-1");
						var h1 = parseInt(prevObj.height()) - 42;
						var h2 = parseInt($(this).height()) - 42;
						var newH = Math.max(h1, h2, 0);
						$(".realResult", $(this)).height( newH );
						$(".realResult", prevObj).height( newH );	
					});
				}
			});
		}

	},
	/*
	 * Resources page functions
	 * --------------------------------------------------------------
	 */
	resource : {
		init : function() {
			$(".jsshowMoreResource").click(function(){
				app.setLoading();
				window.setTimeout(function(){$('.loading').hide();},1000);
				$(this).hide();
				$(".resourceList > ul > li").removeClass("hide");
			});
		}

	},
	/*
	 * Story page functions
	 * --------------------------------------------------------------
	 */
	story : {
		init : function() {
			$(".jsShowMoreArchiveStories").click(function(){
				app.setLoading();
				window.setTimeout(function(){$('.loading').hide();},1000);
				$(this).hide();
				$(".archiveStoriesList > li").removeClass("hide");
			});
		}

	},
	/*
	 * Case page functions
	 * --------------------------------------------------------------
	 */
	casestudy : {
		init : function() {
			
			$(".jsCloseCaseDetails").click(function(){
				var caseItem = $(this).parents(".caseDetailItem").eq(0);
				if (ie7) {
					$('.btn', caseItem).css({
						"visibility": "hidden"
					});
					$('.container', caseItem).css({
						"position": "static"
					});
				}
				caseItem.slideUp(500, function(){
					caseItem.hide()
					$(".jsShowCaseDetails").removeClass("isShow");
					$(".caseDetailItem").hide();
					if (ie7) {
						$('.container', caseItem).css({
							"position": "relative"
						});
						$('.btn', caseItem).css({
							"visibility": ""
						});
					}
				});
			});
			
			$(".caseDetailItem").each(function(index) {
                var newObj = $(this).clone("true");
				var caseGrids = $(".casesView .caseGrid");
				caseGrids.eq(index).append(newObj);
            });
			
			$(".jsShowCaseDetails").click(function(){
				if ($(this).hasClass("isShow")){
					$(".jsCloseCaseDetails:visible").trigger("click");
				}else{
					var ofY=$(this).offset().top-20;
					$("html, body").animate({ scrollTop: ofY });
					if ($(".isShow").length > 0){
						$(".jsShowCaseDetails").removeClass("isShow");
						$(".caseDetailItem").hide();
					}
					$(".jsShowCaseDetails").removeClass("isShow");
					$(this).addClass("isShow");	
					var gridItem = $(this).parent();
					var groupItem = $(this).parents(".group").eq(0);
					var idx = $(".caseGrid", groupItem).index(gridItem);
					var detailsWrapper = groupItem.next(".caseDetailsWrapper");
					var detailItem = $(".caseDetailItem", detailsWrapper).eq(idx);
					if (ie7) {
						$('.btn', detailItem).css({
							"visibility": "hidden"
						});
						$('.container', detailItem).css({
							"position": "relative"
						});
					}
					detailItem.stop().slideDown(800, function(){
						if (ie7) {
							$('.btn', detailItem).css({
								"visibility": ""
							});
						}
					});		
					$(".caseDetailItem", gridItem).eq(0).stop().slideDown(800);	
				}
			});
			

			
		/*	$(".showAllBtn").click(function(){
				app.setLoading();
				window.setTimeout(function(){$('.loading').hide();},1000);
				var btnWrapper =$(this).parents(".dataChanges").eq(0);
				$("> div", btnWrapper ).hide();
				$(".caseGrid, .casesView, .caseDetailsWrapper ").removeClass("hide");
			});
			$('.dataChanges').on(ev, '.nextLink', function(e) {
				$('.prevLink', $(this).parent()).show();
				var _this = $(e.currentTarget);
				var pageNo = _this.attr('href').replace(/#/g, '');
				pageNo = parseInt(pageNo);
				if (pageNo >= 3) {
					_this.hide();
				}
				_this.attr('href', '#' + (pageNo + 1));
				$('.prevLink', $(this).parent()).attr('href', '#' + (pageNo - 1));
				app.setLoading();
				window.setTimeout(function(){$('.loading').hide();},1000);
				return false;
			});*/
			$('.dataChanges').on(ev, '.prevLink', function(e) {
				$('.nextLink', $(this).parent()).show();
				var _this = $(e.currentTarget);
				var pageNo = _this.attr('href').replace(/#/g, '');
				pageNo = parseInt(pageNo);
				if (pageNo <= 1) {
					_this.hide();
				}
				_this.attr('href', '#' + (pageNo - 1));
				$('.nextLink', $(this).parent()).attr('href', '#' + (pageNo + 1));
				app.setLoading();
				window.setTimeout(function(){$('.loading').hide();},1000);
				return false;
			});
		}

	},

    // ie fix
    ie7Fix: function() {
        if (ie7) {
            $('#aboutContent, #footer').hide();
            window.setTimeout(function() {
                $('#aboutContent, #footer').show()
            }, 10);
        }
    },

    // ie fix
    ie7Fix2: function() {
        if (ie7) {
            $('body').hide();
            window.setTimeout(function() {
                $('body').show();
            }, 100);
        }
    },    
    
	formatDate: function(date){
		date = new Date(date.replace(/-/g,'/').replace(/T/,' ').replace(/Z/,' ').replace(/\./,' +'));
		return date.toDateString() + ' ' + date.getHours() + ':' + date.getMinutes();
	},

	formatDate2: function(date){
		date = new Date(date.replace(/-/g,'/').replace(/T/,' ').replace(/Z/,' ').replace(/\./,' +'));
		return date.toDateString() + ' ' + date.getHours() + ':' + date.getMinutes();
	},

	
    // get contests tableView & gridView data
    getContests: function(url, table, pageSize, challenge_type, isAppend, callback) {
        if (url == null || url == "") {
            return false;
        }
        ajax.data["contest_type"] = challenge_type;
		ajax.data["pageSize"] = pageSize;
        app.setLoading();
		
		if(xhr != ""){
			xhr.abort();
		}		
		
        xhr = $.getJSON(url, ajax.data, function(data) {
            app.getContestTable(table, data, pageSize, isAppend);
            app.getContestGrid($('#gridView .contestGrid'), data, (pageSize), isAppend);
			
        }).always(function(){
			if(callback != null && callback !=""){
				callback();
			}			
		});
    },
    // generate contest view table
    getContestTable: function(table, data, records2Disp, isAppend) {
        if (isAppend != true) {
            $('tbody', table).html(null);
        }
        var count = 0;
        $.each(data, function(key, rec) {			
			
            if (count >= records2Disp) {
                count = 0;
				$('.dataChanges').show();
                return false;
            } else {
				$('.dataChanges').hide();
                count += 1;
            }
            var row = $(blueprints.challengeRow).clone();
			var trackName = ajax.data["contest_type"].split('-')[0];
            row.addClass('track-'+trackName);
			if(ajax.data["contest_type"]=="data-srm" ){	
			/*
			* generate table row for contest type SRM
			*/			
            	$('.contestName', row).html('<i></i>' + rec.name);
			//	$('.contestName', row).attr('href',  challengeDetailsUrl + rec.roundId);
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				//$('.vStartDate', row).html(app.formatDate(rec.startDate));
				$('.vStartDate', row).html(app.formatDate2(rec.startDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				//$('.vEndRound', row).html(app.formatDate(rec.round1EndDate));
				$('.vEndRound', row).html(app.formatDate2(rec.round1EndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				//$('.vEndDate', row).html(app.formatDate(rec.endDate));
				$('.vEndDate', row).html(app.formatDate2(rec.endDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(rec.timeLeft);
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.purse);
				
				if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
				$('.colReg', row).html(rec.registrants);
				
				if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
				$('.colSub', row).html(rec.submissions);
				
				if (rec.isRegistered === "true") {
					$('.action', row).html('<a href="javascript:;" class="btn">Submit</a>');
				} else {
					$('.action', row).html('<a href="javascript:;" class="btn btnAlt">Register</a>');
				}
				
			}else if(ajax.data["contest_type"]=="data-marathon"){
				/*
				* generate table row for contest type Marathon
				*/			
            	$('.contestName', row).html('<i></i>' + rec.fullName);
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate(rec.startDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate(rec.round1EndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate(rec.endDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(rec.timeLeft);
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.purse);
				
				if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
				$('.colReg', row).html(rec.registrants);
				
				if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
				$('.colSub', row).html(rec.submissions);
				
				if (rec.isRegistered === "true") {
					$('.action', row).html('<a href="http://community.topcoder.com/tc?module=MatchDetails&rd=' + rec.roundId + '" class="btn">Submit</a>');
				} else {
					$('.action', row).html('<a href="http://community.topcoder.com/tc?module=MatchDetails&rd=' + rec.roundId + '" class="btn btnAlt">Register</a>');
				}
			}else if(ajax.data["contest_type"]=="design"){
				
				/*
				* generate table row for other contest type
				*/	
           		
            	$('.contestName', row).html('<i></i>' +rec.challengeName).attr('href','/challenge-details/' + rec.challengeId + '?type=design');
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "--"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.postingDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
					rec.round1EndDate = "--"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.checkpointSubmissionEndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
					rec.endDate = "--"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.submissionEndDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "--"; //dummy data
				}
				$('.colTLeft', row).html(((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + ' Days');
				
				if (rec.isEnding === "true") {
					$('.colTLeft', row).addClass('imp');
				}
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "--"; //dummy data
				}
				$('.colPur', row).html("$" + rec.prize[0]);
				
				if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "--"; //dummy data
				}
				$('.colReg', row).html(rec.numRegistrants);
				
				if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "--"; //dummy data
				}
				$('.colSub', row).html(rec.numSubmissions);
				
				if (rec.isRegistered === "true") {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn">Submit</a>');
				} else {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn btnAlt">Register</a>');
				}
			}else if(ajax.data["contest_type"]=="develop"){
				/*
				* generate table row for other contest type
				*/	
//           		$('.contestName', row).html('<i></i>' + rec.contestName);
            	$('.contestName', row).html('<i></i>' + rec.challengeName).attr('href','/challenge-details/' + rec.challengeId);
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.postingDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
					rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.checkpointSubmissionEndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
					rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.submissionEndDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + ' Days');
				
				if (rec.isEnding === "true") {
					$('.colTLeft', row).addClass('imp');
				}
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.prize[0]);
				
				if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
				$('.colReg', row).html(rec.numRegistrants);
				
				if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
				$('.colSub', row).html(rec.numSubmissions);
				
				if (rec.isRegistered === "true") {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn">Submit</a>');
				} else {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn btnAlt">Register</a>');
				}

			}else{
				/*
				* generate table row for other contest type
				*/	
//           		$('.contestName', row).html('<i></i>' + rec.contestName);
            	$('.contestName', row).html('<i></i>' + rec.challengeName).attr('href','/challenge-details/' + rec.challengeId);
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.postingDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
					rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.checkpointSubmissionEndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
					rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.submissionEndDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + ' Days');
				
				if (rec.isEnding === "true") {
					$('.colTLeft', row).addClass('imp');
				}
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.prize[0]);
				
				if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
				$('.colReg', row).html(rec.numRegistrants);
				
				if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
				$('.colSub', row).html(rec.numSubmissions);
				
				if (rec.isRegistered === "true") {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn">Submit</a>');
				} else {
					$('.action', row).html('<a href="/challenge-details/' + rec.challengeId + '" class="btn btnAlt">Register</a>');
				}
			}
			
            
            $('tbody', table).append(row);
        });
        app.initZebra(table);
        $('.loading').hide();
    },

    /*
	*  challlenges getGridview Blocks
	*/
    getContestGrid: function(gridEl, data, records2Disp, isAppend) {
		if(isAppend != true){
        	gridEl.html(null);			
		}
        var count = 0;
        $.each(data, function(key, rec) {
            if (count >= records2Disp) {
                count = 0;
				$('.dataChanges').show();
                return false;
            } else {
				$('.dataChanges').hide();
                count += 1;
            }
            
            var con = $(blueprints.challengeGridBlock).clone();
			var trackName = ajax.data["contest_type"].split('-')[0];
			con.addClass('track-'+trackName);
		if(ajax.data["contest_type"]=="data-srm" ){	
			/*
			* generate table row for contest type SRM
			*/	
			$('.contestName', con).html('<i></i>' + rec.name);
			
			if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
			$('.vStartDate', con).html(app.formatDate(rec.startDate));
				
            if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
            $('.vEndRound', con).html(app.formatDate(rec.round1EndDate));
			
			if (con.endDate == null || con.endDate == "") {
                con.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
            $('.vEndDate', con).html(app.formatDate(rec.endDate));
			
			if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
            $('.cgTLeft', con).html('<i></i>' + rec.timeLeft.replace(/ days/g, 'd').replace(/ Hours/g, 'hr').replace(/ Minutes/g, 'min'));
            if (rec.isEnding === "true") {
                $('.cgTLeft', con).addClass('imp');
            }
			
			if (rec.purse == null || rec.purse == "") {
					rec.purse = "--"; //dummy data
				}
            $('.cgPur', con).html('<i></i> $' + rec.purse);
			
			if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "--"; //dummy data
				}
            $('.cgReg', con).html('<i></i>' + rec.registrants);
			
			if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "--"; //dummy data
				}
            $('.cgSub', con).html('<i></i>' + rec.submissions);	
		}else if(ajax.data["contest_type"]=="data-marathon" ){	
			/*
			* generate table row for contest type Marathon
			*/	

            $('.contestName', con).html('<i></i>' + rec.fullName);
            //$('.contestName', con).html('<i></i>' + '<a href="/challenge-details/' + rec.roundId + '">' + rec.fullName + '</a>');
				
			if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
			}
			$('.vStartDate', con).html(app.formatDate2(rec.startDate));

            if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
			$('.vEndRound', con).html(app.formatDate2(rec.endDate));
			
			if (con.endDate == null || con.endDate == "") {
                con.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
			$('.vEndDate', con).html(app.formatDate2(rec.endDate));
			
			if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
            $('.cgTLeft', con).html('<i></i>' + rec.timeLeft.replace(/ days/g, 'd').replace(/ Hours/g, 'hr').replace(/ Minutes/g, 'min'));
            if (rec.isEnding === "true") {
                $('.cgTLeft', con).addClass('imp');
            }
			
			if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
            $('.cgPur', con).html('<i></i> $' + rec.prize[0]);
			
			if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
            $('.cgReg', con).html('<i></i>' + rec.numRegistrants);
			
			if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
            $('.cgSub', con).html('<i></i>' + rec.numSubmissions);		
		}
		else{	
            //$('.contestName', con).html('<i></i>' + rec.contestName);
			if(ajax.data["contest_type"]=="design"){
				$('.contestName', con).html('<i></i>' +  rec.challengeName).attr('href','/challenge-details/' + rec.challengeId +'?type=design');
			}else{
				$('.contestName', con).html('<i></i>' +  rec.challengeName).attr('href','/challenge-details/' + rec.challengeId );	
			}
            

			if (rec.startDate == null || rec.startDate == "") {
            	rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
			}
			$('.vStartDate', con).html(app.formatDate2(rec.postingDate));
            
			if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
			$('.vEndRound', con).html(app.formatDate2(rec.checkpointSubmissionEndDate));
			
			if (con.endDate == null || con.endDate == "") {
                con.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
            $('.vEndDate', con).html(app.formatDate(rec.endDate));
			$('.vEndDate', con).html(app.formatDate2(rec.submissionEndDate));
			
			if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}

            $('.cgTLeft', con).html('<i></i>' + ((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + 'd');
            //$('.cgTLeft', con).html('<i></i>' + rec.timeLeft.replace(/ days/g, 'd').replace(/ Hours/g, 'hr').replace(/ Minutes/g, 'min'));
            if (rec.isEnding === "true") {
                $('.cgTLeft', con).addClass('imp');
            }
			
			if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
            $('.cgPur', con).html('<i></i> $' + rec.prize[0]);
			
			if (rec.registrants == null || rec.registrants == "") {
					rec.registrants = "10"; //dummy data
				}
            $('.cgReg', con).html('<i></i>' + rec.numRegistrants);
			
			if (rec.submissions == null || rec.submissions == "") {
					rec.submissions = "10"; //dummy data
				}
            $('.cgSub', con).html('<i></i>' + rec.numSubmissions);		
        }
				
            gridEl.append(con);			
			$('.loading').hide();
        });
    },

    // generate contest view table
    getPartialContestTable: function(table, data, records2Disp, isAppend) {
		if(isAppend != true){
			$('tbody', table).html(null);	
		}        
        var count = 0;
		
		$.each(data, function(key, rec) {
            if (count >= records2Disp) {
                count = 0;
                return false;
            } else {
                count += 1;
            }
            var row = $(blueprints.partialChallengeRow).clone();
			var trackName = ajax.data["contest_type"].split('-')[0];
            row.addClass('track-'+trackName);
			if(ajax.data["contest_type"]=="data-srm" ){	
			/*
			* generate table row for contest type SRM
			*/			
            	$('.contestName', row).html('<i></i>' + rec.name);
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.startDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.round1EndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.endDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(rec.timeLeft);
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.purse);				
				
				
			}else if(ajax.data["contest_type"]=="data-marathon"){
				/*
				* generate table row for contest type Marathon
				*/			
            	$('.contestName', row).html('<i></i>' + rec.fullName);
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.startDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.round1EndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.endDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(rec.timeLeft);
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.purse);
				
			}else if(ajax.data["contest_type"]=="design"){
				/*
				* generate table row for contest type
				*/			
            	$('.contestName', row).html('<i></i>' + rec.challengeName).attr('href','/challenge-details/' + rec.challengeId + '?type=design');
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.postingDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.checkpointSubmissionEndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.submissionEndDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + ' Days');
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.prize[0]);
				
				
			}else{
				/*
				* generate table row for contest type 
				*/			
            	$('.contestName', row).html('<i></i>' + rec.challengeName + '</a>').attr('href','<a href="/challenge-details/' + rec.challengeId);
				
				if (rec.startDate == null || rec.startDate == "") {
                rec.startDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vStartDate', row).html(app.formatDate2(rec.postingDate));
				
				if (rec.round1EndDate == null || rec.round1EndDate == "") {
                rec.round1EndDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndRound', row).html(app.formatDate2(rec.checkpointSubmissionEndDate));
				
				if (rec.endDate == null || rec.endDate == "") {
                rec.endDate = "2014-01-03T21:00:05.000Z"; //dummy data
				}
				$('.vEndDate', row).html(app.formatDate2(rec.submissionEndDate));
				
				if (rec.timeLeft == null || rec.timeLeft == "") {
					rec.timeLeft = "3 days"; //dummy data
				}
				$('.colTLeft', row).html(((new Number(rec.currentPhaseRemainingTime)) / 60 / 60 / 24).toPrecision(1).toString() + ' Days');
				
				if (rec.purse == null || rec.purse == "") {
					rec.purse = "1500"; //dummy data
				}
				$('.colPur', row).html("$" + rec.prize[0]);
				
			}		
		
        
            $('tbody', table).append(row);
        });
        app.initZebra(table);
        $('.loading').hide();
		
    },

    // table zebra
    initZebra: function(table) {
        $('tbody tr.alt', table).removeClass('alt');
        $('tbody tr:odd', table).addClass('alt');
    },

    // palceholder
    setPlaceholder: function(selector) {
        $(selector).each(function() {
            _this = $(this);
            var text = _this.attr('placeholder');
            _this.val(text).addClass('isBlured');
            _this.on('focus', function() {
                $(this).on('blur', function() {
                    $(this).unbind('blur', arguments.callee);
                    if ($.trim($(this).val()) === '') {
                        $(this).val(text).addClass("isBlured");
                    }
                });
                if ($(this).val() === text) {
                    $(this).val('').removeClass("isBlured");
                }
            });
        });
    }

}
var blueprints = {
    challengeRow: '<tr> \
						<td class="colCh"><div>\
								<a href="#" class="contestName"></a>\
							</div></td>\
							<td class="colType"><i class="ico"></i></td>\
						<td class="colTime"><div>\
								<div class="row">\
									<label class="lbl">Start Date</label>\
									<div class="val vStartDate"> </div>\
								</div>\
								<div class="row">\
									<label class="lbl">Round End</label>\
									<div class="val vEndRound"> </div>\
								</div>\
								<div class="row">\
									<label class="lbl">End Date</label>\
									<div class="val  vEndDate"> </div>\
								</div>\
							</div></td>\
						<td class="colTLeft"></td>\
						<td class="colPur"></td>\
						<td class="colReg"></td>\
						<td class="colSub"></td>\
						<td class="action"><a href="javascript:;" class="btn">Submit</a></td>\
					</tr>',
    partialChallengeRow: '<tr> \
						<td class="colCh"><div>\
								<a href="#" class="contestName"></a>\
							</div></td>\
						<td class="colTime"><div>\
								<div class="row">\
									<label class="lbl">Start Date</label>\
									<div class="val vStartDate"> </div>\
								</div>\
								<div class="row">\
									<label class="lbl">Round End</label>\
									<div class="val vEndRound"> </div>\
								</div>\
								<div class="row">\
									<label class="lbl">End Date</label>\
									<div class="val  vEndDate"> </div>\
								</div>\
							</div></td>\
						<td class="colPur"></td>\
					</tr>',
    challengeGridBlock: '<div class="contest">\
									<div class="cgCh"><a href="#" class="contestName"></a></div>\
									<div class="cgTime">\
										<div>\
											<div class="row">\
												<label class="lbl">Start Date</label>\
												<div class="val vStartDate"></div>\
											</div>\
											<div class="row">\
												<label class="lbl">Round End</label>\
												<div class="val vEndRound"></div>\
											</div>\
											<div class="row">\
												<label class="lbl">End Date</label>\
												<div class="val vEndDate"></div>\
											</div>\
										</div>\
									</div>\
									<div class="genInfo">\
										<p class="cgTLeft">\
											<i></i>\
										</p>\
										<p class="cgPur">\
											<i></i>\
										</p>\
										<p class="cgReg">\
											<i></i>\
										</p>\
										<p class="cgSub">\
											<i></i>\
										</p>\
									</div>\
								</div>'
}

// everythings begins from here
$(document).ready(function() {
    app.init();
    app.initEvents();
})

