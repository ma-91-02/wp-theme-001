<?php
/**
 * Template Name: Post Full width
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Your_MA
 */

get_header();
get_search_form();
?>
<style>
    .site-main{
        width: 100%;
    }
    .search-form{
        margin:1rem;
    }
    .post-widget{
        width:100%;
        text-align:center;
    }
</style>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ma' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ma' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
    <div class="post-widget"><?php the_widget('WP_Widget_Meta');?></div>

<?php
get_footer();
