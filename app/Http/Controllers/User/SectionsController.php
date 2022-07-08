<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sections = Section::with(['classroom', 'classroom.school'])->filters($request)->orderBy('id', 'desc')->paginate(20);
        $classrooms = Classroom::all();
        $users = User::all();
        return view('user.sections.index', compact('sections', 'classrooms', 'users'));
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
            'name' => 'required',
            'total_capasity' => 'required',
            'classroom_id' => 'required',
            'user_id' => 'required',
        ]);
        Section::create($sanitized);
        return redirect()->back()->with('success', 'Section created successfully');
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
    public function update(Request $request, Section $section)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'total_capasity' => 'required',
            'classroom_id' => 'required',
            'user_id' => 'required',
        ]);
        $section->update($sanitized);
        return redirect()->back()->with('success', 'Section Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->back()->with('success', 'Section Deleted Successfully');
    }
}
