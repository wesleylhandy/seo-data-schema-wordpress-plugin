<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5ee7ced5b9506',
	'title' => 'FAQs',
	'fields' => array(
		array(
			'key' => 'field_5ee7cee20a505',
			'label' => 'Frequently Asked Questions',
			'name' => 'faqs',
			'type' => 'repeater',
			'instructions' => 'This should include a mix of informational, marketing, and urgent questions. The right types of questions will not only inform users but increase the SEO value of the site. Remember, people come to search engines to ask questions and find answers. What questions does your site answer? Ask and answer those questions here.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_5ee7cefd0a506',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Add Questions',
			'sub_fields' => array(
				array(
					'key' => 'field_5ee7cefd0a506',
					'label' => 'Question',
					'name' => 'question',
					'type' => 'text',
					'instructions' => 'The full text of the question',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5ee7cf1c0a507',
					'label' => 'Answer',
					'name' => 'answer',
					'type' => 'wysiwyg',
					'instructions' => 'The answer to the provided question',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'faqs-settings',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_graphql' => 1,
	'graphql_field_name' => 'faq',
));

endif;