<?php
namespace Angfuz_Ins;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - The Father class.
 * Initiate all necessary classes, hooks, configs.
 *
 * @since 1.0.0
 */

 class Controller{
  /**
    * The plugin instance.
    *
    * @since 1.0.0
    * @access public
    * @static
    *
    * @var Plugin
 */
  public static $instance = null;

  /**
    * Admin Gutenberg Block instance.
    *
    * @since 1.0.0
    * @access public
    * @static
    *
    * @var Plugin
  */
  public static $page_instance = [];

  /**
    * Autoloader.
    *
    * Plugin autoloader loads all the classes needed to run the plugin.
    *
    * @since 1.0.0
    * @access private
  */
  private static function registrar_autoloader() {
	  require_once \Angfuz_Ins::plugin_dir() . '/autoloader.php';
	  Autoloader::run();
  } // loade the autoloader

  /**
    * Adding all the pages.
    *
    * @since 1.0.0
    * @access private
  */
  static function register_pages(){
    if (empty(self::$page_instance)) {
      // Call the pages
      self::$page_instance = [
        "ins_helper"    => new \Angfuz_Ins\Ins_Helper\Init(),
        "ins_cpt"       => new \Angfuz_Ins\Ins_Cpt\Init(),
        "ins_shortcode" => new \Angfuz_Ins\Shortcode\Shortcode(),
      ];
      // Call the register functions
      foreach(self::$page_instance as $key ){
        if (method_exists($key, 'register')) {
          $key->register();
        }
      }
    }
  }

  /**
    * Instance.
    *
    * Ensures only one instance of the plugin class is loaded or can be loaded.
    *
    * @since 1.0.0
    * @access public
    * @static
    *
    * @return Plugin An instance of the class.
  */
  public static function instance() {
	if ( is_null( self::$instance ) ) {
    // Call the method for autoloader.
    self::registrar_autoloader();
    // Call the method for all pages.
    self::register_pages();
	}
	return self::$instance;
  }
 }

 // Run the instance.
Controller::instance();