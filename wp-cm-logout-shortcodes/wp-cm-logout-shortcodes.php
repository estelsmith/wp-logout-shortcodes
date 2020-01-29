<?php
/**
 * Plugin Name: Cascade Media Logout Shortcodes
 * Plugin URI: https://github.com/cascademedia/wp-cm-logout-shortcodes
 * Description: Shortcodes for providing Logout links in WordPress.
 * Version: 0.0.1
 * Requires at least: 5.3
 * Requires PHP: 7.0
 * Author: Cascade Media
 * Author URI: http://cascademedia.us/
 */

namespace CascadeMedia\WordPress;

class LogoutShortcodes
{
    public function __construct()
    {
        $this->registerShortcodes();
    }

    public static function create(): self
    {
        static $instance = null;

        if (!$instance)
        {
            $instance = new self();
        }

        return $instance;
    }

    private function registerShortcodes()
    {
        add_shortcode('cm_logout_url', [$this, 'logoutUrl']);
    }

    public function logoutUrl(array $options): string
    {
        $options = shortcode_atts(
            [
                'redirect_to' => '/'
            ],
            $options
        );

        return wp_logout_url($options['redirect_to']);
    }
}

LogoutShortcodes::create();
