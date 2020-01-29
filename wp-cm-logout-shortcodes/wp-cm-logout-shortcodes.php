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
    const PLUGIN_PREFIX = 'cm_logout';

    /**
     * Instantiates class and ensures only a single instance exists.
     *
     * This is the only supported way to instantiate the plugin.
     *
     * @return static
     */
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
     * Returns the provided name after applying the plugin prefix.
     *
     * Example: "my_hook" becomes "cm_logout_my_hook"
     *
     * @param string $name
     * @return string
     */
    private function getPrefixedName(string $name): string
    {
        return sprintf(
            '%s_%s',
            self::PLUGIN_PREFIX,
            $name
        );
    }

    /**
     * Register available shortcodes with WordPress.
     */
    private function registerShortcodes()
    {
        add_shortcode($this->getPrefixedName('url'), [$this, 'logoutUrl']);
        add_shortcode($this->getPrefixedName('link'), [$this, 'logoutLink']);
    }

    /**
     * Returns the WordPress logout URL.
     *
     * Available $options:
     * - `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
     * - `label` (default: `Logout`) - The label displayed in the `<a>` tag
     *
     * Available filters:
     * - `cm_logout_url_redirect_to` - The `redirect_to` option that was passed
     * - `cm_logout_url` - The generated WordPress logout URL
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

        $redirectTo = apply_filters($this->getPrefixedName('url_redirect_to'), $options['redirect_to']);
        return apply_filters($this->getPrefixedName('url'), wp_logout_url($redirectTo));
    }

    /**
     * Returns an `<a>` tag containing the logout URL.
     *
     * Available $options:
     * - `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
     * - `label` (default: `Logout`) - The label displayed in the `<a>` tag
     *
     * Available filters:
     * - `cm_logout_link_url` - The generated WordPress logout URL
     * - `cm_logout_link_label` - The `label` option that was passed
     *
     * Available actions:
     * - `cm_logout_link_before` - Before rendering the logout link
     * - `cm_logout_link_after` - After rendering the logout link
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

        $url = apply_filters($this->getPrefixedName('link_url'), $this->logoutUrl($options));
        $label = apply_filters($this->getPrefixedName('link_label'), $options['label']);

        ob_start();
        do_action($this->getPrefixedName('link_before'));
        ?>
        <a href="<?= $url ?>"><?= esc_html($label) ?></a>
        <?php
        do_action($this->getPrefixedName('link_after'));
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}

LogoutShortcodes::create();
