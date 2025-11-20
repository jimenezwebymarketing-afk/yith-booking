<?php
/**
 * Plugin Name: YITH Booking and Appointment for WooCommerce Premium
 * Plugin URI: https://yithemes.com/themes/plugins/yith-woocommerce-booking/
 * Description: <code><strong>YITH Booking and Appointment for WooCommerce</strong></code> allows you to create and manage Booking Products. You can create monthly/daily/hourly/per-minute booking products with Services and People by setting costs and availability. You can also synchronize your booking products with external services such as Booking.com or Airbnb. Moreover, it includes Google Calendar integration, Google Maps, Search Forms, YITH Booking theme, and many other features! <a href="https://yithemes.com/" target="_blank">Get more plugins for your e-commerce shop on <strong>YITH</strong></a>
 * Version: 5.27.1
 * Author: YITH
 * Author URI: https://yithemes.com/
 * Text Domain: yith-booking-for-woocommerce
 * Domain Path: /languages/
 * WC requires at least: 10.1
 * WC tested up to: 10.3
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH\Booking
 * @version 5.27.1
 */

defined( 'ABSPATH' ) || exit;

// Check if required plugin framework exists
if ( file_exists( __DIR__ . '/plugin-fw/yit-plugin-registration-hook.php' ) ) {
	if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
		require_once __DIR__ . '/plugin-fw/yit-plugin-registration-hook.php';
	}
	register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );
}

// Check if plugin upgrade functions exist
if ( file_exists( __DIR__ . '/plugin-upgrade/functions-yith-licence.php' ) ) {
	if ( ! function_exists( 'yith_plugin_onboarding_registration_hook' ) ) {
		include_once __DIR__ . '/plugin-upgrade/functions-yith-licence.php';
	}
	register_activation_hook( __FILE__, 'yith_plugin_onboarding_registration_hook' );
}


if ( ! defined( 'YITH_WCBK_PREMIUM' ) ) {
	define( 'YITH_WCBK_PREMIUM', true );
}

if ( ! defined( 'YITH_WCBK_INIT' ) ) {
	define( 'YITH_WCBK_INIT', plugin_basename( __FILE__ ) );
}

if ( defined( 'YITH_WCBK_VERSION' ) ) {
	return;
}

if ( ! defined( 'YITH_WCBK_VERSION' ) ) {
	define( 'YITH_WCBK_VERSION', '5.27.1' );
}

if ( ! defined( 'YITH_WCBK_FILE' ) ) {
	define( 'YITH_WCBK_FILE', __FILE__ );
}

// Only load global initialization if file exists
if ( file_exists( __DIR__ . '/init-global.php' ) ) {
	require_once __DIR__ . '/init-global.php';
} else {
	// Deactivate plugin if essential files are missing
	if ( function_exists( 'add_action' ) ) {
		add_action( 'admin_init', function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		} );
		add_action( 'admin_notices', function() {
			?>
			<div class="error">
				<p><?php esc_html_e( 'YITH Booking and Appointment for WooCommerce has been deactivated because essential files are missing. Please reinstall the plugin.', 'yith-booking-for-woocommerce' ); ?></p>
			</div>
			<?php
		} );
	}
}
