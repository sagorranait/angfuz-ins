<?php
/*
  Plugin Name: Angfuz Insurance Filtering and Compairing
  Plugin URI: http://angfuzsoft.com/products/plugins/angfuz-insurance-filtering-compairing
  Description: Angfuz Insurance Filtering and Compairing WordPress Plugin
  Version: 1.0.0
  Requires at least: 4.0
  Requires PHP: 5.2
  Tested up to: 5.5
  Author: Angfuzsoft
  Author URI: https://www.angfuzsoft.com/
  Text Domain: angfuz-ins

  Copyright 2015 - 2021  Vecurosoft  (email: angfuzsoft@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License

*/

defined('ABSPATH') || die();

final class Angfuz_Ins{
  /**
     * Plugin Version
     *
     * @since 1.0.0
     * @var string The plugin version.
     */
    static function version(){
   	 return '1.0.0';
    }

  /**
     * Author Name
     *
     * @since 1.0.0
     * @var string The plugin author.
     */
    static function author_name(){
   	 return 'Angfuzsoft';
    }

  /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the plugin.
     */
    static function min_php_version(){
   	 return '5.2';
    }

  /**
     * Plugin file
     *
     * @since 1.0.0
     * @var string plugins's root file.
     */
    static function plugin_file(){
   	 return __FILE__;
    }

    /**
     * Plugin URL
     *
     * @since 1.0.0
     * @var string plugins's root url.
     */
    static function plugin_url(){
   	 return trailingslashit(plugin_dir_url( __FILE__ ));
    }

    /**
     * Plugin dir
     *
     * @since 1.0.0
     * @var string plugins's root directory.
     */
    static function plugin_dir(){
   	 return trailingslashit(plugin_dir_path( __FILE__ ));
    }

  /**
   * Rewrite flush.
   *
   * @since 1.0.0
   * @access public
   */
    static function flush_rewrites(){
   	 flush_rewrite_rules();
    }

    public function __construct() {
      // Call the Controller
      self::controller();
    }

    /**
    * Plugin Controller
    *
    * @since 1.0.0
    * @var string Manage all the Actions
    */
    static function controller(){
      require_once self::plugin_dir() . '/controller.php';
    }

}

new Angfuz_Ins();
/**
  * Plugin Activation
  *
  * @since 1.0.0
  * @access public
*/
register_activation_hook( __FILE__, 'Angfuz_Ins::flush_rewrites' );