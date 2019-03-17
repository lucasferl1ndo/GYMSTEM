<?php
/*
Plugin Name:  Viaativa Theme
Description:  Tema do administrador feito pela Viaativa.
Version:      1.1.2
Author:       Viaativa Web
Author URI:   http://www.viaativa.com.br/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'THEMESLUG', 'configuracao-viaativa' );

include_once dirname( __FILE__ ) . '/modules/login_theme/login_theme.php';
include_once dirname( __FILE__ ) . '/modules/create_roles/create_roles.php';
include_once dirname( __FILE__ ) . '/modules/base_de_conhecimento/base_de_conhecimento.php';


register_activation_hook( __FILE__, 'create_roles' );
//register_deactivation_hook( __FILE__, 'delete_roles' );

function show_welcome_page(){
    ?>
        <h2>Olá, bem vindo ao ViaTools!</h2>
        <p>
            Desenvolvemos este Plugin para facilitar a comunicação entre você e o seu site.<br>
            O ViaTools conta com ferramentas de personalização, base de conhecimento e muito mais.<br><br>
            Fique atento nas atualizações e bom trabalho!
        </p>
    <?php
}
function create_config_page(){
    add_menu_page(
        __('ViaTools'),
        __('ViaTools'),
        'level_0',
        THEMESLUG,
        'show_welcome_page',
        plugins_url('modules/login_theme/assets/images/icon.png', __FILE__),
        null,
        null
    );
    /*remove_submenu_page('configuracao-viaativa', 'configuracao-viaativa');*/
    add_submenu_page(
        THEMESLUG,
            _('Configuração Tela de Login'),
            _('Config. Tela de Login'),
            'level_0',
            'configuracao-viaativa-theme',
            array('MySettingsPage', 'show_config_page')
    );
    add_action( 'admin_init', array('MySettingsPage', 'register_viaativa_theme_settings') );
}
add_action('admin_menu', 'create_config_page', 1);
