<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package barrier_reef_orchestra
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title index-excerpt"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="index-entry-meta">
				<?php barrier_reef_orchestra_index_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content index-excerpt">
		<?php
		the_excerpt();
		?>
	</div><!-- .entry-content -->

	<div class="continue-reading">
		<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" >
			<?php
			printf(
				wp_kses( __( 'Continue reading %s ', 'barrier_reef_orchestra' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) ;


			?>
		</a>
	</div>

	
</article><!-- #post-## -->