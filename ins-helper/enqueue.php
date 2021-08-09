<?php
namespace Angfuz_Ins\Ins_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Enqueue Class.
 * Initiate all necessary CSS, JS Files.
 *
 * @since 1.0.0
 */

class Enqueue{
  /**
    * The Enqueue instance.
    *
    * @since 1.0.0
    * @access public
    * @static
    *
    * @var Plugin
 */
  public $instance = null;

  /**
    * Load All the enqueue function.
    *
    * @since 1.0.0
    * @access public
  */
  public function register() {
	  if(is_null( $this->instance )){
      add_action( 'admin_enqueue_scripts', [$this, 'ins_enqueue_editor_scripts']);
      add_action( 'wp_enqueue_scripts', [$this, 'ins_enqueue_frontend_scripts']);
    }
  }

  /**
    * Load All the CSS & Js file for editor.
    *
    * @since 1.0.0
    * @access public
  */
  public function ins_enqueue_editor_scripts() {
	  wp_enqueue_style( 'angfuzins-editor-css', \Angfuz_Ins::plugin_url().'assets/css/angfuz-ins.css', [], \Angfuz_Ins::version(), 'all');
    wp_enqueue_script( 'angfuzins-editor-js', \Angfuz_Ins::plugin_url().'assets/js/angfuz-ins.js', ['jquery']);
  }

  /**
    * Load All the CSS & Js file for Front-End.
    *
    * @since 1.0.0
    * @access public
  */
  public function ins_enqueue_frontend_scripts() {
	  wp_enqueue_style( 'angfuzins-bootstrap', \Angfuz_Ins::plugin_url().'assets/css/bootstrap.min.css', [], \Angfuz_Ins::version(), 'all');
    wp_enqueue_style( 'angfuzins-fontawesome', \Angfuz_Ins::plugin_url().'assets/css/font-awesome.min.css', [], \Angfuz_Ins::version(), 'all');
    wp_enqueue_script( 'angfuzins-bootstrapjs', \Angfuz_Ins::plugin_url().'assets/js/bootstrap.min.js', ['jquery']);
  }
}

new Enqueue();