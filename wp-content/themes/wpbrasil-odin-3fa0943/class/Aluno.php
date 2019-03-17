<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/01/2019
 * Time: 13:35
 */

class Aluno
{
    const CLASSNAME = "Aluno";
    const POSTTYPE = "aluno";

//    public $numero_cadastro;
    public $nome;
    public $rg;
    public $cpf;
    public $nascimento;
    public $idade;
    public $telefone;
    public $rua;
    public $bairro;
    public $cidade;
    public $atividade;
    public $tipo_atividade;
    public $medicamento;
    public $tipo_medicamento;
    public $porque_medicamento;
    public $cardiaco_articular;
    public $tipo_cardiaco_articular;
    public $fortalecimento;
    public $emagrecimento;
    public $massa_muscular;
    public $cirurgia;
    public $tipo_cirurgia;
    public $data_matricula;
    public $id;

    function __construct($id = null)
    {
        global $post;
        $id = $id ? $id : $post->ID;
        $aluno = get_post($id);
        $this->id = $id;

        //info aluno
        $this->nome = $aluno->post_title;
        $this->imagem = get_the_post_thumbnail($aluno->ID, 'full');
        $this->data_matricula = get_post_meta($aluno->ID, 'data_matricula', true);
        $this->nome = get_post_meta($aluno->ID, 'nome', true);
        $this->rg = get_post_meta($aluno->ID, 'rg', true);
        $this->cpf = get_post_meta($aluno->ID, 'cpf', true);
        $this->nascimento = get_post_meta($aluno->ID, 'nascimento', true);
        $this->rua = get_post_meta($aluno->ID, 'rua', true);
        $this->bairro = get_post_meta($aluno->ID, 'bairro', true);
        $this->cidade = get_post_meta($aluno->ID, 'cidade', true);

        //cond. fis. aluno
        $this->atividade = get_post_meta($aluno->ID, 'atividade', true);
        $this->tipo_atividade = get_post_meta($aluno->ID, 'tipo_atividade', true);
        $this->medicamento = get_post_meta($aluno->ID, 'medicamento', true);
        $this->tipo_medicamento = get_post_meta($aluno->ID, 'tipo_medicamento', true);
        $this->porque_medicamento = get_post_meta($aluno->ID, 'porque_medicamento', true);
        $this->cardiaco_articular = get_post_meta($aluno->ID, 'cardiaco_articular', true);
        $this->tipo_cardiaco_articular = get_post_meta($aluno->ID, 'tipo_cardiaco_articular', true);

        //objetivo aluno
        $this->fortalecimento = get_post_meta($aluno->ID, 'fortalecimento', true);
        $this->emagrecimento = get_post_meta($aluno->ID, 'emagrecimento', true);
        $this->massa_muscular = get_post_meta($aluno->ID, 'massa_muscular', true);

        //cirurgias aluno
        $this->cirurgia = get_post_meta($aluno->ID, 'cirurgia', true);
        $this->tipo_cirurgia = get_post_meta($aluno->ID, 'tipo_cirurgia', true);
//        $this->descricao = $aluno->post_content;
    }

    function register_cpt()
    {
        $labels = array(
            'name' => __('Alunos Matrícula'),
            'featured_image' => __('Imagem do aluno')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'supports' => array('title', 'thumbnail'),
        );

        register_post_type(
            self::POSTTYPE,
            $args
        );
    }

    function metaboxes()
    {

        add_meta_box(
            'data_hora',
            'Data da Matrícula',
            array(self::CLASSNAME, 'render_mb_data_hora'),
            self::POSTTYPE,
            'side',
            'high'
        );

        add_meta_box(
            'aluno_info',
            'Informações do Aluno',
            array(self::CLASSNAME, 'render_mb_info_aluno'),
            self::POSTTYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'aluno_atividade',
            'Condições Físicas',
            array(self::CLASSNAME, 'render_mb_atividade'),
            self::POSTTYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'social',
            'Qual seu objetivo na academia?',
            array(self::CLASSNAME, 'render_mb_objetivo'),
            self::POSTTYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'cirurgia',
            'Cirurgias',
            array(self::CLASSNAME, 'render_mb_cirurgia'),
            self::POSTTYPE,
            'normal',
            'high'
        );
    }

    function render_mb_data_hora()
    {
        wp_nonce_field('data', 'data_nonce');
        global $post;
        $data_matricula = get_post_meta($post->ID, 'data', true);
//        $hora = get_post_meta($post->ID, 'hora', true);

        ?>
        <table class="form-table">
            <tr>
                <td valign="top">
                    <label>Data</label><br>
                    <input type="date" name="data_matricula" value="<?= $data_matricula ?>">
                </td>
            </tr>
        </table>
        <?php
    }

