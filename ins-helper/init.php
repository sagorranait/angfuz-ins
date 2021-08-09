<?php
namespace Angfuz_Ins\Ins_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Helper Init Class.
 * Initiate all necessary helper file here.
 *
 * @since 1.0.0
 */

class Init{
  /**
    * The helper instance.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
 */
  public $instance = null;

  /**
    * Admin enqueue scripts instance.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $enqueue_instance = [];

  /**
    * Load All the helpers file here.
    *
    * @since 1.0.0
    * @access public
  */
  public function register() {
    // Call the register-helpers function
	  $this->register_helpers();
  }

  /**
 * Adding All the helpers files.
 *
 * @since 1.0.0
 * @access public
 */
  public function register_helpers(){
    if (empty($this->$enqueue_instance)) {
      // Call the enqueue scripts
      $this->$enqueue_instance = [
        "pricing" => new \Angfuz_Ins\Ins_Helper\Enqueue()
      ];
      // Call the register functions
      foreach($this->$enqueue_instance as $key ){
        if (method_exists($key, 'register')) {
          $key->register();
        }
      }
    }
  }
}

new Init();