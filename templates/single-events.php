<?php
/**
 * The Template for displaying all single Event posts.
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
            while ( have_posts() ) :
                the_post();
				$id = get_the_ID();
				// do something with get_field
			endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>