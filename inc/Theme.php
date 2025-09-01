<?php

namespace VelixTech;

defined('ABSPATH') || exit;

final class Theme
{

    // set instance
    private static $instance;

    /**
     * Constructor
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct()
    {
        // initiate assets
        new Assets;

        $this->define_constant();

        add_action('after_setup_theme', [$this, 'setup']);
    }

    /**
     * Initiator
     * @since 1.0.0
     * @return object initialized object of the class
     * @staticvar object $instance
     * @access public
     */
    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Define Constants
     * @since 1.0.0
     * @return void
     */
    public function define_constant()
    {
        define('THEME_VERSION', wp_get_theme()->get('Version'));
        define('THEME_DIR', trailingslashit(get_template_directory()));
        define('THEME_URI', trailingslashit(get_template_directory_uri()));
        define('ASSETS', trailingslashit(THEME_URI . 'assets'));
        define('ADMIN_ASSETS', trailingslashit(ASSETS . 'admin'));
    }

    /**
     * Theme Setup
     * @since 1.0.0
     * @return void
     */
    public function setup()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');

        // register text domain
        load_theme_textdomain('velixtech', THEME_DIR . 'lang');

        register_nav_menus([
            'primary_menu'   => esc_html__('Primary Menu', 'velixtech'),
            'offcanvas_menu' => esc_html__('Offcanvas menu', 'velixtech'),
        ]);
    }

    public function get_logo()
    {
        $img_src = ASSETS . 'img/logo.png';

        printf(
            '<a href="%s" class="logo-link"><img src="%s" style="max-width: 120px;" alt="%s"></a>',
            esc_url(home_url()),
            esc_url($img_src),
            esc_attr(get_bloginfo('name'))
        );
    }

    public function primary_menu()
    {
        wp_nav_menu([
            'theme_location' => 'primary_menu',
            'menu_class'     => 'd-none d-lg-flex primary-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'depth'          => 1,
            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
        ]);
    }
}
