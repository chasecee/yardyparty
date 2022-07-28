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


// Register Custom Post Type
function shows() {

	$labels = array(
		'name'                  => _x( 'Shows', 'Post Type General Name', '_s' ),
		'singular_name'         => _x( 'Show', 'Post Type Singular Name', '_s' ),
		'menu_name'             => __( 'Shows', '_s' ),
		'name_admin_bar'        => __( 'Shows', '_s' ),
		'archives'              => __( 'Show Archives', '_s' ),
		'attributes'            => __( 'Show Attributes', '_s' ),
		'parent_item_colon'     => __( 'Parent Item:', '_s' ),
		'all_items'             => __( 'All Shows', '_s' ),
		'add_new_item'          => __( 'Add New Show', '_s' ),
		'add_new'               => __( 'Add New', '_s' ),
		'new_item'              => __( 'New Show', '_s' ),
		'edit_item'             => __( 'Edit Show', '_s' ),
		'update_item'           => __( 'Update Item', '_s' ),
		'view_item'             => __( 'View Item', '_s' ),
		'view_items'            => __( 'View Items', '_s' ),
		'search_items'          => __( 'Search Item', '_s' ),
		'not_found'             => __( 'Not found', '_s' ),
		'not_found_in_trash'    => __( 'Not found in Trash', '_s' ),
		'featured_image'        => __( 'Featured Image', '_s' ),
		'set_featured_image'    => __( 'Set featured image', '_s' ),
		'remove_featured_image' => __( 'Remove featured image', '_s' ),
		'use_featured_image'    => __( 'Use as featured image', '_s' ),
		'insert_into_item'      => __( 'Insert into item', '_s' ),
		'uploaded_to_this_item' => __( 'Uploaded to this show', '_s' ),
		'items_list'            => __( 'Show list', '_s' ),
		'items_list_navigation' => __( 'Items list navigation', '_s' ),
		'filter_items_list'     => __( 'Filter items list', '_s' ),
	);
	$args = array(
		'label'                 => __( 'Show', '_s' ),
		'description'           => __( 'Upcoming Shows', '_s' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'shows', $args );

}
add_action( 'init', 'shows', 0 );
