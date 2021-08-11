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
    * Load the Callback Class.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $insurance_callback;

	/**
    * Initiate all the option name.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $insurance_key = [];

	/**
    * Constructor Function.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
	function __construct() {
		$this->insurance_callback = new \Angfuz_Ins\Ins_Cpt\Callbacks\Insurance();

		// All Option key
		$this->insurance_key = [
			'_insurance_batch_key' 				=> sanitize_text_field( $_POST['insurance_batch_key']),
			'_insurance_price_key' 				=> sanitize_text_field( $_POST['insurance_price_key']),
			'_insurance_price_info_key' 	=> sanitize_text_field( $_POST['insurance_price_info_key']),
			'_insurance_month_key' 				=> sanitize_text_field( $_POST['insurance_month_key']),
			'_insurance_rating_key'				=> sanitize_text_field( $_POST['insurance_rating_key']),
			'_insurance_complete_btn_key' => sanitize_text_field( $_POST['insurance_complete_btn_key']),
			'_insurance_quote_btn_key'		=> sanitize_text_field( $_POST['insurance_quote_btn_key'])
		];
	}

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

		// Register Metabox
		add_action( 'add_meta_boxes', [ $this, 'insurance_details_meta_box' ]);
		// Save the Options
		add_action( 'save_post', [ $this, 'insurance_save_options_data' ]);
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
			'featured_image'        => __( 'Company Logo', 'angfuz-ins' ),
			'set_featured_image'    => __( 'Set Company Logo', 'angfuz-ins' ),
			'remove_featured_image' => __( 'Remove company logo', 'angfuz-ins' ),
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
			'supports'            => ['thumbnail'],
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

		register_post_type('angfuzins-insurance', $args); // Register Meta box
	}

	/**
    * Register Callback.
    *
    * @since 1.0.0
    * @access public
  */
	public function insurance_details_meta_box() {
		add_meta_box( 'insurance_details', 'Insurance Details', [ $this->insurance_callback, 'insurance_input_callbacks' ], 'angfuzins-insurance' );
	}

	/**
    * Save Option Callback.
    *
    * @since 1.0.0
    * @access public
  */
	public function insurance_save_options_data( $post_id ) {

		if ( ! isset($_POST['insurance_details_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['insurance_details_meta_box_nonce'], 'insurance_save_options_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;
		if (! isset($_POST['insurance_batch_key']) || ! isset($_POST['insurance_price_key']) || ! isset($_POST['insurance_price_info_key']) || ! isset($_POST['insurance_month_key']) || ! isset($_POST['insurance_rating_key']) || ! isset($_POST['insurance_complete_btn_key']) || ! isset($_POST['insurance_quote_btn_key']) ) {
			return;
		}

		foreach ($this->insurance_key as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}
  
}

new Insurance_Cpt();
