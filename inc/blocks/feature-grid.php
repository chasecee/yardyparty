<?php
/**
 * Block template for Feature Grid
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: Feature Grid
 * Category: text
 * Align: full
 * Mode: preview
 */
$id = 'feature-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'block-feature-grid';
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

if ( ! empty( $bg_color ) ) {
	$bg_color = 'bg-' . $bg_color;
} else {
	$bg_color = 'bg-zinc-50';
}

// clone: spacing
$margin = get_field('margin');
if ( ! empty( $margin ) ) {
    $margin = 'my-' . $margin;
}
$padding = get_field('padding');
if ( ! empty( $padding ) && ($padding) !== 0 ) {
    $padding = 'py-' . $padding;
} else{
	$padding = 'py-100';
}

if ( get_field( 'patterns' ) == 0 ) {
	$classes .= ' overflow-hidden';
}
// acf vars
$icon_bg_colors = get_field('icon_bg_colors');
if ( ! empty( $icon_bg_colors )) {
    $icon_bg_colors = 'bg-' . $icon_bg_colors;
} else{
	$icon_bg_colors = 'bg-mars';
}
$classes .= ' grid';

$columns = get_field('columns');
if ( ! empty( $columns ) ) {
    $classes .= ' md:grid-cols-' . $columns;
}
$column_gap = get_field('column_gap');
$column_gap_override = get_field('column_gap_override');
if ( ! empty( $column_gap ) ) {
    $gap_class = ' gap-' . $column_gap;
} else{
	$gap_class = ' gap-40';
}
if ( ! empty( $column_gap_override ) ) {
    $gap_class = $column_gap_override;
}
$classes .= ' ' . $gap_class;

$icon_alignment = get_field('icon_alignment');
$boxed_bg = get_field('boxed_bg');
$text_layout = 'items-baseline';
if ( $icon_alignment === 'left' ) {
	$icon_alignment = 'flex-row';
	$text_layout .= ' justify-between';
} elseif ( $icon_alignment === 'top' ) {
	$icon_alignment = 'flex-col';
	$text_layout .= ' justify-between';
} elseif ( $icon_alignment === 'top-center' ) {
	$icon_alignment = 'flex-col mt-24 pt-0';
	$icon_alignment_self = 'self-center relative transform-gpu -translate-y-1/2';
	$layout = 'p-24 pb-32 rounded-3xl';

	if ( ! empty( $boxed_bg ) ) {
		$layout .= ' bg-' . $boxed_bg;
	}
	$text_layout = 'items-center text-center';
}

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $margin ); ?>">

	<?php if ( have_rows( 'features' ) ) : ?>
		<?php while ( have_rows( 'features' ) ) : the_row(); ?>
			<?php // acf vars
				$svg_code = get_sub_field( 'svg_code' );
				$image = get_sub_field( 'image' );
				$title = get_sub_field( 'title' );
				$description = get_sub_field( 'description' );
				$button_link = get_sub_field( 'button_link' );
			?>
			<div class="flex gap-16 <?php echo esc_attr($icon_alignment); ?> <?php echo esc_attr($layout); ?>">
				<?php if ( get_field( 'icons' ) == 'visible' ) : ?>
					<div class="w-48 h-48 rounded-md flex justify-center items-center flex-none <?php echo esc_attr( $icon_bg_colors ); ?> <?php echo esc_attr( $icon_alignment_self ); ?>">
						<div class="">
							<?php if ( ! empty( $image ) ) : ?>
								<?php echo wp_get_attachment_image( $image, $size ); ?>
							<?php else: ?>
								<?php echo wp_kses( $svg_code, get_kses_extended_ruleset() ); ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="flex flex-auto flex-col gap-16 <?php echo esc_attr($text_layout); ?>">
					<div>
						<?php if ($title): ?>
							<h3 class="h4">
									<?php echo esc_html( $title ); ?>
							</h3>
						<?php endif; ?>
						<?php if ($description): ?>
								<p class=""><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
					</div>
					<?php if ( get_field( 'buttons' ) == 'visible' ) : ?>
						<?php if ( $button_link ) : ?>
							<a class="link" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>">
								<?php echo esc_html( $button_link['title'] ); ?>
								<?php get_template_part( '/svg/inline/inline', 'arrow-right.svg' ); ?>
							</a>
							<?php else:  ?>
							<a class="link" href="#" >
								Learn More
								<?php get_template_part( '/svg/inline/inline', 'arrow-right.svg' ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>



			<?php $image = get_sub_field( 'image' ); ?>
			<?php $size = 'full'; ?>
			<?php if ( $image ) : ?>
				<?php echo wp_get_attachment_image( $image, $size ); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>

</div>
