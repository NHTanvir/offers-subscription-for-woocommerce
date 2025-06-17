<?php
/**
 * All settings related functions
 */
namespace Codexpert\OffersSubscriptionForWoocommerce\App;
use Codexpert\OffersSubscriptionForWoocommerce\Helper;
use Codexpert\Plugin\Base;
use Codexpert\Plugin\Settings as Settings_API;

/**
 * @package Plugin
 * @subpackage Settings
 * @author Codexpert <hi@codexpert.io>
 */
class Settings extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}
	
	public function init_menu() {
		
		$site_config = [
			'PHP Version'				=> PHP_VERSION,
			'WordPress Version' 		=> get_bloginfo( 'version' ),
			'WooCommerce Version'		=> is_plugin_active( 'woocommerce/woocommerce.php' ) ? get_option( 'woocommerce_version' ) : 'Not Active',
			'Memory Limit'				=> defined( 'WP_MEMORY_LIMIT' ) && WP_MEMORY_LIMIT ? WP_MEMORY_LIMIT : 'Not Defined',
			'Debug Mode'				=> defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled',
			'Active Plugins'			=> get_option( 'active_plugins' ),
		];

		$settings = [
			'id'            => $this->slug,
			'label'         => $this->name,
			'title'         => "{$this->name} v{$this->version}",
			'header'        => $this->name,
			// 'parent'     => 'woocommerce',
			// 'priority'   => 10,
			// 'capability' => 'manage_options',
			// 'icon'       => 'dashicons-wordpress',
			// 'position'   => 25,
			// 'topnav'	=> true,
			'sections'      => [
				'offers-subscription-for-woocommerce_basic'	=> [
					'id'        => 'offers-subscription-for-woocommerce_basic',
					'label'     => __( 'Basic Settings', 'offers-subscription-for-woocommerce' ),
					'icon'      => 'dashicons-admin-tools',
					// 'color'		=> '#4c3f93',
					'sticky'	=> false,
					'fields'    => [
						'sample_text' => [
							'id'        => 'sample_text',
							'label'     => __( 'Text Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'text',
							'desc'      => __( 'This is a text field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'default'   => 'Hello World!',
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
						],
						'sample_number' => [
							'id'      => 'sample_number',
							'label'     => __( 'Number Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'number',
							'desc'      => __( 'This is a number field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'default'   => 10,
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
						],
						'sample_email' => [
							'id'      => 'sample_email',
							'label'     => __( 'Email Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'email',
							'desc'      => __( 'This is an email field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'default'   => 'john@doe.com',
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
						],
						'sample_url' => [
							'id'      => 'sample_url',
							'label'     => __( 'URL Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'url',
							'desc'      => __( 'This is a url field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'default'   => 'https://johndoe.com',
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
						],
						'sample_password' => [
							'id'      => 'sample_password',
							'label'     => __( 'Password Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'password',
							'desc'      => __( 'This is a password field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
							'default'   => 'uj34h'
						],
						'sample_textarea' => [
							'id'      => 'sample_textarea',
							'label'     => __( 'Textarea Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'textarea',
							'desc'      => __( 'This is a textarea field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'columns'   => 24,
							'rows'      => 5,
							'default'   => 'lorem ipsum dolor sit amet',
							'readonly'  => false, // true|false
							'disabled'  => false, // true|false
						],
						'sample_radio' => [
							'id'      => 'sample_radio',
							'label'     => __( 'Radio Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'radio',
							'desc'      => __( 'This is a radio field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'item_1'  => 'Item One',
								'item_2'  => 'Item Two',
								'item_3'  => 'Item Three',
							],
							'default'   => 'item_2',
							'disabled'  => false, // true|false
						],
						'sample_select' => [
							'id'      => 'sample_select',
							'label'     => __( 'Select Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'This is a select field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => 'option_2',
							'disabled'  => false, // true|false
							'multiple'  => false, // true|false
						],
						'sample_multiselect' => [
							'id'      => 'sample_multiselect',
							'label'     => __( 'Multi-select Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'This is a multiselect field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => [ 'option_2', 'option_3' ],
							'disabled'  => false, // true|false
							'multiple'  => true, // true|false
						],
						'sample_checkbox' => [
							'id'      => 'sample_checkbox',
							'label'     => __( 'Checkbox Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'checkbox',
							'desc'      => __( 'This is a checkbox field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'default'   => 'on'
						],
						'sample_multicheck' => [
							'id'      => 'sample_multicheck',
							'label'     => __( 'Multi-check Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'checkbox',
							'desc'      => __( 'This is a multi-check field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => [ 'option_2' ],
							'disabled'  => false, // true|false
							'multiple'  => true, // true|false
						],
						'sample_switch' => [
							'id'      => 'sample_switch',
							'label'     => __( 'Switch Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'switch',
							'desc'      => __( 'This is a switch field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'default'   => 'on'
						],
						'sample_multiswitch' => [
							'id'      => 'sample_multiswitch',
							'label'     => __( 'Multi-switch Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'switch',
							'desc'      => __( 'This is a multi-switch field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => [ 'option_2' ],
							'disabled'  => false, // true|false
							'multiple'  => true, // true|false
						],
						'sample_range' => [
							'id'      => 'sample_range',
							'label'     => __( 'Range Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'range',
							'desc'      => __( 'This is a range field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'min'		=> 0,
							'max'		=> 16,
							'step'		=> 2,
							'default'   => 4,
						],
						'sample_date' => [
							'id'      => 'sample_date',
							'label'     => __( 'Date Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'date',
							'desc'      => __( 'This is a date field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'default'   => '1971-12-16',
						],
						'sample_time' => [
							'id'      => 'sample_time',
							'label'     => __( 'Time Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'time',
							'desc'      => __( 'This is a time field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'default'   => '15:45',
						],
						'sample_color' => [
							'id'      => 'sample_color',
							'label'     => __( 'Color Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'color',
							'desc'      => __( 'This is a color field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							// 'default'   => '#f0f'
						],
						'sample_wysiwyg' => [
							'id'      => 'sample_wysiwyg',
							'label'     => __( 'WYSIWYG Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'wysiwyg',
							'desc'      => __( 'This is a wysiwyg field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'width'     => '100%',
							'rows'      => 5,
							'teeny'     => true,
							'text_mode'     => false, // true|false
							'media_buttons' => false, // true|false
							'default'       => 'Hello World'
						],
						'sample_file' => [
							'id'      => 'sample_file',
							'label'     => __( 'File Field' ),
							'type'      => 'file',
							'upload_button'     => __( 'Choose File', 'offers-subscription-for-woocommerce' ),
							'select_button'     => __( 'Select File', 'offers-subscription-for-woocommerce' ),
							'desc'      => __( 'This is a file field.', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'disabled'  => false, // true|false
							'default'   => 'http://example.com/sample/file.txt'
						],
					]
				],
				'offers-subscription-for-woocommerce_advanced'	=> [
					'id'        => 'offers-subscription-for-woocommerce_advanced',
					'label'     => __( 'Advanced Settings', 'offers-subscription-for-woocommerce' ),
					'icon'      => 'dashicons-admin-generic',
					// 'color'		=> '#d30c5c',
					'sticky'	=> false,
					'fields'    => [
						'sample_select3' => [
							'id'      => 'sample_select3',
							'label'     => __( 'Select with Chosen', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'jQuery Chosen plugin enabled. <a href="https://harvesthq.github.io/chosen/" target="_blank">[See more]</a>', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => Helper::get_posts( [ 'post_type' => 'page' ], false, true ),
							'default'   => 2,
							'disabled'  => false, // true|false
							'multiple'  => false, // true|false
							'chosen'    => true
						],
						'sample_multiselect3' => [
							'id'      => 'sample_multiselect3',
							'label'     => __( 'Multi-select with Chosen', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'jQuery Chosen plugin enabled. <a href="https://harvesthq.github.io/chosen/" target="_blank">[See more]</a>', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => [ 'option_2', 'option_3' ],
							'disabled'  => false, // true|false
							'multiple'  => true, // true|false
							'chosen'    => true
						],
						'sample_select2' => [
							'id'      => 'sample_select2',
							'label'     => __( 'Select with Select2', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'jQuery Select2 plugin enabled. <a href="https://select2.org/" target="_blank">[See more]</a>', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => 'option_2',
							'disabled'  => false, // true|false
							'multiple'  => false, // true|false
							'select2'   => true
						],
						'sample_multiselect2' => [
							'id'      => 'sample_multiselect2',
							'label'     => __( 'Multi-select with Select2', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'jQuery Select2 plugin enabled. <a href="https://select2.org/" target="_blank">[See more]</a>', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'default'   => [ 'option_2', 'option_3' ],
							'disabled'  => false, // true|false
							'multiple'  => true, // true|false
							'select2'   => true
						],
						'sample_group' => [
							'id'      => 'sample_group',
							'label'     => __( 'Field Group' ),
							'type'      => 'group',
							'desc'      => __( 'A group of fields.', 'offers-subscription-for-woocommerce' ),
							'items'     => [
								'sample_group_select1' => [
									'id'      => 'sample_group_select1',
									'label'     => __( 'First Item', 'offers-subscription-for-woocommerce' ),
									'type'      => 'select',
									'options'   => [
										'option_1'  => 'Option One',
										'option_2'  => 'Option Two',
										'option_3'  => 'Option Three',
									],
									'default'   => 'option_2',
								],
								'sample_group_select2' => [
									'id'      => 'sample_group_select2',
									'label'     => __( 'Second Item', 'offers-subscription-for-woocommerce' ),
									'type'      => 'select',
									'options'   => [
										'option_1'  => 'Option One',
										'option_2'  => 'Option Two',
										'option_3'  => 'Option Three',
									],
									'default'   => 'option_1',
								],
								'sample_group_select3' => [
									'id'      => 'sample_group_select3',
									'label'     => __( 'Third Item', 'offers-subscription-for-woocommerce' ),
									'type'      => 'select',
									'options'   => [
										'option_1'  => 'Option One',
										'option_2'  => 'Option Two',
										'option_3'  => 'Option Three',
									],
									'default'   => 'option_3',
								],
							],
						],
						'sample_conditional' => [
							'id'      => 'sample_conditional',
							'label'     => __( 'Conditional Field', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'options'   => [
								'option_1'  => 'Option One',
								'option_2'  => 'Option Two',
								'option_3'  => 'Option Three',
							],
							'desc'      => __( 'Shows up if the third option in the  \'Field Group\' above is set as \'Option Two\'', 'offers-subscription-for-woocommerce' ),
							'default'   => 'option_2',
							'condition'	=> [
								'key'		=> 'sample_group_select3',
								'value'		=> 'option_2',
								'compare'	=> '==',
							]
						],
						'sample_repeater'	=> [
							'id'		=> 'sample_repeater',
							'label'		=> __( 'Sample Repeater' ),
							'type'		=> 'repeater',
							'items'		=> [
								'text_repeat' => [
									'id'		=> 'text_repeat',
									'label'		=> __( 'Repeat Text Field', 'offers-subscription-for-woocommerce' ),
									'type'		=> 'text',
									'placeholder'=> __( 'Repeat Text', 'offers-subscription-for-woocommerce' ),
									'desc'		=> __( 'This field will be repeated.', 'offers-subscription-for-woocommerce' ),
								],
								'number_repeat' => [
									'id'		=> 'number_repeat',
									'label'		=> __( 'Repeat Number Field', 'offers-subscription-for-woocommerce' ),
									'type'		=> 'number',
									'placeholder'=> __( 'Repeat Number', 'offers-subscription-for-woocommerce' ),
									'desc'		=> __( 'This field will be repeated.', 'offers-subscription-for-woocommerce' ),
								],
							]
						],
						'sample_tabs' => [
							'id'      => 'sample_tabs',
							'label'     => __( 'Sample Tabs' ),
							'type'      => 'tabs',
							'items'     => [
								'sample_tab1' => [
									'id'      => 'sample_tab1',
									'label'     => __( 'First Tab', 'offers-subscription-for-woocommerce' ),
									'fields'    => [
										'sample_tab1_email' => [
											'id'      => 'sample_tab1_email',
											'label'     => __( 'Tab Email Field', 'offers-subscription-for-woocommerce' ),
											'type'      => 'email',
											'desc'      => __( 'This is an email field.', 'offers-subscription-for-woocommerce' ),
											// 'class'     => '',
											'default'   => 'john@doe.com',
											'readonly'  => false, // true|false
											'disabled'  => false, // true|false
										],
										'sample_tab1_url' => [
											'id'      => 'sample_tab1_url',
											'label'     => __( 'Tab URL Field', 'offers-subscription-for-woocommerce' ),
											'type'      => 'url',
											'desc'      => __( 'This is a url field.', 'offers-subscription-for-woocommerce' ),
											// 'class'     => '',
											'default'   => 'https://johndoe.com',
											'readonly'  => false, // true|false
											'disabled'  => false, // true|false
										],
									],
								],
								'sample_tab2' => [
									'id'      => 'sample_tab2',
									'label'     => __( 'Second Tab', 'offers-subscription-for-woocommerce' ),
									'fields'    => [
										'sample_tab2_text' => [
											'id'        => 'sample_tab2_text',
											'label'     => __( 'Tab Text Field', 'offers-subscription-for-woocommerce' ),
											'type'      => 'text',
											'desc'      => __( 'This is a text field.', 'offers-subscription-for-woocommerce' ),
											// 'class'     => '',
											'default'   => 'Hello World!',
											'readonly'  => false, // true|false
											'disabled'  => false, // true|false
										],
										'sample_tab2_number' => [
											'id'      => 'sample_tab2_number',
											'label'     => __( 'Tab Number Field', 'offers-subscription-for-woocommerce' ),
											'type'      => 'number',
											'desc'      => __( 'This is a number field.', 'offers-subscription-for-woocommerce' ),
											// 'class'     => '',
											'default'   => 10,
											'readonly'  => false, // true|false
											'disabled'  => false, // true|false
										],
									],
								],
							],
						],
					]
				],
				'offers-subscription-for-woocommerce_tools'	=> [
					'id'        => 'offers-subscription-for-woocommerce_tools',
					'label'     => __( 'Tools', 'offers-subscription-for-woocommerce' ),
					'icon'      => 'dashicons-hammer',
					'sticky'	=> false,
					'fields'    => [
						'enable_debug' => [
							'id'      	=> 'enable_debug',
							'label'     => __( 'Enable Debug', 'offers-subscription-for-woocommerce' ),
							'type'      => 'switch',
							'desc'      => __( 'Enable this if you face any CSS or JS related issues.', 'offers-subscription-for-woocommerce' ),
							'disabled'  => false,
						],
						'report' => [
							'id'      => 'report',
							'label'     => __( 'Report', 'offers-subscription-for-woocommerce' ),
							'type'      => 'textarea',
							'desc'     	=> '<button id="offers-subscription-for-woocommerce_report-copy" class="button button-primary"><span class="dashicons dashicons-admin-page"></span></button>',
							'columns'   => 24,
							'rows'      => 10,
							'default'   => json_encode( $site_config, JSON_PRETTY_PRINT ),
							'readonly'  => true,
						],
					]
				],
				'offers-subscription-for-woocommerce_table' => [
					'id'        => 'offers-subscription-for-woocommerce_table',
					'label'     => __( 'Table', 'offers-subscription-for-woocommerce' ),
					'icon'      => 'dashicons-editor-table',
					// 'color'		=> '#28c9ee',
					'hide_form'	=> true,
					'template'  => Offers_Subscription_For_WooCommerce_DIR . '/views/settings/table.php',
				],
			],
		];

		new Settings_API( $settings );
	}
}