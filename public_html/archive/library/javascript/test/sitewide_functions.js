var modalShown = false;

function markPropertyViewed(pref) {

	//get the status of the checkbox
	var isChecked = $('#'+pref+'_viewed').attr('checked');

	//amend the descriptor
	if (isChecked) {
		$('#'+pref+'_viewed_txt').fadeOut(500,function() { $('#'+pref+'_viewed_txt').html('Viewed') });
		$('#'+pref+'_viewed_txt').fadeIn();
	} else {
		$('#'+pref+'_viewed_txt').fadeOut(500,function() { $('#'+pref+'_viewed_txt').html('Mark as viewed') });
		$('#'+pref+'_viewed_txt').fadeIn();
	}

	//make the call
	$.ajax({
		type: 'POST',
		url: '/includes/property_viewed.php',
		data: 'pref='+pref+'&add='+isChecked,
		success: function(msg) {
			//alert('Data Saved: ' + msg);
		}
	});
}

function agentDetails(agentId, webRef) {
	$('#lightboxIframeLoading').show();
	$('#lightboxIframe').attr('src','/lightboxes/agent_details.php?agentId='+agentId+'&webReference='+webRef);
	setModalIframeHeight('295');

	showGenericModal('lightbox',492);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackEvent('Property Interest', 'Property Interest Click', 'Agent Details lightbox');
	}
} //end agentDetails

function emailAgent(agentId, webRef) {
	//$('#lightboxIframeLoading').show();
	$('#lightboxIframe').attr('src','/lightboxes/email_agent.php?agentId='+agentId+'&webReference='+webRef);
	setModalIframeHeight('295');

	showGenericModal('lightbox',492);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackPageview('/lightboxes/email_agent.php?agentId='+agentId+'&webReference='+webRef);
	}
} //end emailAgent

function emailAgentByPropertyRef(webRef) {
	//$('#lightboxIframeLoading').show();
	$('#lightboxIframe').attr('src','/lightboxes/email_agent.php?pref='+webRef);
	setModalIframeHeight('295');

	showGenericModal('lightbox',492);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackPageview('/lightboxes/email_agent.php?pref='+webRef);
	}
} //end emailAgent

function emailAgentFromMap(webRef) {
	closeModal();
	emailAgentByPropertyRef(webRef);
} //end emailAgent

// Pop a light box with the gallery associated with the property reference number
function fetchGallery(propId) {
	$('#lightboxIframe').attr('src','/lightboxes/gallery.php?lightbox=1&pref='+propId);
	setModalIframeHeight('406');
	showGenericModal('lightbox',492);
} //end fetchGallery

function smsAgent(agentId, webRef) {
	$('#lightboxIframeLoading').show();
	$('#lightboxIframe').attr('src','/lightboxes/sms_agent.php?agentId='+agentId+'&webReference='+webRef);
	setModalIframeHeight('295');

	showGenericModal('lightbox',492);
	$('#lightboxIframeLoading').hide();

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackPageview('/lightboxes/sms_agent.php?agentId='+agentId+'&webReference='+webRef);
	}
} //end smsAgent

function showGoogleMapProperty(webRef) {
	$('#lightboxIframeLoading').show();
	setModalIframeHeight('595');
	$('#lightboxIframeLoading').hide();
	$('#lightbox_my_list').width(892);
	$('#lightbox_my_list').css('position','fixed');
	$('#lightbox_my_list').css('top','5px');
	$('#lightboxIframeMyList').attr('src','/lightboxes/google_maps_property.php?webReference='+webRef);
	showGenericModal('lightbox_my_list',892);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackPageview('/lightboxes/google_maps_property.php?webReference='+webRef);
	}
} //end showGoogleMapProperty

function sendToFriend(url) {
	$('#lightboxIframe').attr('src','/lightboxes/send_to_friend.php?url='+url);
	//setModalIframeHeight('405');

	showGenericModal('lightbox',492);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackEvent('Generic page links', 'Send to a friend open', 'Page send to a friend request');
	}
} //end sendToFriend

function propertyAlert() {
	$('#lightboxIframePropertyAlert').attr('src','/lightboxes/property_alert.php');
	showGenericModal('lightbox_property_alert',741);
} // propertyAlert

function share(url) {
	$('.shareit').toggle();

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackEvent('Generic page links', 'Share', 'Share'+url);
	}
} //end share

