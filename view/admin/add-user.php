<!-- add modal -->
<div id="add-vip-user" uk-modal class="add-modal-wrapper" bg-close="false">
    <div class="uk-modal-dialog uk-modal-body add-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title add-title">افزودن کاربر ویژه</h2>
        <div class="uk-container-xlarge vip-font">
            <form class="uk-form-horizontal uk-margin-large" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">ایمیل</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="email" id="email" type="email" placeholder="email...">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="plan_type">پلن</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="plan_type" name="plan_type">
                            <option value="1">پایه</option>
                            <option value="2">نقره‌ای</option>
                            <option value="3">طلایی</option>
                        </select>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="start_date">تاریخ شروع</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="start_date" name="start_date" type="text" placeholder="تاریخ شروع"
                               data-jdp>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="expire_date">تاریخ اتمام</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="expire_date" name="expire_date" type="text"
                               placeholder="تاریخ اتمام" data-jdp>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="status">وضعیت</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="status" name="status">
                            <option value="0">غیرفعال</option>
                            <option value="1">فعال</option>
                        </select>
                    </div>
                </div>
        </div>
        <div class="uk-text-left uk-margin-medium-top">
            <button name="add_vip_user" type="submit" class="uk-button uk-button-primary uk-border-rounded"
                    value="user-submit">
                افزودن
            </button>
            <?php wp_nonce_field('add_vip_user', '_nonce_add_vip_user') ?>
        </div>
        </form>
    </div>
</div>
<?php
//handle adding user to database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_vip_user'])) {
    if (isset($_POST['_nonce_add_vip_user']) && wp_verify_nonce($_POST['_nonce_add_vip_user'], 'add_vip_user') && current_user_can('manage_options')) {
// check to not be empty inputs
        foreach ($_POST as $name => $value) {
            if ($name == 'status' && $value == '0') continue;
            if (empty($value)) {
                FlashMessage::addMsg('تکمیل تمامی فیلدها الزامی است.', 0);
                return;
            }
        }
        $email = sanitize_text_field($_POST['email']);
        $user_id = email_exists($email);
//check to be email registered
        if ($user_id === false) {
            FlashMessage::addMsg('ایمیل وارد شده عضو سایت نیست', 0);
            return;
        }
        $vip_user_data = [
            'plan_type' => intval($_POST['plan_type']),
            'status' => intval($_POST['status']),
            'start_date' => Helper::toGregorian(sanitize_text_field($_POST['start_date']), '/'),
            'expire_date' => Helper::toGregorian(sanitize_text_field($_POST['expire_date']), '/'),
        ];
        $add_new_vip_use=update_user_meta($user_id, '_vip', $vip_user_data);
        if(!$add_new_vip_use){
            FlashMessage::addMsg('خطایی در افزودن کاربر ویژه جدید رخ داده است.', 0);
        }else{
            FlashMessage::addMsg('کاربر ویژه با موفقیت افزوده شد.', 1);
        }
    }
}


