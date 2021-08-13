<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Category Class.
 * Initiate Category page.
 *
 * @since 1.0.0
 */
class Insurance_Category{

  public $instance = null;
	public $cat_repeater = null;

	function __construct() {
		$this->cat_repeater = [
			[
				"cat_id" => "inscategory",
				"cat_singular" => "Category",
				"cat_plural" => "Categories"
			],
			[
				"cat_id" => "insaccoummodations",
				"cat_singular" => "Accoummodation",
				"cat_plural" => "Accoummodations"
			],
			[
				"cat_id" => "inscontributions",
				"cat_singular" => "Contribution",
				"cat_plural" => "Contributions"
			],
			[
				"cat_id" => "insdate",
				"cat_singular" => "Date",
				"cat_plural" => "Insurance Dates"
			]
		];
	}

  public function register() {
		if (is_null($this->instance)) {
			add_action( 'init', [$this, 'angfuzins_insurance_category']);
		}
  }

  public function angfuzins_insurance_category()
	{
		foreach($this->cat_repeater as $repeater){
			$labels = [
				'name'              => __($repeater['cat_plural'], 'angfuz-ins'),
				'singular_name'     => __($repeater['cat_singular'], 'angfuz-ins'),
				'search_items'      => __('Search '.$repeater['cat_plural'], 'angfuz-ins'),
				'all_items'         => __('All '.$repeater['cat_plural'], 'angfuz-ins'),
				'parent_item'       => __('Parent '.$repeater['cat_singular'], 'angfuz-ins'),
				'parent_item_colon' => __('Parent '.$repeater['cat_singular'].':', 'angfuz-ins'),
				'edit_item'         => __('Edit '.$repeater['cat_singular'], 'angfuz-ins'),
				'update_item'       => __('Update '.$repeater['cat_singular'], 'angfuz-ins'),
				'add_new_item'      => __('Add '.$repeater['cat_singular'], 'angfuz-ins'),
				'new_item_name'     => __('New '.$repeater['cat_singular'], 'angfuz-ins'),
				'menu_name'         => __($repeater['cat_plural'], 'angfuz-ins'),
			];
	
			$args = [
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $repeater['cat_id'] ),
			];
	
			register_taxonomy( $repeater['cat_id'], 'angfuzins-insurance', $args );
		}
	}
  
}

new Insurance_Category();