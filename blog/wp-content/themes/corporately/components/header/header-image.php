<?php
// You can upload a custom header and it'll output in a smaller logo size.
global $post;

$header_image = get_header_image();
$use_gradient = get_theme_mod( 'use_gradient' );

if ( ! empty( $header_image ) || $use_gradient !== 0 ) { ?>
<?php if ( has_header_image() ) { ?>
<div id="header-image" class="custom-header">
<div class="header-wrapper">
  <div class="site-branding-header">

   <p class="site-title">

              <?php bloginfo( 'name' ); ?>



  </p>
 <p class="site-description">
         <?php bloginfo( 'description' ); ?>

</p>
</div><!-- .site-branding -->
<div class="header-img-container"><img src="<?php header_image(); ?>"></div>
</div><!-- .header-wrapper -->
<?php } ?>
<?php if ( is_page_template( 'page-templates/frontpage-portfolio.php' ) ) { ?>
<div class="front-menu-box group unsaturate">

  <?php wp_nav_menu( array( 
    'theme_location'    => 'front', 
    'menu_id'           => 'front-menu',
    'menu_class'        => 'small-block-grid-2 medium-block-grid-3 flip-cards',
    'fallback_cb'       => false,
    'walker'            => new corporately_front_page_walker(),
    'depth' => 1 
    ) ); 
    ?>

  </div>
  <?php } ?>

</div><!-- #header-image .custom-header -->

<?php 
} else { 

        // No header? We need nothing. 

} ?>