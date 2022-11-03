<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classrooms = Classroom::filters($request)->with(['school'])->paginate(20);
        $schools = School::all();
        return view('user.classrooms.index', compact('classrooms', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sanitized = $request->validate([
            'name' => ['required'],
            'location' => ['nullable'],
            'monthly_fee' => ['required'],
        ]);
        Classroom::create($sanitized);
        return redirect()->back()->with('success', 'Class Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $sanitized = $request->validate([
            'name' => ['required'],
            'location' => ['nullable'],
            'monthly_fee' => ['required'],
        ]);
        $classroom->update($sanitized);
        return redirect()->back()->with('success', 'Classroom Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }

    public function getSections($classroom_id)
    {
        return Section::where('classroom_id', $classroom_id)->get();
    }

    public function getSubjects($classroom_id)
    {
        return Subject::where('classroom_id', $classroom_id)->get();
    }
}
