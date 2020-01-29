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
    public static function create(): self
    {
        static $instance = null;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    private function __construct()
    {
        $this->registerShortcodes();
    }

    /**
     * Register available shortcodes with WordPress.
     */
    private function registerShortcodes()
    {
        add_shortcode('cm_logout_url', [$this, 'logoutUrl']);
        add_shortcode('cm_logout_link', [$this, 'logoutLink']);
    }

    /**
     * Returns the WordPress logout URL.
     *
     * Available $options:
     * - `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
     * - `label` (default: `Logout`) - The label displayed in the `<a>` tag
     *
     * @param array|null $options
     * @return string
     */
    public function logoutUrl($options): string
    {
        $options = shortcode_atts(
            [
                'redirect_to' => '/'
            ],
            $options
        );

        return wp_logout_url($options['redirect_to']);
    }

    /**
     * Returns an `<a>` tag containing the logout URL.
     *
     * Available $options:
     * - `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
     * - `label` (default: `Logout`) - The label displayed in the `<a>` tag
     *
     * @param array|null $options
     * @return string
     */
    public function logoutLink($options): string
    {
        $options = shortcode_atts(
            [
                'redirect_to' => '/',
                'label' => 'Logout'
            ],
            $options
        );

        $url = $this->logoutUrl($options);
        $label = $options['label'];

        ob_start();
        ?>
        <a href="<?= $url ?>"><?= esc_html($label) ?></a>
        <?php
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}

LogoutShortcodes::create();