// Add a property reference number to 'My List'
function addToList(reference) {
	if (reference != null && !isNaN(reference)) {
		$('#searchForm').ajaxSubmit({
			url: '/lightboxes/my_property_list_add.php?reference=' + reference,
			dataType: 'json',
			type: 'get',
			success: function(json) {
				var jsonData = eval(json); // IE6 and Safari compatibility
				if (jsonData['error'] != 'false' && jsonData['message'] != '' && (jsonData['duplicate'] == 'false')) growl(jsonData['message']);
				if (jsonData['success'] == 'true' || jsonData['success'] == true) {
					$('#addMyList' + reference).html('View my list');
					$('#addMyList' + reference).click(function() {
						showMyPropertyList();
					});
					showMyPropertyList();
					// Google Analytics code
					if (typeof(pageTracker) != 'undefined') {
						pageTracker._trackEvent('My property List', 'Add to List', 'My property list addition: '+reference);
					}
				}
			}
		});
	}
} //end addToList

function showMyPropertyList() {
	$('#lightbox_my_list').width(892);
	$('#lightbox_my_list').css('position','fixed');
	$('#lightboxIframeMyList').attr('src','/lightboxes/my_property_list.php?nc='+Math.floor(Math.random()*10000000000));
	showGenericModal('lightbox_my_list',892);
} //end showMyPropertyList

function showVirtualTour(url,virtualTourX,virtualTourY) {
	if (url != null && virtualTourX != null && virtualTourY != null) {
		if (url != '' && !isNaN(virtualTourX) && !isNaN(virtualTourY)) {
			// make sure these are locally defined to not interfere with Google Analytics
			var x = parseInt(virtualTourX);
			var y = parseInt(virtualTourY);
			$('#lightboxIframeVirtualTour').attr('src',url);
			$('#lightbox_virtual_tour').width(x);
			$('#lightbox_virtual_tour').height(y);
			$('#lightboxIframeVirtualTour').width(x);
			$('#lightboxIframeVirtualTour').height(y);
			showGenericModal('lightbox_virtual_tour',x,'<a id="virtualTourClose" class="modalCloseImg" title="Close" onclick="closeModal(); return false;"></a>');

			// clean up
			x = null;
			y = null;
			delete x;
			delete y;
		}
	}
} //end showVirtualTour

function calculateBond(price) {
	$('#lightboxIframeLoading').show();
	$('#lightboxIframe').attr('src','/lightboxes/bond_calculator.php?pprice='+price);

	setModalIframeHeight('405');
	showGenericModal('lightbox',492);

	// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackEvent('Property Interest', 'Property Interest click', 'Bond Calculator');
	}
} //end calculateBond

function closeModal() {
	modalShown = false;
	$.modal.close();
	$('#lightbox').hide();
	//setTimeout('return true;',2000);
} //end closeModal

function setModalIframeHeight(toHeight,iframeId) {
	if (iframeId == null || iframeId == '') iframeId = 'lightboxIframe';

	//$(window).trigger('resize');
	toHeight = parseInt(toHeight);

	// fix a jQuery/Opera bug with determining the window height
	var windowHeight = $.browser.opera && $.browser.version > '9.5' && $.fn.jquery <= '1.2.6' ?
		document.documentElement['clientHeight'] : $(window).height();

	var topPos = Math.floor((windowHeight - (toHeight + 90))/2);

	$('#' + iframeId).animate({height:toHeight+'px',queue: false});
	// makes IE JUMP to top $('#simplemodal-container').animate({top:topPos+'px',queue: false});
} //end setModalIframeHeight

function setModalIframeWidth(toWidth,iframeId) {
	if (iframeId == null || iframeId == '') iframeId = 'lightboxIframe';

	toWidth = parseInt(toWidth);

	// fix a jQuery/Opera bug with determining the window width
	var windowWidth = $.browser.opera && $.browser.version > '9.5' && $.fn.jquery <= '1.2.6' ?
		document.documentElement['clientWidth'] : $(window).width();

	var leftPos = Math.floor(($(window).width() - toWidth - 80)/2);
	$('#' + iframeId).animate({width:toWidth+'px',queue: false});
	// makes IE JUMP to top $('#simplemodal-container').animate({left:leftPos+'px',queue: false});
} //end setModalIframeWidth

function hideLightboxLoader() {
	$('#lightboxIframeLoading').fadeOut('slow');
} //end hideLightboxLoader

