<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StoreStudentRequest;
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
        $students = Student::filters($request)->with(['school','classroom','section'])->orderBy('id','desc')->paginate(20);
        $classes = Classroom::with(['sections'])->get();
        return view('user.students.index',compact('classes','students'));
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
        $role = Role::where('name','Students')->first();
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
