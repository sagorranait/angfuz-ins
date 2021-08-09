<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Contribution Class.
 * Initiate Contribution page.
 *
 * @since 1.0.0
 */
class Insurance_Contribution{
  /**
    * instance The Contribution.
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
			add_action( 'init', [$this, 'angfuzins_insurance_contribution']);
		}
  }

  /**
    * Register all Contribution options.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_contribution()
	{
		$labels = [
			'name'              => 'Contributions',
			'singular_name'     => 'Contribution',
			'search_items'      => 'Search Contributions',
			'all_items'         => 'All Contributions',
			'parent_item'       => 'Parent Contribution',
			'parent_item_colon' => 'Parent Contribution:',
			'edit_item'         => 'Edit Contribution',
			'update_item'       => 'Update Contribution',
			'add_new_item'      => 'Add Contribution',
			'new_item_name'     => 'New Contribution',
			'menu_name'         => 'Contributions',
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'inscontributions' ),
		];

		register_taxonomy( 'inscontributions', 'angfuzins-insurance', $args );
	}
  
}

new Insurance_Contribution();
