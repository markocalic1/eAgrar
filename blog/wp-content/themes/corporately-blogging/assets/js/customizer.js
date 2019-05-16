/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.top-bar-title .site-title a' ).text( to );
		} );
	} );
        wp.customize( 'header_title_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .site-title' ).css( {
                'color':to
            });
        } );
    } );
        wp.customize( 'header_tagline_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .site-description' ).css( {
                'color':to
            });
        } );
    } );
        wp.customize( 'header_tagline_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-description:before' ).css( {
                'background':to
            });
        } );
    } );
      wp.customize( 'header_bg_color', function( value ) {
        value.bind( function( to ) {
            $( 'div#header-image' ).css( {
                'background':to
            });
        } );
    } );
     wp.customize( 'nav_bg', function( value ) {
        value.bind( function( to ) {
            $( 'ul.sub-menu.dropdown.childopen, .main-navigation ul li a:hover, .top-bar, .top-bar ul, button.menu-toggle.navicon, button.menu-toggle:hover, .main-navigation .sub-menu li' ).css( {
                'background':to
            });
        } );
    } );
    wp.customize( 'nav_bg', function( value ) {
        value.bind( function( to ) {
            $( 'ul.sub-menu.dropdown.childopen, .main-navigation ul li a:hover, .top-bar, .top-bar ul, button.menu-toggle.navicon, button.menu-toggle:hover, .main-navigation .sub-menu li' ).css( {
                'background-color':to
            });
        } );
    } );
      wp.customize( 'nav_link_color', function( value ) {
        value.bind( function( to ) {
            $( '.navicon:focus .fa-bars, .navicon:active .fa-bars, .navicon .fa-bars, .site-header .main-navigation ul li a, .site-header .main-navigation ul li a:hover, .site-header .main-navigation ul li a:visited, .site-header .main-navigation ul li a:focus, .site-header .main-navigation ul li a:active, .main-navigation ul li ul.childopen li:hover a, .top-bar-menu .navicon span, .main-navigation ul li ul.childopen li .active a' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'nav_logo_color', function( value ) {
        value.bind( function( to ) {
            $( '.top-bar-title .site-title a' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_bg', function( value ) {
        value.bind( function( to ) {
            $( '.blog .hentry' ).css( {
                'background-color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_headline_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog h2.entry-title a' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_date_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog time.entry-date.published, .entry-meta, .entry-meta span, .entry-meta .grey-text' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .entry-content label, .blog .entry-content, .blog .entry-content li, .blog .entry-content p, .blog .entry-content ol li, .blog .entry-content ul li' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_featured_color', function( value ) {
        value.bind( function( to ) {
            $( '#content .sticky:before' ).css( {
                'background':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_link_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .entry-content a, .blog .entry-content a:link, .blog .entry-content a:visited' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_button_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .entry-content form.post-password-form input[type="submit"], .blog .entry-content a.more-link.more-link-activated, .blog .entry-content a.more-link.more-link-activated:hover, .blog .entry-content a.more-link.more-link-activated:focus, .blog .entry-content a.more-link.more-link-activated:active, .blog .entry-content a.more-link.more-link-activated:visited' ).css( {
                'border-color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_button_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .entry-content form.post-password-form input[type="submit"],.blog .entry-content a.more-link.more-link-activated, .blog .entry-content a.more-link.more-link-activated:hover, .blog .entry-content a.more-link.more-link-activated:focus, .blog .entry-content a.more-link.more-link-activated:active, .blog .entry-content a.more-link.more-link-activated:visited' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_navigation_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .pagination a:hover, .blog .pagination button:hover, .blog .paging-navigation ul, .blog .pagination ul, .blog .pagination .current' ).css( {
                'background':to
            });
        } );
    } );
      wp.customize( 'blog_feed_post_navigation_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.blog .paging-navigation li a:hover, .blog .pagination li a:hover, .blog .paging-navigation li span.page-numbers, .blog .pagination li span.page-numbers, .paging-navigation li a, .pagination li a' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_background', function( value ) {
        value.bind( function( to ) {
            $( '.single-post .hentry, .single-post .comments-area, .single-post .read-comments, .single-post .write-comments, .single-post .single-post-content, .single-post .site-main .posts-navigation, .page .hentry, .page .comments-area, .page .read-comments, .page .write-comments, .page .page-content, .page .site-main .posts-navigation, .page .site-main .post-navigation, .single-post .site-main .post-navigation, .page .comment-respond, .single-post .comment-respond' ).css( {
                'background':to
            });
        } );
    } );
      wp.customize( 'post_pages_headline', function( value ) {
        value.bind( function( to ) {
            $( '.page #main th, .single-post #main th, .page #main h1, .page #main h2, .page #main h3, .page #main h4, .page #main h5, .page #main h6, .single-post #main h1, .single-post #main h2, .single-post #main h3, .single-post #main h4, .single-post #main h5, .single-post #main h6, h2.comments-title, .page .comment-list .comment-author .fn, .single-post .comment-list .comment-author .fn' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_text', function( value ) {
        value.bind( function( to ) {
            $( '.single-post #main span .single-post .site-main .post-navigation .nav-indicator, .single-post #main p, .single-post #main td, .single-post #main ul,  .single-post #main li,  .single-post #main ol,  .single-post #main blockquote, .page #main span .page .site-main .post-navigation .nav-indicator, .page #main p, .page #main td, .page #main ul,  .page #main li,  .page #main ol,  .page #main blockquote, .page #main, .single-post #main, .page #main p, .single-post #main p, .single-post #main cite, .page #main cite, .page #main abbr, .single-post #main abbr, .single-post .site-main .post-navigation .nav-indicator, .page .site-main .post-navigation .nav-indicator, .page #main label, .single-post #main label' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_date', function( value ) {
        value.bind( function( to ) {
            $( '.page #main time, .single-post #main time, .page time.entry-date.published, .single-post time.entry-date.published, .single-post .entry-meta, .single-post .entry-meta span' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_links', function( value ) {
        value.bind( function( to ) {
            $( '.page #main a, .single-post #main a' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_borders', function( value ) {
        value.bind( function( to ) {
            $( '.page .comment-list .comment-body, .single-post .comment-list .comment-body, .page .comment-form textarea, .single-post .comment-form textarea' ).css( {
                'border-color':to
            });
        } );
    } );
      wp.customize( 'post_pages_button_bg', function( value ) {
        value.bind( function( to ) {
            $( '.single-post .form-submit input#submit, .single-post #main .comment-reply-form input#submit, .page #main .form-submit input#submit, .page #main .comment-reply-form input#submit, .single-post #main .comment-reply-form input#submit' ).css( {
                'border-color':to
            });
        } );
    } );
      wp.customize( 'post_pages_button_text', function( value ) {
        value.bind( function( to ) {
            $( '.single-post .form-submit input#submit, .single-post #main .comment-reply-form input#submit, .page #main .form-submit input#submit, .page #main .comment-reply-form input#submit, .single-post #main .comment-reply-form input#submit' ).css( {
                'color':to
            });
        } );
    } );
      wp.customize( 'post_pages_text', function( value ) {
        value.bind( function( to ) {
            $( '.page blockquote, .single-post blockquote' ).css( {
                'border-color':to
            });
        } );
    } );
    wp.customize( 'sidebar_background', function( value ) {
        value.bind( function( to ) {
            $( '#secondary .widget' ).css( {
                'background':to
            });
        } );
    } );
    wp.customize( 'sidebar_headline', function( value ) {
        value.bind( function( to ) {
            $( '#secondary .widget th, #secondary .widget-title, #secondary h1, #secondary h2, #secondary h3, #secondary h4, #secondary h5, #secondary h6' ).css( {
                'color':to
            });
        } );
    } );
    wp.customize( 'sidebar_text', function( value ) {
        value.bind( function( to ) {
            $( '#secondary .widget cite, #secondary .widget, #secondary .widget p, #secondary .widget li, #secondary .widget td, #secondary .widget abbr' ).css( {
                'color':to
            });
        } );
    } );
    wp.customize( 'sidebar_link', function( value ) {
        value.bind( function( to ) {
            $( '#secondary .widget a, #secondary .widget li a' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'sidebar_button_text_color', function( value ) {
        value.bind( function( to ) {
            $( '#secondary input.search-submit' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'sidebar_button_bg', function( value ) {
        value.bind( function( to ) {
            $( '#secondary input.search-submit' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'footer_background', function( value ) {
        value.bind( function( to ) {
            $( '#supplementary .widget, .site-footer' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'footer_headline', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer .widget-title, .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'footer_text', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer .widget, .site-footer .widget li, .site-footer .widget p, .site-footer abbr, .site-footer cite, .site-footer table caption' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'footer_link', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer .widget a, .site-footer .widget li a, .site-footer .widget ul li a' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'footer_button_bg', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer input.search-submit' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'footer_button_text', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer input.search-submit' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'footer_copyright_text', function( value ) {
        value.bind( function( to ) {
            $( '.copyright' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'footer_copyright_bg', function( value ) {
        value.bind( function( to ) {
            $( '.copyright' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'scroll_top_background', function( value ) {
        value.bind( function( to ) {
            $( 'a.topbutton, a.topbutton:visited, a.topbutton:hover, a.topbutton:focus, a.topbutton:active' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'scroll_top_color', function( value ) {
        value.bind( function( to ) {
            $( 'a.topbutton, a.topbutton:visited, a.topbutton:hover, a.topbutton:focus, a.topbutton:active' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'header_left_button_text_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .header-button-left' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'header_left_button_background_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .header-button-left' ).css( {
                'background':to
            });
        } );
    } );
   wp.customize( 'header_right_button_text_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .header-button-right' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'header_right_button_background_color', function( value ) {
        value.bind( function( to ) {
            $( '#header-image .header-button-right' ).css( {
                'border-color':to
            });
        } );
    } );
   wp.customize( 'top_widgets_headline_color', function( value ) {
        value.bind( function( to ) {
            $( '.top-widget h3, .top-widget-inner-wrapper h3' ).css( {
                'color':to
            });
        } );
    } );
   wp.customize( 'top_widgets_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.top-widget, .top-widget p, .top-widget-inner-wrapper p, .top-widget-inner-wrapper' ).css( {
                'color':to
            });
        } );
    } );

   wp.customize( 'top_widgets_link_color', function( value ) {
        value.bind( function( to ) {
            $( '.top-widget a, .top-widget-inner-wrapper a' ).css( {
                'color':to
            });
        } );
    } );



        wp.customize( 'top_widgets_background_color', function( value ) {
        value.bind( function( to ) {
            $( '.top-widget-inner-wrapper' ).css( {
                'background':to
            });
        } );
    } );




	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-branding-header .site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
                                $( '.site-branding-header, h1.site-title::after' ).css( {
                                        'display': 'none'
                                } );
			} else {
				$( '.site-branding-header .site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
                                $( '.site-branding-header, h1.site-title::after' ).css( {
                                        'display': 'block'
                                } );
				$( '.site-branding-header .site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
        
        // Custom Customizer Functions
        // Header Gradient color
        // Set default colors
        grad1_color = '#085078';
        grad2_color = '#85d8ce';
        grad3_color = '#f8fff3';
        
        wp.customize( 'grad1_color', function( value ) {
		value.bind( function( to ) {
			grad1_color = to;
                        $( '.custom-header' ).css( {
                            'background': 'radial-gradient( ellipse farthest-side at 100% 100%, '
                                    .concat( grad3_color ).concat( ' 10%, ' )
                                    .concat( grad2_color ).concat( ' 50%, ' )
                                    .concat( grad1_color ).concat( ' 120% )' )
                        } );
		} );
	} );
        wp.customize( 'grad2_color', function( value ) {
		value.bind( function( to ) {
			grad2_color = to;
                        $( '.custom-header' ).css( {
                            'background': 'radial-gradient( ellipse farthest-side at 100% 100%, '
                                    .concat( grad3_color ).concat( ' 10%, ' )
                                    .concat( grad2_color ).concat( ' 50%, ' )
                                    .concat( grad1_color ).concat( ' 120% )' )
                        } );
		} );
	} );
        wp.customize( 'grad3_color', function( value ) {
		value.bind( function( to ) {
			grad3_color = to;
                        $( '.custom-header' ).css( {
                            'background': 'radial-gradient( ellipse farthest-side at 100% 100%, '
                                    .concat( grad3_color ).concat( ' 10%, ' )
                                    .concat( grad2_color ).concat( ' 50%, ' )
                                    .concat( grad1_color ).concat( ' 120% )' )
                        } );
		} );
	} );
        
        // Highlight colors
        wp.customize( 'highlight_color', function( value ) {
		value.bind( function( to ) {
			$( 'a:visited, a:hover, a:focus, a:active, .entry-content a, .entry-summary a' ).css( {
                            'color': to 
                        } );
                        $( '.search-toggle, .search-box-wrapper' ).css( {
                            'background-color': to
                        } );
		} );
	} );
        
        
        // Custome Layout (Sidebar) Options
        wp.customize( 'layout_setting', function( value ) {
		value.bind( function( to ) {
			$( '#page' ).removeClass( 'no-sidebar sidebar-right sidebar-left' ); 
                        $( '#page' ).addClass( to );
                        $( '#primary' ).removeClass( 'medium-8 medium-push-4 medium-10 medium-push-1 large-8 large-push-2 no-sidebar sidebar-right sidebar-left' );
                        $( '#secondary' ).removeClass( 'medium-4 medium-pull-8 medium-12 no-sidebar sidebar-right sidebar-left' );
                        $( '#secondary .widget' ).removeClass( 'small-6 medium-4' );
                        if( to === 'sidebar-right' ) {
                            $( '#primary' ).addClass( 'medium-8 sidebar-right' );
                            $( '#secondary' ).addClass( 'medium-4 sidebar-right' );
                        } else if ( to === 'sidebar-left' ) {
                            $( '#primary' ).addClass( 'medium-8 medium-push-4 sidebar-left' );
                            $( '#secondary' ).addClass( 'medium-4 medium-pull-8 sidebar-left' );
                        } else {
                            $( '#primary' ).addClass( 'medium-10 medium-push-1 large-8 large-push-2 no-sidebar' );
                            $( '#secondary' ).addClass( 'medium-12 no-sidebar' );
                            $( '#secondary .widget' ).addClass( 'small-6 medium-4 columns' );
                        }
		} );
	} );
           
} )( jQuery );