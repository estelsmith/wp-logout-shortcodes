# wp-cm-logout-shortcodes
This is a very simple plugin that provides shortcodes for creating or displaying user logout links in WordPress.

## Basic usage
You can create a simple logout link by using the `[cm_logout_link]` shortcode. This will generate a simple `<a>` tag
linked to the WordPress logout URL, such as the example link below:

```html
<a href="/logout?redirect_to=/&wp_nonce=1234">Logout</a>
```

You can change the link's label by adding a `label` option to the shortcode, such as `[cm_logout_link label="Log me out"]`.

Users are redirected to `/` by default after being logged out. This can easily be changed by specifying a `redirect_to`
option: `[cm_logout_link redirect_to="/another-page"]`.

If you want to generate only the logout URL for your own purposes, such as for inclusion in javascript, you can use the
`[cm_logout_url]` shortcode. The `[cm_logout_url]` shortcode also accepts the `redirect_to` option, like:
`[cm_logout_url redirect_to="/another-page"]`.

## Advanced usage
Although this plugin provides simple behavior, there are several extension points within the code, allowing for other
uses than what I could have thought about.

The `[cm_logout_url]` shortcode gives you access to a couple of different filters:
- `cm_logout_url_redirect_to` - The `redirect_to` option that was passed to `[cm_logout_url]`
- `cm_logout_url` - The WordPress logout URL that was generated

The `[cm_logout_link]` shortcode also gives you access to some filters:
- `cm_logout_link_url` - The WordPress logout URL that was generated
- `cm_logout_link_label` - The `label` option that was passed to `[cm_logout_link]`
- `cm_logout_link` - The logout link that was generated

In addition to these filters, `[cm_logout_link]` provides a couple of actions you can hook into:
- `cm_logout_link_before` - Fires before rendering the logout link
- `cm_logout_link_after` - Fires after rendering the logout link

## Plugin Development
I've provided a basic `docker-compose`-based environment to assist with developing the plugin. Run
`docker-compose up -d`, then after everything's been started you can visit `http://localhost:8081` to begin working on
the plugin from inside a running WordPress installation.

When the containers come up for the first time, WordPress' core files will be downloaded to `/wp`.

To stop the development environment, run `docker-compose down`. You can bring it back up later without losing your
WordPress database.

If you want to stop the development environment and destroy the WordPress database as well, then run
`docker-compose down --volumes`.
