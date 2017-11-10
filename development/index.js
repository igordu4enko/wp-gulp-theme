$(window).load(function () {
    $(".loader").delay(600).fadeOut("slow");
});

$(document).ready(function () {

    var navlink = $(".top-menu ul a");
    var navtoggle = $(".nav-toggle");
    var menu = $(".top-menu");
    var sectionHead = $(".section-header");
    var portfolioMix = $(".portfolio>ul li ");

    AOS.init({});

    $('.tooltips').tooltipster({
        theme: 'tooltipster-shadow'
    });

    $('[data-fancybox]').fancybox({
        toolbar  : true
    });

    navtoggle.on("click", function () {
        $(".sandwich").toggleClass("active");
        menu.fadeToggle("slow");
    });

    navlink.on("click", function () {
        menu.fadeOut("fast");
        $(".sandwich").removeClass("active");
    });

    navlink.mPageScroll2id();

    sectionHead.attr({
        "data-aos": "fade-up",
        "data-aos-anchor-placement": "bottom-bottom"
    });

    $("#portfolio-grid").mixItUp();

    portfolioMix.click(function () {
        portfolioMix.removeClass("active");
        $(this).addClass("active");
    });

    $(function () {
        var ink, d, x, y;
        $(".ripplelink").click(function (e) {
            if ($(this).find(".ink").length === 0) {
                $(this).prepend("<span class='ink'></span>");
            }

            ink = $(this).find(".ink");
            ink.removeClass("animate");

            if (!ink.height() && !ink.width()) {
                d = Math.max($(this).outerWidth(), $(this).outerHeight());
                ink.css({height: d, width: d});
            }

            x = e.pageX - $(this).offset().left - ink.width() / 2;
            y = e.pageY - $(this).offset().top - ink.height() / 2;

            ink.css({top: y + 'px', left: x + 'px'}).addClass("animate");
        });
    });

    var input = $(".input-field");

    input.val("");

    input.focusout(function () {
        console.log("works");
        if ($(this).val() != "") {
            $(this).addClass("has-content");
        } else {
            $(this).removeClass("has-content");
        }
    });

});

$.fn.isInViewport = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom && elementBottom < viewportBottom && elementTop > viewportTop;
//     return elementBottom > viewportTop && elementTop < viewportBottom;
};

$(window).on('resize scroll', function() {
    if ($(window).width() < 768) {
        $('.item-container').each(function () {
            if ($(this).isInViewport()) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }
});
