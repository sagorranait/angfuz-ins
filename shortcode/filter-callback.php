<?php
namespace Angfuz_Ins\Shortcode;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Enqueue Class.
 * Initiate all necessary CSS, JS Files.
 *
 * @since 1.0.0
 */

class Filter_Callback{
  
  public $instance = null;

  public function register() {
    if (is_null($this->instance)) {
      add_action('wp_ajax_nopriv_insurance_filter', [$this, 'insurance_filter_ajax']);
      add_action('wp_ajax_insurance_filter', [$this, 'insurance_filter_ajax']);
    }
  }

  public function insurance_filter_ajax(){
    $filter = $_POST['filters'];
  
    $insurances = get_posts([
      'post_type' => 'angfuzins-insurance',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'tax_query' => [
        [
          'taxonomy' => 'insaccoummodations',
          'field'		=> 'term_id',
          'terms'		=> $filter[2]
        ]
      ],
      'order' => $filter[1]
    ]);

    if ($insurances) {
      foreach($insurances as $insurance){
        $batch_text	= get_post_meta( $insurance->ID, '_insurance_batch_text_key', true );
        $batch 			= get_post_meta( $insurance->ID, '_insurance_batch_key', true );
        $price 			= get_post_meta( $insurance->ID, '_insurance_price_key', true );
        $month 			= get_post_meta( $insurance->ID, '_insurance_month_key', true );
        $price_info = get_post_meta( $insurance->ID, '_insurance_price_info_key', true );
        $rating 		= get_post_meta( $insurance->ID, '_insurance_rating_key', true );

        $url = wp_get_attachment_url( get_post_thumbnail_id($insurance->ID), 'thumbnail' );

        echo '<div class="vs-service">
          <div class="vs-service-top">
            <span class="top-title '.$batch.'">'.$batch_text.'</span>
          </div>
          <div class="vs-service-content">
            <div class="content-left">
              <img src="'.$url.'" alt="Service Image">
              <p class="small mb-0">Comfort '.strip_tags(get_the_term_list($insurance->ID, 'insaccoummodations')).' <i class="fa fa-info info-icon mt-1"></i></p>
            </div>
            <div class="content-middle">
              <div class="middle-left">
                <div class="price-area">
                  <span class="price">€'.$price.'</span>
                  <sub>/ '.$month.'</sub>
                  <i class="fa fa-info info-icon mt-1"></i>
                </div>
              </div>
              <div class="middle-right">
                <span class="small d-lg-inline-block d-none">ACIO rating</span>
                <div class="rating mb-2 d-lg-block d-none">';
                  for ($i=0; $i <$rating; $i++) { 
                    echo '<i class="fa fa-star" aria-hidden="true"></i> ';
                  }
                echo '</div><ul class="list-service">';
                  $cat = '<li><a href="#">'.strip_tags(get_the_term_list($insurance->ID, 'inscategory', '<i class="plus-icon">+</i> ', ' <i class="plus-icon">+</i> ', '')).'</a></li>';
                  echo $cat;
                  // <li><a href="#"><i class="plus-icon">+</i> Chefarztbehandlung</a></li>
                  // <li><a href="#"><i class="plus-icon">+</i> Honorar ohne Begrenzung</a></li>
                  // <li><a href="#"><i class="plus-icon">+</i> Ambulante OP</a></li>
                echo '</ul>
                <span class="label-small">Beltrag</span>
                <span class="small text-gray">'.strip_tags(get_the_term_list($insurance->ID, 'inscontributions')).'</span>
              </div>
            </div>
            <div class="content-right">
              <a href="#" class="vs-btn">Complete online</a>
              <a href="#" class="vs-btn style-outline">Request a quote</a>
            </div>
          </div>
          <div class="service-footer">
            <div class="checkbox">
              <input type="checkbox" id="serviceCheck1">
              <label for="serviceCheck1" class="small">Compare tariff</label>
            </div>
          </div>            
        </div>';
      }
      wp_reset_postdata();
    }

    die();
  }
}

new Filter_Callback();