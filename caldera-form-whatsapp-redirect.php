<?php
/*
Plugin Name:  Caldera Form WhatsApp Redirect
Plugin URI:   https://github.com/yeyenpamula
Description:  Caldera Forms processor to redirect form message to WhatsApp
Version:      1.0.0
Author:       Yeyen Pamula
Author URI:   https://tsabitlabs.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  caldera-form-whatsapp-redirect
Domain Path:  /languages
*/

/**
 * Register processor
 */
add_filter( 'caldera_forms_get_form_processors', function( $processors ) {
	$processors['my_processor_extra_meta'] 	= array(
		'name'              =>  'Contact Form to WhatsApp',
		'description'       =>  'Contact Form Owner Properties',
		'processor'	    	=>  'my_redirect', //'my_processor_contact_form_owner_processor',
		'pre_processor'		=>	'my_set_url',
		'template' 			=> __DIR__ . '/config.php'
	);
	return $processors;
} );

function my_set_url( $config, $form, $processor_id ) {
	global $transdata;

	$number = Caldera_Forms::do_magic_tags( $config[ 'owner_whatsapp_number' ] );
	$text = Caldera_Forms::do_magic_tags( $config[ 'whatsapp_message' ] );

	if($number == '') {
		$phone = '6285728853510';
	} else {
		$phone = $number;
	}

	$transdata[ 'my_slug' ][ 'url' ] = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$text;
	return array(
		'type' => 'success'
	);

	// default number 447824633445
}

/**
 * At process, get the post ID and the data and save in post meta
 *
 * @param array $config Processor config
 * @param array $form Form config
 * @param string $process_id Unique process ID for this submission
 *
 * @return void|array
 */
function my_processor_contact_form_owner_processor( $config, $form, $process_id ){

	/*$post_id = Caldera_Forms::do_magic_tags( $config[ 'post' ] );
	$field_value = Caldera_Forms::do_magic_tags( $config[ 'field' ] );

	if( is_numeric( $post_id ) && is_object( $post = get_post( $post_id )  ) ){
		update_post_meta( $post_id, 'extra_meta_field', $field_value );
	}*/

	$nama = Caldera_Forms::do_magic_tags( $config[ 'owner_whatsapp_number' ] );
	$pesan = Caldera_Forms::do_magic_tags( $config[ 'whatsapp_message' ] );

}


/**
 * Setup fields to pass to Caldera_Forms_Processor_UI::config_fields() in config
 *
 * @return array
 */
function my_processor_contact_form_owner_processor_fields(){
	return array(
		array(
			'id'   => 'owner_whatsapp_number',
			'label' => 'Owner WhatsApp Number',
			'type' => 'text',
			'required' => true,
			'magic' => true,
		),
		array(
			'id'   => 'whatsapp_message',
			'label' => 'WhatsApp Message',
			'type' => 'textarea',
			'required' => true,
			'magic' => true,
			'extra_classes' => array('row' => 6),
		),
	);
}

add_filter( 'caldera_forms_submit_return_redirect', 'my_redirect', 10, 4 );
function my_redirect($form, $config, $process_id ){
	global $transdata;
	if ( ! empty( $transdata[ 'my_slug' ] ) && ! empty( $transdata[ 'my_slug' ][ 'url' ] ) ) {
		return $transdata[ 'my_slug' ][ 'url' ];
	}

	//return $url;
}