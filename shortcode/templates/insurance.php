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
<div class="container">
  <div class="row no-gutters">
    <div class="col-lg-3">
      <h2 class="vs-bar-title"><?php echo $attr['title']; ?></h2>
      <div class="sidebox-wrap">
        <h3 class="sidebox-title">Chief Physician & Co.<i class="fa fa-info info-icon mt-1"></i></h3>
        <?php
          $args = array(
            'taxonomy' => 'inscategory',
            'hide_empty' => false,
          );
          $blockone = get_categories($args);
          foreach($blockone as $block){
            echo '<div class="sidebox-check"><input type="checkbox" id="'.$block->term_id.'">
            <label for="'.$block->term_id.'">'.$block->name.' <i class="fa fa-question modal-toggler" data-modal="#modal-no1" aria-hidden="true"></i></label></div>';
          }
        ?>
      </div>
      <div class="sidebox-wrap">
        <h3 class="sidebox-title">Accommodation <i class="fa fa-info info-icon mt-1"></i></h3>
        <div class="select-inline">
          <div>
            <select>
            <?php
              $args = array(
                'taxonomy' => 'insaccoummodations',
                'hide_empty' => false,
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
        <select>
          <?php
            $args = array(
              'taxonomy' => 'inscontributions',
              'hide_empty' => false,
            );
            $blockthree = get_categories($args);
            foreach($blockthree as $block){
              echo '<option value="'.$block->name.'">'.$block->name.'</option>';
            }
          ?>
        </select>
      </div>
      <div class="sidebox-wrap">
        <h3 class="sidebox-title">Start of insurance <i class="fa fa-info info-icon mt-1"></i></h3>
        <div class="select-inline">
          <div>
            <select>
              <?php
                $args = array(
                  'taxonomy' => 'insdate',
                  'hide_empty' => false,
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
      <div class="sidebox-wrap">
        <ul class="sidebox-icon">
          <li><a href="#"><i class="fa fa-at" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
        </ul>
        <h3 class="author-title">ACIO Service</h3>
        <div class="author-img">
          <img src="assets/img/employee-1.jpg" alt="Employee">
        </div>
        <div class="text-center">
          <p class="author-text mb-0 small">Immer eine persönliche</p>
          <p class="author-text mb-0 small">Ansprechpartner</p>
          <p class="author-text mb-0">Expertentelefon</p>
          <a class="author-text" href="tel:0551900378612">0551 900 378 - 612</a>
          <a href="#" class="author-link-btn">Kontakt</a>
        </div>
      </div>
      <div class="sidebox-wrap">
        <div class="author-img">
          <img src="assets/img/ekomi-logo.png" alt="Ekomi Logo">
        </div>
        <div class="text-center">
          <p class="mb-0 award-text">eKomi Award</p>
          <p class="mb-0 award-text">Bestes Vergleichsportal 2020</p>
          <p class="mb-0 award-text small text-gray">128.856 Kunden haben gewählt</p>
        </div>
        <div class="award-box">
          <div class="media">
            <div class="logo">
              <img src="assets/img/tuv-logo.png" width="50" height="50" alt="Logo">
            </div>
            <div class="media-body">
              <p class="small">Kundenurteil</p>
              <p class="small">Gesamtbewertung</p>
              <p class="rate-text small"><strong id="rate_number">4,9</strong> / 5 Sterne (6000 Bewertungen)</p>
            </div>
          </div>
          <div class="w-100 bg-white px-2">
            <img src="assets/img/stars.png" alt="Rating" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row no-gutters justify-content-between">
        <div class="col-md-8">
          <h2 class="vs-bar-title">Your personal recommendation</h2>
        </div>
        <div class="col-md-4">
          <div class="vs-select-wrap">
            <select size="1" class="vs-bar-select w-100">
              <option selected="" value="costBenefit">Default sorting</option>
              <option value="cost">Sort by average rating</option>
              <option value="averageCost">Sort by latest</option>
              <option value="averageCostBenefit">Sort by price: low to high</option>
              <option value="benefit">Sort by price: high to low</option>
            </select>
          </div>
        </div>
      </div>          
      <div class="vs-service-area vs-service-style1">
        <?php
          $insurances = get_posts([
            'post_type' => 'angfuzins-insurance',
            'post_status' => 'publish',
            'posts_per_page' => -1
          ]);
          if ($insurances) {
            foreach($insurances as $insurance){
              $batch_text	= get_post_meta( $insurance->ID, '_insurance_batch_text_key', true );
              $batch 			= get_post_meta( $insurance->ID, '_insurance_batch_key', true );
              $price 			= get_post_meta( $insurance->ID, '_insurance_price_key', true );
              $month 			= get_post_meta( $insurance->ID, '_insurance_month_key', true );
              $price_info = get_post_meta( $insurance->ID, '_insurance_price_info_key', true );
              $rating 		= get_post_meta( $insurance->ID, '_insurance_rating_key', true );

              echo '<div class="vs-service">
                <div class="vs-service-top">
                  <span class="top-title '.$batch.'">'.$batch_text.'</span>
                </div>
                <div class="vs-service-content">
                  <div class="content-left">
                    <img src="https://i.ibb.co/b62Hsc9/Asset-1.png" alt="Service Image">
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
        ?>               
        <ul class="vs-pagination text-center">
          <li><a href="#">01</a></li>
          <li><a href="#">02</a></li>
          <li><a href="#">03</a></li>
          <li><a href="#">04</a></li>
          <li><a href="#">05</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</section>