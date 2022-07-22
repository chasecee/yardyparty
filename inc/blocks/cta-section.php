<?php
/**
 * Block template
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: CTA Section
 * Category: text
 * Align: full
 * Mode: preview
 */
$id = 'cta-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'block-cta-section';
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
$foreground_color = get_field('foreground_color');
$text_color = get_field('text_color');

if ( ! empty( $bg_color ) ) {
	$bg_color = 'bg-' . $bg_color;
} else {
	$bg_color = 'bg-black';
}
if ( ! empty( $foreground_color ) ) {
	$foreground_color = 'bg-' . $foreground_color;
}
if ( ! empty( $text_color ) ) {
	$text_color = 'text-' . $text_color;
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
$template = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'Join our team',
	)),
    array( 'core/paragraph', array(
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur minima sequi recusandae, porro maiores officia assumenda aliquam laborum ab aliquid veritatis impedit odit adipisci optio iste blanditiis facere. Totam, velit.',
    ) )
);
$style = get_field('style');

?>
<?php if( $style == 'brand-overlap' ): ?>
	<?php if ( empty( $text_color ) ) {
	$text_color = 'text-white';
	} ?>

	<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $margin ); ?> <?php echo esc_attr( $bg_color ); ?>">
		<div class="<?php echo esc_attr( $padding ); ?> <?php echo esc_attr( $text_color ); ?>">

			<div class="relative container">
				<div class="z-0 absolute inset-0 top-150 md:top-0 md:left-1/4 md:rounded-3xl <?php echo esc_attr( $foreground_color ); ?>"></div>
				<div class="flex md:flex-row flex-col items-center gap-20 relative">
					<div class="md:w-1/3">
						<div class="rounded-3xl md:py-64">
							<?php $bg_image = get_field( 'bg_image' );
							$size = 'full';
							if ( $bg_image ) :
								echo wp_get_attachment_image( $bg_image, $size );
							endif; ?>
						</div>
					</div>
					<div class="md:w-2/3">
						<div class="p-150 md:pl-100">
							<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endif; // if style: brand-overlap ?>
