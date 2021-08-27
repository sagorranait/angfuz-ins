<?php
defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Enqueue Class.
 * Initiate all the shortcode info.
 *
 * @since 1.0.0
 */
?>
<section class="vs-service-wrapper py-5">
<form class="insurance-filter">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-lg-3">
        <h2 class="vs-bar-title"><?php echo $attr['title']; ?></h2>
        <?php
          $inshortcode = get_posts([
            'post_type' => 'shortcode-cpt',
            'post_status' => 'publish',
            'posts_per_page' => -1
          ]);
          if ($inshortcode) {
            foreach($inshortcode as $shortcode){
              $blockone = get_post_meta( $shortcode->ID, '_insurance_categoryone_key', true );
              $blockone_number = get_post_meta( $shortcode->ID, '_insurance_categoryone_number_key', true );
              $blockone_note = get_post_meta( $shortcode->ID, '_insurance_categoryone_note_key', true );
              $blocktwo = get_post_meta( $shortcode->ID, '_insurance_categorytwo_key', true );
              $blocktwo_number = get_post_meta( $shortcode->ID, '_insurance_categorytwo_number_key', true );
              $blocktwo_note = get_post_meta( $shortcode->ID, '_insurance_categorytwo_note_key', true );
              $blockthree = get_post_meta( $shortcode->ID, '_insurance_categorythree_key', true );
              $blockthree_number = get_post_meta( $shortcode->ID, '_insurance_categorythree_number_key', true );
              $blockthree_note = get_post_meta( $shortcode->ID, '_insurance_categorythree_note_key', true );
              $blockfour = get_post_meta( $shortcode->ID, '_insurance_categoryfour_key', true );
              $blockfour_number = get_post_meta( $shortcode->ID, '_insurance_categoryfour_number_key', true );
              $blockfour_note = get_post_meta( $shortcode->ID, '_insurance_categoryfour_note_key', true );
        ?>
        <div class="sidebox-wrap">
          <h3 class="sidebox-title"><?php echo $blockone;?> <i class="fa fa-info info-icon mt-1"></i></h3>
          <?php
            $args = array(
              'taxonomy' => 'inscategory',
              'hide_empty' => false,
              'number' => $blockone_number
            );
            $blockone = get_categories($args);
            foreach($blockone as $block){
              echo '<div class="sidebox-check"><input type="checkbox" class="inscategory" id="'.$block->term_id.'" value="'.$block->term_id.'"><label for="'.$block->term_id.'">'.$block->name.' <i class="fa fa-question modal-toggler" data-modal="#modal-no1" aria-hidden="true"></i></label></div>';
            }
          ?>
        </div>
        <div class="sidebox-wrap">
          <h3 class="sidebox-title">Accommodation <i class="fa fa-info info-icon mt-1"></i></h3>
          <div class="select-inline">
            <div>
              <select class="insurance-accommodation">
              <?php
                $args = array(
                  'taxonomy' => 'insaccoummodations',
                  'hide_empty' => false,
                  'number' => $blocktwo_number,
                );
                $blocktwo = get_categories($args);
                foreach($blocktwo as $block){
                  echo '<option value="'.$block->term_id.'">'.$block->name.'</option>';
                }
              ?>
              </select>
            </div>
            <div>
              <span class="small">room</span>
            </div>
          </div>
          <div class="sidebox-check">
            <input type="checkbox" id="check5">
            <label for="check5">Free choice of hospital <i class="fa fa-question" aria-hidden="true"></i></label>
          </div>
        </div>
        <div class="sidebox-wrap">
          <h3 class="sidebox-title">Contribution development <i class="fa fa-info info-icon mt-1"></i></h3>
          <select class="insurance-contribution">
            <?php
              $args = array(
                'taxonomy' => 'inscontributions',
                'hide_empty' => false,
                'number' => $blockthree_number,
              );
              $blockthree = get_categories($args);
              foreach($blockthree as $block){
                echo '<option value="'.$block->term_id.'">'.$block->name.'</option>';
              }
            ?>
          </select>
        </div>
        <div class="sidebox-wrap">
          <h3 class="sidebox-title">Start of insurance <i class="fa fa-info info-icon mt-1"></i></h3>
          <div class="select-inline">
            <div>
              <select class="insurance-date">
                <?php
                  $args = array(
                    'taxonomy' => 'insdate',
                    'hide_empty' => false,
                    'number' => $blockfour_number,
                  );
                  $blockfour = get_categories($args);
                  foreach($blockfour as $block){
                    echo '<option value="'.$block->term_id.'">'.$block->name.'</option>';
                  }
                ?>
              </select>
            </div>
            <div>
              <span class="small">Beginning</span>
            </div>
          </div>
        </div>
        <?php
          $supporter_image = get_post_meta( $shortcode->ID, '_insurance_support_image_key', true );
          $supporter_title = get_post_meta( $shortcode->ID, '_insurance_support_title_key', true );
          $supporter_number = get_post_meta( $shortcode->ID, '_insurance_support_number_key', true );
          $supporter_gmail = get_post_meta( $shortcode->ID, '_insurance_support_gamil_key', true );
          $supporter_button = get_post_meta( $shortcode->ID, '_insurance_support_button_key', true );
        ?>
        <div class="sidebox-wrap">
          <ul class="sidebox-icon">
            <li><a href="mailto:<?php echo $supporter_gmail;?>"><i class="fa fa-at" aria-hidden="true"></i></a></li>
            <li><a href="tel:<?php echo $supporter_number;?>"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
          </ul>
          <h3 class="author-title"><?php echo $supporter_title;?></h3>
          <div class="author-img">
            <img src="<?php echo $supporter_image;?>" alt="Employee">
          </div>
          <div class="text-center">
            <p class="author-text mb-0 small">Always a personal one</p>
            <p class="author-text mb-0 small">contact person</p>
            <p class="author-text mb-0">Expert telephone</p>
            <a class="author-text" href="tel:<?php echo $supporter_number;?>"><?php echo $supporter_number;?></a>
            <a href="#" class="author-link-btn"><?php echo $supporter_button;?></a>
          </div>
        </div>
        <?php
          $award_image          = get_post_meta( $shortcode->ID, '_insurance_award_image_key', true );
          $award_title          = get_post_meta( $shortcode->ID, '_insurance_award_title_key', true );
          $award_description    = get_post_meta( $shortcode->ID, '_insurance_award_description_key', true );
          $award_voted          = get_post_meta( $shortcode->ID, '_insurance_award_voted_key', true );
          $company_logo         = get_post_meta( $shortcode->ID, '_insurance_award_company_logo_key', true );
          $company_description  = get_post_meta( $shortcode->ID, '_insurance_award_company_description_key', true );
          $company_rating       = get_post_meta( $shortcode->ID, '_insurance_award_company_rating_key', true );
        ?>
        <div class="sidebox-wrap">
          <div class="author-img">
            <img src="<?php echo $award_image;?>" alt="Ekomi Logo">
          </div>
          <div class="text-center">
            <p class="mb-0 award-text"><?php echo $award_title;?></p>
            <p class="mb-0 award-text"><?php echo $award_description;?></p>
            <p class="mb-0 award-text small text-gray"><?php echo $award_voted;?> customers voted</p>
          </div>
          <div class="award-box">
            <div class="media">
              <div class="logo">
                <img src="<?php echo $company_logo;?>" width="50" height="50" alt="Logo">
              </div>
              <div class="media-body">
                <p class="small"><?php echo $company_description;?></p>
              </div>
            </div>
            <div class="w-100 bg-white px-2 company_rating">
              <?php
                for ($i=0; $i <$company_rating; $i++) { 
                  echo '<i class="fa fa-star" aria-hidden="true"></i> ';
                }
              ?>
            </div>
          </div>
        </div>
      <?php
          }
        }
      ?>
      </div>
      <div class="col-lg-9">
        <div class="row no-gutters justify-content-between">
          <div class="col-md-8">
            <h2 class="vs-bar-title">Your personal recommendation</h2>
          </div>
          <div class="col-md-4">
            <div class="vs-select-wrap">
              <select size="1" class="vs-bar-select w-100 insurance-default-filter">
                <option value="DESC">Default sorting</option>
                <option value="DESC">Sort by latest</option>
                <option value="DESC">Sort by A to Z</option>
                <option value="ASC">Sort by Z to A</option>
              </select>
            </div>
          </div>
        </div>          
        <div class="vs-service-area vs-service-style1">
          <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            $args = array('taxonomy' => 'inscategory','hide_empty' => false,);
            $inscategorys = get_categories($args);

            $args = array('taxonomy' => 'insaccoummodations','hide_empty' => false,);
            $accoummodations = get_categories($args);

            $args = array('taxonomy' => 'inscontributions','hide_empty' => false,);
            $contributions = get_categories($args);

            $args = array('taxonomy' => 'insdate','hide_empty' => false,);
            $insdates = get_categories($args);

            $insurances = new \WP_Query([
              'post_type' => 'angfuzins-insurance',
              'post_status' => 'publish',
              'posts_per_page' => 6,
              'paged' => $paged,
              'tax_query' =>
                [
                  'taxonomy' => 'inscategory',
                  'field' => 'id',
                  'terms' => $inscategorys,
                  'operator' => 'NOT IN'
                ],
                [
                  'taxonomy' => 'insaccoummodations',
                  'field' => 'id',
                  'terms' => $accoummodations,
                  'operator' => 'NOT IN'
                ],
                [
                  'taxonomy' => 'inscontributions',
                  'field' => 'id',
                  'terms' => $contributions,
                  'operator' => 'NOT IN'
                ],
                [
                  'taxonomy' => 'insdate',
                  'field' => 'id',
                  'terms' => $insdates,
                  'operator' => 'NOT IN'
                ],
              'order' => 'DESC'
            ]);

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
              echo '<div class="insurance-pagination">'.paginate_links([
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
              ]).'<div>';
              wp_reset_postdata();  
            }else{
              echo '<div class="vs-service">
                  <p class="no-insurance">No Insurance</p>         
                </div>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</form>
</section>