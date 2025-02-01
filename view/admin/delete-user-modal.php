<!-- delete modal -->
<div id="delete-vip-user-<?php echo $user->ID ?>" uk-modal class="delete-modal-wrapper">
    <div class="uk-modal-dialog uk-modal-body delete-modal-body">
        <form method="post">
            <h2 class="uk-modal-title delete-title">می‌خواهید کاربر با مشخصات زیر حذف شود؟</h2>
            <table class="user-details">
                <tr>
                    <td>نام ونام خانوادگی:</td>
                    <td class="detail-item"><span><?php echo $user->display_name ?></span></td>
                </tr>
                <tr>
                    <td>پلن:</td>
                    <td class="detail-item">
                        <span><?php echo esc_html(Helper::planType($user_vip_data['plan_type'])) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>اعتبار باقی مانده</td>
                    <td class="detail-item">
                        <span><?php echo Helper::calculateRemainingCredit($user_vip_data['expire_date']) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>ایمیل</td>
                    <td class="detail-item"><span><?php echo esc_html($user->user_email) ?></span></td>
                </tr>
                <tr>
                    <td>وضعیت:</td>
                    <td class="detail-item">
                        <span><?php echo Helper::vipStatus($user_vip_data['status']) ?></span></td>
                </tr>
            </table>
            <p class="uk-text-left uk-margin-medium-top">
                <button class="uk-button uk-button-default uk-modal-close uk-border-rounded"
                        type="button">خیر
                </button>

                <button class="uk-button uk-button-danger uk-border-rounded" type="submit" name="delete_vip_user">بله</button>
                <input type="hidden" name="user_id" value="<?php echo $user->ID?>">
                <?php wp_nonce_field('delete_vip_user','_nonce_delete_vip_user')?>

            </p>
        </form>
    </div>
</div>
