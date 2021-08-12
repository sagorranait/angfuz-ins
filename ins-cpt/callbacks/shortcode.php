<?php
namespace Angfuz_Ins\Ins_Cpt\Callbacks;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Shortcode Callback Class.
 * Initiate all necessary Cpt options and fields.
 *
 * @since 1.0.0
 */
class Shortcode{
  /**
    * Show all the option on Editor.
    *
    * @since 1.0.0
    * @access public
  */
  public function insurance_get_shortcode( $post )
	{
		wp_nonce_field( 'insurance_shortcode_generator_save', 'shortcode_generator_meta_box_nonce' );
		$code = get_post_meta( $post->ID, '_insurance_shortcode_key', true );
		$title = '';
		if (@get_the_title()) {
			$title = get_the_title();
		}
		$shortcode = '[vsteam id="'.get_the_ID().'" title="'.$title.'"]';
		
		echo '<textarea onfocus="this.select();" class="regular-text" name="option_shortcode_value_key" rows="1" cols="50" readonly>'.$shortcode.'</textarea>';
	}
	
	public function shortcode_category_callbacks( $post ) {
		wp_nonce_field( 'insurance_shortcode_save_options', 'insurance_shortcode_meta_box_nonce' );

		 $categoryone = get_post_meta( $post->ID, '_insurance_categoryone_key', true );
		 $categoryone_number = get_post_meta( $post->ID, '_insurance_categoryone_number_key', true );
		 $categoryone_note = get_post_meta( $post->ID, '_insurance_categoryone_note_key', true );
		 $categorytwo = get_post_meta( $post->ID, '_insurance_categorytwo_key', true );
		 $categorytwo_number = get_post_meta( $post->ID, '_insurance_categorytwo_number_key', true );
		 $categorytwo_note = get_post_meta( $post->ID, '_insurance_categorytwo_note_key', true );
		 $categorythree = get_post_meta( $post->ID, '_insurance_categorythree_key', true );
		 $categorythree_number = get_post_meta( $post->ID, '_insurance_categorythree_number_key', true );
		 $categorythree_note = get_post_meta( $post->ID, '_insurance_categorythree_note_key', true );
		 $categoryfour = get_post_meta( $post->ID, '_insurance_categoryfour_key', true );
		 $categoryfour_number = get_post_meta( $post->ID, '_insurance_categoryfour_number_key', true );
		 $categoryfour_note = get_post_meta( $post->ID, '_insurance_categoryfour_note_key', true );

			
    echo '<label for="insurance_categoryone_key">First Category : </label>';
    echo '<input type="text" id="insurance_categoryone_key" name="insurance_categoryone_key" value="'.$categoryone.'" placeholder="Enter First Category Name" size="100%"><br><br>';

		echo '<label for="insurance_categoryone_number_key">Category Limit : </label>';
		echo '<input type="number" id="insurance_categoryone_number_key" name="insurance_categoryone_number_key" value="'.$categoryone_number.'" placeholder="Enter Category Number" size="100%"><br><br>';

		echo '<label for="insurance_categoryone_note_key">Category Note : </label>';
		echo '<textarea id="insurance_categoryone_note_key" name="insurance_categoryone_note_key" rows="2" cols="100">'.esc_attr($categoryone_note).'</textarea><br><br><hr><br>';

    echo '<label for="insurance_categorytwo_key">Second Category : </label>';
    echo '<input type="text" id="insurance_categorytwo_key" name="insurance_categorytwo_key" value="'.$categorytwo.'" placeholder="Enter Second Category Name" size="100%"><br><br>';

		echo '<label for="insurance_categorytwo_number_key">Category Limit : </label>';
		echo '<input type="number" id="insurance_categorytwo_number_key" name="insurance_categorytwo_number_key" value="'.$categorytwo_number.'" placeholder="Enter Category Number" size="100%"><br><br>';

		echo '<label for="insurance_categorytwo_note_key">Category Note : </label>';
		echo '<textarea id="insurance_categorytwo_note_key" name="insurance_categorytwo_note_key" rows="2" cols="100">'.esc_attr($categorytwo_note).'</textarea><br><br><hr><br>';

    echo '<label for="insurance_categorythree_key">Third Category : </label>';
    echo '<input type="text" id="insurance_categorythree_key" name="insurance_categorythree_key" value="'.$categorythree.'" placeholder="Enter Third Category Name" size="100%"><br><br>';

		echo '<label for="insurance_categorythree_number_key">Category Limit : </label>';
		echo '<input type="number" id="insurance_categorythree_number_key" name="insurance_categorythree_number_key" value="'.$categorythree_number.'" placeholder="Enter Category Number" size="100%"><br><br>';

		echo '<label for="insurance_categorythree_note_key">Category Note : </label>';
		echo '<textarea id="insurance_categorythree_note_key" name="insurance_categorythree_note_key" rows="2" cols="100">'.esc_attr($categorythree_note).'</textarea><br><br><hr><br>';

    echo '<label for="insurance_categoryfour_key">Fourth Category : </label>';
    echo '<input type="text" id="insurance_categoryfour_key" name="insurance_categoryfour_key" value="'.$categoryfour.'" placeholder="Enter Fourth Category Name" size="100%"><br><br>';

		echo '<label for="insurance_categoryfour_number_key">Category Limit : </label>';
		echo '<input type="number" id="insurance_categoryfour_number_key" name="insurance_categoryfour_number_key" value="'.$categoryfour_number.'" placeholder="Enter Category Number" size="100%"><br><br>';

		echo '<label for="insurance_categoryfour_note_key">Category Note : </label>';
		echo '<textarea id="insurance_categoryfour_note_key" name="insurance_categoryfour_note_key" rows="2" cols="100">'.esc_attr($categoryfour_note).'</textarea><br><br>';
	}

