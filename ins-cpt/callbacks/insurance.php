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

  public function insurance_input_callbacks( $post ) {
		wp_nonce_field( 'insurance_save_options_data', 'insurance_details_meta_box_nonce' );

		$batch 			= get_post_meta( $post->ID, '_insurance_batch_key', true );
		$price 			= get_post_meta( $post->ID, '_insurance_price_key', true );
		$price_info = get_post_meta( $post->ID, '_insurance_price_info_key', true );
		$month 			= get_post_meta( $post->ID, '_insurance_month_key', true );
		$rating 		= get_post_meta( $post->ID, '_insurance_rating_key', true );

		$this->input_select('insurance_batch_key', 'Insurance Batch', [
			'standard' => 'Standard',
			'gold' => 'Gold',
			'premium' => 'Premium',
		], $batch);
		// echo '<label for="insurance_batch_key">Insurance Batch : </label>';
		// echo '<select name="insurance_batch_key" class="regular-text">
		// 	<option value="standard" '.selected( 'standard', $batch, false ).'>Standard</option>
		// 	<option value="gold" '.selected( 'gold', $batch, false ).'>Gold</option>
		// 	<option value="premium" '.selected( 'premium', $batch, false ).'>Premium</option>
		// </select><br><br>';

		$this->input_text('insurance_price_key', 'Price', $price, 'Enter Your Insurance Price');

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
	}

	private function input_text($id, $name, $value, $placeholder){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<input type="text" id="insurance_price_key" name="insurance_price_key" value="'.esc_attr($value).'" placeholder="'.$placeholder.'" size="50%"><br><br>';
	}

	private function input_select($id, $name, array $values, $input_key){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<select name="'.$id.'">';
			foreach($values as $key => $value){
				echo '<option value="'.$key.'" '.selected( "$key", $input_key, false ).'>'.$value.'</option>';
				var_dump($input_key);
			}
		echo '</select><br><br>';
	}
}

new Insurance();