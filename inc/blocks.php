<?php
/**
 * Register Blocks
 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
 *
 */
function be_register_blocks() {

	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'section',
		'title'			=> __( 'Section', '_s' ),
		'render_template'	=> 'inc/blocks/section.php',
		'category'		=> 'formatting',
		'icon'			=> 'editor-insertmore',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));
	acf_register_block_type( array(
		'name'			=> 'feature-grid',
		'title'			=> __( 'Feature Grid', '_s' ),
		'render_template'	=> 'inc/blocks/feature-grid.php',
		'category'		=> 'formatting',
		'icon'			=> 'align-right',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));
	acf_register_block_type( array(
		'name'			=> 'home-hero',
		'title'			=> __( 'Home Hero', '_s' ),
		'render_template'	=> 'inc/blocks/home-hero.php',
		'category'		=> 'formatting',
		'icon'			=> 'superhero-alt',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));
	acf_register_block_type( array(
		'name'			=> 'icon-links',
		'title'			=> __( 'Icon Links', '_s' ),
		'render_template'	=> 'inc/blocks/icon-links.php',
		'category'		=> 'formatting',
		'icon'			=> 'superhero-alt',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));
	acf_register_block_type( array(
		'name'			=> 'inline-svg',
		'title'			=> __( 'Inline SVG', '_s' ),
		'render_template'	=> 'inc/blocks/inline-svg.php',
		'category'		=> 'formatting',
		'icon'			=> 'superhero-alt',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));
	acf_register_block_type( array(
		'name'			=> 'post-grid-menu',
		'title'			=> __( 'Post Grid Menu', '_s' ),
		'render_template'	=> 'inc/blocks/post-grid-menu.php',
		'category'		=> 'formatting',
		'icon'			=> 'superhero-alt',
		'mode'			=> 'preview',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'		=> [
			'align'			=> false,
			'anchor'		=> true,
			'customClassName'	=> true,
			'jsx' 			=> true,
		]
	));

}
add_action('acf/init', 'be_register_blocks' );
