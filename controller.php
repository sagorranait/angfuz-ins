<?php
namespace Angfuz_Ins;

defined( 'ABSPATH' ) || exit;

class Controller{

  public static $instance = null;

  public static $page_instance = [];

  private static function registrar_autoloader() {
	  require_once \Angfuz_Ins::plugin_dir() . '/autoloader.php';
	  Autoloader::run();
  } // loade the autoloader

  static function register_pages(){
    if (empty(self::$page_instance)) {
      // Call the pages
      self::$page_instance = [
        "ins_helper"    => new \Angfuz_Ins\Ins_Helper\Init(),
        "ins_cpt"       => new \Angfuz_Ins\Ins_Cpt\Init(),
        "ins_shortcode" => new \Angfuz_Ins\Shortcode\Shortcode(),
        "insurance_filter" => new \Angfuz_Ins\Shortcode\Filter_Callback(),
      ];
      // Call the register functions
      foreach(self::$page_instance as $key ){
        if (method_exists($key, 'register')) {
          $key->register();
        }
      }
    }
  }

  public static function instance() {
	if ( is_null( self::$instance ) ) {
    self::registrar_autoloader();
    self::register_pages();
	}
	return self::$instance;
  }
 }
 
Controller::instance();