function showGenericModal(lightboxId, widthAmount, paramCloseHTML) {
	if (modalShown == false) {
		modalShown = true;
		if (lightboxId == null || lightboxId == '') lightboxId = 'lightbox';
		if (widthAmount != null) {
			if (isNaN(widthAmount)) {
				widthAmount = 492; // default if not a number
			}
			widthAmount = parseInt(widthAmount);
			//$('#' + lightboxId).css('width',widthAmount);
			setModalIframeWidth(widthAmount);
		}
		if (widthAmount == null || isNaN(widthAmount)) {
			widthAmount = 492; // default if not a number
			setModalIframeWidth(widthAmount);
		}
		$('#' + lightboxId).width(widthAmount);
		$('#' + lightboxId).css('width',widthAmount);
/*		$('#' + lightboxId).css('background-color','red');
		$('#' + lightboxId).css('border','2px solid gold');
		$('#' + lightboxId).css('position','fixed');
		$('#' + lightboxId).css('left','50%');
		$('#' + lightboxId).css('top','50%');
		$('#' + lightboxId).css('margin-left',(widthAmount / 2) * -1);
		$('#' + lightboxId).css('margin-top',(widthAmount / 2) * -1);*/
		//$('#' + lightboxId).css('display','block');
		$('#lightboxIframeLoading').width(widthAmount);
		$('#lightboxIframeLoading').show();
		if (paramCloseHTML == null || paramCloseHTML == '') {
			$('#' + lightboxId).modal({
				overlayCss: {
					backgroundColor: '#000'
				},
				onOpen: function (dialog) {
					dialog.overlay.fadeIn('slow', function () {
						dialog.container.slideDown('slow', function () {
							dialog.data.fadeIn();
							$('#lightboxIframeLoading').hide();
						});
					});
				}
			});
		} else { // Custom close HTML needs to be injected
			$('#' + lightboxId).modal({
				overlayCss: {
					backgroundColor: '#000'
				},
				closeHTML: paramCloseHTML,
				onOpen: function (dialog) {
					dialog.overlay.fadeIn('slow', function () {
						dialog.container.slideDown('slow', function () {
							dialog.data.fadeIn();
							$('#lightboxIframeLoading').hide();
						});
					});
				}
			});
		}
		$('#simplemodal-overlay').click(function() { closeModal(); }); // allow closing by clicking on the overlay
	}
} // end showGenericModal

function growl(msg,duration) {
	var showFor = (isset(duration) && is_numeric(duration)) ? duration : 2500;
	$.jGrowl(msg,{ life: showFor });
} // end growl

//--------------- Lifestyle Popup script ----------------------
function openLifestyle() {
	$('#lightbox').removeClass('content');
	$('#lightbox').addClass('lifestyle_lightbox');
	$('#lightbox').css('position','fixed');
	setModalIframeWidth(874,'lightboxIframeLifestyleShowcase');
	// load this page into an iframe
	$('#lightboxIframeLifestyleShowcase').attr('src','/lightboxes/lifestyle_showcase.php');
	//pop the modal
	$('#lifestyleLightbox').modal({
		overlayCss: {
			backgroundColor: '#000'
		},
		onOpen: function (dialog) {
			dialog.overlay.fadeIn('slow', function () {
				dialog.container.slideDown('slow', function () {
					dialog.data.fadeIn();
				});
			});
		}
	});
	$('#simplemodal-overlay').click(function() { closeModal(); }); // allow closing by clicking on the overlay
}

