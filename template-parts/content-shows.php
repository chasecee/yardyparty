<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>
<?php $postid = get_the_ID(); ?>
	<article <?php post_class( 'post-container' ); ?>>
		<div class="entry-content show relative">
			<?php
			$show_date = get_field( 'date', $postid );
			$date_formatted = get_field( 'date_formatted', $postid );
			$postidstring = $postid . 'post';
			?>
			<div class="banner">
				<p class="banner-title">NEXT SHOW IN <span class="date_item" data-date="<?php echo $show_date; ?>" id="<?php echo esc_attr($postidstring); ?>"></span></p>
				<div class="arrow">

<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_h03opD.json"  background="transparent"  speed=".75"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
				</div>
			</div>

			<div class="panel text-stroke relative uppercase">
				<h2 class="display-1"><?php echo esc_html( $date_formatted ); ?></h2>
				<?php
				if( have_rows('artists', $postid ) ):
					while( have_rows('artists', $postid) ) : the_row(); ?>
						<?php $artist_title = get_sub_field('artist_title'); ?>
						<h3 class="display-4"><?php echo esc_html( $artist_title ); ?></h3>
				<?php
					endwhile;
				endif;
				?>
				<a class="btn no-text-stroke mt-24" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">CHECK IT</a>
			</div>




			<?php
//     $today = strtotime( date( 'ymd' ) );
//     $meeting = strtotime( get_field( 'date', $postid ) );
//     $diff = ceil( abs( $meeting - $today ) / 86400 );
// if ( $diff >= 1 ) {
//     echo esc_html( 'show is more than one day out' );
// } else {
//     echo esc_html( 'Show in one day!' );
// }

?>
			<?php the_content(); ?>
		</div><!-- .entry-content -->


	</article><!-- #post-## -->
