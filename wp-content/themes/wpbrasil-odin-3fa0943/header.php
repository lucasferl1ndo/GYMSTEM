<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (!get_option('site_icon')) : ?>
        <link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon"/>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a id="skippy" class="sr-only sr-only-focusable" href="#content">
    <div class="container">
        <span class="skiplink-text"><?php _e('Skip to content', 'odin'); ?></span>
    </div>
</a>

<header id="header" role="banner">
    <div id="main-navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-flex">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-main-navigation">
                        <span class="sr-only"><?php _e('Toggle navigation', 'odin'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="custom-header">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img src="<?php header_image(); ?>"
                                 width="<?php echo esc_attr(get_custom_header()->width); ?>"
                                 height="<?php echo esc_attr(get_custom_header()->height); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"/>
                        </a>
                    </div>
                </div>

                <nav class="collapse navbar-collapse navbar-main-navigation" role="navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => 'nav navbar-nav',
                            'fallback_cb' => 'Odin_Bootstrap_Nav_Walker::fallback',
                            'walker' => new Odin_Bootstrap_Nav_Walker()
                        )
                    );
                    ?>
                </nav><!-- .navbar-collapse -->
            </div>
        </div><!-- #main-navigation-->

    </div><!-- .container-->
</header><!-- #header -->

<div id="wrapper" class="container">
    <div class="row">
