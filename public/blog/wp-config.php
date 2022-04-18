<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wordpress' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'wp_user' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'wp_pass' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql-innodbcluster.mysql-operator:6446' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9x3fGoQmUTCqP|_9%tS)0E%C_HPRR3 [_qVy+R9H;S@XHHtJej<]uu!Pm`tWwllN' );
define( 'SECURE_AUTH_KEY',  '@(sBzJpUWO9iSkSWqhjaG#Mb~Q.$%FKye8*tc@kQ{d%&,U^)+iH9R5SAY59zgFrD' );
define( 'LOGGED_IN_KEY',    'Mt7dO}Cd2;p;KOaQ.x, S94i7}8PYUp77nhzDy]25Zp|B1|GH<oeqUOS%oVI-1M@' );
define( 'NONCE_KEY',        'f^$t^1|EH9#jw]>JhVk_b^H[QS#fw9~iP}([+gC/kXA<+XySX!rRy_=yc6!_cRz8' );
define( 'AUTH_SALT',        'I@s4rHx7bWAT 7|USnDj 5%[(&X|DsKq_q$Hic:iCx1O`)2ahr%,XE{v9U#HPp_ ' );
define( 'SECURE_AUTH_SALT', 'ZBF~,R9SNFy&Kfi$vtwv*hkxU>`Py#lE-wJYRnwrFIpk|Yz>$%CMjftTK[@<Xxbo' );
define( 'LOGGED_IN_SALT',   '`|El]aiW>#F?Kt)$ZH5N#?U){5/=5a[L-@h(8iZlp(~yD%yotWHF%;tcik4;hC^_' );
define( 'NONCE_SALT',       '37u*]bL9Hkdvp*)-ZsOM%GXue) VyB<_BAB@/}lVoIhFu*ltYiR/%/z81>?]f8Cv' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';