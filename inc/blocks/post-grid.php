<?php
/**
 * Block template
 *
 * @package lexalytics
 * @license GPL-3.0-or-later
 *
 * Block Name: Post Grid
 * Category: text
 * Align: full
 */

$post_grid_option = get_field('post_grid_option');
$post_grid_post_type = get_field('post_type');
$post_grid_style = get_field('post_grid_style');
$post_grid_add_button = get_field('add_button');
$post_grid_button = get_field('post_grid_button');
$post_grid_baccent_color = get_field('accent_color');
$gap_class = get_field('gap_class');
$limit_posts = get_field('limit_posts');

?>
<script async src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<div class="block-inner showslist">
    <div class="relative">
        <div class="relative ">
            <div class="flex flex-col gap-24">
            <?php
			$time = current_time( 'timestamp' ); // Get current unix timestamp

			// Set up custom query with meta_query to compare event start date with today's date
			$args_post_grid_query = array (
			'post_type'              => 'shows', // your event post type slug
			'post_status'            => 'publish', // only show published events
			'orderby'                => 'meta_value', // order by date
			'meta_key'               => 'date', // your ACF Date & Time Picker field
			'meta_value'             => $time, // Use the current time from above
			'meta_compare'           => '>=', // Compare today's datetime with our event datetime
			'order'                  => 'ASC', // Show earlier events first
			'posts_per_page'         => $limit_posts,
			);
            if ($post_grid_option == 'custom' ){
                $post_grid_posts = get_field('post_grid_posts');

                // update query args
                $args_post_grid_query['post_type'] = 'any';
                $args_post_grid_query['posts_per_page'] = -1;
                $args_post_grid_query['post__in'] = $post_grid_posts;
                // print("<pre>".print_r($args_post_grid_query,true)."</pre>");
            }
            // The Query
            $post_grid_query = new WP_Query( $args_post_grid_query );

            // The Loop
            if ( $post_grid_query->have_posts() ) {
                while ( $post_grid_query->have_posts() ) {
                    $post_grid_query->the_post();

                    get_template_part(
                        'template-parts/content',
                        'shows',
                        array(
                            'accent-color'  => $post_grid_baccent_color,
                            'post-type' => $post_grid_post_type,
                        )
                    );

                }
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
            </div>

            <?php if($post_grid_add_button) { ?>
                <div class="flex <?php echo $post_grid_style == 'stacked' ? 'pt-20' : 'justify-center pt-40'; ?>">
                <a target="<?php echo $post_grid_button['target']?>" href="<?php  echo $post_grid_button['url']?>" class="flex items-center gap-6 hover:gap-10 transform hover:translate-x-4 font-semibold text-<?php echo $post_grid_baccent_color;?> transition ease-in-out duration-150"><span class="grow block"><?php echo $post_grid_button['title']?></span> <span class="block grow" aria-hidden="true"><?php include get_template_directory() . '/svg/inline/inline-arrow-right.svg.php'; ?></span></a>
                </div>
            <?php  } ?>

        </div>
    </div>



</div>
