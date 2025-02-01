<?php
add_shortcode('vip-gateway', 'wp_vip_gateway');

function wp_vip_gateway()
{
    if (!isset($_POST['plan_id']) || !is_user_logged_in() || empty($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'])) {
        wp_redirect(home_url());
    }

    $current_user_info = wp_get_current_user();

    $plan_id = intval($_POST['plan_id']);
    $plan = new Plan();
    $plan = $plan->find_by_id($plan_id);
    Session::set('user_plan_data', [
        'session_id' => session_id(),
        'plan_type' => $plan->type,
        'price' => $plan->price,
        'user_id' => $current_user_info->ID,
        'first_name' => $current_user_info->first_name,
        'last_name' => $current_user_info->last_name,
        'email' => $current_user_info->user_email,
        'order_number' => Helper::orderNumber()
    ]);
//    Session::unset('user_plan_data');
    if (Session::isSetSession('user_plan_data')) {
        wp_redirect(home_url('vip-checkout'));
    } else {
        wp_redirect(home_url());
    }
}
