<?php
//update vip user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_vip_user'])) {
    if (isset($_POST['_nonce_update_vip_user']) && wp_verify_nonce($_POST['_nonce_update_vip_user'], 'update_vip_user') && current_user_can('manage_options')) {
        // check to not be empty inputs
        foreach ($_POST as $name => $value) {
            if ($name == 'status' && $value == '0') continue;
            if (empty($value)) {
                FlashMessage::addMsg('پرکردن تمامی فیلدها الزامی است', 0);
                return;
            }
        }
        $new_user_data = [
            'plan_type' => intval($_POST['plan_type']),
            'status' => intval($_POST['status']),
            'start_date' => Helper::toGregorian(sanitize_text_field($_POST['start_date']), '/'),
            'expire_date' => Helper::toGregorian(sanitize_text_field($_POST['expire_date']), '/'),
        ];
        $user_id = sanitize_text_field($_POST['user_id']);
        $update_vip_use = update_user_meta($user_id, '_vip', $new_user_data);
        if (!$update_vip_use) {
            FlashMessage::addMsg('خطایی در ویرایش کاربر ویژه رخ داده است.', 0);
        } else {
            FlashMessage::addMsg('کاربر ویژه با موفقیت ویرایش شد.', 1);
        }
    }


}