<?php

class BaseDeConhecimento{

    const NAMECLASS = 'BaseDeConhecimento';
    const POSTTYPE = 'va-base-conhecimento';


    function assets( ){

        wp_enqueue_media();

        wp_register_script('upload-video-js', plugins_url('../assets/js/upload.video.js', __FILE__));
        wp_enqueue_script('upload-video-js');

        wp_register_style('base-de-conhecimento', plugins_url('../assets/css/base-de-conhecimento.css', __FILE__));
        wp_enqueue_style('base-de-conhecimento');

    }

    function registrar_post_type(){
        $labels = array(
            'name' => __('Bases de Conhecimentos'),
            'singular_name' => __('Base de Conhecimento')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_in_menu' => false,
            'supports' => array('title')
        );

        register_post_type(self::POSTTYPE, $args);
    }

    function menu(){
        add_menu_page(
            __('Sobre Meu Site'),
            __('Sobre Meu Site'),
            'level_0',
            'via-tools-videos',
            array(self::NAMECLASS, 'video_page'),
            'dashicons-format-video',
            30
        );

        add_submenu_page(
            THEMESLUG,
            _('Base de Conhecimento'),
            _('Base de Conhecimento'),
            'administrator',
            'edit.php?post_type=va-base-conhecimento'
        );
    }

    function video_page(){

        $args = array(
            'posts_per_page' => -1,
            'numberposts' => -1,
            'post_type' => self::POSTTYPE
        );

        ?>
        <h1>Sobre Meu Site</h1>
        <p>Assista aos vídeos e aprenda mais sobre o seu site!!</p>
        <div class="bloco_videos">
        <?php

        foreach(get_posts($args) as $video){
            $video_id = get_post_meta($video->ID, 'video_id', true);
            $video_src = wp_get_attachment_url( $video_id );
            ?>
                <div class="bloco-video">
                    <video class="bloco-video__video" controls>
                        <source src="<?= $video_src ?>" type="video/mp4">
                    </video>
                    <div class="bloco-video__titulo">
                        <?= $video->post_title ?>
                    </div>
                </div>
            <?php
        }
        ?>
        </div>
        <?php
    }

    function add_metaboxes(){
        add_meta_box(
            'upload-video',
            __('Upload Vídeo'),
            array(self::NAMECLASS, 'render_metabox_video'),
            self::POSTTYPE,
            'normal',
            'high'
        );
    }
    function render_metabox_video(){
        global $post;
        $video_id = get_post_meta($post->ID, 'video_id', true);
        $video_src = wp_get_attachment_url( $video_id );

        ?>
        <div class="video">
        <?php if($video_src) :?>
            <video controls>
                <source src="<?= $video_src ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        </div>
        <input type="hidden" name="video_id" class="video-id" value="">
        <button type="button" class="button button-primary add-video <?php if(strlen($video_src)) echo 'hidden' ?>">
            <?php _e('Adicionar Vídeo')?>
        </button>
        <button type="button" class="button button-secondary rem-video <?php if(!strlen($video_src)) echo 'hidden' ?>">
            <?php _e('Remover Vídeo')?>
        </button>
        <?php
    }

    function save($post_id){
        if(isset($_POST['video_id'])){
            update_post_meta($post_id, 'video_id', $_POST['video_id']);
        }
    }

    static function init(){
        add_action('init', array(self::NAMECLASS, 'registrar_post_type'));
        add_action('admin_menu', array(self::NAMECLASS, 'menu'));
        add_action('add_meta_boxes', array(self::NAMECLASS, 'add_metaboxes'));
        add_action('admin_enqueue_scripts', array(self::NAMECLASS, 'assets'));
        add_action('save_post', array(self::NAMECLASS, 'save'));
    }

}