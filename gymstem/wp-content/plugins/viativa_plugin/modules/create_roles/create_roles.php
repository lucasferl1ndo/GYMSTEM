<?php
function create_roles()
{
    global $wp_roles;
    if ( ! isset( $wp_roles ) ) $wp_roles = new WP_Roles();
    $adm = $wp_roles->get_role('administrator');
    $roles = array(
        array(
            'slug' => 'gestor',
            'name' => 'Gestor'
        )
    );
    foreach ($roles as $r){
        add_role(
            $r['slug'],
            __($r['name']),
            $adm->capabilities
        );
    }
}
function delete_roles(){
    $roles = array('cliente', 'desenvolvedor', 'desenvolvimento');
    foreach ($roles as $r){
        if( get_role($r) ){
            remove_role($r);
        }
    }
}

function hide_role_developer(){

    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
    $wp_roles->roles['administrator']['name'] = __('Desenvolvedor');
    $wp_roles->role_names['administrator'] = __('Desenvolvedor');


   /*global $wp_roles;
   if(is_user_logged_in()){
       $user = wp_get_current_user();
       $roles = ( array ) $user->roles;
       if(!in_array( 'administrator', $roles) && !in_array( 'desenvolvedor', $roles)){
           unset($wp_roles->roles['desenvolvedor']);
       }
   }
//    $adm = $wp_roles->get_role('administrator');
//    var_dump($adm->capabilities);
//    die();*/
}
add_action('admin_init', 'hide_role_developer');