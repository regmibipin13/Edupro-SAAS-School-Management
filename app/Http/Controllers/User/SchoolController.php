<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(School $school)
    {
        // $school->load(['users']);
        if (auth()->user()->school_id !== $school->id) {
            return abort(404);
        }
        return view('user.schools.edit', compact('school'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->all());
        return redirect()->back()->with('success', 'School Details Updated Successfully');
    }
}
