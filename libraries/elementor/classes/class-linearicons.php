<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( !class_exists( 'FontFlow_WP_Plugin_Elementor_Linear_Icons' ) ) {

	/**
	 * Define the Linear Icons icon library.
	 */
    class FontFlow_WP_Plugin_Elementor_Linear_Icons {

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
			do_action( 'fontflow-action/plugin/elementor/icon-library/linearicons/loaded' );
        }

        public function load( $additional_tabs ) {

            $icons = [
                'alarm',
                'apartment',
                'arrow-down-circle',
                'arrow-down',
                'arrow-left-circle',
                'arrow-left',
                'arrow-right-circle',
                'arrow-right',
                'arrow-up-circle',
                'arrow-up',
                'bicycle',
                'bold',
                'book',
                'bookmark',
                'briefcase',
                'bubble',
                'bug',
                'bullhorn',
                'bus',
                'calendar-full',
                'camera-video',
                'camera',
                'car',
                'cart',
                'chart-bars',
                'checkmark-circle',
                'chevron-down-circle',
                'chevron-down',
                'chevron-left-circle',
                'chevron-left',
                'chevron-right-circle',
                'chevron-right',
                'chevron-up-circle',
                'chevron-up',
                'circle-minus',
                'clock',
                'cloud-check',
                'cloud-download',
                'cloud-sync',
                'cloud-upload',
                'cloud',
                'code',
                'coffee-cup',
                'cog',
                'construction',
                'crop',
                'cross-circle',
                'cross',
                'database',
                'diamond',
                'dice',
                'dinner',
                'direction-ltr',
                'direction-rtl',
                'download',
                'drop',
                'earth',
                'enter-down',
                'enter',
                'envelope',
                'exit-up',
                'exit',
                'eye',
                'file-add',
                'file-empty',
                'film-play',
                'flag',
                'frame-contract',
                'frame-expand',
                'funnel',
                'gift',
                'graduation-hat',
                'hand',
                'heart-pulse',
                'heart',
                'highlight',
                'history',
                'home',
                'hourglass',
                'inbox',
                'indent-decrease',
                'indent-increase',
                'italic',
                'keyboard',
                'laptop-phone',
                'laptop',
                'layers',
                'leaf',
                'license',
                'lighter',
                'line-spacing',
                'linearicons',
                'link',
                'list',
                'location',
                'lock',
                'magic-wand',
                'magnifier',
                'map-marker',
                'map',
                'menu-circle',
                'menu',
                'mic',
                'moon',
                'move',
                'music-note',
                'mustache',
                'neutral',
                'page-break',
                'paperclip',
                'paw',
                'pencil',
                'phone-handset',
                'phone',
                'picture',
                'pie-chart',
                'pilcrow',
                'plus-circle',
                'pointer-down',
                'pointer-left',
                'pointer-right',
                'pointer-up',
                'poop',
                'power-switch',
                'printer',
                'pushpin',
                'question-circle',
                'redo',
                'rocket',
                'sad',
                'screen',
                'select',
                'shirt',
                'smartphone',
                'smile',
                'sort-alpha-asc',
                'sort-amount-asc',
                'spell-check',
                'star-empty',
                'star-half',
                'star',
                'store',
                'strikethrough',
                'sun',
                'sync',
                'tablet',
                'tag',
                'text-align-center',
                'text-align-justify',
                'text-align-left',
                'text-align-right',
                'text-format-remove',
                'text-format',
                'text-size',
                'thumbs-down',
                'thumbs-up',
                'train',
                'trash',
                'underline',
                'undo',
                'unlink',
                'upload',
                'user',
                'users',
                'volume-high',
                'volume-low',
                'volume-medium',
                'volume',
                'warning',
                'wheelchair',
            ];

            $additional_tabs[ 'fontflow-linearicons' ] = [
                'name'          => 'fontflow-linearicons',
                'label'         => esc_html__( 'FontFlow - LinearIcons', 'fontflow' ),
                'labelIcon'     => 'fas fa-chevron-right',
                'ver'           => FCIFE_CONST_VERSION,
                'prefix'        => 'fontflow-linearicons-',
                'displayPrefix' => 'fontflow-linearicons',
                'url'           => FCIFE_CONST_URL . 'assets/css/linearicons/fontflow-linearicons.min.css',
                'enqueue'       => [ FCIFE_CONST_URL . 'assets/css/linearicons/fontflow-linearicons.min.css' ],
                'icons'         => $icons
            ];

            return $additional_tabs;
        }
    }

}

if( !function_exists( 'fontflow_wp_plugin_elementor_linear_icons' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_elementor_linear_icons() {

        return FontFlow_WP_Plugin_Elementor_Linear_Icons::get_instance();
    }
}

fontflow_wp_plugin_elementor_linear_icons();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */