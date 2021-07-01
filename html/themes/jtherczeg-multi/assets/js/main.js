function getUserFullName(name, surname){
    return name + '  ' + surname;
}

jQuery(function($) {'use strict';
    //form letter
    $(document).ready(function() {
        let teachername = '';
        let teachersurname = '';
        let studentname = '';
        let studentsurname = '';
        let subject = '';
        let letter = '';

        let studentContainer = $("#student-mirela");
        let subjectContainer = $("#subject");
        let textContainer = $("#parinte-mirela");
        let teacherContainer = $("#invatatoare-mirela");

        let teacherNameInput = $("input[name='teacher-name']");
        let teacherSurnameInput = $("input[name='teacher-surname']");
        let studentNameInput =  $("input[name='student-name']");
        let studentSurnameInput =  $("input[name='student-surname']");
        let subjectInput =  $("input[name='subject']");
        let letterInput =  $("textarea#letter");

        studentNameInput.keyup(function(){

            studentname = studentNameInput.val();
            studentContainer.empty();
            studentContainer.html(getUserFullName(studentname,studentsurname));
        });

        studentSurnameInput.keyup(function(){
            studentsurname = studentSurnameInput.val();
            studentContainer.empty();
            studentContainer.html(getUserFullName(studentname,studentsurname));
        });

        teacherNameInput.keyup(function(){
            teachername = teacherNameInput.val();
            teacherContainer.empty();
            teacherContainer.html(getUserFullName(teachername,teachersurname));
        });

        teacherSurnameInput.keyup(function(){
            teachersurname = teacherSurnameInput.val();
            teacherContainer.empty();
            teacherContainer.html(getUserFullName(teachersurname,teachersurname));
        });

        subjectInput.keyup(function(){
            subject = subjectInput.val();
            subjectContainer.empty();
            subjectContainer.html(subject);
        });

        letterInput.keyup(function(){
            letter = letterInput.val();
            textContainer.empty();
            textContainer.html(letter);
        });


    });
    //form teacher
    $(document).ready(function() {

        let username ='';
        let usersurname = '';
        let teachername = '';
        let teachersurname = '';

        let parinte = $("#parinte-mirela");
        let teacher = $("#invatatoare-mirela");
        let userNameInput = $("input[name='user-name']");
        let userSurnameInput = $("input[name='user-surname']");
        let teacherNameInput =  $("input[name='teacher-name']");
        let teacherSurnameInput =  $("input[name='teacher-surname']");

        userNameInput.keyup(function(){
            username = userNameInput.val();
             parinte.empty();
             parinte.html(getUserFullName(username,usersurname));
        });


        userSurnameInput.keyup(function(){
            usersurname = userSurnameInput.val();
            parinte.empty();
            parinte.html(getUserFullName(username,usersurname));
        });


        teacherNameInput.keyup(function(){
            teachername = teacherNameInput.val();
            teacher.empty();
            teacher.html(getUserFullName(teachername,teachersurname));
        });


        teacherSurnameInput.keyup(function(){
            teachersurname = teacherSurnameInput.val();
            teacher.empty();
            teacher.html(getUserFullName(teachername, teachersurname));
        });

    });

	// Navigation Scroll
	$(window).scroll(function(event) {
		Scroll();
	});

	$('.navbar-collapse ul li a').on('click', function() {
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 5}, 1000);
		return false;
	});

	// User define function
	function Scroll() {
		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   500;
	/*	$('.navbar-collapse').find('.scroll a').each(function(){
			contentTop.push( $( $(this).attr('href') ).offset());
			contentBottom.push( $( $(this).attr('href') ).offset() + $( $(this).attr('href') ).height() );
		})
		*/
		$.each( contentTop, function(i){
			if ( winTop > contentTop[i] - rangeTop ){
				$('.navbar-collapse li.scroll')
				.removeClass('active')
				.eq(i).addClass('active');
			}
		})
	}

	$('#tohash').on('click', function(){
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 5}, 1000);
		return false;
	});

	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});

	//Slider
	$(document).ready(function() {
		var time = 7; // time in seconds

	 	var $progressBar,
	      $bar,
	      $elem,
	      isPause,
	      tick,
	      percentTime;

	    //Init the carousel
	    $("#main-slider").find('.owl-carousel').owlCarousel({
	      slideSpeed : 500,
	      paginationSpeed : 500,
	      singleItem : true,
	      navigation : true,
			navigationText: [
			"<i class='fa fa-angle-left'></i>",
			"<i class='fa fa-angle-right'></i>"
			],
	      afterInit : progressBar,
	      afterMove : moved,
	      startDragging : pauseOnDragging,
	      //autoHeight : true,
	      transitionStyle : "fadeUp"
	    });

	    //Init progressBar where elem is $("#owl-demo")
	    function progressBar(elem){
	      $elem = elem;
	      //build progress bar elements
	      buildProgressBar();
	      //start counting
	      start();
	    }

	    //create div#progressBar and div#bar then append to $(".owl-carousel")
	    function buildProgressBar(){
	      $progressBar = $("<div>",{
	        id:"progressBar"
	      });
	      $bar = $("<div>",{
	        id:"bar"
	      });
	      $progressBar.append($bar).appendTo($elem);
	    }

	    function start() {
	      //reset timer
	      percentTime = 0;
	      isPause = false;
	      //run interval every 0.01 second
	      tick = setInterval(interval, 10);
	    }

	    function interval() {
	      if(isPause === false){
	        percentTime += 1 / time;
	        $bar.css({
	           width: percentTime+"%"
	         });
	        //if percentTime is equal or greater than 100
	        if(percentTime >= 100){
	          //slide to next item
	          $elem.trigger('owl.next')
	        }
	      }
	    }

	    //pause while dragging
	    function pauseOnDragging(){
	      isPause = true;
	    }

	    //moved callback
	    function moved(){
	      //clear interval
	      clearTimeout(tick);
	      //start again
	      start();
	    }
	});

	//Initiat WOW JS
	new WOW().init();
	//smoothScroll
	smoothScroll.init();

	// portfolio filter
	$(window).load(function(){
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});

		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

	$(document).ready(function() {
		//Animated Progress
		$('.progress-bar').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			if (visible) {
				$(this).css('width', $(this).data('width') + '%');
				$(this).unbind('inview');
			}
		});

		//Animated Number
		$.fn.animateNumbers = function(stop, commas, duration, ease) {
			return this.each(function() {
				var $this = $(this);
				var start = parseInt($this.text().replace(/,/g, ""));
				commas = (commas === undefined) ? true : commas;
				$({value: start}).animate({value: stop}, {
					duration: duration == undefined ? 1000 : duration,
					easing: ease == undefined ? "swing" : ease,
					step: function() {
						$this.text(Math.floor(this.value));
						if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
					},
					complete: function() {
						if (parseInt($this.text()) !== stop) {
							$this.text(stop);
							if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
						}
					}
				});
			});
		};

		$('.animated-number').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			var $this = $(this);
			if (visible) {
				$this.animateNumbers($this.data('digit'), false, $this.data('duration'));
				$this.unbind('inview');
			}
		});
	});
/*
	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		//event.preventDefault();
      //  console.log($(this).serialize());
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),
			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
		});
	});
*/
	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});

	//Google Map
	var latitude = $('#google-map').data('latitude');
	var longitude = $('#google-map').data('longitude');
	function initialize_map() {
		var myLatlng = new google.maps.LatLng(latitude,longitude);
		var mapOptions = {
			zoom: 14,
			scrollwheel: false,
			center: myLatlng
		};
		var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map
		});
	}
});
