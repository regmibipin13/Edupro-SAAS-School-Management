<?php

namespace App\Services;

use App\Models\Time;
use App\Models\Timetable;

class CalenderService
{
    public function generateCalenderData($weekDays)
    {
        $calenderData = [];
        $timeRange = (new TimeService)->generateTimeRange();
        $timetables = Timetable::with(['subject', 'teacher'])->byRole();

        foreach ($timeRange as $time) {
            $timeText = $time['start'] . '-' . $time['end'];
            $timeDB = Time::where('time_from', $time['start'])->where('time_to', $time['end'])->first();
            $calenderData[$timeText] = [];

            foreach ($weekDays as $day) {
                $timetable = $timetables->whereHas('days', function ($t) use ($day) {
                    $t->where('name', $day);
                })->where('time_id', $timeDB->id)->first();

                if ($timetable) {
                    array_push($calenderData[$timeText], [
                        'subject_name' => $timetable->subject->name,
                        'teacher_name' => $timetable->teacher->name
                    ]);
                }
            }
        }
        return $calenderData;
    }


    public function generateTable()
    {
        $calenderData = [];
    }
}
