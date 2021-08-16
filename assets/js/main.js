(function ($) {
  "use strict";

  function vsmodal(){
    var $toggler = '.modal-toggler',
      $closer = '.modal-close',
      $modal = 'modal', // Selected From Data Attribute of btn
      $modalWrap = '.vs-modal-wrap',
      $toggleCls = 'show';
    // Modal Toggler
    $($toggler).each(function(){
      $(this).on('click', function(){
        var $btn = $(this);
        var modal = $btn.data($modal);
        $(modal).toggleClass($toggleCls);
      })
    });
    // Modal Close
    $($closer).each(function(){
      $(this).on('click', function(){
        var parent = $(this).closest($modalWrap)
        parent.removeClass($toggleCls);
      })
    });
    // Modal Close On body Click
    $($modalWrap).each(function(){
      $(this).on('click', function(e){
        e.stopPropagation();
        $(this).removeClass($toggleCls);
      })
      $(this).children().on('click', function(e){
        e.stopPropagation();
        $(this).addClass($toggleCls)
      })
    })
  }
  vsmodal()

})(jQuery);


