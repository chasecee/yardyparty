<?php
/**
 * Block template
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: Inline SVG
 * Category: text
 * Align: full
 * Mode: preview
 */
$id = 'inline-svg-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'block-inline-svg';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// acf vars
$svg_code = get_field( 'svg_code' );

$override_colors = get_field( 'override_colors' );
$override_color = get_field( 'override_color' );

if ( $override_colors == 1 ) {
	$svg_code = convertHexToCurrentColor($svg_code);
}
if ( ! empty( $override_color ) ) {
    $override_color_class = 'text-' . $override_color;
} else {
	$override_color_class = '';
}

$classes .= ' ' . $override_color_class;
?>
<div class="<?php echo esc_attr($classes); ?>">
	<?php echo wp_kses( $svg_code, get_kses_extended_ruleset() ); ?>
</div>

