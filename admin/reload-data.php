<?php
/**
 * Reload example data admin view.
 *
 * @package WP_KK_Writer_Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap">
	<h2><?php esc_html_e( 'Reload data', 'kkwdomain' ); ?></h2>

	<div>
		<p><?php esc_html_e( 'Click the button to reload all the data of the plugin: pages, taxonomy terms, etc. .', 'kkwdomain' ); ?></p>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=kkw_loadexamples_menu&action=reload' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Reload', 'kkwdomain' ); ?></a>
	</div>

</div>
