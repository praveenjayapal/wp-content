<?php
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<?php
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'barrier-reef-orchestra' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'barrier-reef-orchestra' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'barrier-reef-orchestra' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'barrier-reef-orchestra' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
			?>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>