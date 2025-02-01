<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_vip_user'])) {
    if (isset($_POST['_nonce_delete_vip_user']) && wp_verify_nonce($_POST['_nonce_delete_vip_user'], 'delete_vip_user') && current_user_can('manage_options')) {
        $user_id = intval($_POST['user_id']);
        $delete_vip_use= delete_user_meta($user_id,'_vip');
        if(!$delete_vip_use){
            FlashMessage::addMsg('خطایی در حذف کاربر ویژه رخ داده است.', 0);
        }else{
            FlashMessage::addMsg('کاربر ویژه با موفقیت حذف شد.', 1);
        }
    }
}
