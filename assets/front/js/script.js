// Login Form
$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});


/******** Fancy Light Box*********/
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();
			
			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});
		});

/************ Magnifying Popup ***************/
	$(document).ready(function() {
		$('.popup-vimeo').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
	
			fixedContentPos: false
		});
	});

/***** Scrolling Script ****************/
				jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});

/***** dropdown menu ****************/

$(document).ready(function () {
    
     
    
    var drop = $('.hover-drop');
    var menu = $('.hover-drop ul');
    drop.hover(function() {
        menu.show();
    }, function() {
        menu.hide();
    });
    
    /****** hover single*********/
    menu.find('li').hover(function() {
        $(this).addClass('underline');
        var padding = $(this).css('padding-bottom');
    }, function() {
        $(this).removeClass('underline');
    });
});


/********Mask input field**********/
jQuery(function($){
   $("#signup_contact").mask("999-9999999");
   $("#contact_mobile").mask("999-9999999");
   
   $("#signup_ic").mask("999999-99-9999");
});



/****************Highlight Input Value***********************/
$(document).ready(function() {
    $('.highlight').css('background-color', '#FFFF99');
});
