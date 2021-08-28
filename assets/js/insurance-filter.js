(function($){

  $(document).ready(function(){
    $(document).on('change', '.insurance-filter', function(e){
      e.preventDefault();
      var inscategory = ['0']
      let inschecked = document.querySelectorAll('input[type=checkbox]:checked');

      for (var i = 0; i < inschecked.length; i++) {
        inscategory.push(inschecked[i].value)
      }
      
      let orderby = $('.insurance-default-filter').find("option:selected").val();
      let accommodation = $('.insurance-accommodation').find("option:selected").val();
      let contribution = $('.insurance-contribution').find("option:selected").val();
      let insuranceDate = $('.insurance-date').find("option:selected").val();

      const filter = [inscategory, orderby, accommodation, contribution, insuranceDate];

      $.ajax({
        url: ajaxfilter.ajax_url,
        data: {action : 'insurance_filter', filters: filter},
        type: 'post',
        success: function(res){
          $('.vs-service-area').html(res);
        },
        error: function(res){
          console.log(res);
        }
      });
    });
  });

})(jQuery);