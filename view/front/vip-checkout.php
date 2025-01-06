<?php
add_shortcode('vip-checkout', 'wp_vip_checkout');
function wp_vip_checkout()
{
    ?>
    <section class="checkout-container">
        <div class="checkout-wrapper">
            <h1 class="checkout-title">سفارش عضویت VIP - پکیج نقره‌ای</h1>
            <table class="order-details">
                <tr>
                    <td>شماره سفارش:</td>
                    <td class="order-number"><span>12354899656357</span></td>

                </tr>
                <tr>
                    <td>تاریخ:</td>
                    <td class="order-date"><span>1403-09-12</span></td>

                </tr>
                <tr>
                    <td>مبلغ کل:</td>
                    <td class="order-total"><span>149000</span><span> تومان</span></td>
                </tr>
            </table>
            <div class="payment">
                <form action="" method="post">
                    <input type="submit" name="payment" value="پرداخت" class="btn-payment">
                </form>
            </div>
        </div>
    </section>
    <?php
}
