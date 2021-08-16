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

  public $instance = null;
  public $insurance_callback;
  public $insurance_key = [];

	function __construct() {
		$this->insurance_callback = new \Angfuz_Ins\Ins_Cpt\Callbacks\Insurance();

		// All Option key
		$this->insurance_key = [
			'_insurance_batch_text_key' 	=> sanitize_text_field( $_POST['insurance_batch_text_key']),
			'_insurance_batch_key' 				=> sanitize_text_field( $_POST['insurance_batch_key']),
			'_insurance_price_key' 				=> sanitize_text_field( $_POST['insurance_price_key']),
			'_insurance_price_info_key' 	=> sanitize_text_field( $_POST['insurance_price_info_key']),
			'_insurance_month_key' 				=> sanitize_text_field( $_POST['insurance_month_key']),
			'_insurance_rating_key'				=> sanitize_text_field( $_POST['insurance_rating_key'])
		];
	}

  public function register() {
		if (is_null($this->instance)) {
			add_action( 'init', [$this, 'angfuzins_insurance_cpt']);
			add_filter('manage_angfuzins-insurance_posts_columns', [ $this, 'insurance_column' ]);
			add_action( 'manage_angfuzins-insurance_posts_custom_column', [ $this, 'insurance_custom_column'], 10, 2 );
		}
		add_action( 'add_meta_boxes', [ $this, 'insurance_details_meta_box' ]);
		add_action( 'save_post', [ $this, 'insurance_save_options_data' ]);
  }

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

	public function insurance_column( $columns ){
		$SC_column = array();
		$SC_column['price'] = 'Insurance Price';
		$SC_column['inscategory'] = 'Categories';
		$SC_column['insaccoummodations'] = 'Accoummodations';
		$SC_column['inscontributions'] = 'Contributions';
		$SC_column['insdate'] = '	Insurance Dates';
 		$SC_column['date'] = 'Date';
		return $SC_column;
	}

	function insurance_custom_column( $column, $post_id ){
	
		switch( $column ){
			case 'price' :
				//code column
				$price = get_post_meta( $post_id, '_insurance_price_key', true );
				echo '<h3>€ '.$price.'</h3>';
			break;
			case "inscategory":  
				echo $cat = strip_tags(get_the_term_list($post_id->ID, 'inscategory', '', ', ',''));  
			break;
			case "insaccoummodations":  
				echo $cat = strip_tags(get_the_term_list($post_id->ID, 'insaccoummodations', '', ', ',''));  
			break;
			case "inscontributions":  
				echo $cat = strip_tags(get_the_term_list($post_id->ID, 'inscontributions', '', ', ',''));  
			break;
			case "insdate":  
				echo $cat = strip_tags(get_the_term_list($post_id->ID, 'insdate', '', ', ',''));  
			break;
		}
	}

	public function insurance_details_meta_box() {
		add_meta_box( 'insurance_details', 'Insurance Details', [ $this->insurance_callback, 'insurance_input_callbacks' ], 'angfuzins-insurance' );
	}

	public function insurance_save_options_data( $post_id ) {

		if ( ! isset($_POST['insurance_details_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['insurance_details_meta_box_nonce'], 'insurance_save_options_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;
		if (! isset($_POST['insurance_batch_key']) || ! isset($_POST['insurance_price_key']) || ! isset($_POST['insurance_price_info_key']) || ! isset($_POST['insurance_month_key']) || ! isset($_POST['insurance_rating_key'])) {
			return;
		}

		foreach ($this->insurance_key as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}
  
}

new Insurance_Cpt();
