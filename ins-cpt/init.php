<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Cpt Init Class.
 * Initiate all necessary custom post type.
 *
 * @since 1.0.0
 */

class Init{
  /**
    * The custom post type instance.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
 */
  public $instance = null;

  /**
    * Admin custom post type instance.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $cpt_instance = [];

  /**
    * Register all custom post type
    *
    * @since 1.0.0
    * @access public
  */
  public function register() {
    // Call the custom post type
	  $this->ins_register_custompost();
  }

  /**
 * Adding All the custom post type.
 *
 * @since 1.0.0
 * @access public
 */
  public function ins_register_custompost(){
    if (empty($this->$cpt_instance)) {
      // Call the cpt scripts
      $this->$cpt_instance = [
        "ins_cpt"      => new \Angfuz_Ins\Ins_Cpt\Insurance_Cpt(),
        "ins_category" => new \Angfuz_Ins\Ins_Cpt\Insurance_Category(),
        "ins_accoummodation" => new \Angfuz_Ins\Ins_Cpt\Insurance_Accoummodation(),
        "ins_contribution" => new \Angfuz_Ins\Ins_Cpt\Insurance_Contribution(),
        "ins_date" => new \Angfuz_Ins\Ins_Cpt\Insurance_Date(),
      ];
      // Call the register functions
      foreach($this->$cpt_instance as $key ){
        if (method_exists($key, 'register')) {
          $key->register();
        }
      }
    }
  }
}

new Init();