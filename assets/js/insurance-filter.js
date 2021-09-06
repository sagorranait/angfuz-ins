(function($){

  $(document).ready(function(){
    $(document).on('change', '.insurance-filter', function(e){
      e.preventDefault();
      var inscategory = [];
    //  let inscategory = $('input[type=checkbox]:checked').val();

    /*  for (var i = 0; i < inschecked.length; i++) {
         inscategory.push(inschecked[i].value)
      }
	*/
	
	jQuery(".inscategory:checked").each(function(i,e) {
			inscategory.push(jQuery(this).val());
	});
	
      let orderby = $('.insurance-default-filter').find("option:selected").val();
      let accommodation = $('.insurance-accommodation').find("option:selected").val();
      let contribution = $('.insurance-contribution').find("option:selected").val();
      let insuranceDate = $('.insurance-date').find("option:selected").val();

      $.ajax({
        url: ajaxfilter.ajax_url,
        dataType: 'html',
        data: {
          'action' : 'insurance_filter', 
          'order' : orderby,
          'categoryOne[]' : inscategory.join(),
          'categoryTwo' : accommodation,
          'categorythree' : contribution,
          'categoryFour' : insuranceDate,
        },
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