    function render_mb_info_aluno()
    {
        global $post;
        $nome = get_post_meta($post->ID, 'nome', true);
        $rg = get_post_meta($post->ID, 'rg', true);
        $cpf = get_post_meta($post->ID, 'cpf', true);
        $nascimento = get_post_meta($post->ID, 'nascimento', true);
        $rua = get_post_meta($post->ID, 'rua', true);
        $bairro = get_post_meta($post->ID, 'bairro', true);
        $cidade = get_post_meta($post->ID, 'cidade', true);
//        $idade = get_post_meta($post->ID, 'idade', true);
        ?>
        <table class="form-table">
            <tr>
                <td valign="top" colspan="3">
                    <label>Nome</label><br>
                    <input id="nome" type="text" name="nome" value="<?= $nome ?>" class="full__input">
                </td>
            </tr>
            <tr>
                <td valign="top" class="">
                    <label>RG</label><br>
                    <input id="rg" type="text" name="rg"
                           value="<?= $rg ?>"
                           class="full__input">
                </td>
                <td valign="top" class="">
                    <label>CPF</label><br>
                    <input id="cpf" type="text" name="cpf"
                           value="<?= $cpf ?>"
                           class="full__input">
                </td>
                <td valign="top" class="">
                    <label>Nascimento</label><br>
                    <input id="nacimento" type="date" name="nascimento"
                           value="<?= $nascimento ?>"
                           class="full__input">
                </td>
            </tr>

            <tr>
                <td valign="top" colspan="2">
                    <label>Endereço</label><br>

                    <input type="text" name="rua" value="<?= $rua ?>"
                           class="full__input">
                </td>
                <td valign="top" colspan="1">
                    <label>Bairro</label><br>
                    <input type="text" name="bairro" value="<?= $bairro ?>"
                           class="full__input">
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <label>Cidade</label><br>
                    <input type="text" name="cidade" value="<?= $cidade ?>"
                           class="full__input">
                </td>
            </tr>
        </table>
        <?php
    }

    function render_mb_atividade()
    {
        global $post;
        $atividade = get_post_meta($post->ID, 'atividade', true);
        $tipo_atividade = get_post_meta($post->ID, 'tipo_atividade', true);
        $medicamento = get_post_meta($post->ID, 'medicamento', true);
        $tipo_medicamento = get_post_meta($post->ID, 'tipo_medicamento', true);
        $porque_medicamento = get_post_meta($post->ID, 'porque_medicamento', true);
        $cardiaco_articular = get_post_meta($post->ID, 'cardiaco_articular', true);
        $tipo_cardiaco_articular = get_post_meta($post->ID, 'tipo_cardiaco_articular', true);

        ?>
        <table class="form-table">
            <tr>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="atividade" value="<?= checked($atividade) ?>" class="full__input">
                        Pratica alguma atividade física?
                    </label>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <label>Qual?</label><br>
                    <input type="text" name="tipo_atividade" value="<?= $tipo_atividade ?>" class="full__input">
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="medicamento" value="<?= checked($medicamento) ?>"
                               class="full__input">
                        Faz uso de algum medicamento?
                    </label>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="2">
                    <label>Quais?</label><br>
                    <input type="text" name="tipo_medicamento" value="<?= $tipo_medicamento ?>" class="full__input">
                </td>
                <td valign="top" colspan="1">
                    <label>Porque?</label><br>
                    <input type="text" name="porque_medicamento" value="<?= $porque_medicamento ?>" class="full__input">
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="cardiaco_articular" value="<?= checked($cardiaco_articular) ?>"
                               class="full__input">
                        Você possui algum problema Cardiaco ou Articular?
                    </label>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <label>Qual?</label><br>
                    <input type="text" name="tipo_cardiaco_articular" value="<?= $tipo_cardiaco_articular ?>"
                           class="full__input">
                </td>
            </tr>
            <!--            <tr>-->
            <!--                <td colspan="2">-->
            <!--                    <hr>-->
            <!--                </td>-->
            <!--            </tr>-->
        </table>
        <?php
    }

    function render_mb_objetivo()
    {
        global $post;
        $fortalecimento = get_post_meta($post->ID, 'fortalecimento', true);
        $emagrecimento = get_post_meta($post->ID, 'emagrecimento', true);
        $massa_muscular = get_post_meta($post->ID, 'massa_muscular', true);

        ?>
        <table class="form-table">

            <tr>
                <td valign="top" colspan="1">
                    <!--                    <label></label><br>-->
                    <label>
                        <input type="checkbox" name="$fortalecimento" value="<?= checked($fortalecimento) ?>"
                               class="full__input">
                        Fortalecimento Muscular
                    </label>
                </td>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="$emagrecimento" value="<?= checked($emagrecimento) ?>"
                               class="full__input">
                        Emagrecimento
                    </label>
                </td>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="$massa_muscular" value="<?= checked($massa_muscular) ?>"
                               class="full__input">
                        Ganho de Massa Muscular
                    </label>
                </td>
            </tr>
            <!--            <tr>-->
            <!--                <td colspan="2">-->
            <!--                    <hr>-->
            <!--                </td>-->
            <!--            </tr>-->
        </table>
        <?php
    }

