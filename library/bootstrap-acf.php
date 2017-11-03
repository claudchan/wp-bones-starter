<?php
/*
Plugin Name: Bootstrap for Advanced Custom Fields
Plugin URI: https://github.com/kalenjohnson/wp-acf-bootstrap
Description: This set's up Flexible Content and Repeaters for Bootstrap specific layouts
Version: 0.0.1
Author: Kalen Johnson
Author URI: http://kalenjohnson.com/
License: MIT
Copyright: Kalen Johnson
*/
class Bootstrap_ACF_Sections {
	var $views,
		$count;
	function bootstrap_sections()
	{
		if ( have_rows( 'sections' ) )
		{
			while ( have_rows( 'sections' ) )
			{
				the_row();
				if ( get_row_layout() == 'carousel' )
				{
					$this->slides = get_sub_field( 'slides' );
					if ( ! empty( $this->slides ) )
					{
						include $this->views . 'carousel.php';
					}
				}
				elseif ( get_row_layout() == 'accordion' && have_rows( 'accordion_section' ) )
				{
					include $this->views . 'accordion.php';
				}
				elseif ( get_row_layout() == 'tabs' && have_rows( 'tab_section' ) )
				{
					include $this->views . 'tabs.php';
				}
				$this->count++;
			}
		}
	}
	function __construct()
	{
		$this->views = dirname(__FILE__) . '/views/';
		$this->count = 0;
		if ( class_exists('acf_pro') || function_exists( 'acf_register_flexible_content_field' ) )
		{
			$this->add_action( 'bootstrap-acf', array( $this, 'bootstrap_sections' ) );
		}
	}
	function add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 )
	{
		if ( is_callable( $function_to_add ) )
		{
			add_action( $tag, $function_to_add, $priority, $accepted_args );
		}
	}
}
new Bootstrap_ACF_Sections;







/**
 * @title Bootstrap ACF Flexible Content fields
 * @description Straight export of Flexible Content. Includes Accordions, Carousels, and Tabs
 * @version 0.0.1
 * @date 07/04/2014
 */

if ( function_exists( "register_field_group" ) ) {
	register_field_group( array(
		'id'         => 'acf_bootstrap-sections',
		'title'      => 'Bootstrap Sections',
		'fields'     => array(
			array(
				'key'          => 'field_53b6f7c57d8bc',
				'label'        => 'Sections',
				'name'         => 'sections',
				'type'         => 'flexible_content',
				'layouts'      => array(
					array(
						'label'      => 'Carousel',
						'name'       => 'carousel',
						'display'    => 'row',
						'min'        => '',
						'max'        => '',
						'sub_fields' => array(
							array(
								'key'           => 'field_53b6fe807d8bd',
								'label'         => 'Full Width',
								'name'          => 'full_width',
								'type'          => 'true_false',
								'column_width'  => '',
								'message'       => '',
								'default_value' => 1,
							),
							array(
								'key'           => 'field_53b6ff407d8c0',
								'label'         => 'Carousel Controls',
								'name'          => 'carousel_controls',
								'type'          => 'true_false',
								'column_width'  => '',
								'message'       => '',
								'default_value' => 1,
							),
							array(
								'key'           => 'field_53b6ff627d8c1',
								'label'         => 'Carousel Indicators',
								'name'          => 'carousel_indicators',
								'type'          => 'true_false',
								'column_width'  => '',
								'message'       => '',
								'default_value' => 1,
							),
							array(
								'key'          => 'field_53b6fee57d8be',
								'label'        => 'Slides',
								'name'         => 'slides',
								'type'         => 'repeater',
								'column_width' => '',
								'sub_fields'   => array(
									array(
										'key'          => 'field_53b6ff1c7d8bf',
										'label'        => 'Image',
										'name'         => 'image',
										'type'         => 'image',
										'required'     => 1,
										'column_width' => '',
										'save_format'  => 'object',
										'preview_size' => 'medium',
										'library'      => 'all',
									),
									array(
										'key'           => 'field_53b6ffc87d8c2',
										'label'         => 'Caption',
										'name'          => 'caption',
										'type'          => 'wysiwyg',
										'instructions'  => 'Optional',
										'column_width'  => '',
										'default_value' => '',
										'toolbar'       => 'full',
										'media_upload'  => 'yes',
									),
								),
								'row_min'      => '',
								'row_limit'    => '',
								'layout'       => 'table',
								'button_label' => 'Add Slide',
							),
						),
					),
					array(
						'label'      => 'Accordion',
						'name'       => 'accordion',
						'display'    => 'row',
						'min'        => '',
						'max'        => '',
						'sub_fields' => array(
							array(
								'key'          => 'field_53b705ca7d8c4',
								'label'        => 'Accordion Section',
								'name'         => 'accordion_section',
								'type'         => 'repeater',
								'column_width' => '',
								'sub_fields'   => array(
									array(
										'key'           => 'field_53b705dd7d8c5',
										'label'         => 'Title',
										'name'          => 'title',
										'type'          => 'text',
										'column_width'  => '',
										'default_value' => '',
										'placeholder'   => '',
										'prepend'       => '',
										'append'        => '',
										'formatting'    => 'html',
										'maxlength'     => '',
									),
									array(
										'key'           => 'field_53b705ff7d8c6',
										'label'         => 'Content',
										'name'          => 'content',
										'type'          => 'wysiwyg',
										'column_width'  => '',
										'default_value' => '',
										'toolbar'       => 'full',
										'media_upload'  => 'yes',
									),
								),
								'row_min'      => '',
								'row_limit'    => '',
								'layout'       => 'row',
								'button_label' => 'Add Accordion Section',
							),
						),
					),
					array(
						'label'      => 'Tabs',
						'name'       => 'tabs',
						'display'    => 'row',
						'min'        => '',
						'max'        => '',
						'sub_fields' => array(
							array(
								'key'          => 'field_53b7064f7d8c8',
								'label'        => 'Tab Section',
								'name'         => 'tab_section',
								'type'         => 'repeater',
								'column_width' => '',
								'sub_fields'   => array(
									array(
										'key'           => 'field_53b706707d8c9',
										'label'         => 'Title',
										'name'          => 'title',
										'type'          => 'text',
										'column_width'  => '',
										'default_value' => '',
										'placeholder'   => '',
										'prepend'       => '',
										'append'        => '',
										'formatting'    => 'html',
										'maxlength'     => '',
									),
									array(
										'key'           => 'field_53b707d77d8cb',
										'label'         => 'Content',
										'name'          => 'content',
										'type'          => 'wysiwyg',
										'column_width'  => '',
										'default_value' => '',
										'toolbar'       => 'full',
										'media_upload'  => 'yes',
									),
								),
								'row_min'      => '',
								'row_limit'    => '',
								'layout'       => 'row',
								'button_label' => 'Add Tab Section',
							),
							array(
								'key'           => 'field_53b707037d8ca',
								'label'         => 'Active Tab',
								'name'          => 'active_tab',
								'type'          => 'select',
								'column_width'  => '',
								'choices'       => array(),
								'default_value' => '',
								'allow_null'    => 1,
								'multiple'      => 0,
							),
						),
					),
				),
				'button_label' => 'Add New Section',
				'min'          => '',
				'max'          => '',
			),
		),
		'location'   => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-bootstrap-acf.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options'    => array(
			'position'       => 'acf_after_title',
			'layout'         => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	) );
}

?>