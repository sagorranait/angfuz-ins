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
  /**
    * instance The Category.
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
			add_action( 'init', [$this, 'angfuzins_insurance_category']);
		}
  }

  /**
    * Register all Category options.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_category()
	{
		$labels = [
			'name'              => 'Categories',
			'singular_name'     => 'Category',
			'search_items'      => 'Search Categories',
			'all_items'         => 'All Categories',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add Category',
			'new_item_name'     => 'New Category',
			'menu_name'         => 'Categories',
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'inscategory' ),
		];

		register_taxonomy( 'inscategory', 'angfuzins-insurance', $args );
	}
  
}

new Insurance_Category();
