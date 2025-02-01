<div class=" uk-container-expand uk-margin-medium-top uk-overflow-auto vip-user-list-container">
    <?php $users = User::get_vip_users();
    if ($users): ?>

    <div class="uk-flex uk-flex-between uk-margin-medium-left uk-flex-middle">
        <h2><?php echo esc_html(get_admin_page_title()) ?></h2>
        <a
                class="uk-background-muted uk-button uk-button-default uk-border-rounded"
                uk-tooltip="افزودن کاربر ویژه"
                href="#add-vip-user" uk-toggle>کاربر جدید<span class="uk-margin-small-right"
                                                                  uk-icon="icon: plus; ratio: 0.7"></span></a>
    </div>
    <?php echo FlashMessage::showMsg()?>
    <table class="uk-table uk-table-small uk-table-striped">
        <thead >
        <tr>
            <th>#</th>
            <th>نام و نام خانوادگی</th>
            <th>پلن</th>
            <th>تاریخ شروع</th>
            <th>تاریخ اتمام</th>
            <th>زمان باقی‌مانده</th>
            <th>ایمیل</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user) User::is_user_vip($user->ID); //to update user vip status
        foreach ($users as $user):
            $user_vip_data = get_user_meta($user->ID, '_vip', true);
        if(empty($user_vip_data)) return;
            ?>
            <tr>
                <td><?php echo esc_html($user->ID) ?></td>
                <td><?php echo esc_html($user->display_name) ?></td>
                <td><?php echo esc_html(Helper::planType($user_vip_data['plan_type'])) ?></td>
                <td><?php echo Helper::toJalali($user_vip_data['start_date'], '-') ?></td>
                <td><?php echo Helper::toJalali($user_vip_data['expire_date'], '-') ?></td>
                <td><?php echo Helper::calculateRemainingCredit($user_vip_data['expire_date']) ?></td>
                <td><?php echo esc_html($user->user_email) ?></td>
                <td><?php echo Helper::vipStatus($user_vip_data['status']) ?></td>
                <td>
                    <a uk-tooltip="بروزرسانی کاربر ویژه"
                       href="#update-vip-user-<?php echo $user->ID ?>" uk-toggle><span
                                class="uk-margin-small-right" uk-icon="pencil"></span></a>
                    <!--include update user modal-->
                    <?php include VIP_PLUGIN_DIR . 'view/admin/update-user-modal.php';?>

                    <a uk-tooltip="حذف کاربر ویژه" href="#delete-vip-user-<?php echo $user->ID ?>" uk-toggle><span
                                class="uk-text-danger" uk-icon="trash"></span></a>
                    <!--include delete user modal-->
                    <?php include VIP_PLUGIN_DIR . 'view/admin/delete-user-modal.php';?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="uk-alert-warning" uk-alert>
                <p>تا کنون کاربر ویژه‌ای ثبت نام نکرده است.</p>
            </div>
        <?php endif; ?>
        </tbody>
    </table>
</div>




<?php
