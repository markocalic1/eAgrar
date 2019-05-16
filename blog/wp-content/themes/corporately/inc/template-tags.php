<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package corporately
 */

if ( ! function_exists( 'corporately_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function corporately_posted_on() {
        global $post;
    
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url( get_permalink() ),
                wp_kses( $time_string, array( 
                    'i' => array( 'class' => array() ), 
                    'span' => array( 'class' => array() ),
                    'time' => array( 'class' => array(), 'datetime' => array() ) 
                    ) )
    );

    $byline = sprintf(
                /* translators: %s: post author name */
        esc_html_x( 'By %s', 'post author', 'corporately' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    //echo '<span class="byline"> ' . $byline . '</span>';
        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
        
        // Categories
        if ( 'post' === get_post_type() || 'jetpack-portfolio' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
                if( 'post' === get_post_type() ) {
                    $categories_list = get_the_category_list( __( '</li><li>', 'corporately' ) );
                } elseif ( 'jetpack-portfolio' === get_post_type() ) {
                    $categories_list = get_the_term_list( $post->ID, 'jetpack-portfolio-type', '', '</li><li>', '' );
                }
        }
    }
endif;

if ( ! function_exists( 'corporately_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function corporately_entry_footer() {
    global $post;
    
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() || 'jetpack-portfolio' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
            if( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( esc_html__( ', ', 'corporately' ) );
            } elseif( 'jetpack-portfolio' === get_post_type() ) {
                $categories_list = get_the_term_list( $post->ID, 'jetpack-portfolio-type', '', esc_html_x(', ', 'Used between list items, there is a space after the comma.', 'corporately' ), '');
            }
        if ( $categories_list && corporately_categorized_blog() ) {
            printf( '<span class="cat-links">' . $categories_list . '</span>', $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
                if ( 'post' === get_post_type() ) {
                    $tags_list = get_the_tag_list( '<li class="label radius">', '</li><li class="label radius">', '</li>' );
                } elseif ( 'jetpack-portfolio' === get_post_type() ) {
                    $tags_list = get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '<li class="label radius">', '</li><li class="label radius">', '</li>' );
                }
        if ( $tags_list ) {
            echo '<ul class="tags-links">' . $tags_list . '</ul>'; // WPCS: XSS OK.
        }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'corporately' ), esc_html__( '1 Comment', 'corporately' ), esc_html__( '% Comments', 'corporately' ) );
        echo '</span>';
    }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function corporately_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'corporately_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'corporately_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so corporately_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so corporately_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in corporately_categorized_blog.
 */
function corporately_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'corporately_categories' );
}
add_action( 'edit_category', 'corporately_category_transient_flusher' );
add_action( 'save_post',     'corporately_category_transient_flusher' );



/*==============================================================================
 * corporately CUSTOM TAGS BELOW
 =============================================================================*/
/**
 * Fancy excerpts
 * 
 * @link: http://wptheming.com/2015/01/excerpt-versus-content-for-archives/
 */
function corporately_fancy_excerpt() {
    global $post;
    if( is_archive() ) {
       the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'corporately' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'corporately' ) . '</a>'; 
        echo '</div>';
    } elseif ( is_page_template( 'page-templates/page-child-pages.php' ) ) {
        the_excerpt();
         echo '<div class="continue-reading">';
        echo '<a class="continue-reading-arrow" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'corporately' ) . get_the_title() . '" rel="bookmark">&rarr;</a>'; 
        echo '</div>';
    } elseif ( has_excerpt() || is_page_template( 'page-templates/frontpage-portfolio.php' ) ) {
        the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'corporately' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'corporately' ) . '</a>'; 
        echo '</div>';
    } elseif ( strpos ( $post->post_content, '<!--more-->' ) ) {
        the_content();
                echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'corporately' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'corporately' ) . '</a>'; 
        echo '</div>';
    } elseif ( str_word_count ( $post->post_content ) < 200 ) {
        the_excerpt();
    } else {
        the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'corporately' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'corporately' ) . '</a>'; 
        echo '</div>';
    }
}

/*
 * Customize the read-more indicator for excerpts
 */
function corporately_excerpt_more( $more ) {
    if( is_admin() ) {
        return $more;
    }
    return " &hellip;";
}
add_filter( 'excerpt_more', 'corporately_excerpt_more' );

/**
 * Add an author box below posts
 * @link http://www.wpbeginner.com/wp-tutorials/how-to-add-an-author-info-box-in-wordpress-posts/
 */