	public function insurance_supporter_info( $post ) {
		wp_nonce_field( 'insurance_supporter_save_options', 'insurance_support_meta_box_nonce' );

		$supporter_image = get_post_meta( $post->ID, '_insurance_support_image_key', true );
		$supporter_title = get_post_meta( $post->ID, '_insurance_support_title_key', true );
		$supporter_number = get_post_meta( $post->ID, '_insurance_support_number_key', true );
		$supporter_gmail = get_post_meta( $post->ID, '_insurance_support_gamil_key', true );
		$supporter_button = get_post_meta( $post->ID, '_insurance_support_button_key', true );

		
    echo '<input type="button" class="button button-secondary" value="Upload Support Image" id="supporter_image"/><input type="text" id="insurance_support_image_key" name="insurance_support_image_key" value="'.$supporter_image.'"/><br><br>';

		echo '<label for="insurance_support_title_key">Title : </label>';
    echo '<input type="text" id="insurance_support_title_key" name="insurance_support_title_key" value="'.$supporter_title.'" placeholder="Enter Your Title"><br><br>';

		echo '<label for="insurance_support_number_key">Telephone : </label>';
		echo '<input type="number" id="insurance_support_number_key" name="insurance_support_number_key" value="'.$supporter_number.'" placeholder="Enter Supporter Number"><br><br>';

    echo '<label for="insurance_support_gamil_key">Email : </label>';
    echo '<input type="email" id="insurance_support_gamil_key" name="insurance_support_gamil_key" value="'.$supporter_gmail.'" placeholder="Enter Support Email Name"><br><br>';

		echo '<label for="insurance_support_button_key">Button Text : </label>';
		echo '<input type="text" id="insurance_support_button_key" name="insurance_support_button_key" value="'.$supporter_button.'" placeholder="Contact Us"><br><br>';
	}

	public function insurance_award_info( $post ) {
		wp_nonce_field( 'insurance_award_save_options', 'insurance_award_meta_box_nonce' );

		$award_image = get_post_meta( $post->ID, '_insurance_award_image_key', true );
		$award_title = get_post_meta( $post->ID, '_insurance_award_title_key', true );
		$award_description = get_post_meta( $post->ID, '_insurance_award_description_key', true );
		$award_voted = get_post_meta( $post->ID, '_insurance_award_voted_key', true );
		$company_logo = get_post_meta( $post->ID, '_insurance_award_company_logo_key', true );
		$company_description = get_post_meta( $post->ID, '_insurance_award_company_description_key', true );
		$company_rating = get_post_meta( $post->ID, '_insurance_award_company_rating_key', true );

		
    echo '<input type="button" class="button button-secondary" value="Upload Support Image" id="award_image"/><input type="text" id="insurance_award_image_key" name="insurance_award_image_key" value="'.$award_image.'"/><br><br>';

		echo '<label for="insurance_award_title_key">Award Title : </label>';
    echo '<input type="text" id="insurance_award_title_key" name="insurance_award_title_key" value="'.$award_title.'" placeholder="Enter Your Title"><br><br>';

		echo '<label for="insurance_award_description_key">Award For : </label>';
		echo '<input type="text" id="insurance_award_description_key" name="insurance_award_description_key" value="'.$award_description.'" placeholder="Best comparison portal 2020"><br><br>';

    echo '<label for="insurance_award_voted_key">Customers Voted : </label>';
    echo '<input type="number" id="insurance_award_voted_key" name="insurance_award_voted_key" value="'.$award_voted.'" placeholder="Enter customers voted"><br><br>';

		echo '<input type="button" class="button button-secondary" value="Upload Support Image" id="company_logo"/><input type="text" id="insurance_award_company_logo_key" name="insurance_award_company_logo_key" value="'.$company_logo.'"/><br><br>';

		echo '<label for="insurance_award_company_description_key">Telephone : </label>';
		echo '<input type="text" id="insurance_award_company_description_key" name="insurance_award_company_description_key" value="'.$company_description.'" placeholder="Enter Company Description"><br><br>';

		echo '<label for="insurance_award_company_rating_key">Rating : </label>';
    echo '<select name="insurance_award_company_rating_key">
      <option value="1" '.selected( '1', $company_rating, false ).'>1 ⭐</option>
			<option value="2" '.selected( '2', $company_rating, false ).'>2 ⭐⭐</option>
			<option value="3" '.selected( '3', $company_rating, false ).'>3 ⭐⭐⭐</option>
			<option value="4" '.selected( '4', $company_rating, false ).'>4 ⭐⭐⭐⭐</option>
			<option value="5" '.selected( '5', $company_rating, false ).'>5 ⭐⭐⭐⭐⭐</option>
		</select><br><br>';
	}
  
}

new Shortcode();