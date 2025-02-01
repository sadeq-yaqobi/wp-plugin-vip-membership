<?php
add_shortcode('vip-checkout', 'wp_vip_checkout');
function wp_vip_checkout()
{
    $user_plan_data = Session::get('user_plan_data');
    $plan_name = 'پکیج '.Helper::planType($user_plan_data['plan_type']);
    $order_number = $user_plan_data['order_number'];
    $price = $user_plan_data['price'];
    ?>
    <section class="checkout-container">
        <div class="checkout-wrapper">
            <h1 class="checkout-title">سفارش عضویت VIP - <?php echo $plan_name; ?></h1>
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
            </table>
            <div class="payment">
                <form action="<?php echo htmlspecialchars(get_the_permalink()) ?>" method="post">
                    <input type="submit" name="payment" value="پرداخت" class="btn-payment">
                </form>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['payment'])) {
        $transaction = new Transaction();
        $transaction->save($user_plan_data);

        $description = 'پرداخت برای عضویت ویژه - ' . $plan_name;
        Payment::setter($user_plan_data, $description);
        Payment::gateway();
    }

}
