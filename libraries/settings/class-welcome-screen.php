<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if( ! class_exists( 'FontFlow_WP_Plugin_Welcome_Screen' ) ) {

    /**
     * The admin welcome screen setup class.
     */
    class FontFlow_WP_Plugin_Welcome_Screen {

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
            ?>
                <div class="wrap e-a-apps">
                    <div class="e-a-page-title">
                        <h2><?php echo esc_html__( 'FontFlow Custom Icons Library for Elementor.', 'fontflow' ); ?></h2>
                        <p>
                            <?php echo esc_html__('Elevate your Elementor website with FontFlow Custom Icons, a dynamic plugin that seamlessly integrates an extensive icon library.', 'fontflow' ); ?>
                            <br/>
                            <a href="https://wordpress.org/plugins/fontflow-custom-icons-for-elementor/" target="_blank"><?php echo esc_html__( 'Learn more about this plugin.', 'fontflow' ); ?></a>
                        </p>
                    </div>

                    <div class="e-a-list">
                        <?php $this->render_icons_list(); ?>
                    </div>
                </div>
            <?php
        }

        public function render_icons_list() {
            $icons_list = $this->get_icons_list();

            foreach( $icons_list as $icon_list ) {
                $this->render_item( $icon_list );
            }
        }

        public function get_icons_list() : array {
            $images_url = FCIFE_CONST_URL . 'assets/images/icon-provides/';
            $icons_list = [
                [
                    'name'           => 'Devicons',
                    'author'         => 'vorillaz',
                    'author_url'     => 'https://vorillaz.github.io/devicons/',
                    'description'    => esc_html__( 'Devicons is a full statck iconic font made for developers, code jedis, ninjas, HTTPsters, evangelists and nerds.', 'fontflow' ),
                    'learn_more_url' => 'https://github.com/vorillaz/devicons',
                    'db_option'      => 'fontflow_devicons',
                    'action_url'     => 'javascript:void(0);',
                    'image'          => $images_url . 'devicons.svg',
                ],
                [
                    'name'           => 'Elegant Icons',
                    'author'         => 'ElegantThemes',
                    'author_url'     => 'https://www.elegantthemes.com',
                    'description'    => esc_html__( 'The Elegant Icon Font – 360 Of The Best Free Icons For The Modern Web. They are vector based and can expand and contract without quality degradation. The result is crisp, beautiful graphics on any display (including Retina displays).', 'fontflow' ),
                    'learn_more_url' => 'https://www.elegantthemes.com/blog/resources/elegant-icon-font#introducing-the-elegant-themes-icon-font',
                    'db_option'      => 'fontflow_eleganticons',
                    'action_url'     => 'javascript:void(0);',
                    'image'          => $images_url . 'elegant-themes.svg',
                ],
                [
                    'name'           => 'Feather Icons',
                    'author'         => 'Cole Bemis',
                    'author_url'     => 'https://twitter.com/colebemis',
                    'description'    => esc_html__( 'Feather is a collection of simply beautiful open-source icons. Each icon is designed on a 24x24 grid with an emphasis on simplicity, consistency, and flexibility.', 'fontflow' ),
                    'learn_more_url' => 'https://feathericons.com/',
                    'db_option'      => 'fontflow_feathericons',
                    'action_url'     => 'javascript:void(0);',
                    'image'          => $images_url . 'feathericons.svg',
                ],
                [
                    'name'           => 'Linear Icons',
                    'author'         => 'Perxis',
                    'author_url'     => 'https://perxis.com/',
                    'description'    => esc_html__( 'The Linearicons icon pack includes a font that you can install and use in any application with a custom text tool.This font comes with hundreds of ligatures, making it easy to find and use the icons.', 'fontflow' ),
                    'learn_more_url' => 'https://linearicons.com/',
                    'db_option'      => 'fontflow_linearicons',
                    'action_url'     => 'javascript:void(0);',
                    'image'          => $images_url . 'linearicons.svg',
                ],
                [
                    'name'           => 'Line Icons',
                    'author'         => 'icons8',
                    'author_url'     => 'https://icons8.com/',
                    'description'    => esc_html__( 'Line Awesome consists of ~1380 flat line icons that offer complete coverage of the main Font Awesome icon set. This icon-font is based off of the Icons8 Windows 10 style, which consists of over 4,000 icons.', 'fontflow' ),
                    'learn_more_url' => 'https://icons8.com/line-awesome/',
                    'db_option'      => 'fontflow_lineicons',
                    'action_url'     => 'javascript:void(0);',
                    'image'          => $images_url . 'Icons8.svg',
                ],
            ];

            return $icons_list;
        }

        public function render_item( $item ) {
            ?>
                <div class="e-a-item">
                    <div class="e-a-heading">
                        <img class="e-a-img" src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
                    </div>
                    <h3 class="e-a-title"><?php echo esc_html( $item['name'] ); ?></h3>
                    <p class="e-a-author"><?php esc_html_e( 'By', 'fontflow' ); ?> <a href="<?php echo esc_url( $item['author_url'] ); ?>" target="_blank"><?php echo esc_html( $item['author'] ); ?></a></p>
                    <div class="e-a-desc">
                        <p><?php echo esc_html( $item['description'] ); ?></p>
                    </div>
                    <p class="e-a-actions">
                        <?php if ( ! empty( $item['learn_more_url'] ) ) : ?>
                            <a class="e-a-learn-more" href="<?php echo esc_url( $item['learn_more_url'] ); ?>" target="_blank"><?php echo esc_html__( 'Learn More', 'fontflow' ); ?></a>
                        <?php endif; ?>
                        <a
                            href    = "<?php echo esc_html( $item['action_url'] ); ?>"
                            class   = "e-btn e-accent fontflow-ajax"
                            data-db = "<?php echo esc_html( $item['db_option'] ); ?>"
                        ><?php
                            if( get_option( $item['db_option'] ) ) {
                                echo esc_html__('Disable', 'fontflow');
                            } else {
                                echo esc_html__('Enable', 'fontflow');
                            }
                        ?></a>
                    </p>
                </div>
            <?php
        }

    }

}

if( !function_exists( 'fontflow_wp_plugin_admin_welcome_screen' ) ) {

    /**
     * Returns the instance of a class.
     */
    function fontflow_wp_plugin_admin_welcome_screen() {

        return FontFlow_WP_Plugin_Welcome_Screen::get_instance();
    }

}

fontflow_wp_plugin_admin_welcome_screen();
/* Omit closing PHP tag to avoid "Headers already sent" issues. */