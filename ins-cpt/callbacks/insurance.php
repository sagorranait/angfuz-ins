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

		$this->input_select('insurance_batch_key', 'Insurance Batch', $batch, 
			[
				'standard' => 'Standard',
				'gold' => 'Gold',
				'premium' => 'Premium',
			]
		);

		$this->input_text('insurance_price_key', 'Price', $price, 'Enter Your Insurance Price');

		$this->input_select('insurance_month_key', 'Time', $month, 
			[
				'month' => 'month',
				'year' => 'year',
				'day' => 'day',
			]
		);

		$this->input_textarea('insurance_price_info_key', 'Price Note', $price_info);

		$this->input_select('insurance_rating_key', 'Rating', $rating, 
			[
				'1' => '1 ⭐',
				'2' => '2 ⭐⭐',
				'3' => '3 ⭐⭐⭐',
				'4' => '4 ⭐⭐⭐⭐',
				'5' => '5 ⭐⭐⭐⭐⭐',
			]
		);
	}

	private function input_text($id, $name, $value, $placeholder){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<input type="text" id="'.$id.'" name="'.$id.'" value="'.esc_attr($value).'" placeholder="'.$placeholder.'" size="50%"><br><br>';
	}

	private function input_textarea($id, $name, $value){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<textarea id="'.$id.'" name="'.$id.'" rows="2" cols="50">'.esc_attr($value).'</textarea><br><br>';
	}

	private function input_select($id, $name, $selected, array $values){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<select name="'.$id.'">';
			foreach($values as $key => $value){
				echo '<option value="'.$key.'" '.selected( "$key", $selected, false ).'>'.$value.'</option>';
			}
		echo '</select><br><br>';
	}
}

new Insurance();