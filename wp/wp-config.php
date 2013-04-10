<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'Anime-Trigger-WP');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'root');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.H-rp1Xk+cDwq9dZ 8:JY}DyidxxMre6O9ou5A>hNklm.)H],<ii0>/VG`i);*Md');
define('SECURE_AUTH_KEY',  'FoP%bExJXCpm$z@3<XZ5jA|w#B~6Up|vdH?BwA3qcVjI!9OCs:k>^a:J4fVbbciW');
define('LOGGED_IN_KEY',    'f-yaij~*SZ;$QbMq*jh47,#J1]8$64gL.J$Z)C(5+?m5J@YU}K(D<C<j^>9kJe+R');
define('NONCE_KEY',        'ut*t*JsdK_};,JoPHlWJM)>U1Baqp=wIoU!1N*$g%4:1SIiND*H02(fiTX:|h,S~');
define('AUTH_SALT',        'N;b]bbPqO;d`=]|IAeCgvCXoDcuI2tiC6B456AgjRi`ow80?A(|SkZbd;W;~e%+G');
define('SECURE_AUTH_SALT', 'EDsO~B1<is%cO9aA.fozv4@`bbBQF4CKhdvf{n[Dhsc?dTs|`AD@yC%2;H okKIg');
define('LOGGED_IN_SALT',   '5b[jtAis>D=[tR5<`+nR5OtWmmVn|4P;&F=0ng(B*WT2#?`bhQEVc:35p^j#Xr[N');
define('NONCE_SALT',       'oRU~N&Bsv]VETt}eb|lc.,Ro:BKSxxNnk 2]n^L:q.UiSr>t9{40KB#|U%(;s&t(');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
