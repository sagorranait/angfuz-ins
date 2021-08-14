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
		$shortcode = '[insurance id="'.get_the_ID().'" title="'.$title.'"]';
		
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
		// First Block
		$this->input_text('insurance_categoryone_key', 'First Block', $categoryone, 'Enter Block Name');
		$this->input_number('insurance_categoryone_number_key', 'Block Limit', $categoryone_number, 'Enter Block Number');
		$this->input_textarea('insurance_categoryone_note_key', 'Block Note', $categoryone_note);
		// Second Block
		$this->input_text('insurance_categorytwo_key', 'Second Block', $categorytwo, 'Enter Block Name');
		$this->input_number('insurance_categorytwo_number_key', 'Block Limit', $categorytwo_number, 'Enter Block Number');
		$this->input_textarea('insurance_categorytwo_note_key', 'Block Note', $categorytwo_note);
		// Third Block
		$this->input_text('insurance_categorythree_key', 'Third Block', $categorythree, 'Enter Block Name');
		$this->input_number('insurance_categorythree_number_key', 'Block Limit', $categorythree_number, 'Enter Block Number');
		$this->input_textarea('insurance_categorythree_note_key', 'Block Note', $categorythree_note);
		// Fourth Block
		$this->input_text('insurance_categoryfour_key', 'Fourth Block', $categoryfour, 'Enter Block Name');
		$this->input_number('insurance_categoryfour_number_key', 'Block Limit', $categoryfour_number, 'Enter Block Number');
		$this->input_textarea('insurance_categoryfour_note_key', 'Block Note', $categoryfour_note);
	}

	public function insurance_supporter_info( $post ) {
		wp_nonce_field( 'insurance_supporter_save_options', 'insurance_support_meta_box_nonce' );

		$supporter_image = get_post_meta( $post->ID, '_insurance_support_image_key', true );
		$supporter_title = get_post_meta( $post->ID, '_insurance_support_title_key', true );
		$supporter_number = get_post_meta( $post->ID, '_insurance_support_number_key', true );
		$supporter_gmail = get_post_meta( $post->ID, '_insurance_support_gamil_key', true );
		$supporter_button = get_post_meta( $post->ID, '_insurance_support_button_key', true );

		$this->input_button('insurance_support_image_key', 'supporter_image', $supporter_image, 'Upload Support Image');
		$this->input_text('insurance_support_title_key', 'Title', $supporter_title, 'Enter Your Title');
		$this->input_number('insurance_support_number_key', 'Telephone', $supporter_number, 'Enter Supporter Number');
		$this->input_email('insurance_support_gamil_key', 'Email', $supporter_gmail, 'Enter Support Email Name');
		$this->input_text('insurance_support_button_key', 'Button Text', $supporter_button, 'Contact Us');
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

		$this->input_button('insurance_award_image_key', 'award_image', $award_image, 'Upload Award Image');
		$this->input_text('insurance_award_title_key', 'Award Title', $award_title, 'Enter Your Title');
		$this->input_text('insurance_award_description_key', 'Award For', $award_description, 'Best comparison portal 2020');
		$this->input_number('insurance_award_voted_key', 'Customers Voted', $award_voted, 'Enter customers voted');
		$this->input_button('insurance_award_company_logo_key', 'company_logo', $company_logo, 'Upload Company Logo');
		$this->input_text('insurance_award_company_description_key', 'Telephone', $company_description, 'Enter Company Description');
		$this->input_select('insurance_award_company_rating_key', 'Rating', $company_rating, 
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

	private function input_email($id, $name, $value, $placeholder){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<input type="email" id="'.$id.'" name="'.$id.'" value="'.esc_attr($value).'" placeholder="'.$placeholder.'" size="50%"><br><br>';
	}

	private function input_number($id, $name, $value, $placeholder){
		echo '<label for="'.$id.'">'.$name.' : </label>';
		echo '<input type="number" id="'.$id.'" name="'.$id.'" value="'.esc_attr($value).'" placeholder="'.$placeholder.'" size="50%"><br><br>';
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

	private function input_button($key, $id, $value, $placeholder){
		echo '<input type="button" class="button button-secondary" value="'.$placeholder.'" id="'.$id.'"/><input type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'"/><br><br>';
	}
  
}

new Shortcode();