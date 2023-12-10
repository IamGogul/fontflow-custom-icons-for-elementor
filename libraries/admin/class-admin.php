<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'FontFlow_WP_Plugin_Admin' ) ) {

	/**
	 * Define the admin utils for this plugin.
	 */
    class FontFlow_WP_Plugin_Admin {

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

            if( !is_admin() ) {
                return;
			}

			add_filter( 'plugin_action_links_fontflow-custom-icons-for-elementor/fontflow-custom-icons-for-elementor.php', [ $this, 'plugin_action_links' ], 10, 2 );

        }

		/**
		 * Add additional links below each plugin on the plugins page.
		 */
		public function plugin_action_links( $actions, $plugin_file ) {

			if( FCIFE_CONST_BASENAME === $plugin_file ) {

				$links   = [
					'settings' => sprintf('<a href="%1$s">%2$s</a>',
						esc_url(
							add_query_arg( [
								'page' => 'fontflow'
							],
							admin_url( 'admin.php' ) )
						),
						esc_html__( 'Settings', 'fontflow' ),
					)
				];

				$actions = array_merge( $links, $actions );
			}

			return $actions;
		}

    }

}

if( !function_exists( 'fontflow_wp_plugin_admin' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_admin() {

        return FontFlow_WP_Plugin_Admin::get_instance();
    }
}

fontflow_wp_plugin_admin();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */