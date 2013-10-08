// File Common.js

/*
* Main Modular script. functionality will be fired from here
* documentation: http://devpress.gilinux.dev/gi/javascript/javascript-module-loader
*/
(function($){
    $.resizeend = function(el, options){
        var base = this;

        base.$el = $(el);
        base.el = el;

        base.$el.data("resizeend", base);
		base.rtime = new Date(1, 1, 2000, 12,00,00);
        base.timeout = false;
        base.delta = 200;

        base.init = function(){
            base.options = $.extend({},$.resizeend.defaultOptions, options);

            if(base.options.runOnStart) base.options.onDragEnd();

            $(base.el).resize(function() {
                base.rtime = new Date();
                if (base.timeout === false) {
                    base.timeout = true;
                    setTimeout(base.resizeend, base.delta);
                }
            });

        };
        base.resizeend = function() {
            if (new Date() - base.rtime < base.delta) {
                setTimeout(base.resizeend, base.delta);
            } else {
                base.timeout = false;
                base.options.onDragEnd();
            }
        };

        base.init();
    };

    $.resizeend.defaultOptions = {
        onDragEnd : function() {},
        runOnStart : false
    };

    $.fn.resizeend = function(options){
        return this.each(function(){
            (new $.resizeend(this, options));
        });
    };

})(jQuery);

// explicitly invoke window so people know we MEANT to make a global variable(function ($) {

window.TT = {};

var TT = window.TT = (typeof window.TT!== "undefined") ? window.TT : {};

TT.common = (function($) {
	var init = function() {
		elem = {
			locations: $('.locations'),
			darken: $('.darken'),
			welcomeHeader: $('.welcome .logo'),
			welcome: $('.welcome'),
			imagesWrap: $('.images-wrap'),
			imagesWrapWrap: $('.images-wrap-wrap'),
			under: $('.under'),
			underPageWidth: $('.under .page-width'),
			chalkboardContent: $('.top .chalkboard-content'),
			chalkboard: $('.chalkboard')
		};

		hpTracking();

		//initial dawn animation
		addClass();

		//any direction click
		scrollThing();

		//rightAway
		rightAway();

		//initialize google maps
		googleMapsProvincetown();
		googleMapsCambridge();
		googleMapsJP();

		$("#formEvent").validate();

	},
    //GA TRACKING
    hpTracking = function() {

        var _gaq = _gaq || [];

        $('.locations .top-nav-wrap a').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'navigation', 'click', linkText);
        });
        $('.locations .mega-wrap a').click(function(){
            var linkText = $(this).attr('id');
            ga('send','event', 'navigation-locations', 'click', linkText);
        });
        $('.social a').click(function(){
            var linkText = $(this).attr('class');
            ga('send','event', 'social', 'click', linkText);
        });
        $('.logo-mini').click(function(){
            ga('send','event', 'navigation', 'click', 'logo-mini');
        });

        $('.about-nav a').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'navigation-sub', 'click', linkText);
        });

        $('.welcome .jog-open').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'gallery', 'click', 'gallery open or close');
        });
        $('.welcome .jog-left').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'gallery', 'click', 'gallery click left');
        });
        $('.welcome .jog-right').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'gallery', 'click', 'gallery click right');
        });
        $('.welcome .close-blowup').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'gallery', 'click', 'close large view');
        });
        $('.welcome .images-wrap-wrap a').click(function(){
            var linkText = $(this).text();
            ga('send','event', 'gallery', 'click', 'blow image up for large view');
        });

    },

	freshEvents = function() {
		var elem = {
			locations: $('.locations'),
			under: $('.under')
		};

		$('.chalkboard-content').hide();
		$('.chalkboard').addClass('flex');
		$('body').addClass('flex');
		$('.mega-wrap .mega.'+locationPicked).fadeIn(4800);

		elem.locations.addClass('flex');
		elem.locations.on('addClass',function(e, oldClass, newClass){
			if(newClass == 'locations flex faders') {
				measurings();
				elem.under.addClass('flex').animate({
					top: fixedNavHeight
				},2000, function(){
				});
				$('.under.flex .fullscreen-bg.'+locationPicked).show().animate({
					bottom: '-50%'
				},1600, function(){
				});
				measurings();
				elem.locations.animate({
					bottom: newPosition+'%'
				},1500, function(){
					elem.under.addClass('relative');
					$('.under .page-width.'+locationPicked).delay(500).fadeIn(1500);

					$('.chalkboard.middle,.content.page-width').hide();
					$('.chalkboard.top').addClass('bg');
					$('.chalkboard.top nav a,.chalkboard-content section').removeClass('active');
					$('.chalkboard.top nav li').removeClass('current_page_item');
				});
				//elem.underPageWidth.css('top',chalkboardHeight + locationsHeight);
			}	
		});
		elem.locations.removeClass('fresh').addClass('faders');
		$('.first.fullscreen-bg,.welcome').animate({
			bottom: '200%'
		},6000, function(){

			resizeMaps();

		});
	};

	var docWidth = $(document).width();
    var imageSliderImagesLengths = 0;

	googleMapsCambridge = function() {
		var myLatlng1 = new google.maps.LatLng(42.37912356576,-71.127235366574);
		var myLatlng2 = new google.maps.LatLng(42.377822,-71.130595);
		var myLatlng3 = new google.maps.LatLng(42.379347,-71.129726);
		var myLatlng4 = new google.maps.LatLng(42.377425,-71.123085);
		var myLatlng5 = new google.maps.LatLng(42.373336,-71.118944);
		var myLatlng6 = new google.maps.LatLng(42.377665,-71.129163);
		var myOptions = {
			zoom: 16,
			center: myLatlng1,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		mapCambridge = new google.maps.Map(document.getElementById("map_cambridge"), myOptions);
		calcRoute();
		function calcRoute() {
			directionsService = new google.maps.DirectionsService(); 

		    var request = {
		        origin: myLatlng1,
		        destination: myLatlng3,
		        travelMode: google.maps.DirectionsTravelMode.WALKING
		    };
		    directionsService.route(request);
		  }

	    var contentString1 = "<div id='contentCambridge'>";
		    contentString1 += "<h2><a href='https://plus.google.com/107740359554153481459/about?gl=us&hl=en' target='_blank'>Ten Tables Cambridge</a></h2>";
		    contentString1 += "<div id='infoCambridge'><p>5 Craigie Circle<br>";
			contentString1 += "Cambridge, MA 02138<br>";
			contentString1 += "(617) 576-5444<br />";
		    contentString1 += "<a target='_blank' href='http://maps.google.com/maps/ms?msid=202325866755147352156.0004bd86052e7ef96de0b&msa=0&ie=UTF8&t=m&source=embed&ll=42.378155,-71.128519&spn=0.003194,0.004823'>Parking & Directions</a></p>";
	    	contentString1 += "</div></div>";
	    var contentString2 = "<div class='map-content-wrap'>";
		    contentString2 += "<h2>Parking in front of the Armenian church</h2>";
		    contentString2 += "<div class='map-content'><p>There are spots for 15-20 cars on Brattle St in front of the Armenian church</p>";
	    	contentString2 += "</div></div>";
	    var contentString3 = "<div class='map-content-wrap'>";
		    contentString3 += "<h2>Parker St spots</h2>";
		    contentString3 += "<div class='map-content'><p>You can park in the loading zone alongside the brick building on Parker St, adjacent to the intersection with Buckingham St.</p>";
	    	contentString3 += "</div></div>";
	    var contentString4 = "<div class='map-content-wrap'>";
		    contentString4 += "<h2>Sheraton Commander lot</h2>";
		    contentString4 += "<div class='map-content'><p>The Sheraton Commander Hotel has a parking lot. They charge $18 for up to 5 hours.</p>";
	    	contentString4 += "</div></div>";
	    var contentString5 = "<div class='map-content-wrap'>";
		    contentString5 += "<h2>Walking from Harvard Square T Station</h2><p>Follow Mass Ave North away from the Harvard T Stop. Bear left on to Garden St (Cambridge Common across the street on the right). Continue till you reach the Sheraton Commander Hotel. Take a left after the hotel on to Berklee St, after one block the street turns to the right. Follow this till the intersection with Craigie St - the restaurant sign will be directly in front if you. Our entrance is on the right side of the parking lot at Craigie Circle (under the black awnings).</p>";
	    var contentString6 = "<div class='map-content-wrap'>";
		    contentString6 += "<h2>Brattle Street Parking Spots</h2>";
		    contentString6 += "<div class='map-content'><p>You may park in the two-hour spots (free after 6pm) along the side of Brattle St heading westbound (away from Harvard Sq) between Willard St. and Mercer Cir.</p>";
	    	contentString6 += "</div></div>";
	    infowindowCambridge1 = new google.maps.InfoWindow({
			content: contentString1
	    });
	    infowindowCambridge2 = new google.maps.InfoWindow({
			content: contentString2
	    });
	    infowindowCambridge3 = new google.maps.InfoWindow({
			content: contentString3
	    });
	    infowindowCambridge4 = new google.maps.InfoWindow({
			content: contentString4
	    });
	    infowindowCambridge5 = new google.maps.InfoWindow({
			content: contentString5
	    });
	    infowindowCambridge6 = new google.maps.InfoWindow({
			content: contentString6
	    });
		markerCambridge1 = new google.maps.Marker({
			position: myLatlng1,
			map: mapCambridge,
			visible: true,
			title:"Ten Tables Cambridge"
		});
		markerCambridge2 = new google.maps.Marker({
			position: myLatlng2,
			map: mapCambridge,
			title:"Parking in front of the Armenian church"
		});
		markerCambridge3 = new google.maps.Marker({
			position: myLatlng3,
			map: mapCambridge,
			title:"Parker St spots"
		});
		markerCambridge4 = new google.maps.Marker({
			position: myLatlng4,
			map: mapCambridge,
			title:"Sheraton Commander lot"
		});
		markerCambridge5 = new google.maps.Marker({
			position: myLatlng5,
			map: mapCambridge,
			title:"Harvard Square T Station"
		});
		markerCambridge6 = new google.maps.Marker({
			position: myLatlng6,
			map: mapCambridge,
			title:"Brattle St Parking Spots"
		});
		infowindowCambridge1.open(mapCambridge,markerCambridge1);
		google.maps.event.addListener(markerCambridge1, 'click', function() {
		   infowindowCambridge1.open(mapCambridge, markerCambridge1);
		});
		google.maps.event.addListener(markerCambridge2, 'click', function() {
		   infowindowCambridge2.open(mapCambridge, markerCambridge2);
		   infowindowCambridge1.close();
		   infowindowCambridge3.close();
		   infowindowCambridge4.close();
		   infowindowCambridge5.close();
		   infowindowCambridge6.close();
		});
		google.maps.event.addListener(markerCambridge3, 'click', function() {
		   infowindowCambridge3.open(mapCambridge, markerCambridge3);
		   infowindowCambridge1.close();
		   infowindowCambridge2.close();
		   infowindowCambridge4.close();
		   infowindowCambridge5.close();
		   infowindowCambridge6.close();
		});
		google.maps.event.addListener(markerCambridge4, 'click', function() {
		   infowindowCambridge4.open(mapCambridge, markerCambridge4);
		   infowindowCambridge1.close();
		   infowindowCambridge2.close();
		   infowindowCambridge3.close();
		   infowindowCambridge5.close();
		   infowindowCambridge6.close();
		});
		google.maps.event.addListener(markerCambridge5, 'click', function() {
		   infowindowCambridge5.open(mapCambridge, markerCambridge5);
		   infowindowCambridge1.close();
		   infowindowCambridge2.close();
		   infowindowCambridge4.close();
		   infowindowCambridge3.close();
		   infowindowCambridge6.close();
		});
		google.maps.event.addListener(markerCambridge6, 'click', function() {
		   infowindowCambridge6.open(mapCambridge, markerCambridge6);
		   infowindowCambridge1.close();
		   infowindowCambridge2.close();
		   infowindowCambridge4.close();
		   infowindowCambridge5.close();
		   infowindowCambridge3.close();
		});
	};
	googleMapsJP = function() {
		var myLatlng = new google.maps.LatLng(42.314906,-71.104889);
		var myOptions = {
			zoom: 16,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		mapJP = new google.maps.Map(document.getElementById("map_jp"), myOptions);
	    var contentString = "<div id='contentJP'>";
		    contentString += "<h2><a href='https://plus.google.com/112731179182071500669/about?gl=us&hl=en' target='_blank'>Ten Tables Jamaica Plain</a></h2>";
		    contentString += "<div id='infoJP'><p>597 Centre Street<br>";
			contentString += "Jamaica Plain, MA 02130<br>";
			contentString += "(617) 524-8810<br />";
		    contentString += "<a target='_blank' href='https://maps.google.com/maps?ie=UTF8&q=jamaica+plain+ten+tables&fb=1&gl=us&hq=jamaica+plain+ten+tables&hnear=jamaica+plain+ten+tables&cid=0,0,13303590853718196932&t=m&ll=42.316607,-71.115682&spn=0.005553,0.018711&z=16&vpsrc=6&iwloc=A&f=d&daddr=Ten+Tables,+597+Centre+Street,+Jamaica+Plain,+MA+02130&geocode=%3BCdEZf_qdUOn1FaKshQIdF-LC-ynp-XvlcXnjiTHEQgJhZdmfuA'>Directions</a></p>";
	    	contentString += "</div></div>";
	    infowindowJP = new google.maps.InfoWindow({
			content: contentString
	    });
		markerJP = new google.maps.Marker({
			position: myLatlng,
			map: mapJP,
			visible: true,
			title:"Ten Tables Jamaica Plain"
		});
		infowindowJP.open(mapJP,markerJP);
		google.maps.event.addListener(markerJP, 'click', function() {
		   infowindowJP.open(mapJP, markerJP);
		});
	};
	googleMapsProvincetown = function() {
		var myLatlng = new google.maps.LatLng(42.05251,-70.186595);
		var myOptions = {
			zoom: 16,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		mapProvincetown = new google.maps.Map(document.getElementById("map_provincetown"), myOptions);
	    var contentString = "<div id='contentProvincetown'>";
		    contentString += "<h2><a href='https://plus.google.com/108797547865597351645/about?gl=us&hl=en' target='_blank'>Ten Tables Provincetown</a></h2>";
		    contentString += "<div id='infoProvincetown'><p>133 Bradford Street<br>";
			contentString += "Cape Cod, MA 02657<br>";
			contentString += "(508) 487-0106<br />";
		    contentString += "<a target='_blank' href='http://maps.google.com/maps?ie=UTF8&q=ten+tables+provincetown&fb=1&gl=us&hq=ten+tables&hnear=0x89fca780cf83c821:0xd8d2863ae0f05eda,Provincetown,+MA&cid=0,0,16939832805744530089&t=m&z=16&vpsrc=0&iwloc=A&f=d&daddr=Ten+Tables,+133+Bradford+Street,+Cape+Cod,+MA+02657&geocode=%3BCUKC2hSQ1YmcFZ6rgQIdnQnR-ymx0sD5e6f8iTGpUumML2AW6w'>Directions</a></p>";
	    	contentString += "</div></div>";
	    infowindowProvincetown = new google.maps.InfoWindow({
			content: contentString
	    });
		markerProvincetown = new google.maps.Marker({
			position: myLatlng,
			map: mapProvincetown,
			visible: true,
			title:"Ten Tables Provincetown"
		});
		infowindowProvincetown.open(mapProvincetown,markerProvincetown);
		google.maps.event.addListener(markerProvincetown, 'click', function() {
		   infowindowProvincetown.open(mapProvincetown, markerProvincetown);
		});
	};

	resizeMaps = function() {
		lastProvincetownCenter=mapProvincetown.getCenter();
		lastJPCenter=mapJP.getCenter();
		lastCambridgeCenter=mapCambridge.getCenter();

		google.maps.event.trigger(mapProvincetown, "resize");	
		google.maps.event.trigger(mapJP, "resize");	
		google.maps.event.trigger(mapCambridge, "resize");

		mapProvincetown.setCenter(lastProvincetownCenter);
		mapJP.setCenter(lastJPCenter);
		mapCambridge.setCenter(lastCambridgeCenter);

		infowindowProvincetown.open(mapProvincetown,markerProvincetown);
		infowindowCambridge1.open(mapCambridge,markerCambridge1);
		infowindowJP.open(mapJP,markerJP);

	};

	//////////////
	//
	//EARLY EVENTS
	//
	//////////////

	//
	//adds event to "addclass"
	//
	addClass = function() {
		var methods = ["addClass"];

		$.map(methods, function(method){
		    // Store the original handler
		    var originalMethod = $.fn[ method ];

		    $.fn[ method ] = function(){
		        // Execute the original hanlder.
		        var oldClass = this[0].className;
		        var result = originalMethod.apply( this, arguments );
		        var newClass = this[0].className;

		        // trigger a custom event
		        this.trigger(method, [oldClass, newClass]);

		        // return the original result
		        return result;
		    };
		});
	};

	//
	//scroll thing
	//
	scrollThing = function() {
		$('.locations').localScroll({
			hash: true,
			stop: true,
		    offset: {
		        top: -190
		    }
		});	
	};

	//
	//things that happen right away!
	//
	rightAway = function() {

		//navigation replacement & highlighting content
		$('.chalkboard.top > nav > li > a').each(function( index ){
			var sectionName = $(this).text().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
			$(this).addClass(sectionName);
		});

		//sets chalkboard heights and such
		chalkboardHeight = elem.chalkboard.height();
		$('.chalkboard.middle').css('padding-top',chalkboardHeight);

		//changes open table stuff appropriately
		$('.OT_TableButton#submit').each(function(){
			$("<input type='submit' />").attr({ name: this.name, value: 'Book a Table' }).insertBefore(this);
		}).remove();

		//makes sure everything's in the right place after resize
		$(window).resizeend({
			onDragEnd : function(){
				measurings();
				elem.under.css('top',fixedNavHeight);
				$('.locations.faders').css('bottom',newPosition+'%');
			},
			runOnStart : true
		});

		//makes sure everything's in the right place after stuff loads
		$(window).bind("load", function() {
			measurings();
			elem.under.css('top',fixedNavHeight);
			$('.locations.faders').css('bottom',newPosition+'%');
			$('.loading').fadeOut(1000);
		});

		//handles which part of the site to show for specific hashtags

		var megaItemPicked = true;
		var chalkboardItemPicked = true;
		var locationPicked = "a";
		if(window.location.href.indexOf('jp') > -1) {
			locationPicked = 'location-jp';
			locationPickedSimple = 'jp';
		}
		if(window.location.href.indexOf('cambridge') > -1) {
			locationPicked = 'location-cambridge';
			locationPickedSimple = 'cambridge';
		}
		if(window.location.href.indexOf('provincetown') > -1) {
			locationPicked = 'location-provincetown';
			locationPickedSimple = 'provincetown';
		}
		if(window.location.href.indexOf('drinks') > -1) {
			megaItemPicked = 'drinks';
		}
		if(window.location.href.indexOf('menu') > -1) {
			megaItemPicked = 'menu';
		}
		if(window.location.href.indexOf('parking--directions') > -1) {
			megaItemPicked = 'parking--directions';
		}
		if(window.location.href.indexOf('contact') > -1) {
			megaItemPicked = 'contact';
		}
		if(window.location.href.indexOf('team') > -1) {
			megaItemPicked = 'team';
		}
		//for chalkboards
		if(window.location.href.indexOf('about-us') > -1) {
			chalkboardItemPicked = 'about-us';
		}
		if(window.location.href.indexOf('gift-cards') > -1) {
			chalkboardItemPicked = 'gift-cards';
		}
		if(window.location.href.indexOf('reservations--private-events') > -1) {
			chalkboardItemPicked = 'reservations--private-events';
		}
		//says if locationPicked isn't picked, then do chalkboard one instead
		if(locationPicked.length < 3) {
			$('nav.page-width .'+chalkboardItemPicked).click();
		} else {
			//stuff only for locationPicked
			$('.mega-wrap .mega.'+locationPicked).show();
			measurings();
			elem.under.css('top',fixedNavHeight);
			$('.under').addClass('flex');
			$('.under.flex .fullscreen-bg.'+locationPicked).show().css('bottom','-50%');
			$('.under .page-width.'+locationPicked).show();
			elem.under.addClass('relative');
			$('.locations .column a#'+locationPicked).addClass('active');
			elem.locations.addClass('flex');
			measurings();
			elem.chalkboard.addClass('flex');


			elem.locations.on('addClass',function(e, oldClass, newClass){
				if(newClass == 'locations flex faders') {
					measurings();
					//$('.under.flex .fullscreen-bg').fadeOut();
					$('.under.flex .fullscreen-bg.'+locationPicked).show().css({
						bottom: '-50%'
					}, function(){
						elem.under.css('top',fixedNavHeight);
					});
					elem.locations.css({
						bottom: newPosition+'%'
					}, function(){
						elem.under.addClass('relative');
						$('.under .page-width.'+locationPicked).show();
						$('.chalkboard.middle,.content.page-width').hide();
						$('.chalkboard.top').addClass('bg');
						$('.chalkboard.top nav a,.chalkboard-content section').removeClass('active');
						$('.chalkboard.top nav li').removeClass('current_page_item');
					});
					//elem.underPageWidth.css('top',chalkboardHeight + locationsHeight);
				}	
			});
			elem.locations.removeClass('fresh').addClass('faders');
			$('.first.fullscreen-bg,.welcome').css({
				bottom: '200%'
			}, function(){

			});
			$('#'+megaItemPicked+'-'+locationPickedSimple+'-link').click();
		}

	};
	sliderMeasurings = function() {

		//measures length of slides to determine arrows and on/off states
		elem.imagesWrapWrap.find('.image-wrap').each(function(){
			imageSliderImagesLengths += $(this).outerWidth(true);
		});

	};

	//////////////
	//
	//STUFF ON CLICKS
	//
	//////////////

	if($('body').hasClass('page-template-templatesnews-events-php')) {
		$('.close-chalkboard,.page-template-templatesnews-events-php #menu-item-16 a').click(function(e){
			$('body').removeClass('switchPositionings');
			e.preventDefault();
			elem.chalkboardContent.hide();
			$('.chalkboard nav a,.chalkboard-content section').removeClass('active');
			$('#menu-item-16 a').addClass('active');
			elem.darken.hide();
		});
	} else {
		$('.close-chalkboard').click(function(){
			$('body').removeClass('switchPositionings');
			elem.chalkboardContent.hide();
			$('.chalkboard > nav > li > a,.chalkboard-content section').removeClass('active');
			elem.darken.hide();
			elem.locations.show();
			//window.location.hash.substring(1);
			if($('.locations').hasClass('flex')) {
				$('.chalkboard').addClass('flex');
			}
		});
	}
	$('.chalkboard.top nav li a').slice(0,3).click(function(e){
		e.preventDefault();
		elem.darken.show();

		$('body').addClass('switchPositionings');
		$('.chalkboard.top > nav > li > a,.chalkboard-content section').removeClass('active').parents('li').removeClass('current_page_item');
		$(this).addClass('active');
		elem.chalkboard.removeClass('flex');
		elem.locations.hide();
		elem.chalkboardContent.show();
		var sectionName = $(this).text().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		elem.chalkboardContent.find('#'+sectionName).addClass('active');
		window.location.hash = sectionName;

		$("html, body").animate({ scrollTop: 0 }, "slow");
  		return false;
		
	});


	//the crazy slide up thingy
	$('body').on('click', '.locations .column a', function(){
		$('.locations .column a').removeClass('active');
		$('.mega a').removeClass('active');
		$('.highlight').removeClass('highlighted');
		$(this).addClass('active');
	});
	$('body').on('click', '.fresh .column a', function(){
		locationPicked = $(this).attr('id');
		freshEvents();
	});
	$('body').on('click', '.page-width .mega a', function(e){
		e.preventDefault();
		$('.page-width .mega a').removeClass('active');
		$(this).addClass('active');

		//get the location!
		var str, split_str, locationPicked;
		str = $(this).parents('nav').attr('class');
		split_str = str.split('-',2);
		locationPicked = split_str[1];

		var sectionName = $(this).text().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('.highlight').removeClass('highlighted');
		setTimeout(function () {
			$('.highlight').removeClass('highlighted');
			elem.underPageWidth.find('.highlight.'+sectionName+'-'+locationPicked).addClass('highlighted');
		}, 1000);
	});

	$('body').on('click', '.image-wrap a', function(e){
		e.preventDefault();
		elem.welcome.addClass('blowup');
		elem.locations.addClass('blowup');
		elem.welcome.removeClass('initial');
		$(this).parents('.image-wrap').addClass('active');
		$('body').on('click', '.welcome.blowup .jog-right', function(e){
			e.preventDefault();
			var $select = $('.images-wrap').find('.image-wrap.active');
			var $next = $select.next('.image-wrap');
			if($next.length == 0) {
				$next = $('.images-wrap .image-wrap:first');
			} 
			elem.imagesWrap.find('.image-wrap.active').removeClass('active');
			$next.addClass('active');
		});
		$('body').on('click', '.welcome.blowup .jog-left', function(e){
			e.preventDefault();
			var $select = elem.imagesWrap.find('.image-wrap.active');
			var $prev = $select.prev('.image-wrap');
			if($prev.length == 0) {
				$prev = $('.images-wrap .image-wrap:last');
			} 
			elem.imagesWrap.find('.image-wrap.active').removeClass('active');
			$prev.addClass('active');
		});
		$('.close-blowup').click(function(e){
			e.preventDefault();
			elem.welcome.removeClass('blowup');
			elem.locations.removeClass('blowup');
			elem.welcome.addClass('initial');
			$('.image-wrap').removeClass('active');
		});
	});
	//the slider functionality
	//forced to repeat code. couldn't combine clicks for some absurd reason. gah.
	$('.chalkboard.top > nav > li#menu-item-173 a').click(function(e){
		e.preventDefault();
		closings();
		$(this).addClass('active').parents().siblings().children().removeClass('active');
		sliderMeasurings();
		elem.welcome.removeClass('overflow');
		$('body').addClass('overflow');	
		$('.chalkboard-content').hide();
		elem.locations.show();
		elem.darken.hide();
		$('body').removeClass('switchPositionings');
		elem.imagesWrapWrap.stop(true,false).animate({
				marginRight: 0
			},500, function(){
				$('.welcome .jog-left,.welcome .jog-right').removeClass('inactive');
				$('.welcome .jog-open').addClass('inactive');
				$('body').removeClass('overflow');	
		});
		elem.welcomeHeader.stop(true,false).animate({
			top: -45
		},800, function(){
			//elem.welcomeHeader.addClass('clickit');
		});	
	});
	$('body').on('click', '.welcome.initial .jog-open:not(".inactive")', function(e){
		e.preventDefault();
		$('.chalkboard.top > nav > li:nth-last-child(2) a').addClass('active');
		sliderMeasurings();
		elem.welcome.removeClass('overflow');
		$('body').addClass('overflow');		
		elem.imagesWrapWrap.stop(true,false).animate({
				marginRight: 0
			},500, function(){
				$('.welcome .jog-left,.welcome .jog-right').removeClass('inactive');
				$('.welcome .jog-open').addClass('inactive');
				$('body').removeClass('overflow');	
		});
		elem.welcomeHeader.stop(true,false).animate({
			top: -45
		},800, function(){
			//elem.welcomeHeader.addClass('clickit');
		});
	});
	//CLOSE SLIDER THING
	$('body').on('click', '.inactive .open',function(e){
		e.preventDefault();
		$('.chalkboard.top > nav > li a').removeClass('active');
		$('body').addClass('overflow');
		elem.welcomeHeader.removeClass('clickit').animate({
			top: 174
		},800,function(){
		});
		$('.welcome .jog-left,.welcome .jog-right').addClass('inactive');
		$('.welcome .jog-open').removeClass('inactive');
		elem.imagesWrapWrap.animate({
			marginRight: -(imageSliderImagesLengths * 2.4)
		},800, function(){
			elem.imagesWrap.css('left',0);
			$('body').removeClass('overflow');
			elem.welcome.addClass('overflow');
		});
	});
	$('body').on('click', '.welcome.initial .jog-right', function(e){
		e.preventDefault();
		var positionL = elem.imagesWrap.position();
		
		$('.welcome .jog-left').removeClass('inactive');
		elem.imagesWrap.animate({left: (-docWidth/2 + positionL.left)},300, function(){
			if(imageSliderImagesLengths/4.4 <= (positionL.left*(-1))) {
				$('.welcome .jog-right').addClass('inactive');
			}
		});
	});
	$('body').on('click', '.welcome.initial .jog-left', function(e){
		e.preventDefault();
		var positionR = elem.imagesWrap.position();
		$('.welcome .jog-right').removeClass('inactive');
		elem.imagesWrap.animate({left: (docWidth/2 + positionR.left)},300, function(){
			if(imageSliderImagesLengths/4.4 <= positionR.left) {
				$('.welcome .jog-left').addClass('inactive');
			}
		});
	});
	$('body').on('click', '.faders .column a:not(".active")', function(){
		locationPicked = $(this).attr('id');
		fadersEvents();
	});

	$('body.home').on('click', '#close-faders,.logo-mini', function(){
		closings();
		//window.location.hash.substring(1);
	});

	$('body').on('click', 'nav.about-nav a', function(e){
		e.preventDefault();
		$('nav.about-nav a').removeClass('active');
		$(this).addClass('active');
		$('.tab').removeClass('active');
		$('.tab').eq($(this).index()).addClass('active');
	});


	//////////////
	//
	//BULK LATER ACTIONS
	//
	//////////////
	var fadersEvents = function() {
		$('.under.flex .fullscreen-bg').fadeOut(1200);
		$('.under.flex .fullscreen-bg.'+locationPicked).stop(true,true).css('bottom','-50%').fadeIn(1000);
		$('.mega-wrap .mega a').removeClass('active');
		$('.mega-wrap .mega').hide();
		$('.mega-wrap .mega.'+locationPicked).fadeIn(3800);
		elem.underPageWidth.removeClass('active');
		elem.underPageWidth.stop(true,false).fadeOut(500);
		$('.under .page-width.'+locationPicked).delay(1800).fadeIn(1500, function(){
			resizeMaps();
			measurings();
		}).addClass('active');

	};

	var measurings = function() {
		windowHeight = $(window).height();
		chalkboardHeight = $('.chalkboard.top').height();
		locationsHeight = $('.top-nav-wrap').height() + $('.mega-wrap').height() + 2;
		fixedNavHeight = chalkboardHeight + locationsHeight;
		locationsHeightPercent = ((locationsHeight*100)/windowHeight);
		chalkboardHeightPercent = ((chalkboardHeight*100)/windowHeight);
		newPosition = (100 - (locationsHeightPercent + chalkboardHeightPercent));
		newUnderPosition = (locationsHeightPercent + chalkboardHeightPercent);
	};

	var closings = function(){
		elem.under.removeClass('relative');

		$('.locations .column a').removeClass('active');
		$('.mega-wrap .mega').hide();
		$('body').removeClass('flex');
		$('.chalkboard.top,.locations,.under').stop(true,true).removeClass('flex');

		$('.first').stop(true,false).animate({
			bottom: '-50%'	
		},500);
		elem.welcome.stop(true,false).animate({
			bottom: '50%'	
		});
		elem.locations.animate({
			bottom: '-0'
		});
		elem.under.stop(true,false).animate({
			bottom: '0%'
		},500, function(){
			elem.locations.removeClass('faders').addClass('fresh');
		});
		elem.underPageWidth.stop(true,true).hide();
		$('.under.fixed .fullscreen-bg').css('bottom','-200%');
	};

	return {
		init: init
	};

}(jQuery));

window.UTIL = {

	fire : function(func,funcname, args){

		// change this to whatever your namespace is actually called
		var namespace = TT;

		// if funcname is undefined, we'll fire namespace.funcname.init()
		funcname = (funcname === undefined) ? 'init' : funcname;

		// if func exists, and namespace.func.funcname is a function...
		if (func !== '' && namespace[func] && typeof namespace[func][funcname] == 'function'){

			// call the method with optional arguments
			namespace[func][funcname](args);
		}

  	},

	loadEvents : function(){

		var $body = jQuery('body');
		//initClass = $body.data( "init" ),
		//classMethod = $body.data( "subinit" );

		// hit namespace.common.init() first
		UTIL.fire('common');

		// fire namespace.initClass.init()
		// UTIL.fire(initClass);

		// fire namespace.initClass.classMethod()
		// UTIL.fire(initClass,classMethod);

		// fire namespace.common.finalize() last (for code to always run after page initialization)
		UTIL.fire('common','finalize');

	}
};

jQuery(document).ready(UTIL.loadEvents);
