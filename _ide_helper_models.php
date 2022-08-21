<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Attendance
 *
 * @property int $id
 * @property int $school_id
 * @property int $student_id
 * @property int $classroom_id
 * @property int $section_id
 * @property string $date
 * @property string $attendance
 * @property string|null $absent_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\School $school
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereAbsentReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereUpdatedAt($value)
 */
	class Attendance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classroom
 *
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property int $school_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Section[] $sections
 * @property-read int|null $sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereUpdatedAt($value)
 */
	class Classroom extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Day
 *
 * @property int $id
 * @property int $school_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Illuminate\Database\Eloquent\Builder|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereUpdatedAt($value)
 */
	class Day extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Exam
 *
 * @property int $id
 * @property string $name
 * @property string $term
 * @property string $start_date
 * @property string $end_date
 * @property int $school_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\School $school
 * @method static \Illuminate\Database\Eloquent\Builder|Exam filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereUpdatedAt($value)
 */
	class Exam extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Grade
 *
 * @property int $id
 * @property int $school_id
 * @property string $name
 * @property float $marks_from
 * @property float $marks_to
 * @property string $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\School $school
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereMarksFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereMarksTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereUpdatedAt($value)
 */
	class Grade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mark
 *
 * @property int $id
 * @property int $school_id
 * @property int $classroom_id
 * @property int $section_id
 * @property int $student_id
 * @property int $exam_id
 * @property int $subject_id
 * @property float $total_marks
 * @property float|null $gpa_gained
 * @property float $pass_marks
 * @property float $pass_gpa
 * @property float $full_marks
 * @property float $full_gpa
 * @property string|null $remark
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\School $school
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\Subject $subject
 * @method static \Illuminate\Database\Eloquent\Builder|Mark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereFullGpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereFullMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereGpaGained($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark wherePassGpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark wherePassMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereTotalMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereUpdatedAt($value)
 */
	class Mark extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\School
 *
 * @property int $id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $contact
 * @property string $city
 * @property string $address
 * @property string|null $google_map_link
 * @property string|null $owner_name
 * @property string|null $owner_contact
 * @property string $principle_name
 * @property string|null $principle_contact
 * @property string $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|School filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|School newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School query()
 * @method static \Illuminate\Database\Eloquent\Builder|School whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereGoogleMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereOwnerContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School wherePrincipleContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School wherePrincipleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereUpdatedAt($value)
 */
	class School extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $name
 * @property int $total_capasity
 * @property int $user_id
 * @property int $classroom_id
 * @property int $school_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\User $class_teacher
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTotalCapasity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUserId($value)
 */
	class Section extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property int $user_id
 * @property int $school_id
 * @property int $classroom_id
 * @property int $section_id
 * @property int $parent_id
 * @property string $admitted_date
 * @property string|null $uniqueStudentId
 * @property string $blood_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\Classroom $classroom
 * @property-read mixed $absent_reason
 * @property-read mixed $attendance
 * @property-read mixed $total_marks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mark[] $marks
 * @property-read int|null $marks_count
 * @property-read \App\Models\User $parent
 * @property-read \App\Models\School $school
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Student filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAdmittedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUniqueStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUserId($value)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $classroom_id
 * @property int $school_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $full_marks
 * @property int $pass_marks
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $teachers
 * @property-read int|null $teachers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Illuminate\Database\Eloquent\Builder|Subject filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereFullMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject wherePassMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Time
 *
 * @property int $id
 * @property int $school_id
 * @property string $time_from
 * @property string $time_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $days
 * @property-read mixed $subject_id
 * @property-read mixed $teacher_id
 * @property-read \App\Models\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Illuminate\Database\Eloquent\Builder|Time newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time query()
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereUpdatedAt($value)
 */
	class Time extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Timetable
 *
 * @property int $id
 * @property int $school_id
 * @property int $classroom_id
 * @property int $section_id
 * @property int $subject_id
 * @property int $time_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classroom $classroom
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Day[] $days
 * @property-read int|null $days_count
 * @property-read \App\Models\School $school
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @property-read \App\Models\Time $time
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable byRole()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUserId($value)
 */
	class Timetable extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $is_admin
 * @property string $dial_code
 * @property string|null $phone
 * @property string|null $dob
 * @property string|null $city
 * @property string|null $address
 * @property string|null $gender
 * @property int|null $school_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Section[] $class_sections
 * @property-read int|null $class_sections_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\School|null $school
 * @property-read \App\Models\Student|null $student
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User filters($request)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDialCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

