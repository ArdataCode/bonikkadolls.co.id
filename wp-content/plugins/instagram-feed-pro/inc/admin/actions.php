<?php
/**
 * Includes functions related to actions while in the admin area.
 *
 * - All AJAX related features
 * - Enqueueing of JS and CSS files
 * - Settings link on "Plugins" page
 * - Creation of local avatar image files
 * - Connecting accounts on the "Configure" tab
 * - Displaying admin notices
 * - Clearing caches
 * - License renewal
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function sb_instagram_menu() {
	$cap = current_user_can( 'manage_instagram_feed_options' ) ? 'manage_instagram_feed_options' : 'manage_options';

	$cap = apply_filters( 'sbi_settings_pages_capability', $cap );

	global $sb_instagram_posts_manager;
	$notice = '';
	if ( $sb_instagram_posts_manager->are_critical_errors() ) {
		//$notice = ' <span class="update-plugins sbi-error-alert"><span>!</span></span>';
	}

	$sbi_notifications = new SBI_Notifications();
	$notifications = $sbi_notifications->get();

	$notice_bubble = '';
	if ( empty( $notice ) && ! empty( $notifications ) && is_array( $notifications ) ) {
		$notice_bubble = ' <span class="sbi-notice-alert"><span>'.count( $notifications ).'</span></span>';
	}

	add_menu_page(
		__( 'Instagram Feed', 'instagram-feed' ),
		__( 'Instagram Feed', 'instagram-feed' ). $notice_bubble,
		$cap,
		'sb-instagram-feed',
		'sb_instagram_settings_page'
	);
}
add_action( 'admin_menu', 'sb_instagram_menu' );

function sb_instagram_admin_style() {
	wp_register_style( 'sb_instagram_admin_css', SBI_PLUGIN_URL . 'css/sb-instagram-admin.css', array(), SBIVER );
	wp_enqueue_style( 'sb_instagram_font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'sb_instagram_admin_css' );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_style' );

function sb_instagram_admin_scripts() {
	wp_enqueue_script( 'sb_instagram_admin_js', SBI_PLUGIN_URL . 'js/sb-instagram-admin.js', array(), SBIVER, true );
	wp_localize_script(
		'sb_instagram_admin_js',
		'sbiA',
		array(
			'ajax_url'  => admin_url( 'admin-ajax.php' ),
			'sbi_nonce' => wp_create_nonce( 'sbi_nonce' ),
		)
	);
	$strings = array(
		'addon_activate'                  => esc_html__( 'Activate', 'instagram-feed' ),
		'addon_activated'                 => esc_html__( 'Activated', 'instagram-feed' ),
		'addon_active'                    => esc_html__( 'Active', 'instagram-feed' ),
		'addon_deactivate'                => esc_html__( 'Deactivate', 'instagram-feed' ),
		'addon_inactive'                  => esc_html__( 'Inactive', 'instagram-feed' ),
		'addon_install'                   => esc_html__( 'Install Addon', 'instagram-feed' ),
		'addon_error'                     => esc_html__( 'Could not install addon. Please download from wpforms.com and install manually.', 'instagram-feed' ),
		'plugin_error'                    => esc_html__( 'Could not install a plugin. Please download from WordPress.org and install manually.', 'instagram-feed' ),
		'addon_search'                    => esc_html__( 'Searching Addons', 'instagram-feed' ),
		'ajax_url'                        => admin_url( 'admin-ajax.php' ),
		'cancel'                          => esc_html__( 'Cancel', 'instagram-feed' ),
		'close'                           => esc_html__( 'Close', 'instagram-feed' ),
		'nonce'                           => wp_create_nonce( 'sbi-admin' ),
		'almost_done'                     => esc_html__( 'Almost Done', 'instagram-feed' ),
		'oops'                            => esc_html__( 'Oops!', 'instagram-feed' ),
		'ok'                              => esc_html__( 'OK', 'instagram-feed' ),
		'plugin_install_activate_btn'     => esc_html__( 'Install and Activate', 'instagram-feed' ),
		'plugin_install_activate_confirm' => esc_html__( 'needs to be installed and activated to import its forms. Would you like us to install and activate it for you?', 'instagram-feed' ),
		'plugin_activate_btn'             => esc_html__( 'Activate', 'instagram-feed' ),
	);
	$strings = apply_filters( 'sbi_admin_strings', $strings );
	wp_localize_script(
		'sb_instagram_admin_js',
		'sbi_admin',
		$strings
	);
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$sbi_plugin_file = 'instagram-feed-pro/instagram-feed.php';
add_filter( "plugin_action_links_$sbi_plugin_file", 'sbi_add_settings_link', 10, 2 );

//modify the link by unshifting the array
function sbi_add_settings_link( $links, $file ) {
	$sbi_settings_link = '<a href="' . admin_url( 'admin.php?page=sbi-feed-builder' ) . '">' . __( 'Settings', 'instagram-feed' ) . '</a>';
	array_unshift( $links, $sbi_settings_link );

	return $links;
}

function sbi_formatted_error( $response ) {
	if ( isset( $response['error'] ) ) {
		$error  = '<p>' . sprintf( __( 'API error %s:', 'instagram-feed' ), esc_html( $response['error']['code'] ) ) . ' ' . esc_html( $response['error']['message'] ) . '</p>';
		$error .= '<div class="license-action-btns"><p class="sbi-error-directions"><a href="https://smashballoon.com/instagram-feed/docs/errors/" target="_blank" rel="noopener">' . __( 'Directions on how to resolve this issue', 'instagram-feed' ) . '</a></p></div>';

		return $error;
	} else {
		$message = '<p>' . sprintf( __( 'Error connecting to %s.', 'instagram-feed' ), $response['url'] ) . '</p>';
		if ( isset( $response['response'] ) && isset( $response['response']->errors ) ) {
			foreach ( $response['response']->errors as $key => $item ) {
				$message .= '<p>' . esc_html( $key ) . ' - ' . esc_html( $item[0] ) . '</p>';
			}
		}
		$message .= '<div class="license-action-btns"><p class="sbi-error-directions"><a href="https://smashballoon.com/instagram-feed/docs/errors/" target="_blank" rel="noopener">' . __( 'Directions on how to resolve this issue', 'instagram-feed' ) . '</a></p></div>';

		return $message;
	}
}

function sbi_connect_new_account( $access_token, $account_id ) {
	$split_id   = explode( ' ', trim( $account_id ) );
	$account_id = preg_replace( '/[^A-Za-z0-9 ]/', '', $split_id[0] );
	if ( ! empty( $account_id ) ) {
		$split_token  = explode( ' ', trim( $access_token ) );
		$access_token = preg_replace( '/[^A-Za-z0-9 ]/', '', $split_token[0] );
	}

	$account = array(
		'access_token' => $access_token,
		'user_id'      => $account_id,
		'type'         => 'business',
	);

	if ( sbi_code_check( $access_token ) ) {
		$account['type'] = 'basic';
	}

	$connector = new SBI_Account_Connector();

	$response = $connector->fetch( $account );

	if ( isset( $response['access_token'] ) ) {
		$connector->add_account_data( $response );
		$connector->update_stored_account();
		$connector->after_update();
		return $connector->get_account_data();
	} else {
		return $response;
	}
}

add_action( 'sbi_admin_notices', 'sbi_admin_error_notices' );
function sbi_admin_error_notices() {
	global $sb_instagram_posts_manager;

	if ( isset( $_GET['page'] ) && in_array( $_GET['page'], array( 'sbi-settings' )) ) {
		$errors = $sb_instagram_posts_manager->get_errors();
		if ( ! empty( $errors ) && (! empty( $errors['database_create'] ) || ! empty( $errors['upload_dir'] )) ) : ?>
			<div class="sbi-admin-notices sbi-critical-error-notice">
				<span class="sb-notice-icon sb-error-icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="#D72C2C"/>
						</svg>
				</span>
				<div class="sbi-notice-body">

					<?php if ( ! empty( $errors['database_create'] ) ) : ?>
						<h3 class="sb-notice-title">
							<?php echo esc_html__( 'Instagram Feed was unable to create new database tables.', 'instagram-feed') ; ?>
						</h3>
						<p><?php echo wp_kses_post( $errors['database_create'] ); ?></p><br><br>
						<p class="sbi-error-directions"><a href="https://smashballoon.com/docs/instagram/" class="sbi-license-btn sbi-btn-blue sbi-notice-btn" target="_blank"><?php esc_html_e(  'Visit our FAQ page for help', 'instagram-feed' ); ?></a> <button class="sbi-retry-db sbi-space-left sbi-btn sbi-notice-btn sbi-btn-grey"><?php esc_html_e(  'Try creating database tables again', 'instagram-feed' ); ?></button></p>
					<?php
					endif;
					?>
					<?php if ( ! empty( $errors['upload_dir'] ) ) : ?>
						<p><?php echo wp_kses_post( $errors['upload_dir'] ); ?></p><br><br>

						<p class="sbi-error-directions"><a href="https://smashballoon.com/docs/instagram/" class="sbi-license-btn sbi-btn-blue sbi-notice-btn" target="_blank"><?php esc_html_e(  'Visit our FAQ page for help', 'instagram-feed' ); ?></a></p>

					<?php endif; ?>
				</div>
			</div>

		<?php endif;
		$errors = $sb_instagram_posts_manager->get_critical_errors();
		if ( $sb_instagram_posts_manager->are_critical_errors() ) :
			?>
			<div class="sbi-admin-notices sbi-critical-error-notice">
					<span class="sb-notice-icon sb-error-icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="#D72C2C"/>
						</svg>
					</span>
				<div class="sbi-notice-body">
					<h3 class="sb-notice-title">
						<?php echo esc_html__( 'Instagram Feed is encountering an error and your feeds may not be updating due to the following reasons:', 'instagram-feed') ; ?>
					</h3>

					<p><?php echo $errors; ?></p>
				</div>
			</div>
		<?php
		endif;
	}
}

function sbi_reset_log() {
	check_ajax_referer( 'sbi_nonce', 'sbi_nonce' );

	if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
		wp_send_json_error();
	}

	global $sb_instagram_posts_manager;

	$sb_instagram_posts_manager->remove_all_errors();

	wp_send_json_success( '1' );
}
add_action( 'wp_ajax_sbi_reset_log', 'sbi_reset_log' );

function sb_instagram_settings_page() {
	$link = admin_url( 'admin.php?page=sbi-settings' );
	?>
	<div id="sbi_admin">
		<div class="sbi_notice">
			<strong><?php esc_html_e( 'The Instagram Feed Settings page has moved!', 'instagram-feed' ); ?></strong>
			<a href="<?php echo esc_url( $link ); ?>"><?php esc_html_e( 'Click here to go to the new page.', 'instagram-feed' ); ?></a>
		</div>
	</div>
<?php
}

function sbi_get_connect_account_button( $page = 'admin.php?page=sb-instagram-feed' ) {
	$state_url   = wp_nonce_url( admin_url( 'admin.php?page=sbi-settings' ), 'sbi-connect', 'sbi_con' );
	$connect_url = 'https://connect.smashballoon.com/auth/ig/?state=' . $state_url;
	?>
	<a data-new-api="<?php echo esc_attr( $connect_url ); ?>" href="<?php echo esc_attr( $connect_url ); ?>" class="sbi_admin_btn"><i class="fa fa-user-plus" aria-hidden="true" style="font-size: 20px;"></i>&nbsp; <?php esc_html_e( 'Connect an Instagram Account', 'instagram-feed' ); ?></a>
	<?php
}
