<?php
namespace Angfuz_Ins\Shortcode;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Enqueue Class.
 * Initiate all necessary CSS, JS Files.
 *
 * @since 1.0.0
 */

class Shortcode{
  
  public $instance = null;

  public function register() {
    if (is_null($this->instance)) {
      add_shortcode('insurance', [$this, 'insurance_shotrcode']);
    }
  }

  public function insurance_shotrcode($attr){
    $id = '00';
		$title = 'Choose services';
		$attr = shortcode_atts(
			 [
			    'id' => $id,
			    'title' => $title
			 ], $attr 
		);

		if (!empty($attr['id'])) {
      ob_start();
			  require_once ("templates/insurance.php");
      return ob_get_clean();
		}
  }
}

new Shortcode();