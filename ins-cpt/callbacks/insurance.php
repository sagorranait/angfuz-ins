<?php
namespace Angfuz_Ins\Ins_Cpt\Callbacks;

defined( 'ABSPATH' ) || exit;

/**
 * Angfuz_Ins - Insurance Callback Class.
 * Initiate all necessary Cpt options and fields.
 *
 * @since 1.0.0
 */
class Insurance{
  /**
    * Show all the input on Editor.
    *
    * @since 1.0.0
    * @access public
  */
  public function insurance_input_callbacks( $post ) {
		wp_nonce_field( 'insurance_save_options_data', 'insurance_details_meta_box_nonce' );

		$price = get_post_meta( $post->ID, '_insurance_price_key', true );
		$price_info = get_post_meta( $post->ID, '_insurance_price_info_key', true );
		$month = get_post_meta( $post->ID, '_insurance_month_key', true );
		$rating = get_post_meta( $post->ID, '_insurance_rating_key', true );
		$complatebtn = get_post_meta( $post->ID, '_insurance_complete_btn_key', true );
		$quotebtn = get_post_meta( $post->ID, '_insurance_quote_btn_key', true );
		
		echo '<label for="insurance_price_key">Price : </label>';
		echo '<input type="text" id="insurance_price_key" name="insurance_price_key" value="'.esc_attr($price).'" placeholder="Enter Your Insurance Price" size="50%"><br><br>';

		echo '<label for="insurance_month_key">Time : </label>';
		echo '<select name="insurance_month_key" class="regular-text">
			<option value="month" '.selected( 'month', $month, false ).'>month</option>
			<option value="year" '.selected( 'year', $month, false ).'>year</option>
			<option value="day" '.selected( 'day', $month, false ).'>day</option>
		</select><br><br>';

		echo '<label for="insurance_price_info_key">Price Note : </label>';
		echo '<textarea id="insurance_price_info_key" name="insurance_price_info_key" rows="2" cols="50">'.esc_attr($price_info).'</textarea><br><br>';

		echo '<label for="insurance_rating_key">Rating : </label>';
    echo '<select name="insurance_rating_key" class="regular-text">
      <option value="1" '.selected( '1', $rating, false ).'>1 ⭐</option>
			<option value="2" '.selected( '2', $rating, false ).'>2 ⭐⭐</option>
			<option value="3" '.selected( '3', $rating, false ).'>3 ⭐⭐⭐</option>
			<option value="4" '.selected( '4', $rating, false ).'>4 ⭐⭐⭐⭐</option>
			<option value="5" '.selected( '5', $rating, false ).'>5 ⭐⭐⭐⭐⭐</option>
		</select><br><br>';

		echo '<label for="insurance_complete_btn_key">First Button : </label>';
		echo '<input type="text" id="insurance_complete_btn_key" name="insurance_complete_btn_key" value="'.esc_attr($complatebtn).'" placeholder="Complete Online" size="50%"><br><br>';

		echo '<label for="insurance_quote_btn_key">Second Button : </label>';
		echo '<input type="text" id="insurance_quote_btn_key" name="insurance_quote_btn_key" value="'.esc_attr($quotebtn).'" placeholder="Reaquest a quote" size="50%"><br><br>';
	}
}

new Insurance();