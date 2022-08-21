<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Day;
use App\Models\Time;
use App\Models\Timetable;
use App\Models\User;
use App\Services\CalenderService;
use Illuminate\Http\Request;

class TimetablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CalenderService $calenderService)
    {
        return "Comming Soon";
        $timetables = Timetable::filters($request)->get();
        if ($request->ajax()) {
            return $timetables;
        }
        $classrooms = Classroom::all();
        $days = collect(Day::all())->map->name->toArray();
        $calenderData = $calenderService->generateCalenderData($days);
        dd($calenderData);
        return view('user.timetables.index', compact('timetables', 'classrooms', 'days', 'times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classrooms = Classroom::all();
        $times = Time::all();
        $days = Day::all();
        $teachers = User::role('Teachers')->get();
        return view('user.timetables.create', compact('times', 'classrooms', 'days', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->times as $time) {
            if ($request->classroom_id !== null && $request->section_id !== null && (isset($time['subject_id']) && $time['subject_id'] !== null) && (isset($time['days']) && $time['days'] !== null) && (isset($time['teacher_id']) && $time['teacher_id'] !== null)) {
                $data = [];
                $data['school_id'] = auth()->user()->school_id;
                $data['classroom_id'] = $request->classroom_id;
                $data['section_id'] = $request->section_id;
                $data['time_id'] = $time['id'];
                $data['subject_id'] = $time['subject_id'];
                $data['user_id'] = $time['teacher_id']['id'];

                $timetable = Timetable::updateOrCreate(
                    [
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'subject_id' => $time['subject_id'],
                        'time_id' => $time['id']
                    ],
                    $data
                );
                $timetable->days()->sync(collect($time['days'])->map->id->toArray());
            }
        }

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
