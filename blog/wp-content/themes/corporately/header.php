<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package corporately
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php // Add custom code to handle the sidebar - right, left, none, full-width-page ?>

	<?php if ( is_page_template( 'page-templates/page-sidebar-right.php' ) || get_theme_mod( 'layout_setting' ) === 'sidebar-right' ) { ?>

	<div id="page" class="site sidebar-right">

		<?php } else if ( is_page_template( 'page-templates/page-sidebar-left.php' ) || get_theme_mod( 'layout_setting' ) === 'sidebar-left' ) { ?>

		<div id="page" class="site sidebar-left">

			<?php } else if ( is_page_template( 'page-templates/page-no-sidebar.php' ) || get_theme_mod( 'layout_setting' ) === 'no-sidebar' ) { ?>

			<div id="page" class="site no-sidebar">

				<?php } else if ( is_page_template( 'page-templates/page-full-width.php' ) ) { ?>

				<div id="page" class="site no-sidebar page-full-width">

					<?php } else { ?>   

					<div id="page" class="site sidebar-right">

						<?php } ?>

						<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'corporately' ); ?></a>


						<div data-sticky-container>

							<header id="masthead" class="group site-header title-bar top-bar" role="banner" data-sticky data-options="marginTop:0;" style="width:100%" data-top-anchor="masthead" data-btm-anchor="colophon:bottom">

								<div class="row"> <!-- Start Foundation row -->

									<div class="top-bar-title">

											<div class="site-branding">

											
											<?php if ( get_theme_mod( 'show_sitename_in_menubar' ) == '' ) : ?>
												<?php if ( is_front_page() || is_home() || is_page_template( 'page-templates/frontpage-portfolio.php' ) ) : ?>
													<?php 
													if (!has_custom_logo()) { 
													} else {
														the_custom_logo();
													} ?>
													<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php else : ?>
													<?php 
													if (!has_custom_logo()) { 
													} else {
														the_custom_logo();
													} ?>
													<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
												<?php endif; ?>
											<?php else : ?>
												<?php 
												if (!has_custom_logo()) { 
												} else {
													the_custom_logo();
												} ?>
											<?php endif; ?>




										</div><!-- .site-branding -->

									</div>

									<div class="top-bar-right">
										<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
									</div>


								</div> <!-- End Foundation row -->

							</header>
						</div><!-- END data-sticky-container -->


						<div class="row">
							<div id="primary" class="content-area large-12 columns">        
								<?php get_template_part( 'components/header/header', 'image' ); ?>
							</div>
						</div>

						<!--Widgets -->
						<?php if ( is_active_sidebar( 'top-widget-left') ||  is_active_sidebar( 'top-widget-middle') ||  is_active_sidebar( 'top-widget-right')  ) : ?>
							<div class="row">
								<div class="large-4 medium-4 column">

									<?php if ( is_active_sidebar( 'top-widget-left')) : ?>
										<div class="top-widget-inner-wrapper">
											<?php dynamic_sidebar( 'top-widget-left' );  ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="large-4 medium-4 column">
									<?php if ( is_active_sidebar( 'top-widget-middle')) : ?>
										<div class="top-widget-inner-wrapper">
											<?php dynamic_sidebar( 'top-widget-middle' );  ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="large-4 medium-4 column">
									<?php if ( is_active_sidebar( 'top-widget-right')) : ?>
										<div class="top-widget-inner-wrapper">
											<?php dynamic_sidebar( 'top-widget-right' );  ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<!--Widgets -->

						<div id="content" class="site-content <?php echo ! is_page_template( 'page-templates/frontpage-portfolio.php' ) ? 'row' : 'front-page-content'; ?>"> <!-- Foundation row start -->
