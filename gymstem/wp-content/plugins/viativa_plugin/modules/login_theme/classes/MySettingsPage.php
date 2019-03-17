<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 17/09/2018
 * Time: 16:26
 */

class MySettingsPage
{
    const MYCLASS = "MySettingsPage";
    
    public function __construct()
    {
//        add_action('admin_menu', array(self::MYCLASS, 'create_config_page'));
    }

    function register_viaativa_theme_settings(){

        register_setting( 'viaativa-theme-settings-group', 'darkmode' );

        register_setting( 'viaativa-theme-settings-group', 'background_image_id' );
        register_setting( 'viaativa-theme-settings-group', 'logo_image_id' );
        register_setting( 'viaativa-theme-settings-group', 'button_color' );
        register_setting( 'viaativa-theme-settings-group', 'by' );
        register_setting( 'viaativa-theme-settings-group', 'link' );

        //Background do lado direito
        register_setting( 'viaativa-theme-settings-group', 'background_pattern_id' );
        register_setting( 'viaativa-theme-settings-group', 'background_color' );
    }

    function show_config_page(){
        $upload_link = esc_url( get_upload_iframe_src( 'image') );
    ?>
        <div class="wrap">
            <?php echo sprintf('<h1>%s</h1>', __('Tela de configuração da página de login')); ?>
            <form method="post" action="options.php">
                <?php settings_fields( 'viaativa-theme-settings-group' ); ?>
                <?php do_settings_sections( 'viaativa-theme-settings-group' ); ?>
                <table class="form-table">


                    <tr valign="top">
                        <th scope="row"><?php _e('Dark') ?></th>
                        <td>
                            <input type="checkbox" name="darkmode" value="1" <?php checked( get_option('darkmode', false)); ?>>
                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row"><?php _e('Imagem do Background Esquerdo') ?></th>
                        <td>
                            <?php
                            $your_img_id = get_option( 'background_image_id', false );
                            $your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );
                            $you_have_img = is_array( $your_img_src );
                            ?>
                            <div class="background_image">
                                <?php if ( $you_have_img ) : ?>
                                    <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-height:50px;" />
                                <?php endif; ?>
                            </div>
                            <p class="hide-if-no-js">
                                <a class="upload-custom-img background_image_add <?php if ( $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="<?php echo $upload_link ?>"
                                   data-class=".background_image"
                                   data-input=".background_image_id"
                                   data-rm=".background_image_rm">
                                    <?php _e('Selecionar Imagem') ?>
                                </a>
                                <a class="delete-custom-img background_image_rm <?php if ( ! $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="#"
                                   data-class=".background_image"
                                   data-input=".background_image_id"
                                   data-add=".background_image_add">
                                    <?php _e('Remover Imagem') ?>
                                </a>
                            </p>
                            <input  class="background_image_id"
                                    type="hidden"
                                    name="background_image_id"
                                    value="<?php echo esc_attr( $your_img_id ); ?>"
                            >
                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row"><?php _e('Pattern do Background Direito') ?></th>
                        <td>
                            <?php
                            $your_img_id = get_option( 'background_pattern_id', false );
                            $your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );
                            $you_have_img = is_array( $your_img_src );
                            ?>
                            <div class="background_pattern">
                                <?php if ( $you_have_img ) : ?>
                                    <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-height:50px;" />
                                <?php endif; ?>
                            </div>
                            <p class="hide-if-no-js">
                                <a class="upload-custom-img background_pattern_add <?php if ( $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="<?php echo $upload_link ?>"
                                   data-class=".background_pattern"
                                   data-input=".background_pattern_id"
                                   data-rm=".background_pattern_rm">
                                    <?php _e('Selecionar Imagem') ?>
                                </a>
                                <a class="delete-custom-img background_pattern_rm <?php if ( ! $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="#"
                                   data-class=".background_pattern"
                                   data-input=".background_pattern_id"
                                   data-add=".background_pattern_add">
                                    <?php _e('Remover Imagem') ?>
                                </a>
                            </p>
                            <input  class="background_pattern_id"
                                    type="hidden"
                                    name="background_pattern_id"
                                    value="<?php echo esc_attr( $your_img_id ); ?>"
                            >
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Cor do Background Direito')?></th>
                        <td>
                            <input type="text"
                                   class="color_field"
                                   name="background_color"
                                   value="<?php echo get_option( 'background_color', '#fff' ) ?>"
                            >

                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row">
                            <?php _e('Logo') ?>
                        </th>
                        <td>

                            <?php
                            $your_img_id = get_option( 'logo_image_id', false );
                            $your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );
                            $you_have_img = is_array( $your_img_src );
                            ?>
                            <div class="logo_image">
                                <?php if ( $you_have_img ) : ?>
                                    <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-height:50px;" />
                                <?php endif; ?>
                            </div>
                            <p class="hide-if-no-js">
                                <a class="upload-custom-img logo_image_add <?php if ( $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="<?php echo $upload_link ?>"
                                   data-class=".logo_image"
                                   data-input=".logo_image_id"
                                   data-rm=".logo_image_rm">
                                    <?php _e('Selecionar Imagem') ?>
                                </a>
                                <a class="delete-custom-img logo_image_rm <?php if ( ! $you_have_img  ) { echo 'hidden'; } ?>"
                                   href="#"
                                   data-class=".logo_image"
                                   data-input=".logo_image_id"
                                   data-add=".logo_image_add">
                                    <?php _e('Remover Imagem') ?>
                                </a>
                            </p>
                            <input  class="logo_image_id"
                                    type="hidden"
                                    name="logo_image_id"
                                    value="<?php echo esc_attr( $your_img_id ); ?>"
                            >
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Cor do botão')?></th>
                        <td>
                            <input type="text"
                                   class="color_field"
                                   name="button_color"
                                   value="<?php echo get_option( 'button_color', '#159b9f' ) ?>"
                            >

                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Desenvolvido por:')?></th>
                        <td>
                            <input type="text"
                                   name="by"
                                   value="<?php echo get_option( 'by', 'viaativa' ) ?>"
                            >
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Link Desenvolvedora:')?></th>
                        <td>
                            <input type="text"
                                   name="link"
                                   value="<?php echo get_option( 'link', 'https://www.viaativa.com.br' ) ?>"
                            >
                        </td>
                    </tr>

                </table>
                <?php submit_button(); ?>

                <table class="form-table">
                    <tr valign="top">
                        <td>
                            <?php
                            $link = esc_url(plugins_url('../assets/psd/gabarito.psd', __FILE__));
                            _e("Clique <a href='{$link}' download>aqui</a> para baixar o gabarito das imagens.")
                            ?>
                        </td>
                    </tr>
                </table>

            </form>
        </div>

    <?php
    }
}

if( is_admin() ) new MySettingsPage;