<?php

namespace VelixTech;

defined('ABSPATH') || exit;

class Assets
{
    public function __construct()
    {
        // Frontend assets
        add_action('wp_enqueue_scripts', [$this, 'register_frontend_script']);
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
}
