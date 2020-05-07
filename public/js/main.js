
jQuery(document).ready(function($) {
    'use strict';

    // ==============================================================
    // Notification list
    // ==============================================================
    if ($(".notification-list").length) {

        $('.notification-list').slimScroll({
            height: '250px'
        });

    }

    // ==============================================================
    // Sidebar scrollnavigation
    // ==============================================================

    if ($(".sidebar-nav-fixed a").length) {
        $('.sidebar-nav-fixed a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 90
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.sidebar-nav-fixed a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');
            });

    }

    // ==============================================================
    // tooltip
    // ==============================================================
    if ($('[data-toggle="tooltip"]').length) {

            $('[data-toggle="tooltip"]').tooltip()

        }

     // ==============================================================
    // popover
    // ==============================================================
       if ($('[data-toggle="popover"]').length) {
            $('[data-toggle="popover"]').popover()

    }
     // ==============================================================
    // Chat List Slim Scroll
    // ==============================================================


        if ($('.chat-list').length) {
            $('.chat-list').slimScroll({
            color: 'false',
            width: '100%'


        });
    }

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){

        // Show button after 100px
        var showAfter = 100;
        if ( $(this).scrollTop() > showAfter ) {
            $('.back-to-top').show();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.back-to-top').click(function(){
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });

}); // AND OF JQUERY

