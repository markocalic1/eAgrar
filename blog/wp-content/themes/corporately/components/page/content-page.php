<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corporately
 */

?>
<?php if ( ! is_page_template( 'page-templates/frontpage-portfolio.php' ) && ! is_page_template( 'page-templates/page-child-pages.php' ) ) : ?>
<?php if ( '' != get_the_post_thumbnail() ) : ?>
    <div class="index-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'corporately-featured-image' ); ?>
            </a>
    </div>
<?php endif; ?>
<?php endif; ?>

<?php if( ! is_page_template( 'page-templates/page-child-pages.php' ) ) { ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
    
	<header class="entry-header">
            
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            
                <?php if ( ! is_page_template( 'page-templates/frontpage-portfolio.php' ) ) : ?>
                <?php endif; ?>
            
	</header>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'corporately' ),
				'after'  => '</div>',
			) );
                        
                        corporately_jetpack_sharing();
		?>
	</div>
    
    <?php 
    // Don't end the article if we want to display child pages too
    // "entry-footer" and </article> are present on that template
    if ( ! is_page_template( 'page-templates/page-child-pages.php' ) && is_user_logged_in() ) : 
    ?>

    
    <?php endif; ?>
        
<?php if( ! is_page_template( 'page-templates/page-child-pages.php' ) ) { ?>
    </article><!-- #post-## -->
<?php } ?>