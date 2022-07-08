<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classrooms = Classroom::all();
        $users = User::whereHas('roles', function ($role) {
            $role->where('name', 'Teachers');
        })->get();
        $subjects = Subject::filters($request)->with(['teachers', 'classroom'])->orderBy('id', 'desc')->paginate(10);
        return view('user.subjects.index', compact('classrooms', 'users', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'code' => 'required',
            'classroom_id' => 'required',
            'users' => 'required',
        ]);

        $subject = Subject::create($sanitized);

        $subject->teachers()->sync($request->users);
        return redirect()->back()->with('success', 'Subject Created Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'classroom_id' => 'required',
            'users' => 'required',
        ]);

        $subject->update($sanitized);
        $subject->teachers()->sync($request->users);
        return redirect()->back()->with('success', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject Deleted Successfully');
    }
}
