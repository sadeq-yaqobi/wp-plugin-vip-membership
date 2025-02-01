<?php
/*Plugin Name: پلاگین اشتراک VIP
Plugin URI: http://siteyar.net/plugins/
Description:  این پلاگین برای ایجاد اشتراک ویژه برای کاربران سایت می باشد
Author: sadeq yaqobi
Version: 1.0.0
License: GPLv2 or later
Author URI: http://siteyar.net/sadeq-yaqobi/ */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

#for security
defined('ABSPATH') || exit();

class Core
{
    public function __construct()
    {
        $this->define_constants();
        $this->init();
    }

    private function define_constants()
    {
        define('VIP_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('VIP_PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    private function init()
    {
        include_once VIP_PLUGIN_DIR . 'class/AutoLoad.php';
        register_activation_hook('__file__', [$this, 'wp_vip_activation']);
        register_activation_hook('__file__', [$this, 'wp_vip_deactivation']);
        add_action('wp_enqueue_scripts', [$this, 'wp_vip_register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'wp_vip_register_assets_admin']);
        add_action('after_setup_theme', [$this,'wp_check_is_user_vip']);

        add_filter('template_redirect', [$this, 'ob_start']); //to prevent headers already sent error
        // it's necessary to include pluggable.php file if you want to use something like get_current_user_id() function in plugins because this function will include just when all plugins were included
        include_once(ABSPATH . 'wp-includes/pluggable.php');
        include_once VIP_PLUGIN_DIR . '_lib/jdf.php'; //library for having data in jalali format
        include_once VIP_PLUGIN_DIR . 'view/front/vip-card.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-checkout.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-gateway.php';
        include_once VIP_PLUGIN_DIR . 'view/front/vip-payment-result.php';
        include_once VIP_PLUGIN_DIR . '_inc/meta-box/vip-meta-box.php';
        include_once VIP_PLUGIN_DIR . '_inc/filter-vip-content.php';
        include_once VIP_PLUGIN_DIR . '_inc/admin/menu.php';

    }

    public function wp_vip_register_assets()
    {
        // Front CSS
        wp_register_style('vip-style', VIP_PLUGIN_URL . 'assets/css/front/style.css', [], '1.0.0');
        wp_enqueue_style('vip-style');
        Helper::wp_vip_check_style_is();

        // Front JS
        wp_register_script('vip-main-js', VIP_PLUGIN_URL . 'assets/js/front/main.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('vip-main-js');
        Helper::wp_vip_check_script_is();

    }

    public function wp_vip_register_assets_admin()
    {
        // Admin CSS
        wp_register_style('uikit-style', VIP_PLUGIN_URL . 'assets/css/admin/uikit-rtl.min.css', [], '3.21.16');
        wp_enqueue_style('uikit-style');

        wp_register_style('jalali-datepicker-style', VIP_PLUGIN_URL . 'assets/css/admin/jalalidatepicker.min.css', [], '1.0.0');
        wp_enqueue_style('jalali-datepicker-style');

        wp_register_style('vip-admin-style', VIP_PLUGIN_URL . 'assets/css/admin/admin.css', [], '1.0.0');
        wp_enqueue_style('vip-admin-style');

        // Admin JS
        wp_register_script('uikit-js', VIP_PLUGIN_URL . 'assets/js/admin/uikit.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('uikit-js');

        wp_register_script('uikit-icon-js', VIP_PLUGIN_URL . 'assets/js/admin/uikit-icons.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('uikit-icon-js');

        wp_register_script('jalali-datepicker-js', VIP_PLUGIN_URL . 'assets/js/admin/jalalidatepicker.min.js', '', '1.0.0', ['strategy' => 'async', 'in_footer' => false]);
        wp_enqueue_script('jalali-datepicker-js');

        wp_register_script('vip-admin-js', VIP_PLUGIN_URL . 'assets/js/admin/admin.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('vip-admin-js');
    }

    public function wp_vip_activation()
    {

    }

    public function wp_vip_deactivation()
    {

    }

    public function ob_start()
    {
        return ob_start(null, 0, 0);
    }

    function wp_check_is_user_vip()
    {
        User::is_user_vip(get_current_user_id());
    }
}

$core = new core;



