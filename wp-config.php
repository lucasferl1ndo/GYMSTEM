<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'ws' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$`,.`Cj@+b;S-II[OqEw[b`iJnM(YJ/1HeYMlB+7BmlQ[^Fy+p;`_{j=rbz45V-i' );
define( 'SECURE_AUTH_KEY',  'Jm1b<,wL2`sPQr<?AvsL~,&L1]0_R!N#w;}Mzro_?Lte>_d{qjh/{[!tQ xySBf@' );
define( 'LOGGED_IN_KEY',    'tu!5d&y&;-./}ah/K[uclaxn@=#5DEl5>gYMwTFwDK%5hH/}r{rzjXb68`@X:PtD' );
define( 'NONCE_KEY',        '8@>{3R6PcPz{MpaLLi~btNmPgIU1hUn^5oVFG;XwfL+01[wYCySMT#b5X|]+$l~n' );
define( 'AUTH_SALT',        '@=jF@gs$i*RB/kca+IZ]lr^Q=wV2sxog@dZ|ex?>5omei+Z6z c@(FWwXk`0%qiN' );
define( 'SECURE_AUTH_SALT', 'q~O- Dd%UT6t+EBg,^Z15$K&zEh>6U1?dmDm(pJF<4&&#^Qpl/5SY{QB:T_dTaLi' );
define( 'LOGGED_IN_SALT',   'Hp;xCR<Eh:f$-k|&36G}#h WLN?u 5<A^+t]>Y2|D1^W.C0>,}Vim0t*^1tZAk7z' );
define( 'NONCE_SALT',       '#NI*IoW5Ftq=8N27l)TZgpIHZO)<%L4SXzmm3y#0~,SyzD9h?Kc2&GQ=gwFHTlaJ' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_ws';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
