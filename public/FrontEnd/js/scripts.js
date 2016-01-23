(function() {
  "use strict";


/* ---------------------------------------------------------------------- */
/*         Ocean View Main Javascript FIle
/* ---------------------------------------------------------------------- */

//Javascipt Scripting Starts Here

function headerInfo () {

        var triggers = $('.header-info .triggers');
        var infos =    $('.header-info .info');

        infos.find('p').first().addClass('active');
        triggers.find('i').first().addClass('active');
        
        triggers.find('i').on('click',function(){

            // adding/removing the active class from trigger
            triggers.find('.active').removeClass('active');
            $(this).addClass('active');

            //getting current item's data-id
            var current = $(this).data("id");

            // adding/removing the active class from infos
            infos.find('.active').removeClass('active');
            infos.find("[data-id='" + current + "']").addClass('active');

        });

    }

function mainNav () {

    var menu_border = $('#main-nav ul li ul li');
    menu_border.on('mouseenter', function (){
        
        $(this).children().addClass('transparent-border');
        $(this).prev().children().addClass('transparent-border');
        
    });
    menu_border.on('mouseleave', function(){
        
        $(this).children().removeClass('transparent-border');
        $(this).prev().children().removeClass('transparent-border');
        
    });

    // Responsive navigation

    $('#main-nav > ul').clone().prependTo('#mobile-nav');

    $('a.nav-toggle').on('click',function(){
        $('#mobile-nav').slideToggle();
    });

}


function customGallery () {

    // GALLERY JAVASCIPT!!!

var gallery = $('.gallery');

var galleryImages = $('.gallery div.img-small');



galleryImages.on('click',function(){

    var largeActive = gallery.find('.large-active');
    var smallActive = gallery.find('.small-active');

    largeActive.slideUp().removeClass('large-active');
    smallActive.removeClass('small-active');

    var imageId = $(this).data('id');
    var largeImage = gallery.find(".img-large[data-id='" + imageId + "']");

    if (largeActive.length > 0) {
        largeImage.delay(500).slideDown();
    }

        else{
            largeImage.slideDown();
        }

    largeImage.addClass('large-active');
    $(this).addClass('small-active');


});

gallery.find('a.cross').on('click',function(){

    var largeActive = gallery.find('.large-active');
    var smallActive = gallery.find('.small-active');

    largeActive.slideUp().removeClass('large-active');
    smallActive.removeClass('small-active');


});

gallery.find('a.next').on('click',function(){

    var largeActive = gallery.find('.large-active');
    var smallActive = gallery.find('.small-active');

    largeActive.slideUp().removeClass('large-active');

    var imageId = smallActive.data('id');
    ++imageId;
    var largeImage = gallery.find(".img-large[data-id='" + imageId + "']");
    largeImage.delay(500).slideDown();
    largeImage.addClass('large-active');
    smallActive.removeClass('small-active');
    gallery.find(".img-small[data-id='" + imageId + "']").addClass('small-active');


});

gallery.find('a.prev').on('click',function(){

    var largeActive = gallery.find('.large-active');
    var smallActive = gallery.find('.small-active');

    largeActive.slideUp().removeClass('large-active');

    var imageId = smallActive.data('id');
    --imageId;
    var largeImage = gallery.find(".img-large[data-id='" + imageId + "']");
    largeImage.delay(500).slideDown();
    largeImage.addClass('large-active');
    smallActive.removeClass('small-active');
    gallery.find(".img-small[data-id='" + imageId + "']").addClass('small-active');


});

      
}

function galleryFilter () {

    $('.gallery-filter a.trigger').on('click',function(e){
        e.preventDefault();
        
        $('.gallery-filter ul').fadeToggle(200);
        
        if ($(this).hasClass('active')) {

            $(this).removeClass('active');

        }else{
            $(this).addClass('active');
        }
    });
    
}

function headerv3Filter () {

    $('.head-v3-filter a.trigger').on('click',function(e){
        e.preventDefault();
        
        $('.head-v3-filter ul').fadeToggle(200);
        
        if ($(this).hasClass('active')) {

            $(this).removeClass('active');

        }else{
            $(this).addClass('active');
        }
    });
    
}

function googleMaps () {

        var LocsA = [
    {
            lat: 45.9,
            lon: 10.9,
            title: 'Italy Office',
            html: '<h3>Italy Office</h3><p>908 New Hampshire Ave NW</p><p>Washington, DC 20037</p><p>(202) 463-5141</p><p>Kendra White</p>',
            icon: 'http://maps.google.com/mapfiles/markerA.png'
    },
    {
            lat: 44.8,
            lon: 1.7,
            title: 'France Office',
            html: '<h3>France Office</h3><p>908 New Hampshire Ave NW</p><p>Washington, DC 20037</p><p>(202) 463-5141</p><p>Kendra White</p>',
            icon: 'http://maps.google.com/mapfiles/markerB.png',
            show_infowindow: false
    },
    {
            lat: 51.5,
            lon: -1.1,
            title: 'UK Office',
            html: '<h3>UK Office</h3><p>908 New Hampshire Ave NW</p><p>Washington, DC 20037</p><p>(202) 463-5141</p><p>Kendra White</p>',
            icon: 'http://maps.google.com/mapfiles/markerC.png'
    }
];


       /* var maplace = new Maplace({
            locations: LocsA,
            controls_type: 'list',
            controls_title: 'Choose a location:'
        });

        maplace.Load();
       */
    
}

function headv4RoomForm () {

    var trigger = $('.room-trigger');
    var form = $('.room-form');
    var closeTrigger = $('.room-form .glyphicon');

    // console.log(closeTrigger);

    trigger.on('click',function(e){
        e.preventDefault();
        form.fadeIn();
    });

    closeTrigger.on('click',function(){
        form.fadeOut();
    });


}
function responsiveSidebar(){

    $(window).resize(function(){

       if ($(window).width() <= 850) {  

             $('#sidebar').insertAfter('#content'); 
             // $('#sidebar').after('#content'); 



       }     
       else{
            $('#sidebar').insertBefore('#content'); 
       }

    });

    if ($(window).width() <= 850) {  

             $('#sidebar').insertAfter('#content'); 
             // $('#sidebar').after('#content'); 



       }     
       else{
            $('#sidebar').insertBefore('#content'); 
       }

}

//Calling Bootstrap Dropdown JS here
$('.selectpicker').selectpicker();
//Calling Bootstrap Datepicker JS here
$('.datepicker').pickadate();

//Calling all the used functions here
responsiveSidebar();
customGallery();
galleryFilter();
headerv3Filter();
headerInfo();
mainNav();
headv4RoomForm();
googleMaps();






}());
