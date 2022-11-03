<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schools\StoreSchoolRequest;

use App\Models\School;
use App\Models\User;
use Auth;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use Hash;
use Spatie\Permission\Models\Role;

class FrontendController extends Controller
{
    public function register()
    {
        return view('frontend.registration');
    }

    public function demoRegister(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());
        $user = User::create([
            'email' => $school->email,
            'password' => Hash::make($request->password),
            'name' => $school->name,
            'school_id' => $school->id,
        ]);
        $role = Role::where('name', 'School Admin')->first();
        $user->roles()->sync($role->id);
        Auth::loginUsingId($user->id);
    }

    public function postRegister(StoreSchoolRequest $request)
    {
        $this->demoRegister($request);
        return redirect()->to('/dashboard')->with('success', 'School Registered Successfully');
        // $this->khalti();
    }

    public function khalti()
    {
        $config = new Config(url('/pay/success'), url('/pay/error'));
        $esewa = new Client($config);
        $esewa->process('P101W201', 300, 0, 0, 0);
    }

    public function success()
    {
        dd('success');
    }

    public function error()
    {
        dd('error');
    }
}