function corporately_author_box() {
    global $post;
    
    // Detect if a post author is set
    if ( isset( $post->post_author ) ) {
        
        /*
         * Get Author info
         */
        $display_name = get_the_author_meta( 'display_name', $post->post_author );                  // Get the author's display name  
            if ( empty ( $display_name ) ) $display_name = get_the_author_meta( 'nickname', $post->post_author ); // If display name is not available, use nickname
        $user_desc =    get_the_author_meta( 'user_description', $post->post_author );              // Get bio info
        $user_site =    get_the_author_meta( 'url', $post->post_author );                           // Website URL
        $user_posts =   get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) );    // Link to author archive page
        
        /*
         * Create the Author box
         */
        $author_details  = '<aside class="author_bio_section">';
        $author_details .= '<h3 class="author-title"><span>' . esc_html__( 'About ', 'corporately' );
            if ( is_author() ) $author_details .= $display_name;        // If an author archive, just show the author name
            else $author_details .= esc_html__( 'the Author', 'corporately' ); // If a regular page, show "About the Author"
        $author_details .= '</span></h3>';
        
        $author_details .= '<div class="author-box">';
        $author_details .= '<section class="author-avatar">' . get_avatar( get_the_author_meta( 'user_email' ), 120 ) . '</section>';
        $author_details .= '<section class="author-info">';
        
        if ( ! empty( $display_name ) && ! is_author() ) {          // Don't show this name on an author archive page
            $author_details .= '<h3 class="author-name">';
            $author_details .= '<a class="fn" href="' . esc_url( $user_posts ) . '">' . $display_name . '</a>';
            $author_details .= '</h3>';
        }
        if ( ! empty( $user_desc ) ) 
            $author_details .= '<p class="author-description">' . $user_desc . '</p>';
        
        if ( ! is_author() ) {  // Don't show the meta info on an author archive page
            $author_details .= '<p class="author-links entry-meta"><span class="vcard">' . esc_html__( 'All posts by', 'corporately' ) . '<a class="fn" href="' . esc_url( $user_posts ) . '">' . $display_name . '</a></span>';

            // Check if author has a website in their profile
            if ( ! empty( $user_site ) ) 
                $author_details .= '<a class="author-site" href="' . esc_url( $user_site ) . '" target="_blank" rel="nofollow">' . esc_html__( 'Website', 'corporately' ) . '</a></p>';
            else $author_details .= '</p>';
        }
        
        $author_details .= '</section>';
        $author_details .= '</div>';
        $author_details .= '<p class="show-hide-author label">' . esc_html__( 'Hide', 'corporately' ) . '</p>';
        $author_details .= '</aside>';
        
        echo wp_kses_post( $author_details );

    }
    
}

function corporately_portfolio_index_footer() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<i class="fa fa-refresh tip"><span class="tooltip">' .
                        esc_attr__( 'First posted: ', 'corporately' ) .
                        '<time class="entry-date published" datetime="%1$s">%2$s</time></span>' . 
                    '</i>' . 
                    '<time class="entry-date published updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
            '<span><a href="%1$s" rel="bookmark">%2$s</a></span>',
            esc_url( get_permalink() ),
            wp_kses( $time_string, array( 
                    'i' => array( 'class' => array() ), 
                    'span' => array( 'class' => array() ),
                    'time' => array( 'class' => array(), 'datetime' => array() ) 
                    ) )
    );
    
    $project_type = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-entry-meta cat-links">', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'corporately' ), '</span>' );

    $output = '<footer class="entry-footer">';
    $output .= $posted_on;
    $output .= $project_type;
    $output .= '</footer>';
    
    echo wp_kses_post( $output );
}

if ( ! function_exists( 'corporately_breadcrumbs' ) ) :
/**
 * Display Post breadcrumbs when applicable.
 *
 * @since corporately 1.0
 * 
 * @link: https://www.branded3.com/blog/creating-a-really-simple-breadcrumb-function-for-pages-in-wordpress/
 */
function corporately_breadcrumbs() {
    
    global $post;
    
    $output = '';
    $breadcrumbs = array();
    $separator = '<span class="breadcrumb-separator">&raquo;</span>';
    $breadcrumb_id = 'breadcrumbs';
    $breadcrumb_class = 'entry-meta';
    
    $page_title = '<span class="current">' . get_the_title( $post->ID ) . '</span>';
    $home_link = '<a aria-label="' . esc_html__( 'Home', 'corporately' ) .'" title="' . esc_html__( 'Home', 'corporately' ) .'" class="breadcrumb-home" href="' . esc_url( home_url() ) . '"><i class="fa fa-home"></i></a>' . $separator;
    
    $output .= "<div aria-label='" . esc_html__( 'You are here:', 'corporately' ) . "' id='$breadcrumb_id' class='$breadcrumb_class'>";
    $output .= $home_link;
    
    if( $post->post_parent ) {
        $parent_id = $post->post_parent;
        
        while( $parent_id ) {
            $page = get_page( $parent_id );
            $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
            $parent_id = $page->post_parent;
        }
        
        $breadcrumbs = array_reverse( $breadcrumbs );
        $breadcrumbs_str = implode( $separator, $breadcrumbs ); 
        $output .= $breadcrumbs_str . $separator;
    }
    
    $output .= $page_title;
    $output .= "</div>";
    
    echo wp_kses_post( $output );
    
    }

