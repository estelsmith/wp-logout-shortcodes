# wp-cm-logout-shortcodes
Shortcodes for providing Logout links in WordPress

## How to use

### [cm_logout_url]
Returns the WordPress logout URL. You can use this anywhere you need the logout URL itself, such as redirects or
creating custom logout links.

The following options are accepted:

- `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred

### [cm_logout_link]
Returns an `<a>` tag containing the logout URL.

The following options are accepted:

- `redirect_to` (default: `/`) - The URL to redirect to after logout has occurred
- `label` (default: `Logout`) - The label displayed in the `<a>` tag
