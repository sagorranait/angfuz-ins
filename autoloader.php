<?php
namespace Angfuz_Ins;

defined( 'ABSPATH' ) || exit;

class Autoloader {

	public static function run() {
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
  }
 
	private static function autoload( $class_name ) {

    if ( 0 !== strpos( $class_name, __NAMESPACE__ ) ) {
        return;
    }
    
    $file_name = strtolower(
        preg_replace(
            [ '/\b'.__NAMESPACE__.'\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
            [ '', '$1-$2', '-', DIRECTORY_SEPARATOR],
            $class_name
        )
    );

    $file = \Angfuz_Ins::plugin_dir() . $file_name . '.php';

    if ( file_exists( $file ) ) {
        require_once( $file );
    }
  }
}