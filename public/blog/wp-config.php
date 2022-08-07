<?php
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
define( 'DB_HOST', 'mysql.mysql:3306' );

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
define( 'AUTH_KEY',         '|WuLIU{@3O%4?,Advn koFPPT(CspoQ!8yWcw(py#46@1PgrZ_w%j7>uW3W`v_k}' );
define( 'SECURE_AUTH_KEY',  ')tzbd=v%4.IiomyM&.j9y1l&Tnx&RsO!lt05r^y#0Q`%)/`W4p9qeCd(3!KHwOLb' );
define( 'LOGGED_IN_KEY',    'L)j$);+549J`%4kX9YViT*>0Qzxa4GraY-ro.bhR=R1<pd0cP8`Pi&#KGSmWIco3' );
define( 'NONCE_KEY',        't)B[S9kAO7/=C*<dgg*2g>CMYB8_w@kfd5n<fK|]2aRC47y(T}:(fJV|*Ry GHAN' );
define( 'AUTH_SALT',        'jqLBK5)0wXX9p=[)lcuq+^|7j5ELt;z?0Bgu]XB#ZoCR~FQ0p2f+ r[S0j)>D_kD' );
define( 'SECURE_AUTH_SALT', 'n2$ax=_3@*#skq]uT s9?mbHM7#x{ s-D8rw.vANBm{}iyw0GiVklD(=<?@Ef[^h' );
define( 'LOGGED_IN_SALT',   'E$]mCps9xL=xv3T`/C?#K=+F|k<(/FaHT{7SZ:~6te|so(?t6t+e(4zx|LC[ro8G' );
define( 'NONCE_SALT',       'DHj`~SL}-:Zm)H05BO`Udw->=%W+B1f(,NV1?0CP0K7=43A|@5?Cm+F%7}[?WeF;' );

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
