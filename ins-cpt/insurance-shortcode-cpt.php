<?php
namespace Angfuz_Ins\Ins_Cpt;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance ShortCode Cpt Class.
 * Initiate all necessary Cpt options and fields.
 *
 * @since 1.0.0
 */
class Insurance_Shortcode_Cpt{

  public $instance = null;
  public $shortcode_callback;
  public $get_shortcode = [];
  public $shortcode_key = [];
  public $supporter_key = [];
  public $award_key = [];

	function __construct() {
		$this->shortcode_callback = new \Angfuz_Ins\Ins_Cpt\Callbacks\Shortcode();

		// Shotcode Genaretor
    $this->get_shortcode = [
			'_insurance_shortcode_key' => sanitize_text_field( $_POST['insurance_shortcode_key']),
		];

		// All Option key
		$this->shortcode_key = [
			'_insurance_categoryone_key' 					=> sanitize_text_field( $_POST['insurance_categoryone_key']),
			'_insurance_categoryone_number_key' 	=> sanitize_text_field( $_POST['insurance_categoryone_number_key']),
			'_insurance_categoryone_note_key' 		=> sanitize_text_field( $_POST['insurance_categoryone_note_key']),
			'_insurance_categorytwo_key' 					=> sanitize_text_field( $_POST['insurance_categorytwo_key']),
			'_insurance_categorytwo_number_key' 	=> sanitize_text_field( $_POST['insurance_categorytwo_number_key']),
			'_insurance_categorytwo_note_key' 		=> sanitize_text_field( $_POST['insurance_categorytwo_note_key']),
			'_insurance_categorythree_key' 				=> sanitize_text_field( $_POST['insurance_categorythree_key']),
			'_insurance_categorythree_number_key' => sanitize_text_field( $_POST['insurance_categorythree_number_key']),
			'_insurance_categorythree_note_key' 	=> sanitize_text_field( $_POST['insurance_categorythree_note_key']),
			'_insurance_categoryfour_key' 				=> sanitize_text_field( $_POST['insurance_categoryfour_key']),
			'_insurance_categoryfour_number_key' 	=> sanitize_text_field( $_POST['insurance_categoryfour_number_key']),
			'_insurance_categoryfour_note_key' 		=> sanitize_text_field( $_POST['insurance_categoryfour_note_key']),
		];

		// Supporter Key
		$this->supporter_key = [
			'_insurance_support_image_key' 		=> sanitize_text_field( $_POST['insurance_support_image_key']),
			'_insurance_support_title_key' 		=> sanitize_text_field( $_POST['insurance_support_title_key']),
			'_insurance_support_number_key' 	=> sanitize_text_field( $_POST['insurance_support_number_key']),
			'_insurance_support_gamil_key' 		=> sanitize_text_field( $_POST['insurance_support_gamil_key']),
			'_insurance_support_button_key' 	=> sanitize_text_field( $_POST['insurance_support_button_key']),
		];

		// Supporter Key
		$this->award_key = [
			'_insurance_award_image_key' 								=> sanitize_text_field( $_POST['insurance_award_image_key']),
			'_insurance_award_title_key' 								=> sanitize_text_field( $_POST['insurance_award_title_key']),
			'_insurance_award_description_key' 					=> sanitize_text_field( $_POST['insurance_award_description_key']),
			'_insurance_award_voted_key' 								=> sanitize_text_field( $_POST['insurance_award_voted_key']),
			'_insurance_award_company_logo_key' 				=> sanitize_text_field( $_POST['insurance_award_company_logo_key']),
			'_insurance_award_company_description_key' 	=> sanitize_text_field( $_POST['insurance_award_company_description_key']),
			'_insurance_award_company_rating_key' 			=> sanitize_text_field( $_POST['insurance_award_company_rating_key']),
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
			add_action( 'init', [$this, 'angfuzins_insurance_shortcode_cpt']);
		}

		// Meta Box Action
		add_action( 'add_meta_boxes', [ $this, 'insurance_shortcode_meta_box' ]);
		add_action( 'save_post', [ $this, 'insurance_shortcode_generator_save' ]);
		add_action( 'save_post', [ $this, 'insurance_shortcode_save_options' ]);
		add_action( 'save_post', [ $this, 'insurance_supporter_save_options' ]);
		add_action( 'save_post', [ $this, 'insurance_award_save_options' ]);
  }

