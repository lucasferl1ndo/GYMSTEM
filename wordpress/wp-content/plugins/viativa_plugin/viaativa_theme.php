<?php
/*
Plugin Name:  Viaativa Theme
Description:  Tema do administrador feito pela Viaativa.
Version:      1.0.0
Author:       Viaativa Web
Author URI:   http://www.viaativa.com.br/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

include_once 'classes/MySettingsPage.php';

    /*
    function my_admin_css() {
        wp_register_style( 'my-admin-css', get_template_directory_uri() . '/assets/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'my-admin-css' );

        wp_register_script('my-admin-js', get_template_directory_uri(). '/assets/js/admin-script.js', array('jquery'), '1.0.0');
        wp_enqueue_script('my-admin-js');
    }
    add_action( 'admin_enqueue_scripts', 'my_admin_css' );
    */

function init_viaativa_theme(){

    define('PATH_THEME', plugin_dir_url(__FILE__));

    function my_assets_admin(){

        wp_enqueue_media();

        wp_enqueue_style( 'wp-color-picker' );

        wp_register_style( 'viaativa-theme-css', PATH_THEME . '/assets/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'viaativa-theme-css' );

        wp_register_script('viaativa-theme-js', PATH_THEME . '/assets/js/admin-script.js', array('jquery', 'wp-color-picker'), '1.0.0');
        wp_enqueue_script('viaativa-theme-js');

        wp_register_script('upload-image-js', PATH_THEME . '/assets/js/upload-image.js', array('jquery'), '1.0.0');
        wp_enqueue_script('upload-image-js');
    }
    add_action( 'admin_enqueue_scripts', 'my_assets_admin' );

    function my_assets_front_page(){
        wp_register_style( 'viaativa-theme-fp-css', PATH_THEME . '/assets/css/frontpage-style.css', false, '1.0.0' );
        wp_enqueue_style( 'viaativa-theme-fp-css' );
    }
    add_action( 'login_enqueue_scripts', 'my_assets_front_page' );

    function custom_login(){
        wp_register_style( 'viaativa-theme-login-css', PATH_THEME . '/assets/css/login-style.css', false, '1.0.0' );
        wp_enqueue_style( 'viaativa-theme-login-css' );

        wp_register_script('viaativa-theme-login-js', PATH_THEME . '/assets/js/login-script.js', array('jquery'), '1.0.0');
        wp_enqueue_script('viaativa-theme-login-js');
    }
    add_action( 'login_enqueue_scripts', 'custom_login' );

    function edit_wp_login(){
        ?><div class="background"></div><?php
    }
    add_action('login_footer', 'edit_wp_login');

    function add_inline_settings_css(){

        if(get_option('darkmode')){
            $darkmode = "
                .login label,
                .login #backtoblog a, .login #nav a{
                    color: #fff;
                }";
            wp_add_inline_style( 'viaativa-theme-login-css', $darkmode );
        }

        $bg_id = get_option( 'background_image_id');
        $bg_img_src = wp_get_attachment_image_src( $bg_id, 'full' );
        $bg_have_img = is_array( $bg_img_src );


        if($bg_have_img){
            $custom_bg = "
                .background{
                        background-image: url(\"{$bg_img_src[0]}\") !important;
                }";
            wp_add_inline_style( 'viaativa-theme-login-css', $custom_bg );
        }

        //bg direita
        //background_pattern_id
        //background_color


        $bg_p_id = get_option( 'background_pattern_id');
        $bg_img_p_src = wp_get_attachment_image_src( $bg_p_id, 'full' );
        $bg_have_img = is_array( $bg_img_p_src );


        if($bg_have_img){
            $custom_bg_p = "
                #login{
                        background-image: url(\"{$bg_img_p_src[0]}\") !important;
                        background-repeat: repeat;
                }";
        }
        wp_add_inline_style( 'viaativa-theme-login-css', $custom_bg_p );



        $bg_p_color = get_option( 'background_color', '#fffff');
        $custom_bg_color = "
            #login{
                    background-color: {$bg_p_color} !important;
            }";
        wp_add_inline_style( 'viaativa-theme-login-css', $custom_bg_color );


        $logo_id = get_option( 'logo_image_id');
        $logo_img_src = wp_get_attachment_image_src( $logo_id, 'full' );
        $logo_have_img = is_array( $logo_img_src );

        if($logo_have_img){
            $custom_logo = "
                #login h1 a, .login h1 a{
                        background-image: url(\"{$logo_img_src[0]}\") !important;
                }";
            wp_add_inline_style( 'viaativa-theme-login-css', $custom_logo );
        }


        $button_color = get_option( 'button_color');

        $custom_button_color = "
            .wp-core-ui.wp-core-ui .button-primary{
                    background-color: {$button_color} !important;
            }";
        wp_add_inline_style( 'viaativa-theme-login-css', $custom_button_color );

        $by = get_option( 'by');
        $link = get_option( 'link');
        if(strlen($by)) {
            if(strlen($link)){
                $html = "<a class='assinatura' href='{$link}'>$by</a>";
            }else{
                $html = "<div class='assinatura'>{$by}</div>";
            }
            $custom_js = " 
                jQuery(function($){
                    $('#login').append(\"{$html}\");
                });";
            wp_add_inline_script('viaativa-theme-login-js', $custom_js);
        }
    }
    add_action( 'login_enqueue_scripts', 'add_inline_settings_css' );

}
add_action('init', 'init_viaativa_theme');