<?php

class Helper
{
    public static function wp_vip_check_style_is()
    {
        $handles = ['css-bootstrap', 'bootstrap', 'boots', 'bootstrap-css', 'bootstrap-4', 'bootstrap-4-css', 'bootstrap@4', 'bootstrap@4-css', 'bootstrap4'];
        foreach ($handles as $handle) {
            if (!wp_style_is($handle)) {
                wp_enqueue_style('bootstrap-4', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', [], '4.6.2');
            }
        }
    }

    public static function wp_vip_check_script_is()
    {
        $handles = ['js-bootstrap', 'bootstrap', 'boots', 'bootstrap-js', 'bootstrap-4', 'bootstrap-4-js', 'bootstrap@4', 'bootstrap@4-js', 'bootstrap4'];
        foreach ($handles as $handle) {
            if (!wp_script_is($handle)) {
                wp_enqueue_script('bootstrap-4-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', ['jquery'], '4.6.2', ['strategy' => 'async', 'in_footer' => true]);
            }
        }
    }

    public static function planType($type)
    {
        switch ($type) {
            case 1:
                return 'پکیج پایه';
                break;
            case 2:
                return 'پکیج نقره‌ای';
                break;
            case 3:
                return 'پکیج طلایی';
                break;
        }
    }

    public static function dropZero($price): string
    {
        return rtrim($price, '0');
    }

    public static function benefits($benefits): string
    {
        $benefits = explode('|n|', $benefits);

        $html = '';
        foreach ($benefits as $benefit) {
            $html .= '<li>' . $benefit . '</li>';
        }
        return $html;
    }

}
