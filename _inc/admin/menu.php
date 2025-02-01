<?php
add_action('admin_menu', 'wp_vip_register_menu');
function wp_vip_register_menu()
{
    add_menu_page(
        ' VIP پلاگین اشتراک ویژه',
        'اشتراک ویژه',
        'manage_options',
        'vip-home',
        'wp_vip_home_handler'
    );
    add_submenu_page(
        'vip-home',
        'لیست کاربران ویژه',
        'کاربران',
        'manage_options',
        'vip-users',
        'wp_vip_user_list_handler'
    );
    add_submenu_page(
        'vip-home',
        'لیست تراکنش‌ها',
        'تراکنش‌ها',
        'manage_options',
        'vip-transactions',
        'wp_vip_transaction_list_handler'
    );
    add_submenu_page(
        'vip-home',
        'پلن‌های vip',
        'پلن‌ها',
        'manage_options',
        'vip-plans',
        'wp_vip_plans_list_handler'
    );
    add_submenu_page(
        'vip-home',
        'تنظیمات پلاگین vip',
        'تنظیمات',
        'manage_options',
        'vip-setting',
        'wp_vip_setting_handler'
    );
}

function wp_vip_home_handler()
{
    echo 'vip home';
}

function wp_vip_user_list_handler()
{
    include_once VIP_PLUGIN_DIR . 'view/admin/add-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/delete-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/update-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/user-list.php';
}

function wp_vip_transaction_list_handler()
{
    echo 'transaction list';
}

function wp_vip_plans_list_handler()
{
    echo 'plans list';
}

function wp_vip_setting_handler()
{
    echo 'setting';
}