    function render_mb_cirurgia()
    {
        global $post;
        $cirurgia = get_post_meta($post->ID, 'cirurgia', true);
        $tipo_cirurgia = get_post_meta($post->ID, 'tipo_cirurgia', true);

        ?>
        <table class="form-table">
            <tr>
                <td valign="top" colspan="1">
                    <label>
                        <input type="checkbox" name="cirurgia" value="<?= checked($cirurgia) ?>" class="full__input">
                        Já fez alguma cirurgia?
                    </label>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <label>Qual?</label><br>
                    <input type="text" name="tipo_cirurgia" value="<?= $tipo_cirurgia ?>" class="full__input">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <?php
    }


    function save_post($post_id)
    {
        // Add nonce for security and authentication.
        $nonce_name = isset($_POST['data_nonce']) ? $_POST['data_nonce'] : '';
        $nonce_action = 'data';

        // Check if nonce is set.
        if (!isset($nonce_name)) {
            return;
        }
        // Check if nonce is valid.
        if (!wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }
        // Check if user has permissions to save data.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        // Check if not an autosave.
        if (wp_is_post_autosave($post_id)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (wp_is_post_autosave($post_id)) {
            return;
        }
        if (isset($_POST['data_matricula'])) {
            update_post_meta($post_id, 'data_matricula', $_POST['data_matricula']);
        }
        if (isset($_POST['nome'])) {
            update_post_meta($post_id, 'nome', $_POST['nome']);
        }
        if (isset($_POST['rg'])) {
            update_post_meta($post_id, 'rg', $_POST['rg']);
        }
        if (isset($_POST['cpf'])) {
            update_post_meta($post_id, 'cpf', $_POST['cpf']);
        }
        if (isset($_POST['rua'])) {
            update_post_meta($post_id, 'rua', $_POST['rua']);
        }
        if (isset($_POST['bairro'])) {
            update_post_meta($post_id, 'bairro', $_POST['bairro']);
        }
        if (isset($_POST['cidade'])) {
            update_post_meta($post_id, 'cidade', $_POST['cidade']);
        }
        if (isset($_POST['atividade'])) {
            update_post_meta($post_id, 'atividade', $_POST['atividade']);
        }
        if (isset($_POST['tipo_atividade'])) {
            update_post_meta($post_id, 'tipo_atividade', $_POST['tipo_atividade']);
        }

        update_post_meta($post_id, 'medicamento', isset($_POST['medicamento']));

        if (isset($_POST['tipo_medicamento'])) {
            update_post_meta($post_id, 'tipo_medicamento', $_POST['tipo_medicamento']);
        }
        if (isset($_POST['porque_medicamento'])) {
            update_post_meta($post_id, 'porque_medicamento', $_POST['porque_medicamento']);
        }

        update_post_meta($post_id, 'cardiaco_articular', isset($_POST['cardiaco_articular']));

        if (isset($_POST['tipo_cardiaco_articular'])) {
            update_post_meta($post_id, 'tipo_cardiaco_articular', $_POST['tipo_cardiaco_articular']);
        }

        update_post_meta($post_id, 'fortalecimento', isset($_POST['fortalecimento']));

        update_post_meta($post_id, 'emagrecimento', isset($_POST['emagrecimento']));

        update_post_meta($post_id, 'massa_muscular', isset($_POST['massa_muscular']));

        update_post_meta($post_id, 'cirurgia', isset($_POST['cirurgia']));

        if (isset($_POST['tipo_cirurgia'])) {
            update_post_meta($post_id, 'tipo_cirurgia', $_POST['tipo_cirurgia']);
        }

    }

    static function todos($quantidade = -1, $argumentos = [])
    {
        $todos = array();
        $args = array(
            'numberposts' => $quantidade,
            'post_type' => self::POSTTYPE,
        );
        $args = array_merge($args, $argumentos);

        $posts = get_posts($args);
        foreach ($posts as $index => $post) {
            $todos[$index] = new self($post->ID);
        }
        return $todos;
    }

    static function init()
    {
        add_action('init', array(self::CLASSNAME, 'register_cpt'));
        add_action('add_meta_boxes', array(self::CLASSNAME, 'metaboxes'));
        add_action('save_post', array(self::CLASSNAME, 'save_post'));
    }

}