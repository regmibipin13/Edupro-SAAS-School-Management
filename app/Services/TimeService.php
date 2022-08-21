<?php

namespace App\Services;

use App\Models\Time;

class TimeService
{
    public function generateTimeRange()
    {
        $timeRange = [];
        $times = Time::all();
        foreach ($times as $time) {
            array_push($timeRange, [
                'start' => $time->time_from,
                'end' => $time->time_to
            ]);
        }
        return $timeRange;
    }
}
