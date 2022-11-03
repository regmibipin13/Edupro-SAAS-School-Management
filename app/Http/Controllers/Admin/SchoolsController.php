<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\StoreSchoolRequest;
use App\Http\Requests\Schools\UpdateSchoolRequest;
use App\Models\School;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function login(School $school)
    {
        $user = User::where('school_id', $school->id)->whereHas('roles', function ($role) {
            $role->where('name', 'School Admin');
        })->first();

        Auth::loginUsingId($user->id, true);
        return redirect()->to('/dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schools = School::filters($request)->orderBy('id', 'desc')->paginate(10);
        return view('admin.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        School::create($request->all());
        return redirect()->to('/admin/schools')->with('success', 'School Added Successfully');
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
    public function edit(School $school)
    {
        return view('admin.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        if ($request->has('is_active') && $request->is_active) {
            $request->merge(['is_active' => 1]);
        } else {
            $request->merge(['is_active' => 0]);
        }
        $school->update($request->all());
        return redirect()->to('/admin/schools')->with('success', 'School Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->back()->with('success', 'School Deleted Successfully');
    }
}
