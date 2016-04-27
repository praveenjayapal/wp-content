<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package barrier-reef-orchestra
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <?php
        if(has_excerpt($post -> ID))
        {
            echo '<div class="deck">';
            echo '<p>'.get_the_excerpt().'</p>';
            echo '</div> <!-- .deck -->';
        }
        ?>
        <div class="entry-meta">
            <?php barrier_reef_orchestra_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'barrier-reef-orchestra' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php barrier_reef_orchestra_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->