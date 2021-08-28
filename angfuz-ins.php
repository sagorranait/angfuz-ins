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
  
    static function version(){
   	 return '1.0.0';
    }

    static function author_name(){
   	 return 'Angfuzsoft';
    }

    static function min_php_version(){
   	 return '5.2';
    }

    static function plugin_file(){
   	 return __FILE__;
    }

    static function plugin_url(){
   	 return trailingslashit(plugin_dir_url( __FILE__ ));
    }

    static function plugin_dir(){
   	 return trailingslashit(plugin_dir_path( __FILE__ ));
    }

    static function flush_rewrites(){
   	 flush_rewrite_rules();
    }

    public function __construct() {
      self::controller();
    }

    static function controller(){
      require_once self::plugin_dir() . '/controller.php';
    }

}

new Angfuz_Ins();
register_activation_hook( __FILE__, 'Angfuz_Ins::flush_rewrites' );