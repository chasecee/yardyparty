<?php
/**
 * Block template
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: Icon Links
 * Category: text
 * Align: full
 * Mode: preview
 */
$id = 'icon-links-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'block-icon-links';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
// add more to classes
$classes .= ' relative flex justify-start';

$orientation = get_field( 'orientation' );
if ( ! empty($orientation )) {
   if ( $orientation == 'row' ){
	$orientation_class = 'flex-row';
   } elseif( $orientation == 'col' ) {
	$orientation_class = 'flex-col';
   }
}
$grid_classes .= ' ' . $orientation_class;

$gap = get_field('gap');
$gap_override = get_field('gap_override');
if ( ! empty( $gap ) ) {
    $gap_class = ' gap-' . $gap;
} else {
	$gap_class = ' gap-40';
}
if ( ! empty( $gap_override ) ) {
    $gap_class = $gap_override;
}
$grid_classes .= ' ' . $gap_class;

$align = get_field('align');

if ( ! empty( $align ) ) {
    $align_class = $align;
} else {
	$align_class = "items-center";
}

$grid_classes .= ' ' . $align_class;

$icons_order = get_field( 'icons_order' );
if ( ! empty($icons_order )) {
	if ( $icons_order == 'text_first' ){
	 $icons_order_class = 'order-1';
	} else {
	 $icons_order_class = 'flex-col';
	}
 }
$text_display = get_field( 'text_display' );
$icons_display = get_field( 'icons_display' );
$icons_color = get_field('icons_color');
if ( ! empty($icons_color )) {
	$icons_color_class = 'text-' . $icons_color;
 } else {
	 $icons_color_class = 'text-current';
 }
?>
<div class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $grid_classes ); ?>">
	<?php if ( have_rows( 'icons' ) ) : ?>
		<?php while ( have_rows( 'icons' ) ) : the_row(); ?>
			<?php $item_link = get_sub_field( 'item_link' );
			$item_icon = get_sub_field( 'item_icon' );
			$newText = convertHexToCurrentColor($item_icon);
			?>

			<?php if ( $item_link ) { ?>
				<a class="flex items-center gap-12" href="<?php echo esc_url( $item_link['url'] ); ?>" target="<?php echo esc_attr( $item_link['target'] ); ?>">
					<?php if ( ! empty($icons_display )) {
						if ( $icons_display == 'show' ){ ?>
							<span class="<?php echo esc_attr( $icons_order_class ); ?> <?php echo esc_attr( $icons_color_class ); ?>"><?php echo wp_kses( $newText, get_kses_extended_ruleset() ); ?></span>
						<?php } } ?>
					<?php if ( $text_display == 'show_text' ){ ?>
						<span class="<?php echo esc_attr($text_display_class); ?>"><?php echo esc_html( $item_link['title'] ); ?></span>
					<?php } ?>
				</a>
			<?php } else { ?>
				<span class="flex items-center gap-12" >
					<?php if ( ! empty($icons_display )) {
							if ( $icons_display == 'show' ){ ?>
					<span class="<?php echo esc_attr( $icons_order_class ); ?>  <?php echo esc_attr( $icons_color_class ); ?>"><?php echo wp_kses( $newText, get_kses_extended_ruleset() ); ?></span>
					<?php } } ?>
					<?php if ( $text_display == 'show_text' ){ ?>
						<span class="<?php echo esc_attr($text_display_class); ?>"><?php echo esc_html( 'Select a Link' ); ?></span>
					<?php } ?>
				</span>
			<?php } ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
