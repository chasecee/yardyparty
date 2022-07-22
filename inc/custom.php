<?php
/**
 * Custom code written and stolen by Chase.
 *
 * @package _s
 */

// Disable comments everywhere without a plugin
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page and option page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 * Function to filter svg code from wp editor.
 *
 * @author Corey Collins
 */
function get_kses_extended_ruleset() {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = array(
		'defs'           => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
		),
		'lineargradient' => array(
			'id'            => true,
			'x1'            => true,
			'x2'            => true,
			'y2'            => true,
			'gradientunits' => true,
			'width'         => true,

		),
		'rect'           => array(
			'id'        => true,
			'data-name' => true,
			'opacity'   => true,
			'transform' => true,
			'fill'      => true,
			'width'     => true,
			'height'    => true,
			'rx'	    => true,
		),
		'stop'           => array(
			'offset'     => true,
			'stop-color' => true,

		),
		'svg'            => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
			'fill'			  => true,
		),
		'g'              => array(
			'fill'         => true,
			'transform'    => true,
			'stroke'       => true,
			'id'           => true,
			'stroke-width' => true,
		),
		'title'          => array( 'title' => true ),
		'path'           => array(
			'd'           	  => true,
			'fill'        	  => true,
			'transform'   	  => true,
			'stroke'      	  => true,
			'strokewidth' 	  => true,
			'id'          	  => true,
			'fill-rule'   	  => true,
			'stroke-width' 	  => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
		),
		'circle'         => array(
			'd'         => true,
			'r'         => true,
			'fill'      => true,
			'transform' => true,
			'stroke'    => true,
			'cx'        => true,
			'cy'        => true,
			'id'        => true,
		),
		'line'           => array(
			'd'         => true,
			'r'         => true,
			'fill'      => true,
			'transform' => true,
			'stroke'    => true,
			'x2'        => true,
			'y2'        => true,
			'id'        => true,
		),
	);
	return array_merge( $kses_defaults, $svg_args );
}

// detect, convert, and replace hex codes (usually in svg's)
function convertHexToCurrentColor($name)
{
	$name = preg_replace("/#[a-f0-9]{6}/i", "currentColor", $name);
	return $name;
}

// remove bs svg bloat on frontend
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
