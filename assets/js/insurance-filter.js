(function($){

  $(document).ready(function(){
    $(document).on('change', '.insurance-filter', function(e){
      e.preventDefault();
      let inscategory = $('input[type=checkbox]:checked').val();
      let orderby = $('.insurance-default-filter').find("option:selected").val();
      let accommodation = $('.insurance-accommodation').find("option:selected").val();
      let contribution = $('.insurance-contribution').find("option:selected").val();
      let insuranceDate = $('.insurance-date').find("option:selected").val();

      const data = [inscategory, orderby, accommodation, contribution, insuranceDate];

      $.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: data,
        type: 'post',
        success: function(res){

        },
        error: function(res){

        }
      });
    });
  });

})(jQuery);