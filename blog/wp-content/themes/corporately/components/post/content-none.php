<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corporately
 */

?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found hentry">
	<header class="entry-header">
		<h1 class="entry-title">
                    <?php 
                    if ( is_404() ) { esc_html_e( 'Nothing found', 'corporately' ); }
                    else if ( is_search() ) { printf( esc_html_e( 'Nothing found for ', 'corporately' ) . '<ins>' . get_search_query() . '</ins>' ); } 
                    else if ( is_page_template( 'page-templates/page-client.php' ) ) { esc_html_e( 'Additional Setup required', 'corporately' ); }
                    else { esc_html_e( 'Nothing found', 'corporately' ); }
                    ?>
                </h1>
	</header><!-- .page-header -->

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php 
                            /* translators: %1$s: link to create a new post */
                            printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'corporately' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); 
                        ?></p>

		<?php elseif ( is_404() ) : ?>
                        
                        <p><?php esc_html_e( 'Are you lost? Try another search below or click one of the latest posts.', 'corporately' ); ?></p>
                        <?php get_search_form(); ?>
                             
                <?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'corporately' ); ?></p>
			<?php get_search_form(); ?>
                        
                <?php elseif ( is_page_template( 'page-templates/page-client.php' ) ) : ?>

			<p><?php esc_html_e( 'Please check the following THREE conditions to display client projects on this page:', 'corporately' ); ?></p>
                        <ol>
                            <li><?php esc_html_e( 'Be sure Jetpack and its Portfolio custom content type are activated.', 'corporately' ); ?></li>
                            <li><?php esc_html_e( 'In THIS PAGE assign a custom meta key of client with a value of the Clients name ie client WordPress.', 'corporately' ); ?></li>
                            <li><?php esc_html_e( 'On every Client Project page (i.e. something created for WordPress), be sure to Tag it with the same Client name.', 'corporately' ); ?></li>
                        </ol>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we cant find what you are looking for. Perhaps searching can help.', 'corporately' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
    </section><!-- .no-results -->

    <?php if ( is_404() || is_search() ) { ?>

            <header class="page-header not-found">
                <h1 class="page-title"><?php esc_html_e( 'Recent Posts:' , 'corporately' ); ?></h1>
            </header>
    

    
            <?php 
                // Get the 5 latest posts
            $args = array(
                'posts_per_page' => 5
            );

            $latest_posts_query = new WP_Query( $args );

            // The Loop
            if ( $latest_posts_query->have_posts() ) {
                while ( $latest_posts_query->have_posts() ) {

                        $latest_posts_query->the_post();
                        
                        // Get standard index page content
                        get_template_part( 'components/post/content', get_post_format() );
                }
            }
            /* Restore original Post Data */
            wp_reset_postdata();
    }
    ?>
