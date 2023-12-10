<?php
/**
 * FontFlow Custom Icons for Elementor
 *
 *
 * Plugin Name: FontFlow Custom Icons for Elementor
 * Plugin URI:  https://wordpress.org/plugins/fontflow-custom-icons-for-elementor
 * Description: Elevate your Elementor website with FontFlow Custom Icons, a dynamic plugin that seamlessly integrates an extensive icon library.
 * Version: 1.0.0
 * Author: M Gogul Saravanan
 * Author URI: https://profiles.wordpress.org/iamgogul/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: fontflow
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Debug
 */
if( !function_exists( 'fontflow_debug' ) ) {
	function fontflow_debug( $arg = NULL ) {
		echo '<pre>';
		var_dump( $arg );
		echo '</pre>';
	}
}

/**
 * Check whether a plugin installed.
 */
if( !function_exists( 'fontflow_is_plugin_active' ) ) {
	function fontflow_is_plugin_active( $plugin_file_path = NULL ) {
		$plugins = get_plugins();
		return isset( $plugins[ $plugin_file_path ] );
	}
}

if( !class_exists( 'FontFlow_WP_Plugin' ) ) {

    final class FontFlow_WP_Plugin {

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

        public function __construct() {
            $this->define_constants();
            $this->load_dependencies();

			// Register activation and deactivation hook.
			register_activation_hook( __FILE__, [ $this, 'activate_plugin' ] );
			register_deactivation_hook( __FILE__, [ $this, 'deactivate_plugin' ] );

			do_action( 'fontflow-action/plugin/loaded' );
		}

		/**
		 * Define plugin required constants
		 */
		private function define_constants() {
			$this->define( 'FCIFE_CONST_SERVER_SOFTWARE', $_SERVER['SERVER_SOFTWARE'] );
            $this->define( 'FCIFE_CONST_FILE', __FILE__ );

			if( ! function_exists('get_plugin_data') ){
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			$plugin_data = get_plugin_data( FCIFE_CONST_FILE );
            $this->define( 'FCIFE_CONST_PLUGIN_NAME', $plugin_data['Name'] );
            $this->define( 'FCIFE_CONST_SAN_PLUGIN_NAME', sanitize_title( $plugin_data['Name'] ) );
            $this->define( 'FCIFE_CONST_VERSION', $plugin_data['Version'] );
            $this->define( 'FCIFE_CONST_DIR', trailingslashit( plugin_dir_path( FCIFE_CONST_FILE ) ) );
			$this->define( 'FCIFE_CONST_URL', trailingslashit( plugin_dir_url( FCIFE_CONST_FILE ) ) );
			$this->define( 'FCIFE_CONST_BASENAME', plugin_basename( FCIFE_CONST_FILE ) );
			$this->define( 'FCIFE_CONST_DEBUG_SUFFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' ) );
		}

		/**
		 * Define constant if not already set.
		 */
		private function define( $name, $value ) {
			if( !defined( $name ) ) {
				define( $name, $value );
            }
        }

		/**
		 * Load the required dependencies for this plugin.
		 */
		private function load_dependencies() {
            if( !$this->check_requirement() ) {
                return;
            }

			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			if( is_admin() ) {
				require_once FCIFE_CONST_DIR . 'libraries/admin/class-admin.php';
			}

			/**
             * Include internationalization functionality of the plugin.
             */
			require_once FCIFE_CONST_DIR . 'libraries/i18n/class-i18n.php';

			/**
			 * Include settings
			 */
			require_once FCIFE_CONST_DIR . 'libraries/settings/class-settings-api.php';

			/**
			 * Elementor
			 */
			require_once FCIFE_CONST_DIR . 'libraries/elementor/class-elementor.php';
		}

		/**
		 * Check whether basic provision reached.
		 */
		private function check_requirement() {
			if ( ! function_exists('is_plugin_active') ){
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			if( !is_plugin_active( 'elementor/elementor.php' ) ) {
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }

				add_action( 'admin_notices', function() {
                    /* translators: %s: html tags */
                    $message = sprintf(
                        __( 'The %1$s FontFlow Custom Icons for Elementor %2$s plugin is compatible with %1$sElementor%2$s plugin. Kindly install and activate it.', 'fontflow' ),
                        '<strong>',
                        '</strong>'
                    );

					$button = '';
					$is_elementor_installed = fontflow_is_plugin_active( 'elementor/elementor.php' );

					if( $is_elementor_installed && current_user_can( 'activate_plugins' ) ) {
						$button = sprintf( '<a href="%1$s" class="button-primary">%2$s</a>',
                            wp_nonce_url( admin_url(
                                add_query_arg( [
									'action'        => 'activate',
									'plugin'        => 'elementor/elementor.php',
									'plugin_status' => 'all',
									'paged'         => '1' ],
									'plugins.php'
								) ),
								'activate-plugin_elementor/elementor.php'
							),
							esc_html__( 'Activate Elementor', 'fontflow' )
						);
					} else if( $is_elementor_installed && current_user_can( 'install_plugins' ) ) {
						$button = sprintf( '<a href="%1$s" class="button-primary">%2$s</a>',
							wp_nonce_url( self_admin_url(
								add_query_arg( [
									'action' => 'install-plugin',
									'plugin' => 'elementor' ],
									'update.php'
								) ),
								'install-plugin_elementor'
							),
							esc_html__( 'Install Elementor', 'fontflow' )
                        );
					}

					printf( '<div class="notice notice-info is-dismissible"> <p> %1$s </p> <p> %2$s </p> </div>', $message, $button );

				});

				return false;
			}

			return true;
		}

		/**
		 * The code that runs during plugin activation.
		 */
		public static function activate_plugin() {
		}

		/**
		 * The code that runs during plugin deactivation.
		 */
		public static function deactivate_plugin() {
		}

	}

}

if( !function_exists( 'fontflow_wp_plugin' ) ) {
    /**
     * Returns instance of the FontFlow WP Plugin class.
     */
    function fontflow_wp_plugin() {
        return FontFlow_WP_Plugin::get_instance();
    }
}

fontflow_wp_plugin();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */