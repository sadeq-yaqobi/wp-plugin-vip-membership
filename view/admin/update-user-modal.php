<!-- update modal -->
<div id="update-vip-user-<?php echo $user->ID ?>" uk-modal class="add-modal-wrapper" bg-close="false">
    <div class="uk-modal-dialog uk-modal-body add-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title add-title">ویرایش کاربر ویژه</h2>
        <div class="uk-container-xlarge vip-font">
            <form class="uk-form-horizontal uk-margin-large" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="display_name">نام و نام خانوادگی</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="display_name" id="display_name" type="text"
                               placeholder="نام و نام خانوادگی" value="<?php echo esc_html($user->display_name) ?>"
                               disabled>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">ایمیل</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="email" id="email" type="email" placeholder="email..."
                               value="<?php echo esc_html($user->user_email) ?>" disabled>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="plan_type">پلن</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="plan_type" name="plan_type">
                            <option value="1" <?php selected($user_vip_data['plan_type'], 1) ?>>پایه</option>
                            <option value="2" <?php selected($user_vip_data['plan_type'], 2) ?>>نقره‌ای</option>
                            <option value="3" <?php selected($user_vip_data['plan_type'], 3) ?>>طلایی</option>
                        </select>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="start_date">تاریخ شروع</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="start_date" name="start_date" type="text" placeholder="تاریخ شروع"
                               data-jdp value="<?php echo Helper::toJalali($user_vip_data['start_date'], '-') ?>">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="expire_date">تاریخ اتمام</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="expire_date" name="expire_date" type="text"
                               placeholder="تاریخ اتمام" data-jdp
                               value="<?php echo Helper::toJalali($user_vip_data['expire_date'], '-') ?>">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="status">وضعیت</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="status" name="status">
                            <option value="0" <?php selected($user_vip_data['status'], 0) ?>>غیرفعال</option>
                            <option value="1" <?php selected($user_vip_data['status'], 1) ?>>فعال</option>
                        </select>
                    </div>
                </div>
        </div>
        <div class="uk-text-left uk-margin-medium-top">
            <button name="update_vip_user" type="submit" class="uk-button uk-button-primary uk-border-rounded"
                    value="update-submit">
                بروزرسانی
            </button>
            <input type="hidden" name="user_id" value="<?php echo $user->ID ?>">
            <?php wp_nonce_field('update_vip_user', '_nonce_update_vip_user') ?>
        </div>
        </form>
    </div>
</div>

