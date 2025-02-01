<?php

function wp_vip_register_meta_box()
{
    add_meta_box('vip', 'نوع محتوا', 'wp_vip_meta_box_html', '', 'normal', 'default');
}

function wp_vip_meta_box_html($post)
{
    wp_nonce_field('vip_post_nonce', 'vip_posts_nonce'); ?>

    <select name="vip_post_type" style="width: 100%">
        <option value="1" <?php selected(get_post_meta($post->ID, '_vip_post_type', true), 1) ?>>رایگان</option>
        <option value="2" <?php selected(get_post_meta($post->ID, '_vip_post_type', true), 2) ?>>ویژه ( vip )</option>
    </select>
    <?php
}

function wp_vip_save_meta_box($post_id)
{
    $vip_nonce = $_POST['vip_posts_nonce'];
    if (!wp_verify_nonce($vip_nonce, 'vip_post_nonce')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    if (!empty($_POST['vip_post_type'])) {
        $vip_meta_box_value = sanitize_text_field($_POST['vip_post_type']);
        update_post_meta($post_id, '_vip_post_type', $vip_meta_box_value);
    }
}


add_action('add_meta_boxes', 'wp_vip_register_meta_box');
add_action('save_post','wp_vip_save_meta_box');
