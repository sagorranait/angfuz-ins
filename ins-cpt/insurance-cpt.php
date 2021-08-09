<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Cpt Class.
 * Initiate all necessary Cpt options and fields.
 *
 * @since 1.0.0
 */
class Insurance_Cpt{
  /**
    * instance The Insurance cpt.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
 */
  public $instance = null;

  /**
    * Call all the Callbacks.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $cpt_callback;

  /**
    * Register all function here.
    *
    * @since 1.0.0
    * @access public
  */
  public function register() {
		if (is_null($this->instance)) {
			add_action( 'init', [$this, 'angfuzins_insurance_cpt']);
		}
  }

  /**
    * Register all the options for Insurance cpt.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_cpt() {
		$labels = [
			'name'                  => __('Insurances', 'angfuz-ins'),
			'singular_name'         => __('Insurance', 'angfuz-ins'),
			'menu_name'             => __('Insurance Filter', 'angfuz-ins'),
			'name_admin_bar'        => __('Insurance', 'angfuz-ins'),
			'archives'              => __('Insurance Archives', 'angfuz-ins'),
			'attributes'            => __('Insurance Attributes', 'angfuz-ins'),
			'parent_item_colon'     => __('Parent Insurance', 'angfuz-ins'),
			'all_items'             => __('All Insurances', 'angfuz-ins'),
			'add_new_item'          => __('Add New Insurance', 'angfuz-ins'),
			'add_new'               => __('Add Insurance', 'angfuz-ins'),
			'new_item'              => __('New Insurance', 'angfuz-ins'),
			'edit_item'             => __('Edit Insurance', 'angfuz-ins'),
			'update_item'           => __('Update Insurance', 'angfuz-ins'),
			'view_item'             => __('View Insurance', 'angfuz-ins'),
			'view_items'            => __('View Insurances', 'angfuz-ins'),
			'search_items'          => __('Search Insurances', 'angfuz-ins'),
			'not_found'             => __('No Insurance Found', 'angfuz-ins'),
			'not_found_in_trash'    => __('No Insurance Found in Trash', 'angfuz-ins'),
			'insert_into_item'      => __('Insert into Insurance', 'angfuz-ins'),
			'uploaded_to_this_item' => __('Upload to this Insurance', 'angfuz-ins'),
			'items_list'            => __('Insurances List', 'angfuz-ins'),
			'items_list_navigation' => __('Insurances List Navigation', 'angfuz-ins'),
			'filter_items_list'     => __('Filter Insurances List', 'angfuz-ins')
		];

		$args = [
			'labels'              => $labels,
			'supports'            => [ 'title', 'thumbnail', 'editor' ],
			'taxonomies'          => [],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 26,
			'menu_icon' 		      => \Angfuz_Ins::plugin_url().'assets/img/menu-icon.png',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post'
		];

		register_post_type('angfuzins-insurance', $args);
	}
  
}

new Insurance_Cpt();
