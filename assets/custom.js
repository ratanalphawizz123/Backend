$(function () {

  'use strict';

  (function () {

    var aside = $('.side-nav'),

        showAsideBtn = $('.show-side-btn'),

        contents = $('#contents');

    showAsideBtn.on("click", function () {

      $("#" + $(this).data('show')).toggleClass('show-side-nav');

      contents.toggleClass('margin');

    });

    if ($(window).width() <= 767) {

      aside.addClass('show-side-nav');

    }
    $(window).on('resize', function () {

      if ($(window).width() > 767) {

        aside.removeClass('show-side-nav');

      }

    });

    // dropdown menu in the side nav
    var slideNavDropdown = $('.side-nav-dropdown');

    $('.side-nav .categories li').on('click', function () {

      $(this).toggleClass('opend').siblings().removeClass('opend');

      if ($(this).hasClass('opend')) {

        $(this).find('.side-nav-dropdown').slideToggle('fast');

        $(this).siblings().find('.side-nav-dropdown').slideUp('fast');

      } else {

        $(this).find('.side-nav-dropdown').slideUp('fast');

      }

    });

    $('.side-nav .close-aside').on('click', function () {

      $('#' + $(this).data('close')).addClass('show-side-nav');

      contents.removeClass('margin');

    });

  }());

  

});


$(function(){
  var $ul   =   $('.sidebar-navigation > ul');
  
  $ul.find('li a').click(function(e){
    var $li = $(this).parent();
    
    if($li.find('ul').length > 0){
      e.preventDefault();
      
      if($li.hasClass('selected')){
        $li.removeClass('selected').find('li').removeClass('selected');
        $li.find('ul').slideUp(400);
        $li.find('a em').removeClass('mdi-flip-v');
      }else{
        
        if($li.parents('li.selected').length == 0){
          $ul.find('li').removeClass('selected');
          $ul.find('ul').slideUp(400);
          $ul.find('li a em').removeClass('mdi-flip-v');
        }else{
          $li.parent().find('li').removeClass('selected');
          $li.parent().find('> li ul').slideUp(400);
          $li.parent().find('> li a em').removeClass('mdi-flip-v');
        }
        
        $li.addClass('selected');
        $li.find('>ul').slideDown(400);
        $li.find('>a>em').addClass('mdi-flip-v');
      }
    }
  });
  
  
  $('.sidebar-navigation > ul ul').each(function(i){
    if($(this).find('>li>ul').length > 0){
      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');
      var pIntPLeft   = parseInt(paddingLeft);
      var result      = pIntPLeft + 20;
      
      $(this).find('>li>a').css('padding-left',result);
    }else{
      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');
      var pIntPLeft   = parseInt(paddingLeft);
      var result      = pIntPLeft + 20;
      
      $(this).find('>li>a').css('padding-left',result).parent().addClass('selected--last');
    }
  });
  
  var t = ' li > ul ';
  for(var i=1;i<=10;i++){
    $('.sidebar-navigation > ul > ' + t.repeat(i)).addClass('subMenuColor' + i);
  }
  
  var activeLi = $('li.selected');
  if(activeLi.length){
    opener(activeLi);
  }
  
  function opener(li){
    var ul = li.closest('ul');
    if(ul.length){
      
        li.addClass('selected');
        ul.addClass('open');
        li.find('>a>em').addClass('mdi-flip-v');
      
      if(ul.closest('li').length){
        opener(ul.closest('li'));
      }else{
        return false;
      }
      
    }
  }
  
});



  $(document).ready(function() {
   // alert('sas')
    $('#example').dataTable();
} );



     