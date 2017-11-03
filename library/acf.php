<?php
/*
	ACF Advanced Custom Fields Setup
*/

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_59f825138b0a0',
	'title' => 'JavaScript Setting',
	'fields' => array (
		array (
			'key' => 'field_59f1acd24e149',
			'label' => 'Bottom Script',
			'name' => 'bottom_script',
			'type' => 'textarea',
			'value' => NULL,
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'administrator',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
	),
	'active' => 1,
	'description' => '',
));

endif;






/* DON'T DELETE THIS CLOSING TAG */ ?>