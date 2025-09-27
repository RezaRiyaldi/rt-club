<?php

use CodeIgniter\I18n\Time;

if (! function_exists('timeAgo')) {
    function timeAgo(string $datetime, string $timezone = 'Asia/Jakarta'): string
    {
        $time = Time::parse($datetime, $timezone);
        $diff = $time->difference(Time::now($timezone));

        if ($diff->getYears() > 0) {
            return $diff->getYears() . ' tahun yang lalu';
        } elseif ($diff->getMonths() > 0) {
            return $diff->getMonths() . ' bulan yang lalu';
        } elseif ($diff->getDays() > 0) {
            return $diff->getDays() . ' hari yang lalu';
        } elseif ($diff->getHours() > 0) {
            return $diff->getHours() . ' jam yang lalu';
        } elseif ($diff->getMinutes() > 0) {
            return $diff->getMinutes() . ' menit yang lalu';
        }

        return 'baru saja';
    }
}
