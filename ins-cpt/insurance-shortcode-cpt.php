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
  /**
    * instance The Insurance ShortCode cpt.
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
  public $shortcode_callback;

  /**
    * Initiate Shortcode.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $get_shortcode = [];

	/**
    * Initiate all the option name.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
  public $shortcode_key = [];

	/**
    * Constructor Function.
    *
    * @since 1.0.0
    * @access public
    *
    * @var Plugin
  */
	function __construct() {
		$this->shortcode_callback = new \Angfuz_Ins\Ins_Cpt\Callbacks\Shortcode();

    $this->get_shortcode = [
			'_insurance_shortcode_key' => sanitize_text_field( $_POST['insurance_shortcode_key']),
		];

		// All Option key
		$this->shortcode_key = [
			'_insurance_categoryone_key' => sanitize_text_field( $_POST['insurance_categoryone_key']),
			'_insurance_categoryone_number_key' => sanitize_text_field( $_POST['insurance_categoryone_number_key']),
			'_insurance_categorytwo_key' => sanitize_text_field( $_POST['insurance_categorytwo_key']),
			'_insurance_categorytwo_number_key' => sanitize_text_field( $_POST['insurance_categorytwo_number_key']),
			'_insurance_categorythree_key' => sanitize_text_field( $_POST['insurance_categorythree_key']),
			'_insurance_categorythree_number_key' => sanitize_text_field( $_POST['insurance_categorythree_number_key']),
			'_insurance_categoryfour_key' => sanitize_text_field( $_POST['insurance_categoryfour_key']),
			'_insurance_categoryfour_number_key' => sanitize_text_field( $_POST['insurance_categoryfour_number_key']),
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
		add_action( 'save_post', [ $this, 'insurance_shortcode_save_options' ]);
		add_action( 'save_post', [ $this, 'insurance_shortcode_generator_save' ]);
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
				'supports'            => [ 'title', 'thumbnail' ],
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
		add_meta_box( 'get_shortcode', 'Your Shortcode', [ $this->shortcode_callback, 'insurance_get_shortcode' ], 'shortcode-cpt' );
		add_meta_box( 'code_generator', 'Category Settings', [ $this->shortcode_callback, 'shortcode_category_callbacks' ], 'shortcode-cpt' );
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

}

new Insurance_Shortcode_Cpt();
