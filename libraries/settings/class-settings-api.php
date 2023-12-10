<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'FontFlow_WP_Plugin_Settings' ) ) {

	/**
	 * Define the locale for this plugin for internationalization.
	 */
    class FontFlow_WP_Plugin_Settings {

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

            add_action('admin_enqueue_scripts', [ $this, 'load_assets' ]);
            add_action( 'admin_menu', [ $this, 'admin_menus' ], 100 );

            add_action( 'wp_ajax_fontflow-action/plugin/settings/update', [ $this, 'update_settings' ] );


			do_action( 'fontflow-action/plugin/settings/loaded' );
        }

        public function load_assets( $hook ) {

            if( 'elementor_page_fontflow' === $hook ) {

                wp_localize_script( 'jquery', 'FCIFE_OBJ', [
                    'pluginName'       => FCIFE_CONST_PLUGIN_NAME,
                    'pluginVersion'    => FCIFE_CONST_VERSION,
                    'settingNonceName' => FCIFE_CONST_SAN_PLUGIN_NAME,
                    'error'            => esc_html__( 'something went wrong.', 'fontflow' ),
                    'settingNonceVal'  => wp_create_nonce( FCIFE_CONST_SAN_PLUGIN_NAME ),
                    'ajax'             => esc_url( admin_url('admin-ajax.php') ),
                ]);

                wp_enqueue_script( 'fontflow-admin', FCIFE_CONST_URL . 'assets/js/admin.min.js', [ 'jquery' ] );
                wp_enqueue_style( 'fontflow-admin', FCIFE_CONST_URL . 'assets/css/admin.min.css', false, FCIFE_CONST_VERSION );

            }
        }

        public function admin_menus() {
            add_submenu_page(
                'elementor',
                esc_html__( '🎖️ FontFlow', 'fontflow' ),
                esc_html__( '🎖️ FontFlow', 'fontflow' ),
                'manage_options',
                'fontflow',
                [ $this, 'welcome_screen' ],
                5
            );
        }

        public function welcome_screen() {
			require_once FCIFE_CONST_DIR . 'libraries/settings/class-welcome-screen.php';
        }

        public function update_settings() {
            $nonce_name = sanitize_text_field( $_POST['nonceName'] );

            check_ajax_referer( $nonce_name, 'nonce' );
            $key = sanitize_text_field( $_POST['key'] );

            if( !empty( $key ) ) {
                $setting = get_option( $key, false );

                if( !$setting ) {
                    update_option( $key, true );
                    wp_send_json_success([
                        'btn' => esc_html__('Disable', 'fontflow'),
                    ]);
                } else {
                    update_option( $key, false );
                    wp_send_json_success([
                        'btn' => esc_html__('Enable', 'fontflow'),
                    ]);
                }
            } else {
                wp_send_json_error([
                    'btn' => esc_html__('something went wrong.', 'fontflow'),
                ]);
            }

            wp_die();
        }
    }

}

if( !function_exists( 'fontflow_wp_plugin_settings' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_settings() {

        return FontFlow_WP_Plugin_Settings::get_instance();
    }
}

fontflow_wp_plugin_settings();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */