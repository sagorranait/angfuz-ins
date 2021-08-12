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