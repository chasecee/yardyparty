<?php
/**
 * Block template: Features Side by Side
 */
$slug = 'feature-side-by-side';
$id = $slug . '-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'block-' . $slug;
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
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
	$padding = '';
}
if ( ! empty( $padding_override )) {
    $padding = $padding_override;
}

$template = array(
	array('core/heading', array(
		'level' => 3,
		'content' => 'Transfer funds world-wide',
	)),
    array( 'core/paragraph', array(
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur minima sequi recusandae, porro maiores officia assumenda aliquam laborum ab aliquid veritatis impedit odit adipisci optio iste blanditiis facere. Totam, velit.',
    ) ),
	array( 'core/button', array(
        'text' => 'Get started',
    ) ),
);

// combine classes
$classes .= ' ' . $padding . ' ' . $margin . ' ';

// acf vars
$image = get_field( 'image' );
$size = 'full';
if ( get_field( 'flip_columns' ) == 1 ) {
	$columns = 'md:order-last';
}
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> relative">
		<div class="grid md:grid-cols-2 items-justified-center gap-30">
			<div class="<?php echo esc_attr($columns); ?> md:py-30 flex flex-col justify-center">
				<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
			</div>
			<?php if ( $image ) : ?>
				<div class="text-center relative">
					<?php echo wp_get_attachment_image( $image, $size, "", ["class" => "inline"] ); ?>
				</div>
			<?php else : ?>
				<div class="text-center relative">
					<div class="m-40">
						<div class="border-4 border-zinc-300 flex font-semibold items-center justify-center rounded-3xl text-center text-zinc-300" style="width: 100%;height: 30rem;"><div>Select a Photo</div></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
</div>
