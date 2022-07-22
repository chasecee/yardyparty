<?php
/**
 * Block template
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: Section
 * Category: text
 * Align: full
 * Mode: preview
 */
$id = 'section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'block-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
// add more to classes
$classes .= ' relative';

// clone: bg
$bg_color = get_field('bg_color');
$bg_image = get_field('bg_image');
$bg_blend_mode = get_field('bg_blend_mode');
$bg_image_custom_class = get_field('bg_image_custom_class');

if ( ! empty( $bg_color ) ) {
	$bg_color = 'bg-' . $bg_color;
} else {
	$bg_color = 'bg-zinc-50';
}
if ( ! empty( $bg_image ) ) {
	$bg_image_attr = 'background-image:url(' . $bg_image . ');';
	$bg_class = ' bg-no-repeat';
}
if ( ! empty( $bg_image_custom_class ) ) {
	$bg_image_custom_class = $bg_image_custom_class;
} else {
	$bg_image_custom_class = 'bg-cover bg-center bg-no-repeat';
}

if ( ! empty( $bg_blend_mode ) ) {
	$bg_blend_class = $bg_blend_mode;
} else {
	$bg_blend_class = ' ';
}

// clone: spacing
$margin = get_field('margin');
$margin_override = get_field('margin_override');
if ( ! empty( $margin ) ) {
    $margin = 'my-' . $margin;
}
if ( ! empty( $margin_override )) {
    $margin = $margin_override;
}
$padding = get_field('padding');
$padding_override = get_field('padding_override');
if ( ! empty( $padding ) && ($padding) !== 0 ) {
    $padding = 'py-' . $padding;
} else {
	$padding = 'py-100';
}
if ( ! empty( $padding_override )) {
    $padding = $padding_override;
}

if ( get_field( 'patterns' ) == 0 ) {
	$classes .= ' overflow-hidden';
}
$content_width = get_field( 'content_width' );
if ( ! empty( $content_width ) ) {
    if ( $content_width == 'container' ) {
		$content_class = 'container';
	} elseif ( $content_width == 'narrow'){
		$content_class = 'container-narrow';
	} else {
		$content_class = '';
	}
}
$inner_class = $bg_color . ' ' . $padding . ' ' . $bg_class . ' ' . $bg_blend_class;
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $margin ); ?>">

	<div class="<?php echo esc_attr( $inner_class ); ?> <?php echo esc_attr( $bg_image_custom_class ); ?>" style="<?php echo esc_attr($bg_image_attr); ?>">

		<?php if ( get_field( 'patterns' ) == 0 ) : ?>
			<!-- <div class="absolute top-0 right-0 z-0 opacity-50"><?php get_template_part( '/svg/inline/inline', 'bg-dots-topright.svg' ); ?></div>
			<div class="absolute bottom-0 left-0 z-0 opacity-50"><?php get_template_part( '/svg/inline/inline', 'bg-dots-bottomleft.svg' ); ?></div> -->
		<?php endif; ?>

		<div class="relative <?php echo esc_attr($content_class); ?>">

			<?php echo "<InnerBlocks />"; ?>

		</div>

	</div>


</div>
