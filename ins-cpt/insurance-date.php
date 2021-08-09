<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Date Class.
 * Initiate Date page.
 *
 * @since 1.0.0
 */
class Insurance_Date{
  /**
    * instance The Date.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
 */
  public $instance = null;

  /**
    * Register all function here.
    *
    * @since 1.0.0
    * @access public
  */
  public function register() {
		if (is_null($this->instance)) {
			add_action( 'init', [$this, 'angfuzins_insurance_date']);
		}
  }

  /**
    * Register all Date options.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_date()
	{
		$labels = [
			'name'              => 'Dates',
			'singular_name'     => 'Date',
			'search_items'      => 'Search Dates',
			'all_items'         => 'All Dates',
			'parent_item'       => 'Parent Date',
			'parent_item_colon' => 'Parent Date:',
			'edit_item'         => 'Edit Date',
			'update_item'       => 'Update Date',
			'add_new_item'      => 'Add Date',
			'new_item_name'     => 'New Date',
			'menu_name'         => 'Dates',
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'insdate' ),
		];

		register_taxonomy( 'insdate', 'angfuzins-insurance', $args );
	}
  
}

new Insurance_Date();
