<?php

namespace VelixTech;

defined('ABSPATH') || exit;

class Assets
{
    public function __construct()
    {
        // Frontend assets
        add_action('wp_enqueue_scripts', [$this, 'register_frontend_script']);

        // conditional enqueue scripts
        add_action('wp_enqueue_scripts', [$this, 'enqueue_conditional_script']);

        // remove emoji script
        add_action('init', [$this, 'remove_emoji_script']);

        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_script']);

        add_filter('script_loader_tag', [$this, 'modify_script_type'], 10, 3);

        add_action('admin_head', [$this, 'localize_admin_script']);
    }

    public function localize_admin_script()
    {
        echo '
        <script type="text/javascript">
            const velixtechData = {
                themeUrl: "' . esc_url(THEME_URI . '/assets/admin/templates/') . '",
            };
        </script>';
    }

    public function remove_emoji_script()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }


    public function register_frontend_script()
    {
        $get_styles   = $this->get_frontend_style();
        $get_scripts  = $this->get_frontend_scripts();

        foreach ($get_styles as $handle => $style) {
            $deps = $style['deps'] ?? [];
            wp_enqueue_style(
                $handle,
                $style['src'],
                $deps,
                THEME_VERSION,
                'all'
            );
        }

        // enqueue scripts
        foreach ($get_scripts as $handle => $script) {
            wp_enqueue_script(
                $handle,
                $script['src'],
                $script['deps'] ?? [],
                THEME_VERSION,
                true
            );
        }

        // Remove Gutenberg styles for non-logged in users
        if (! is_user_logged_in()) {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('global-styles');
            wp_dequeue_style('classic-theme-styles');
        }
    }

    private function get_frontend_style()
    {
        $style = [
            'font-instrument-sans' => [
                'src' => ASSETS . 'fonts/instrument-sans/instrument-sans.css'
            ],
            'frontend-style' => [
                'src' => ASSETS . 'css/frontend.css',
                'deps' => ['font-instrument-sans']
            ],
            'velixtech-style' => [
                'src' => get_stylesheet_uri(),
                'deps' => ['frontend-style']
            ]
        ];

        return $style;
    }


    private function get_frontend_scripts()
    {
        $scripts = [
            'vue-js' => [
                'src'  => ASSETS . 'js/vue.global.prod.js',
                'deps' => []
            ],
            'velixtech-frontend-script' => [
                'src'  => ASSETS . 'js/navbar.js',
                'deps' => ['vue-js']
            ]
        ];

        return $scripts;
    }


    /**
     * Enqueue admin script
     * @since 1.0.0
     * @return void
     * @param string $hook_suffix
     */
    public function enqueue_admin_script($hook_suffix)
    {
        if ($hook_suffix === 'toplevel_page_velixtech') {
            wp_enqueue_script(
                'vue-js',
                ASSETS . 'js/vue.global.prod.js',
                [],
                THEME_VERSION,
                true
            );
            wp_enqueue_script(
                'vue-router-js',
                ASSETS . 'admin/js/vue-router.global.prod.min.js',
                ['vue-js'],
                THEME_VERSION,
                true
            );
            wp_enqueue_script(
                'velixtech-admin-script',
                ASSETS . 'admin/js/custom.js',
                ['vue-router-js'],
                THEME_VERSION,
                true
            );
        }
    }

    /**
     * Modify script type to module
     * @since 1.0.0
     * @return string
     * @param string $tag
     * @param string $handle
     * @param string $src
     */
    public function modify_script_type($tag, $handle, $src)
    {
        if ('velixtech-admin-script' === $handle) {
            return '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }

    /**
     * Enqueue conditional style and script
     *
     * @return void
     */
    public function enqueue_conditional_script()
    {
        // this style for only home page
        if (is_front_page() || is_home()) {
            wp_enqueue_style(
                'vx-home-style',
                THEME_URI . 'assets/css/home.css',
                [],
                THEME_VERSION
            );
        }
    }
}
