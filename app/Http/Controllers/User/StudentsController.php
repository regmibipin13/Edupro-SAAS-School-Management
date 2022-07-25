<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StoreStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Str;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('classroom_id')) {
                return Section::where('classroom_id', $request->classroom_id)->get();
            }
        }
        $students = Student::filters($request)->with(['school', 'classroom', 'classroom.sections'])->orderBy('id', 'desc')->paginate(20);
        $classes = Classroom::with(['sections'])->get();
        return view('user.students.index', compact('classes', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classroom::with('sections')->get();
        $parents = User::whereHas('roles', function ($role) {
            $role->where('name', 'Parents');
        })->get();
        return view('user.students.create', compact('classes', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $generatedPassword = Str::random(8);
        $request->merge(['password' => $generatedPassword]);
        $role = Role::where('name', 'Students')->first();
        $user = User::create($request->except(['_token']));
        $user->roles()->sync($role->id);
        $request->merge(['user_id' => $user->id]);
        $student = Student::create($request->except(['_token']));
        return response()->json(['status' => 'success', 'redirect' => redirect()->back()]);
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
    public function edit(Student $student)
    {
        $classes = Classroom::with('sections')->get();
        $parents = User::whereHas('roles', function ($role) {
            $role->where('name', 'Parents');
        })->get();

        $student->load(['classroom', 'classroom.sections', 'user', 'section', 'parent']);
        return view('user.students.edit', compact('classes', 'parents', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $user = User::find($student->user_id);
        $user->update($request->except(['_token']));
        $request->merge(['user_id' => $user->id]);
        $student->update($request->except(['_token']));
        return response()->json(['status' => 'success', 'redirect' => redirect()->back()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Student Deleted Successfully');
    }
}
