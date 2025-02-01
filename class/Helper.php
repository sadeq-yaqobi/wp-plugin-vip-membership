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
                return 'پایه';
                break;
            case 2:
                return 'نقره‌ای';
                break;
            case 3:
                return 'طلایی';
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

    public static function orderNumber(): string
    {
        return tr_num(jdate('ymd'), 'en') . rand(10000, 99999);
    }

    public static function vipStatus($status)
    {
        switch ($status) {
            case 0:
                return '<span class="uk-label uk-label-danger ">غیر فعال</span>';
                break;
            case 1:

                return '<span class="uk-label uk-label-success">فعال</span>';
                break;
        }
    }

    public static function toJalali($date, $current_separator, $output_separator = '/')
    {
        if (empty($date)) return 'تاریخی ثبت نشده است';

        $date = explode($current_separator, $date);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        return gregorian_to_jalali($year, $month, $day, $output_separator);

    }

    public static function toGregorian($date, $current_separator, $output_separator = '-')
    {
        if (empty($date)) return 'تاریخی ثبت نشده است';

        $date = explode($current_separator, $date);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        return jalali_to_gregorian($year, $month, $day, $output_separator);

    }

    public static function calculateRemainingCredit($expiration_date): string
    {
        $current_date = strtotime(date('Y-m-d'));
        $expiration_date = strtotime($expiration_date);
        $remaining_time= round($expiration_date - $current_date) / (60 * 60 * 24);
        return $remaining_time >= 0 ? $remaining_time . ' روز' : '0';
    }
}
