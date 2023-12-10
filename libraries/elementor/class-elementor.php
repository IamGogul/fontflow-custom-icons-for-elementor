<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'FontFlow_WP_Plugin_Elementor' ) ) {

	/**
	 * Define the elementor plugin compatibility.
	 */
    class FontFlow_WP_Plugin_Elementor {

		/**
		 * A reference to an instance of this class.
		 */
		private static $instance = null;

		/**
		 * Returns the instance.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
            }

			return self::$instance;
		}

		/**
		 * Constructor
		 */
        public function __construct() {
			if ( ! did_action( 'elementor/loaded' ) ) {
				return;
			}

			$this->load_modules();

			do_action( 'fontflow-action/plugin/elementor/loaded' );
        }

        /**
         * Load the required dependencies for elementor.
         */
		public function load_modules() {
			$icons_lib = [
				[
					'key'  => 'fontflow_devicons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-devicons.php'
				],
				[
					'key'  => 'fontflow_eleganticons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-eleganticons.php'
				],
				[
					'key'  => 'fontflow_feathericons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-feathericons.php'
				],
				[
					'key'  => 'fontflow_linearicons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-linearicons.php'
				],
				[
					'key'  => 'fontflow_lineicons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-lineicons.php'
				],
				[
					'key'  => 'fontflow_themifyicons',
					'file' => FCIFE_CONST_DIR . 'libraries/elementor/classes/class-themifyicons.php'
				],
			];


			foreach( $icons_lib as $icon_lib ) {
				$option = get_option( $icon_lib['key'] );
				$file   = $icon_lib['file'];

				if( $option && file_exists( $file ) ) {
					require_once $file;
				}
			}
		}

    }

}

if( !function_exists( 'fontflow_wp_plugin_elementor' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_elementor() {

        return FontFlow_WP_Plugin_Elementor::get_instance();
    }
}

fontflow_wp_plugin_elementor();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */