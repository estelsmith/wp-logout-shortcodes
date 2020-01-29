# wp-cm-logout-shortcodes
Shortcodes for providing Logout links in WordPress

## How to use

### [cm_logout_url]
This shortcode returns the logout URL for WordPress. You can use this anywhere you need the logout URL itself, such as
redirects or creating custom logout links.

The following arguments are accepted:

- `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred

### [cm_logout_link]
This shortcode creates an `<a>` tag containing the logout URL.

The following arguments are accepted:

- `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
- `label` (default: `Logout`) - The label displayed in the `<a>` tag
