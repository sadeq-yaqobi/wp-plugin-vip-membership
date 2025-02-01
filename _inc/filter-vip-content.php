<?php
add_filter('the_content', 'wp_vip_filter_content');

function wp_vip_filter_content($content)
{

    $post_id = get_the_ID();

    if (metadata_exists('post', $post_id, '_vip_post_type') &&
        get_post_meta($post_id, '_vip_post_type', true) == 2) {

        //if user is a vip user they can see whole of content
        if (User::is_user_vip(get_current_user_id())) {
            return $content; //$content is a global array in wp to retrieve content
        } else {
            $vip_excerpt = mb_substr($content, 0, 610, 'UTF-8');

            // Return excerpt with premium content overlay
            return sprintf(
                '<div class="vip-content-container">
                    <span class="vip-excerpt">%s</span><span class="vip-blur-overlay"><span class="blur-content">%s</span></span>
                    <div class="premium-message">
                        <h3>این محتوای برای کاربران ویژه در دسترس است</h3>
                        <p>برای مشاهده ادامه مطلب حساب خود را به VIP ارتقا دهید</p>
                        <a href="%s" class="premium-button">ارتقا حساب</a>
                </div>
            </div>',
                $vip_excerpt,
                substr($content, 610, 300),// Rest of the content that will be blurred
                site_url('vip-plan')
            );

        }

    }
    return $content;
}

