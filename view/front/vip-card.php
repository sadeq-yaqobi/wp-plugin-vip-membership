<?php
add_shortcode('vip-card', 'wp_vip_layout');

function wp_vip_layout()
{
    $plan = new Plan;
    ?>
    <!-- ============================ vip Start ================================== -->
    <section class="bg-light vip-section">
        <div class="container">
            <!-- ============================ Page Title Start================================== -->
            <div class="page-title mb-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h1 class="breadcrumb-title">اشتراک VIP</h1>
                    </div>
                </div>
            </div>
            <!-- ============================ Page Title End ================================== -->
            <div class="row">
                <!-- Single Package -->
                <?php
                $items = $plan->find();
                if ($items) :
                    foreach ($items as $item) :?>
                        <div class="col-lg-4 col-md-4">
                            <div class="packages_wrapping  <?php echo $item->recommended == 1 ? 'recommended' : 'bg-white'; ?>">
                                <div class="packages_headers">

                                    <img class="mb-4" src="<?php echo VIP_PLUGIN_URL.'assets/img/' . ($item->recommended == 1 ? 'layers-white.svg' : 'layers.svg') ?>" alt="icon">
                                    <h4 class="packages_pr_title">پکیج <?php echo helper::planType($item->type); ?></h4>
                                    <span class="packages_price-subtitle">با پکیج <?php echo helper::planType($item->type); ?> شروع کنید!</span>
                                </div>
                                <div class="packages_price">
                                    <h4 class="pr-value"><?php echo Helper::dropZero($item->price); ?></h4>
                                </div>
                                <div class="packages_middlebody">
                                    <ul>
                                        <?php echo Helper::benefits($item->benefits); ?>
                                    </ul>
                                </div>
                                <div class="packages_bottombody">

                                    <form action="<?php echo site_url('gateway')?>" method="post">
                                        <input type="submit" value="عضویت" name="plan_btn" class="btn-pricing">
                                        <input type="hidden" name="plan_id" value="<?php echo $item->id; ?>">
                                        <?php wp_nonce_field(); ?>
                                    </form>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                    <div class="alert alert-warning">هنوز پلنی ایجاد نشده است. به بخش تنظیمات پلاگین رفته و پلن‌‌های
                        مورد نظر را ایجاد نمایید.
                    </div>

                <?php endif; ?>
            </div>

        </div>

    </section>
    <!-- ============================ vip End ================================== -->
    <?php
}