<?php

namespace App\Http\Helpers\Core;


class TimeHelper
{
    /**
     * Convert hours to minutes
     *
     * @param $hour
     * @param $minute
     * @return float|int
     */
    public static function toMinutes($hour, $minute)
    {
        return  ($hour * 60) + $minute;
    }

    /**
     * Convert minutes to hours
     *
     * @param $minutes
     * @return array
     */
    public static function minutesToHours($minutes)
    {
        $res = [
            'hours' => 00,
            'minutes' => 00,
            'parsed' => '00:00'
        ];
        $hours = floor($minutes / 60);
        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = ($minutes % 60);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $res['hours'] = $hours;
        $res['minutes'] = $minutes;
        $res['parsed'] = $hours.':'.$minutes;

        return $res;
    }

}
