tmm-comment-notifications
=========================

Send comment notifications to specific users for EVERY comment that is posted on a site or sub-site. Uses Advanced Custom Fields. Multi-site ready!

To use this plugin out of the box, you need an Advanced Custom Fields "Options" page with a repeater field with a text field called, "acf_list-of-emails-to-receive-comment-notifications".

Below is the Advanced Custom Fields sample code that lives in functions.php:


	/**for Email notifications page**/
	register_field_group(array (
		'id' => 'acf_list-of-emails-to-receive-comment-notifications',
		'title' => 'List of Emails To Receive Comment Notifications',
		'fields' => array (
			array (
				'key' => 'field_535ab35d2fc06',
				'label' => 'Emails To Be Notified',
				'name' => 'emails_to_be_notified',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_535ab3932fc07',
						'label' => 'Email Address',
						'name' => 'email_address',
						'type' => 'email',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => -1,
	));
