<?php
/**
 * Template Name: Front Page
 *
 * @package corporately
 */
?>


<?php

/**
 * The custom template for the one-page style front page. Kicks in automatically
 * @link: http://www.designwall.com/guide/dw-page/ (Good for design ideas)
 * 
 * @TODO: Add CONDITIONAL statements to test for the existence of each of the pages - OR add dummy content to tell people to fill those in
 */

get_header(); ?>

<?php

// Can probably get rid of Incomplete Sections Warnings with new 
// Customizer implementation of front page sections
$incomplete_sections = 0;
$incomplete_section_ids = array();
?>

	<div id="primary" class="content-area front-page<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
            
                    <?php         
        /**
         * /////////////////////////////////////////////////////////////////////
         * SERVICES SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */
        if( get_theme_mod( 'panel_services' ) ) :
                   
                // FIRST QUERY : Get the 'Services' Page
                $pagename = get_theme_mod( 'panel_services' );
                $query = new WP_Query( array( 'page_id' => $pagename ) );

                // If we have a 'Services' page
                if( $query->have_posts() ) { ?>

                    <!-- Begin the 'Services' section -->
                    <section id="services">

                    <?php
                    // SECOND QUERY : Check for Child Pages of 'Services'
                    $args = array(
                        'post_type'     => 'page',
                        'post_parent'   => $pagename,
                        'posts_per_page'=> 12, // This is the parameter passed in to tell how many Service Child Pages to display
                        'orderby'       => 'rand',
                    );
                    $services_query = new WP_Query( $args );

                    // The Loop : Displays random Services
                    // If there are Child Pages of 'Services'
                    if ( $services_query->have_posts() ) { ?>

                        <!-- Start the 'Services' list -->
                        <ul class="row entry-content services-list archive-list">
                            <li class="rotating-services large-8 medium-12 columns">
                            <ul class="rotating-services-div">
                        <?php
                        while ( $services_query->have_posts() ) : $services_query->the_post();

                            echo '<li class="service large-12 columns">';
                            get_template_part( 'components/features/frontpage/front', 'services' ); 
                            echo '</li>';

                        endwhile; // END looping through 'Service' Child Pages
                        ?>
                            </ul><!-- .rotating-services -->
                            </li>
                            
                        <?php

                    } else { // No Posts in the Services Child Pages query

                        // Get the 'Services' Page
                        $query->the_post();
                        
                        echo '<li class="service services-page large-12 columns">';
                        get_template_part( 'components/features/frontpage/front', 'services' );
                        echo '</li>';

                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Pages: Individual Service Pages', 'corporately' );

                    }
                    
                    // This is our original Query - the 'Services' Page
                    while ( $query->have_posts() ) : $query->the_post();
                        
                        echo '<li class="service services-page large-4 medium-12 columns">';
                        get_template_part( 'components/features/frontpage/front', 'services' );
                        echo '</li>';
                        
                    endwhile; 

                    // Restore original Post Data (SECOND LOOP)
                    wp_reset_postdata();
                    ?>
                   
                    </ul><!-- .services-list -->

                    </section><!-- #services -->

                <?php
                } else { // No 'Services' Page

                    // (else) Restore original Post Data (FIRST LOOP)
                    wp_reset_postdata();

                    $incomplete_sections++;
                    $incomplete_section_ids[] = esc_attr__( 'Page: Services', 'corporately' );

                } 
                ?>
                        
                    <?php  
        endif;
        
        /**
         * /////////////////////////////////////////////////////////////////////
         * CLIENTS SECTION =====================================================
         * /////////////////////////////////////////////////////////////////////
         */                 
        if( get_theme_mod( 'panel_clients' ) ) :  
            
                /*
                 * CLIENTS LOOP : Get ALL individual Client Pages
                 */
                $pagename = get_theme_mod( 'panel_clients' );
                $query = new WP_Query( array( 'page_id' => $pagename ) );

                if ( $query->have_posts() ) { ?>
                    <section id="clients">    
                    
                        <?php
                        // Get the children of the clients page
                        $args = array(
                            'post_type'     => 'page',
                            'post_parent'   => $pagename,
                            'posts_per_page'=> 24,
                            'orderby'       => 'rand'
                        );
                        $clients_query = new WP_Query( $args );

                        // The Loop
                        if ( $clients_query->have_posts() ) {
                            echo '<h3 class="widget-title front-page-title"><a href="' . esc_url( home_url( "/clients/" )) . '">' . esc_attr__( 'Clients', 'corporately' ) . '</a></h3>';
                            echo '<ul class="clients-list entry-content row">';
                            while ( $clients_query->have_posts() ) : $clients_query->the_post();

                                get_template_part( 'components/features/frontpage/front', 'clients' );

                            endwhile;
                            echo '</ul>';

                        } else {
                            // No 'Clients' Child Pages found
                            $incomplete_sections++;
                            $incomplete_section_ids[] = esc_attr__( 'Pages: Individual Client Pages', 'corporately' );
                        } ?>
                    
                    </section><!-- #clients -->
                
                <?php
                } else {
                    // No 'Clients' Page found
                    $incomplete_sections++;
                    $incomplete_section_ids[] = esc_attr__( 'Page: Clients', 'corporately' );
                }
                // Restore original Post Data
                wp_reset_postdata();
                ?>
                        
                        
                    <?php
        endif;
        /**
         * /////////////////////////////////////////////////////////////////////
         * HOME SECTION ========================================================
         * /////////////////////////////////////////////////////////////////////
         */
                    ?>
        <!-- BEGIN main page content -->
        <div class="front-page-page row">
                        
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'components/page/content', 'page' );

                    endwhile;
                    
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                        
                          
                    <?php             
        /**
         * /////////////////////////////////////////////////////////////////////
         * ABOUT SECTION =======================================================
         * /////////////////////////////////////////////////////////////////////
         */  
        if( get_theme_mod( 'panel_about' ) ) :  
            
                    $pagename = get_theme_mod( 'panel_about' );
                    $query = new WP_Query( array( 'page_id' => $pagename ) );

                    // The Loop
                    if ( $query->have_posts() ) {
                        ?>

                        <section id="about" class="frontpage-subpage">         

                        <?php
                        while ( $query->have_posts() ) {
                            
                            $query->the_post();
                            get_template_part( 'components/features/frontpage/front', 'subpage' );

                        }
                        ?>

                        </section><!-- #about -->       

                    <?php 
                    } else {

                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Page: About', 'corporately' );
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                        
        </div>
        <!-- END main page content -->        
                        
                    <?php
        endif;
        /**
         * /////////////////////////////////////////////////////////////////////
         * PROJECTS SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */
                    $args = array(
                        'posts_per_page'    => 16,
                        'orderby'           => 'desc',
                        'post_type'         => 'jetpack-portfolio'
                    );

                    $query = new WP_Query( $args );

                    // The Loop
                    if ( $query->have_posts() ) { ?>
                        <section id="latest-projects" class="group">

                            <h2 class="widget-title front-page-title"><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_attr_e( 'Latest Projects', 'corporately' ); ?></a></h2>
                            <div class="front-page-projects archive row">

                            <?php  
                            while ( $query->have_posts() ) : $query->the_post();
                                echo '<div class="archive-item index-post small-12 medium-6 large-3 columns">';
                                    /*
                                     * Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'components/features/portfolio/content', 'portfolio' );
                                echo '</div>';
                            endwhile;
                            ?>

                            </div>
                            <a class="button more-link" role="button" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_attr_e( 'View Full Portfolio &rarr;', 'corporately' ); ?></a>
                        </section><!-- #latest-work -->

                    <?php
                    } else {
                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Jetpack Portfolio Projects', 'corporately' );
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>

                            
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * TESTIMONIALS SECTION ======================================
         * /////////////////////////////////////////////////////////////////////
         */        
                    
                /**
                 * BEGIN TESTIMONIALS SECTION =======================================
                 */
                    
                    /*
                     * LOOP : Gets (up to) 10 individual testimonials (images ONLY)
                     */
                    $args = array(
                        'posts_per_page'    => 10,
                        'orderby'           => 'rand',
                        'post_type'         => 'jetpack-testimonial',
                    );

                    $query = new WP_Query( $args );

                    //The Loop
                    if ( $query->have_posts() ) { ?>
                        
                        <section id="testimonials">
                            <div class="testimonials entry-content row">
                                
                            <ul class="testimonial-quotes">
                            <?php
                            while ( $query->have_posts() ) : $query->the_post(); 
                            
                                if ( '' != get_the_post_thumbnail() ) : ?>
                                    <li class="quote quote-<?php echo get_the_ID(); ?>" data-thumb="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'medium' ) ); ?>">
                                    <?php get_template_part( 'components/features/frontpage/front', 'testimonials' ); ?>
                                    </li>
                                <?php
                                endif;

                            endwhile;
                            ?>
                            </ul>    
                            </div>
                        </section><!-- #testimonials -->
                        
                    <?php
                    } else {
                        
                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Jetpack Testimonials', 'corporately' );
                    }
                    // Restore original Post Data
                    wp_reset_postdata();

        /**
         * /////////////////////////////////////////////////////////////////////
         * BLOG SECTION ========================================================
         * /////////////////////////////////////////////////////////////////////
         */     

                    $sticky = get_option( 'sticky_posts' );
                    $sticky_num = count($sticky);
                    $pages_to_retrieve = 8 - $sticky_num;

                    $args = array(
                        'posts_per_page'    => $pages_to_retrieve,
                        'orderby'           => 'rand',
                        'post_type'         => 'post',
                    );

                    $query = new WP_Query( $args );

                    // The Loop
                    if ( $query->have_posts() ) { ?>

                        <section id="blog">
                            <h2 class="widget-title front-page-title"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_attr_e( 'Latest Articles', 'corporately' ); ?></a></h2>
                            <div class="front-page-blog archive row">

                            <?php
                            while( $query->have_posts() ) : $query->the_post();

                                echo '<div class="archive-item index-post small-12 medium-6 large-3 columns">';
                                get_template_part( 'components/post/content', get_post_format() );
                                echo '</div>';

                            endwhile;
                            ?>
                                
                            </div>
                            <a class="button more-link" role="button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_attr_e( 'See More Articles &rarr;', 'corporately' ); ?></a>
                        </section><!-- #blog -->

                    <?php
                    } else {
                        get_template_part( 'components/post/content', 'none' );

                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Blog', 'corporately' );
                    }
                    // Restore original Post Data
                    wp_reset_postdata();

        /**
         * /////////////////////////////////////////////////////////////////////
         * CONTACT SECTION =====================================================
         * /////////////////////////////////////////////////////////////////////
         */ 
        if( get_theme_mod( 'panel_contact' ) ) :
                    
                    $pagename = get_theme_mod( 'panel_contact' );
                    $query = new WP_Query( array( 'page_id' => $pagename ) );

                    // The Loop
                    if ( $query->have_posts() ) { ?>
                        <div class="front-page-page row">
                        <section id="contact" class="frontpage-subpage">
                        
                            <?php
                            while ( $query->have_posts() ) : $query->the_post();

                                get_template_part( 'components/features/frontpage/front', 'subpage' );

                            endwhile;
                            ?>
                        
                        </section><!-- #contact -->
                        </div>
                    <?php
                    } else {

                        $incomplete_sections++;
                        $incomplete_section_ids[] = esc_attr__( 'Page: Contact', 'corporately' );
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
        endif;
                    
        /**
         * /////////////////////////////////////////////////////////////////////
         * WARNINGS SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */   
                    if ( $incomplete_sections > 0 && is_user_logged_in() ) : ?>
                        <section id="warnings <?php echo get_theme_mod( 'corporately_show_front_page_notifications', '1' ) == '0' ? 'hide' : '' ?>">
                        
                            <h2 class="page-title"><?php esc_attr__( 'Notifications', 'corporately' ); ?></h2>
                            <div class="entry-content row">
                                <h4><?php printf( esc_html__('You have %s incomplete Front Page sections.', 'corporately' ), $incomplete_sections ); ?></h4>
                                <p><?php esc_html_e( 'Complete the sections listed below OR turn off notifications in the Theme Customizer.', 'corporately' ); ?></p>
                                <ol>
                                <?php
                                    foreach( $incomplete_section_ids as $incomplete_section_id ) {
                                        echo "<li>" . esc_html( $incomplete_section_id ) . "</li>";
                                    }
                                ?>
                                </ol>
                            </div>
                        
                        </section>
                    <?php endif; ?>
                    
	</div><!-- #primary -->

<?php get_footer(); ?>