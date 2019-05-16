<?php
/**
 * The template used for displaying projects on index view
 *
 * @package corporately
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php
            if ( '' != get_the_post_thumbnail() ) { ?> style="background: white url(<?php echo esc_url( the_post_thumbnail_url( 'corporately-featured-image' ) ); ?>);" <?php } ?>>
    
    <div class="post-content <?php echo has_post_thumbnail() ? 'post-thumbnail' : ''; ?>">
        
	<header class="portfolio-entry-header">
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
	</header>
        
        <div class="entry-content">
            
            <?php corporately_fancy_excerpt(); ?>
            
        </div>
        
    </div>
    
</article>