var currentWebRef = '';
function webrefSearch(field) {

	//check format
	var obj = $('#' + field);
	var ref = (isset(obj.fieldValue()[0]) && is_numeric(obj.fieldValue()[0])) ? obj.fieldValue()[0] : '-';
	if (!isset(ref) || !is_numeric(ref) || (ref == '')) {
		growl('Please enter a valid numeric web reference number e.g. 95920');
		return false;
	}

	//store for callback usage
	currentWebRef = ref;

	growl('Checking Web Reference ...',100);

	//set page name based on URL
	var pageArray = top.location.href.split('/');
			if (pageArray[3] == '' || pageArray[3] == 'default.php') {
				page = 'home';
			} else {
				if (pageArray[4] != null && pageArray[4] != '') {
					page = pageArray[4] + ' ' + pageArray[3];
				} else {
					page = pageArray[3];
				}
			}

			if (pageArray[3].length == 0 || page == null) {
				page = 'home';
			}

// Google Analytics code
	if (typeof(pageTracker) != 'undefined') {
		pageTracker._trackEvent('Search', 'Search Query', 'Page: '+page+' Type: Web Ref Search');
	} else {
		alert('Internal Error: pageTracker is not available.');
	}

	// Instead of doing AJAX change to Static webreffing
	location.href = '/includes/check_webref.php?pref=' + ref;
	window.event.returnValue = false;

	/*
	//check exists
	$.ajax({
		type: 'POST',
		url: '/includes/check_webref.php',
		data: 'pref='+ref,
		dataType: 'json',
		success: function(json) {
			var jsonData = eval(json); // IE6 and Safari compatibility
			if (jsonData['success'] == true || jsonData['success'] == 'true') {
				growl('Web reference found, please wait while we load the properties details ...',2000);

				//set page name based on URL
				var pageArray = top.location.href.split('/');
				var page = '';
				if (pageArray[4] == '' || pageArray[3] == 'default.php') {
					page = 'home';
				} else {
					page = pageArray[4] + ' ' + pageArray[3];
				}

				// Google Analytics code
				if (typeof(pageTracker) != 'undefined') {
					pageTracker._trackEvent('Search', 'Search Query', 'Page: '+page+' Type: Web Ref Search');
				}
				top.location.href = jsonData['url'] + '/details.php?pref='+currentWebRef;
			} else {
				growl('Unfortunately the Web Reference you entered could not be found, please try again or alternatively contact us for assistance.',6000);
			}
		}
	 });*/
} //end webrefSearch

// IE6 png fix
function pngfix() {
	if ($.browser.msie && $.browser.version < '7.0') {
		$('img[@src$=.png], .tooltip_bubble_btm .top, .tooltip_bubble_btm .cnt, .tooltip_bubble_btm .bot').css('behavior','url(/images/iepngfix.php)');
	}
} //end pngfix

//-------------- Event Bindings ---------------

$(document).ready(function() {

	$('#topNavWebref').focus(function() { $('#topNavWebref').attr('value',''); });
	$('#inPageWebref').focus(function() { $('#inPageWebref').attr('value',''); });

	$('#topNavWebref').numeric();
	$('#inPageWebref').numeric();

	$('#tooltip_bubble').css({'position' : 'absolute' , 'display' : 'none'});
	$('.tooltip_mav').mouseover(function() {
		thisPos = $(this).offset();
		$('#toolTipCopy').html("Ticking 'mark as viewed' will help you keep a record of properties you have already seen, so that when you search again you can quickly see which properties you have and haven't yet viewed.");
		var thisHeight = $(this).height();
		var theMiddle = thisPos.top + (thisHeight/2);
		var bubbleTop = (theMiddle - ($('#tooltip_bubble').height()/2))+20;
		$('#tooltip_bubble').css({'position' : 'absolute' , 'top' :bubbleTop, 'left' : (thisPos.left+$(this).width()+15)});
		$('#tooltip_bubble').show();
	});

	$('.tooltip_onshow').mouseover(function() {
		thisPos = $(this).offset();
		$('#toolTipCopy').html('Ticking this box will show only properties currently on show. Please note that our properties are displayed as on show from Thursday to Sunday.');
		var thisHeight = $(this).height();
		var theMiddle = thisPos.top + (thisHeight/2);
		var bubbleTop = theMiddle - ($('#tooltip_bubble').height()/2);
		$('#tooltip_bubble').css({'position' : 'absolute' , 'top' :bubbleTop, 'left' : (thisPos.left+$(this).width()+15)});
		$('#tooltip_bubble').show();
	});

	$('.tooltip_asda').mouseover(function() {
		thisPos = $(this).offset();
		$('#toolTipCopy').html('Ticking this box will show only properties currently on show. Please note that our properties are only on show from Thursday to Sunday.');
		var thisHeight = $(this).height();
		var theMiddle = thisPos.top + (thisHeight/2);
		var bubbleTop = theMiddle - ($('#tooltip_bubble').height()/2);
		$('#tooltip_bubble').css({'position' : 'absolute' , 'top' :bubbleTop, 'left' : (thisPos.left+$(this).width()+15)});
		$('#tooltip_bubble').show();
	});

	$('.tooltip_btn').mouseout(function() {
		$('#tooltip_bubble').hide();
	});

	pngfix();
});

$(document).bind('contextmenu',function(e) {
	var thisYear = new Date();
	alert('Copyright '+thisYear.getFullYear()+' Seeff Properties.');
	return false;
});