endif;

/**
 * Social Menu
 */
function corporately_social_menu() {
    
    if ( has_nav_menu( 'social' ) ) {
        wp_nav_menu(
                array(
                    'theme_location'    => 'social',
                    'container'         => 'div',
                    'container_id'      => 'menu-social-container',
                    'container_class'   => 'menu-social',
                    'menu_id'           => 'menu-social-items',
                    'menu_class'        => 'menu-items',
                    'depth'             => 1,
                    'link_before'       => '<span class="screen-reader-text">',
                    'link_after'        => '</span>',
                    'fallback_cb'       => '',
                )
        );
    }
    
}

/*
 * Post Icon - can be set in any Post or Page with Custom Fields meta value 'post_icon'
 * Accepts BOTH Dashicons and FontAwesome icons - or returns nothing if neither fa- nor dashicons- precedes the String
 */
function corporately_post_icon() {
    
    $output = '';
    
    // Get the Page icon (if any - Set in Custom Fields for the Page)
    $icon = '';
    $icon = get_post_meta( get_the_ID(), 'post_icon', true ); // Set in the Custom Meta of the Post
    if( strstr( $icon, 'dashicons-' ) ) {
        $icon_class = 'dashicons ' . $icon;
    } else if( strstr( $icon, 'fa-' ) ) {
        $icon_class = 'fa ' . $icon;
    } else {
        $icon_class = '';
    }
    if ( $icon_class != '' ) {
        $output .= "<span class='$icon_class'></span>";
    }
    
    return $output;
    
}

function corporately_the_post_icon() {
    echo wp_kses( corporately_post_icon(), array( 'span' => array( 'class' => array() ) ) );
}

/**
 * Function to show the Jetpack sharing and Likes only at the designated locations in Posts and Pages
 */
function corporately_jetpack_sharing() {
    if ( function_exists( 'sharing_display' ) ) {
        sharing_display( '', true );
    }

    if ( class_exists( 'Jetpack_Likes' ) ) {
        $custom_likes = new Jetpack_Likes;
        echo esc_html( $custom_likes->post_likes( '' ) );
    }
}

/**
 * Prints HTML with post navigation.
 */
function corporately_post_navigation() {
    // Don't print empty makrup if there's nowhere to navigate.
    $previous   = ( is_attachment() ) ? get_post ( get_post() -> post_parent ) : get_adjacent_post( false, '', true );
    $next       = get_adjacent_post( false, '', false );
    
    if ( ! $next && ! $previous ) {
        return;
    }
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <p class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'corporately' ); ?></p>
        <div class="nav-links" data-equalizer>
                <?php
                        previous_post_link( '<div class="nav-previous" data-equalizer-watch><div class="nav-indicator">' . esc_html_x( 'Previous Post:', 'Previous post', 'corporately' ) . '</div><h4>%link</h4></div>', '%title' );
                        next_post_link(     '<div class="nav-next" data-equalizer-watch><div class="nav-indicator">'     . esc_html_x( 'Next Post:', 'Next post', 'corporately' ) . '</div><h4>%link</h4></div>', '%title' );
                ?>
        </div> <!-- .nav-links -->
    </nav> <!-- .navigation -->
    <?php
}

if ( ! function_exists( 'corporately_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function corporately_paging_nav() {
        the_posts_pagination( array(               
            'mid_size'      => 3,
            'prev_text' => __( 'Previous', 'corporately' ),
            'next_text' => __( 'Next', 'corporately' ),
            'type'      => 'list',
        ));
}
endif;


if ( ! function_exists( 'corporately_copyright' ) ) :
/** 
 * Dynamic Copyright as per WPBeginner.com
 * @source: http://www.wpbeginner.com/wp-tutorials/how-to-add-a-dynamic-copyright-date-in-wordpress-footer/
 */
function corporately_copyright() {
    
    global $wpdb;
    
    $copyright_dates = $wpdb->get_results( "SELECT YEAR(min(post_date_gmt)) AS firstdate, YEAR(max(post_date_gmt)) AS lastdate FROM $wpdb->posts WHERE post_status = 'publish' " );
    $output = '';
    $blog_name = get_bloginfo();
    
    if ( $copyright_dates ) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if ( $copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate ) {
            $copyright .= " &ndash; " . $copyright_dates[0]->lastdate;
        }
        $output = $copyright . " " . $blog_name;
    }
    return $output;
}
endif;

