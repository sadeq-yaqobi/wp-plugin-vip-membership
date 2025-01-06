<?php
/*Plugin Name: پلاگین اشتراک VIP
Plugin URI: http://siteyar.net/plugins/
Description:  این پلاگین برای ایجاد اشتراک ویژه برای کاربران سایت می باشد
Author: sadeq yaqobi
Version: 1.0.0
License: GPLv2 or later
Author URI: http://siteyar.net/sadeq-yaqobi/ */


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
        add_action('wp_enqueue_scripts', [$this, 'wp_vip_register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'wp_vip_register_assets_admin']);
        register_activation_hook('__file__', [$this, 'wp_vip_activation']);
        register_activation_hook('__file__', [$this, 'wp_vip_deactivation']);
        include_once VIP_PLUGIN_DIR.'view/front/vip-card.php';
        include_once VIP_PLUGIN_DIR.'view/front/vip-checkout.php';

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
        wp_register_style('uikit-style', 'https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css', [], '3.21.16');
        wp_enqueue_style('uikit-style');

        wp_register_style('vip-admin-style', VIP_PLUGIN_URL . 'assets/css/admin/admin.css', [], '1.0.0');
        wp_enqueue_style('vip-admin-style');

        // Admin JS
        wp_register_script('uikit-js', 'https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('uikit-js');

        wp_register_script('uikit-icon-js', 'https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('uikit-icon-js');

        wp_register_script('vip-admin-js', VIP_PLUGIN_URL . 'assets/js/admin/admin.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
        wp_enqueue_script('vip-admin-js');
    }

    public function wp_vip_activation()
    {

    }

    public function wp_vip_deactivation()
    {

    }
}

$core = new core;