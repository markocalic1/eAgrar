<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package corporately
 */

get_header(); ?>

<?php if ( is_page_template( 'page-templates/page-sidebar-right.php' ) || get_theme_mod( 'layout_setting' ) === 'sidebar-right' ) { ?>

<div id="primary" class="content-area small-12 medium-8 columns sidebar-right">

    <?php } else if ( is_page_template( 'page-templates/page-sidebar-left.php' ) || get_theme_mod( 'layout_setting' ) === 'sidebar-left' ) { ?>

    <div id="primary" class="content-area small-12 medium-8 medium-push-4 columns sidebar-left">

        <?php } else if ( is_page_template( 'page-templates/page-no-sidebar.php' ) || get_theme_mod( 'layout_setting' ) === 'no-sidebar' ) { ?>
        
        <div id="primary" class="content-area small-12 medium-10 medium-push-1 large-8 large-push-2 columns no-sidebar">

            <?php } else if ( is_page_template( 'page-templates/page-full-width.php' ) ) { ?>

            <div id="primary" class="content-area medium-12 columns no-sidebar page-full-width">

                <?php } else { ?>   

                <div id="primary" class="content-area small-12 medium-8 columns sidebar-right">

                    <?php } ?>

                    <main id="main" class="site-main" role="main">


                        <?php if ( have_posts() ) : ?>



                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'components/post/content', get_post_format() );
                            ?>

                        <?php endwhile; ?>
                        <?php corporately_paging_nav(); ?>

                    <?php else : ?>
                    <?php get_template_part( 'components/post/content', 'none' ); ?>



                <?php endif; ?>




            </main>
        </div>
        <?php
        get_sidebar();
        get_footer();