  /**
    * Register all the options for Insurance cpt.
    *
    * @since 1.0.0
    * @access public
  */
  public function angfuzins_insurance_shortcode_cpt() {
		$args = [
			'label'                => __( 'Shortsode', 'angfuz-ins' ),
			'description'          => __( 'Angfuzins Shortcode generator', 'angfuz-ins' ),
			'labels'               => [
				'all_items'          => __( 'Shortcodes', 'angfuz-ins' ),
				'menu_name'          => __( 'Shortcode', 'angfuz-ins' ),
				'singular_name'      => __( 'Shortcode', 'angfuz-ins' ),
				'edit_item'          => __( 'Edit Shortcode', 'angfuz-ins' ),
        'add_new_item'       => __( 'Add New Shortcode', 'angfuz-ins'),
			  'add_new'            => __( 'Add Shortcode', 'angfuz-ins'),
				'new_item'           => __( 'New Shortcode', 'angfuz-ins' ),
				'view_item'          => __( 'View Shortcode', 'angfuz-ins' ),
				'search_items'       => __( 'Shortcode Locations', 'angfuz-ins'),
				'not_found'          => __( 'No Shortcode found.', 'angfuz-ins'),
				'not_found_in_trash' => __( 'No Shortcode found in trash.', 'angfuz-ins'),
        'featured_image'        => __( 'Company Logo', 'angfuz-ins' ),
			  'set_featured_image'    => __( 'Set Company Logo', 'angfuz-ins' ),
			  'remove_featured_image' => __( 'Remove company logo', 'angfuz-ins' ),
			],
				'supports'            => [ 'title' ],
				'public'              => false,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => 'edit.php?post_type=angfuzins-insurance',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
		];

		register_post_type('shortcode-cpt', $args); // Register Meta box
	}

	public function insurance_shortcode_meta_box() {
		add_meta_box( 'short_code', 'Category Settings', [ $this->shortcode_callback, 'shortcode_category_callbacks' ], 'shortcode-cpt' );
		add_meta_box( 'get_shortcode', 'Your Shortcode', [ $this->shortcode_callback, 'insurance_get_shortcode' ], 'shortcode-cpt' );
		add_meta_box( 'insurance_support', 'Supporter Info', [ $this->shortcode_callback, 'insurance_supporter_info' ], 'shortcode-cpt', 'side');
		add_meta_box( 'insurance_award', 'Award Info', [ $this->shortcode_callback, 'insurance_award_info' ], 'shortcode-cpt', 'side');
	}

  public function insurance_shortcode_generator_save( $post_id ) {

		if ( ! isset($_POST['shortcode_generator_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['shortcode_generator_meta_box_nonce'], 'insurance_shortcode_generator_save') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->get_shortcode as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	public function insurance_shortcode_save_options( $post_id ) {

		if ( ! isset($_POST['insurance_shortcode_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['insurance_shortcode_meta_box_nonce'], 'insurance_shortcode_save_options') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->shortcode_key as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	public function insurance_supporter_save_options( $post_id ){
		if ( ! isset($_POST['insurance_support_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['insurance_support_meta_box_nonce'], 'insurance_supporter_save_options') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->supporter_key as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	public function insurance_award_save_options( $post_id ){
		if ( ! isset($_POST['insurance_award_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['insurance_award_meta_box_nonce'], 'insurance_award_save_options') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->award_key as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

}

new Insurance_Shortcode_Cpt();
