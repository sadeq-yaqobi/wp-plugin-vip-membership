<?php

class User
{
    public static function is_user_vip($user_id): bool
    {
        if (metadata_exists('user', $user_id, '_vip')) {
            $user_vip_data = get_user_meta($user_id, '_vip', true);
            if ($user_vip_data['expire_date'] >= date('Y-m-d') && $user_vip_data['status']==1) {
                return true;
            } else {
                $user_status=['status'=>0];
                $new_user_vip_data = array_replace($user_vip_data, $user_status);
                update_user_meta($user_id, '_vip', $new_user_vip_data);

            }
        }
        return false;
    }

    public static function add_vip_user($plan_type)
    {
        $user_id = get_current_user_id();
        $expire_date = '';
        if (self::is_user_vip($user_id)) {
            $get_vip_info = get_user_meta($user_id, '_vip', true);
            $current_expire_date = $get_vip_info['expire_date'];
            switch ($plan_type) {
                case 1:
                    $expire_date = date('Y-m-d', strtotime($current_expire_date . '+1 month'));
                    break;
                case 2:
                    $expire_date = date('Y-m-d', strtotime($current_expire_date . '+2 months'));
                    break;
                case 3:
                    $expire_date = date('Y-m-d', strtotime($current_expire_date . '+3 months'));
                    break;
            }
        } else {
            switch ($plan_type) {
                case 1:
                    $expire_date = date('Y-m-d', strtotime('+1 month'));
                    break;
                case 2:
                    $expire_date = date('Y-m-d', strtotime('+2 months'));
                    break;
                case 3:
                    $expire_date = date('Y-m-d', strtotime('+3 months'));
                    break;
            }
        }
        update_user_meta($user_id, '_vip', [
            'plan_type' => $plan_type,
            'status'=>1,
            'start_date' => date('Y-m-d'),
            'expire_date' => $expire_date
        ]);

    }

    public static function get_vip_users(): array
    {
        $args = [
            'fields' => ['id', 'display_name', 'user_email'],
            'meta_key' => '_vip',
            'orderby ' => 'ID',
            'order' => 'DESC'
        ];
        $users = new WP_User_Query($args);
        return $users->get_results();
    }
}