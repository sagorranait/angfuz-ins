<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Accoummodation Class.
 * Initiate Accoummodation page.
 *
 * @since 1.0.0
 */
class Insurance_Accoummodation{
  /**
    * instance The Accoummodation.
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
			add_action( 'init', [$this, 'angfuzins_insurance_accoummodation']);
		}
  }

  /**
    * Register all Accoummodation options.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_accoummodation()
	{
		$labels = [
			'name'              => 'Accoummodations',
			'singular_name'     => 'Accoummodation',
			'search_items'      => 'Search Accoummodations',
			'all_items'         => 'All Accoummodations',
			'parent_item'       => 'Parent Accoummodation',
			'parent_item_colon' => 'Parent Accoummodation:',
			'edit_item'         => 'Edit Accoummodation',
			'update_item'       => 'Update Accoummodation',
			'add_new_item'      => 'Add Accoummodation',
			'new_item_name'     => 'New Accoummodation',
			'menu_name'         => 'Accoummodations',
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'insaccoummodations' ),
		];

		register_taxonomy( 'insaccoummodations', 'angfuzins-insurance', $args );
	}
  
}

new Insurance_Accoummodation();
