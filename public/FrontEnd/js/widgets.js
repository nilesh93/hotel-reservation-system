(function() {
  "use strict";


/* ---------------------------------------------------------------------- */
/*         Widgets Main Javascript FIle
/* ---------------------------------------------------------------------- */

//Javascipt Scripting Starts Here

function widgetProjects () {

    //  Finding Widget
    var widget = $("#sidebar .widget-projects");

    // Finding Projects Menu
    var projectsMenu = widget.find('.projects-menu');


    // Showing and hiding menu
    var menuToggle = widget.find('.center');

    menuToggle.on('click',function(e){

        e.preventDefault();

        projectsMenu.slideToggle();

    });

    projectsMenu.find('a').on('click',function(){

        projectsMenu.slideToggle();

    });

    // Finding Carousel
    var carousel = widget.find(".carousel");

    // Showing First Carousel

    carousel.first().addClass('carousel-active');

    //widget projects category menu links 
    var menuLink = $(".projects-menu a");

    menuLink.on('click',function(e){

        e.preventDefault();

        var current = "#" + $(this).data("id");

        carousel.removeClass('carousel-active');

        widget.find(current).addClass('carousel-active');


    });

}

function widgetGallery () {

    // calling the fluidbox plugin
    //$('a').fluidbox();

    //  Finding Widget
    var widget = $("#sidebar .widget-gallery");

    // Finding Projects Menu
    var projectsMenu = widget.find('.gallery-menu');


    // Showing and hiding menu
    var menuToggle = widget.find('.center');

    menuToggle.on('click',function(e){

        e.preventDefault();

        projectsMenu.slideToggle();

    });

    projectsMenu.find('a').on('click',function(){

        projectsMenu.slideToggle();

    });

    // Finding Carousel
    var carousel = widget.find(".carousel");

    // Showing First Carousel

    carousel.first().addClass('carousel-active');

    //widget projects category menu links 
    var menuLink = $(".gallery-menu a");

    menuLink.on('click',function(e){

        e.preventDefault();

        var current = "#" + $(this).data("id");

        carousel.removeClass('carousel-active');

        widget.find(current).addClass('carousel-active');


    });

}

function widgetImages () {
    // This triggers after each slide change
    $('.widget-images-carousel').on('slid.bs.carousel', function () {
      var carouselData = $(this).data('bs.carousel');
      var currentIndex = carouselData.getActiveIndex();
      var total = carouselData.$items.length;
        
      // Now display this wherever you want
      var text = (currentIndex + 1) + "/" + total;
      $('.widget-images-count').text(text);
    });
}

function footerWidgetGallery () {

    // calling the fluidbox plugin
    //$('a').fluidbox();

    //  Finding Widget
    var widget = $("#footer .widget-gallery");

    // Finding Projects Menu
    var projectsMenu = widget.find('.gallery-menu');


    // Showing and hiding menu
    var menuToggle = widget.find('.center');

    menuToggle.on('click',function(e){

        e.preventDefault();

        projectsMenu.slideToggle();

    });

    projectsMenu.find('a').on('click',function(){

        projectsMenu.slideToggle();

    });

    // Finding Carousel
    var carousel = widget.find(".carousel");

    // Showing First Carousel

    carousel.first().addClass('carousel-active');

    //widget projects category menu links 
    var menuLink = $(".gallery-menu a");

    menuLink.on('click',function(e){

        e.preventDefault();

        var current = "#" + $(this).data("id");

        carousel.removeClass('carousel-active');

        widget.find(current).addClass('carousel-active');


    });
}

function footerWidgetProjects() {

    //  Finding Widget
    var widget = $("#footer .widget-projects");

    // Finding Projects Menu
    var projectsMenu = widget.find('.projects-menu');


    // Showing and hiding menu
    var menuToggle = widget.find('.center');

    menuToggle.on('click',function(e){

        e.preventDefault();

        projectsMenu.slideToggle();

    });

    projectsMenu.find('a').on('click',function(){

        projectsMenu.slideToggle();

    });

    // Finding Carousel
    var carousel = widget.find(".carousel");

    // Showing First Carousel

    carousel.first().addClass('carousel-active');

    //widget projects category menu links 
    var menuLink = $(".projects-menu a");

    menuLink.on('click',function(e){

        e.preventDefault();

        var current = "#" + $(this).data("id");

        carousel.removeClass('carousel-active');

        widget.find(current).addClass('carousel-active');


    });

}



widgetProjects();
widgetGallery();
widgetImages();
footerWidgetGallery();
footerWidgetProjects();





}());
