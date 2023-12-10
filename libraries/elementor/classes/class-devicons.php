<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'FontFlow_WP_Plugin_Elementor_Dev_Icons' ) ) {

	/**
	 * Define the DevIcons icon library.
	 */
    class FontFlow_WP_Plugin_Elementor_Dev_Icons {

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
            add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'load'] );
			do_action( 'fontflow-action/plugin/elementor/icon-library/devicons/loaded' );
        }

        public function load( $additional_tabs ) {

            $icons = [
                'android',
                'angular_simple',
                'appcelerator',
                'apple',
                'appstore',
                'aptana',
                'asterisk',
                'atlassian',
                'atom',
                'aws',
                'backbone',
                'bing_small',
                'bintray',
                'bitbucket',
                'blackberry',
                'bootstrap',
                'bower',
                'brackets',
                'bugsense',
                'celluloid',
                'chrome',
                'cisco',
                'clojure_alt',
                'clojure',
                'cloud9',
                'coda',
                'code_badge',
                'code',
                'codeigniter',
                'codepen',
                'codrops',
                'coffeescript',
                'compass',
                'composer',
                'creativecommons_badge',
                'creativecommons',
                'css_tricks',
                'css3_full',
                'css3',
                'cssdeck',
                'dart',
                'database',
                'debian',
                'digital-ocean',
                'django',
                'dlang',
                'docker',
                'doctrine',
                'dojo',
                'dotnet',
                'dreamweaver',
                'dropbox',
                'drupal',
                'eclipse',
                'ember',
                'envato',
                'erlang',
                'extjs',
                'firebase',
                'firefox',
                'fsharp',
                'ghost_small',
                'ghost',
                'git_branch',
                'git_commit',
                'git_compare',
                'git_merge',
                'git_pull_request',
                'git',
                'github_alt',
                'github_badge',
                'github_full',
                'github',
                'gnu',
                'go',
                'google_analytics',
                'google_drive',
                'google-cloud-platform',
                'grails',
                'groovy',
                'grunt',
                'gulp',
                'hackernews',
                'haskell',
                'heroku',
                'html5_3d_effects',
                'html5_connectivity',
                'html5_device_access',
                'html5_multimedia',
                'html5',
                'ie',
                'illustrator',
                'intellij',
                'ionic',
                'java',
                'javascript_1',
                'javascript',
                'jekyll_small',
                'jenkins',
                'jira',
                'joomla',
                'jquery_logo',
                'jquery_ui_logo',
                'js_badge',
                'komodo',
                'krakenjs_badge',
                'krakenjs',
                'laravel',
                'less',
                'linux',
                'magento',
                'mailchimp',
                'markdown',
                'materializecss',
                'meteor',
                'meteorfull',
                'mitlicence',
                'modernizr',
                'mongodb',
                'mootools_badge',
                'mootools',
                'mozilla',
                'msql_server',
                'mysql',
                'nancy',
                'netbeans',
                'netmagazine',
                'nginx',
                'nodejs_small',
                'nodejs',
                'npm',
                'onedrive',
                'openshift',
                'opensource',
                'opera',
                'perl',
                'phonegap',
                'photoshop',
                'php',
                'postgresql',
                'prolog',
                'python',
                'rackspace',
                'raphael',
                'rasberry_pi',
                'react',
                'redhat',
                'redis',
                'requirejs',
                'responsive',
                'ror',
                'ruby_rough',
                'ruby',
                'rust',
                'safari',
                'sass',
                'scala',
                'scriptcs',
                'scrum',
                'senchatouch',
                'sizzlejs',
                'smashing_magazine',
                'snap_svg',
                'spark',
                'sqllite',
                'stackoverflow',
                'streamline',
                'stylus',
                'sublime',
                'swift',
                'symfony_badge',
                'symfony',
                'techcrunch',
                'terminal_badge',
                'terminal',
                'travis',
                'trello',
                'typo3',
                'ubuntu',
                'uikit',
                'unity_small',
                'vim',
                'visualstudio',
                'w3c',
                'webplatform',
                'windows',
                'wordpress',
                'yahoo_small',
                'yahoo',
                'yeoman',
                'yii',
                'zend',
            ];

            $additional_tabs[ 'fontflow-devicons' ] = [
                'name'          => 'fontflow-devicons',
                'label'         => esc_html__( 'FontFlow - DevIcons', 'fontflow' ),
                'labelIcon'     => 'fas fa-chevron-right',
                'ver'           => FCIFE_CONST_VERSION,
                'prefix'        => 'fontflow-devicons-',
                'displayPrefix' => 'fontflow-devicons',
                'url'           => FCIFE_CONST_URL . 'assets/css/devicons/fontflow-devicons.min.css',
                'enqueue'       => [ FCIFE_CONST_URL . 'assets/css/devicons/fontflow-devicons.min.css' ],
                'icons'         => $icons
            ];

            return $additional_tabs;
        }
    }

}

if( !function_exists( 'fontflow_wp_plugin_elementor_dev_icons' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_elementor_dev_icons() {

        return FontFlow_WP_Plugin_Elementor_Dev_Icons::get_instance();
    }
}

fontflow_wp_plugin_elementor_dev_icons();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */