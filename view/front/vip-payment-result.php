<?php
add_shortcode('vip-payment-result', 'wp_vip_payment_result');
function wp_vip_payment_result()
{
    if (!is_user_logged_in() || !isset($_GET['Authority']) ||!isset($_GET['Status']) || $_GET['Status'] != 'OK') {
        wp_redirect(home_url());
    }

    $user_plan_data = Session::get('user_plan_data');
    $order_number = $user_plan_data['order_number'];
    $price = $user_plan_data['price'];
    Payment::setter($user_plan_data);
    Payment::payment_result();

    ?>
    <section class="pay-result-container">
        <div class="pay-result-wrapper">
            <h1 class="pay-resul-title">پرداخت با موفقیت انجام شد</h1>
            <p class="thanks-msg">سپاس از خرید شما</p>
            <table class="order-details">
                <tr>
                    <td>شماره سفارش:</td>
                    <td class="order-number"><span><?php echo $order_number; ?></span></td>
                </tr>
                <tr>
                    <td>تاریخ:</td>
                    <td class="order-date"><span><?php echo jdate('Y/m/d') ?></span></td>
                </tr>
                <tr>
                    <td>مبلغ کل:</td>
                    <td class="order-total"><span><?php echo $price ?></span><span> تومان</span></td>
                </tr>
                <tr>
                    <td>شماره تراکنش:</td>
                    <td class="order-total"><span><?php echo Payment::getRefId(); ?></span></td>
                </tr>
            </table>
            <div class="go-home">
                <a href="<?php echo site_url(); ?>" class="go-home-link ">بازگشت به سایت</a>
            </div>
        </div>
    </section>
    <?php
    Session::unset('user_plan_data');
}
