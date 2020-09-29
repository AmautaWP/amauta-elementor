<?php

namespace Amautor;

class Controller
{

	public function __construct()
	{
		add_action( 'plugins_loaded', [ $this, 'localize' ] );

	}

	public function localize()
	{
		load_textdomain( 'teachers', AMAUTOR_PATH .'/languages/amautor-'. get_locale() .'.mo' );
		load_plugin_textdomain( 'teachers', false, dirname( plugin_basename( AMAUTOR_FILE ) ) . '/languages' );
	}

	public function setup()
	{
		$this->register_category();

		// Dynamic Tags
		new Dynamic_Tags\Has_Access;
		new Dynamic_Tags\Course_Lesson;
	}

	public function register_category()
	{
		add_action( 
			'elementor/init',
			function()
			{
				\Elementor\Plugin::$instance->elements_manager->add_category( 
					'amauta',
					[
						'title' => __( 'Amauta', 'amautor' ),
						'icon' => 'fa fa-plug', //default icon
					],
					2 // position
				);
			}
		);
	}
}