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
		add_action( 'init', [ $this, 'setup_updater' ] );

		$this->register_category();

		// Dynamic Tags
		new Dynamic_Tags\Has_Access;
		new Dynamic_Tags\Course_Lesson;
	}

	public function setup_updater()
	{
		include_once AMAUTOR_PATH . '/includes/control/updater.php';

		define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() )
		{
			$config = [
				'slug'               => plugin_basename( AMAUTOR_FILE ),
				'proper_folder_name' => 'amauta-elementor',
				'api_url'            => 'https://api.github.com/repos/AmautaWP/amauta-elementor',
				'raw_url'            => 'https://raw.github.com/AmautaWP/amauta-elementor/master',
				'github_url'         => 'https://github.com/AmautaWP/amauta-elementor',
				'zip_url'            => 'https://github.com/AmautaWP/amauta-elementor/archive/master.zip',
				'sslverify'          => true,
				'requires'           => '5.0',
				'tested'             => '5.3',
				'readme'             => 'README.md',
				'access_token'       => '',
			];

			new \WP_GitHub_Updater( $config );
		}

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