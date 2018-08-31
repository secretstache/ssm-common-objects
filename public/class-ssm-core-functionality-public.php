<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.secretstache.com/
 * @since      1.0.0
 *
 * @package    SSM_Core_Functionality
 * @subpackage SSM_Core_Functionality/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    SSM_Core_Functionality
 * @subpackage SSM_Core_Functionality/public
 * @author     Secret Stache Media <alex@secretstache.com>
 */
class SSM_Core_Functionality_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The list of public modules to be included in the core
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
    protected $public_modules;

    /**
	 * The array of arguments in accordance with corresponding public core modules
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $public_modules_functions;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $public_modules, $public_modules_functions ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->public_modules = $public_modules;
        $this->public_modules_functions = $public_modules_functions;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ssm-core-functionality-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ssm-core-functionality-public.js', array( 'jquery' ), $this->version, false );
	}

}
