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
$id = 'home-hero-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'home-hero';
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

if ( ! empty( $bg_color ) ) {
	$bg_color = 'bg-' . $bg_color;
} else {
	$bg_color = 'bg-black';
}

// clone: spacing
$margin = get_field('margin');
if ( ! empty( $margin ) ) {
    $margin = 'my-' . $margin;
} else {
	$margin = '';
}
$padding = get_field('padding');
if ( ! empty( $padding ) && ($padding) !== 0 ) {
    $padding = 'py-' . $padding;
} else{
	$padding = 'py-190';
}

$title = get_field( 'title' );
$text = get_field( 'text' );
?>

<div class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr( $margin ); ?> <?php echo esc_attr($bg_color); ?>" id="<?php echo esc_attr( $id ); ?>">
	<div class="block-inner <?php echo esc_attr($padding); ?> relative overflow-hidden">
		<div class="container flex gap-80 items-center text-white">
			<div class="md:w-1/2">
				<?php if ($title): ?>
					<h1 class="">
							<?php echo esc_html( $title ); ?>
						<?php if ($title_2): ?>
							<span class="block text-nebula"><?php echo esc_html( $title_2 ); ?></span>
						<?php endif; ?>
					</h1>
				<?php endif; ?>
				<?php if ($text): ?>
						<p class="h6 max-w-3xl mx-auto"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>
				<div class="flex items-center justify-start gap-16 mt-30">
						<?php // Buttons Repeater ?>
						<?php if ( have_rows( 'buttons' ) ) : ?>
							<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>

							<?php $button_style = get_sub_field( 'buttons_button_style' );
								$link = get_sub_field('buttons_button_link');
								if( $link ):
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';

								?>

									<a class="btn <?php echo esc_attr($button_style); echo ' ' . esc_attr($btn_class); ?>"
									href="<?php echo esc_url( $link_url ); ?>"
									target="<?php echo esc_attr( $link_target ); ?>"
									title="<?php echo esc_html( $link_title ); ?>">
										<?php echo esc_html( $link_title ); ?>
									</a>
							<?php endif; ?>

							<?php endwhile; ?>
						<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="absolute inset-0 left-0 md:left-1/2 md:w-1/2 aspect-square bg-cover bg-center">
			<?php get_template_part( '/svg/inline/inline', 'home-hero-bg.svg' ); ?>
		</div>
	</div>
</div><!-- block -->
