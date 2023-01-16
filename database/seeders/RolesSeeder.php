<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'dasboard_access', 'guard_name' => 'web'],
            ['name' => 'users_access', 'guard_name' => 'web'],
            ['name' => 'school_details_access', 'guard_name' => 'web'],
            ['name' => 'school_details_edit_access', 'guard_name' => 'web'],
            ['name' => 'classrooms_access', 'guard_name' => 'web'],
            ['name' => 'classrooms_crud_access', 'guard_name' => 'web'],
            ['name' => 'sections_access', 'guard_name' => 'web'],
            ['name' => 'subjects_access', 'guard_name' => 'web'],
            ['name' => 'subjects_crud_access', 'guard_name' => 'web'],
            ['name' => 'sections_crud_access', 'guard_name' => 'web'],
            ['name' => 'exams_access', 'guard_name' => 'web'],
            ['name' => 'exams_crud_access', 'guard_name' => 'web'],
            ['name' => 'grades_access', 'guard_name' => 'web'],
            ['name' => 'grades_crud_access', 'guard_name' => 'web'],
            ['name' => 'marks_access', 'guard_name' => 'web'],
            ['name' => 'marks_crud_access', 'guard_name' => 'web'],
            ['name' => 'marksheet_access', 'guard_name' => 'web'],
            ['name' => 'routine_access', 'guard_name' => 'web'],
            ['name' => 'students_access', 'guard_name' => 'web'],
            ['name' => 'students_admit_access', 'guard_name' => 'web'],
            ['name' => 'attendance_access', 'guard_name' => 'web'],
            ['name' => 'attendance_crud_access', 'guard_name' => 'web'],
            ['name' => 'fee_management_access', 'guard_name' => 'web'],
            ['name' => 'fee_management_pay_access', 'guard_name' => 'web']
        ];
        Permission::insert($permissions);

        $schoolAdmin = Role::create([
            'name' => 'School Admin',
        ]);

        $schoolAdmin->permissions()->sync(collect(Permission::all())->map->id->toArray());
    }
}
