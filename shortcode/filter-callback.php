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
    print_r($filter);
    // if (isset($filter[1])) {
    //   echo $filter[1];
    // }
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $insurance_args = [
      'post_type' => 'angfuzins-insurance',
      'post_status' => 'publish',
      'posts_per_page' => 6,
      'paged' => $paged,
    ];
    if (isset($filter[1])) {
      $insurance_args['order'] = $filter[1];
    }
    if (isset($filter[2])) {
      $insurance_args['tax_query'] = array( 'relation'=>'AND' );
      $insurance_args['tax_query'] = [
        [
          'taxonomy'  => 'insaccoummodations',
          'field'		  => 'term_id',
          'terms'     => $filter[2],
          'operator'  => 'IN'
        ],
        [
          'taxonomy'  => 'inscontributions',
          'field'		  => 'term_id',
          'terms'     => $filter[3],
          'operator'  => 'IN'
        ],
        [
          'taxonomy'  => 'insdate',
          'field'		  => 'term_id',
          'terms'     => $filter[4],
          'operator'  => 'IN'
        ]
      ];
    }
    // if (isset($filter[3])) {
    //   $insurance_args['tax_query'][] = [
    //     'taxonomy'  => 'inscontributions',
    //     'field'		  => 'term_id',
    //     'terms'     => $filter[3],
    //     'operator'  => 'IN'
    //   ];
    // }
    // if (isset($filter[4])) {
    //   $insurance_args['tax_query'][] = [
    //     'taxonomy'  => 'insdate',
    //     'field'		  => 'term_id',
    //     'terms'     => $filter[4],
    //     'operator'  => 'IN'
    //   ];
    // }
    $insurances = new \WP_Query($insurance_args);
    

    if ($insurances->have_posts()) {
      while ($insurances->have_posts()){ $insurances->the_post();
        global $post;
        $batch_text	= get_post_meta( $post->ID, '_insurance_batch_text_key', true );
        $batch 			= get_post_meta( $post->ID, '_insurance_batch_key', true );
        $price 			= get_post_meta( $post->ID, '_insurance_price_key', true );
        $month 			= get_post_meta( $post->ID, '_insurance_month_key', true );
        $price_info = get_post_meta( $post->ID, '_insurance_price_info_key', true );
        $rating 		= get_post_meta( $post->ID, '_insurance_rating_key', true );

        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );

        echo '<div class="vs-service '.$batch.'">
          <div class="vs-service-top">
            <span class="top-title">'.$batch_text.'</span>
          </div>
          <div class="vs-service-content">
            <div class="content-left">
              <img src="'.$url.'" alt="Service Image">
              <p class="small mb-0">Comfort '.strip_tags(get_the_term_list($post->ID, 'insaccoummodations')).' <i class="fa fa-info info-icon mt-1"></i></p>
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
                  $cat = '<li><a href="#">'.strip_tags(get_the_term_list($post->ID, 'inscategory', '<i class="plus-icon">+</i> ', ' <i class="plus-icon">+</i> ', '')).'</a></li>';
                  echo $cat;
                echo '</ul>
                <span class="label-small">Beltrag</span>
                <span class="small text-gray">'.strip_tags(get_the_term_list($post->ID, 'inscontributions')).'</span>
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
      echo paginate_links( array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $insurances->max_num_pages,
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => false,
        'add_args'     => false,
        'add_fragment' => '',
    ) );
      wp_reset_postdata();
    }else{
      echo '<div class="vs-service">
          <p class="no-insurance">No Insurance</p>         
        </div>';
    }

    die();
  }
}

new Filter_Callback();