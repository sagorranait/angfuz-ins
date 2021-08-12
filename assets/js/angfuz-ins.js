jQuery(document).ready(function($){
  var mediaUploader;

  $('#supporter_image').on('click', function(e){
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Supporter Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple: false
    });

    mediaUploader.on('select', function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#insurance_support_image_key').val(attachment.url)
    });

    mediaUploader.open();
  });
});

jQuery(document).ready(function($){
  var mediaUploader;

  $('#award_image').on('click', function(e){
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Award Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple: false
    });

    mediaUploader.on('select', function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#insurance_award_image_key').val(attachment.url)
    });

    mediaUploader.open();
  });
});

jQuery(document).ready(function($){
  var mediaUploader;

  $('#company_logo').on('click', function(e){
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Company Logo',
      button: {
        text: 'Choose Logo'
      },
      multiple: false
    });

    mediaUploader.on('select', function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#insurance_award_company_logo_key').val(attachment.url)
    });

    mediaUploader.open();
  });
});