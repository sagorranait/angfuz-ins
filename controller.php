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
  public static $block_instance = [];

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
	}
	return self::$instance;
  }
 }

 // Run the instance.
Controller::instance();