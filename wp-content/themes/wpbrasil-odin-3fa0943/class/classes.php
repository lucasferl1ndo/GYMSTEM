<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/01/2019
 * Time: 13:35
 */

function assets(){
    wp_enqueue_style(
        'stylef-scss',
        get_template_directory_uri() .'/assets/css/admin-style.css',
        array(),
        '1.0',
        false
    );
}

wp_register_script('admin-script', get_template_directory_uri() . '/assets/js/admin-script.js');
wp_enqueue_script('admin-script');

add_action('admin_enqueue_scripts','assets');

//inclue as classes
include_once 'Aluno.php';
include_once 'shortcodes.php';

//Importa functions felipe

//inicializa conteudo das classes
Aluno::init();