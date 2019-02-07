<?php

namespace App\Policies;

use App\Entities\Course;
use App\Entities\Role;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function optForCourse( ? User $user,  ? Course $course)
    {
        return !$user->teacher || $user->teacher->id !== $course->teacher_id;
    }

    public function subscribe( ? User $user)
    {
        return !$user->role_id !== Role::ADMIN && !$user->subscribed('main');
    }

    public function inscribe( ? User $user,  ? Course $course)
    {
        //return !$course->students->contains($user->student->id);
        return !$course->students->contains(auth()->id());
    }

    public function review( ? User $user,  ? Course $course)
    {
        //return !$course->students->contains($user->student->id);
        return !$course->reviews->contains('user_id', auth()->id());
    }
}
