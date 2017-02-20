<?php
/*
Plugin Name: PMPro Customization: Add NIF
Plugin URI: https://github.com/MiquelAdell/PMPro-Customization-Add-NIF
Description: Add NIF requisite on new subscriptions
Version: .1
Author: Miquel Adell
Author URI: http://www.miqueladell.com
*/
//we have to put everything in a function called on init, so we are sure Register Helper is loaded
function my_pmprorh_init()
{
	//don't break if Register Helper is not loaded
	if(!function_exists( 'pmprorh_add_registration_field' )) {
		return false;
	}

	//define the fields
	$fields = array();
	$fields[] = new PMProRH_Field(
		'nif',						// input name, will also be used as meta key
		'text',							// type of field
		array(
			'label'		=> __('NIF','pmpro-custom-add-nif')	,		// custom field label
			'size'		=> 40,				// input size
			'class'		=> 'nif',			// custom class
			'profile'	=> true,			// show in user profile
			"memberslistcsv"    =>  true,                  // Let field be included in "Member List" CSV export (true | false)
			'required'	=> true			// make this field required
		)
	);

	//add the fields into a new checkout_boxes are of the checkout page
	foreach($fields as $field)
		pmprorh_add_registration_field(
			'after_billing_fields',			// location on checkout page
			$field						// PMProRH_Field object
		);
	//that's it. see the PMPro Register Helper readme for more information and examples.
}
add_action( 'init', 'my_pmprorh_init' );
