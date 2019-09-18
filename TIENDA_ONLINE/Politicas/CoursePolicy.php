<?php

namespace App\Policies;

use App\Role;
use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function opt_for_course (User $user, Course $course) {
    	return ! $user->teacher || $user->teacher->id !== $course->teacher_id;
    }
    //si no es maestro o impartio un curso.

    public function subscribe (User $user) {
    	return $user->role_id !== Role::ADMIN && ! $user->subscribed('main');
    }
    //El usuario no sea admin y no este subscrito, esto es del paquete  de paga el subscribed

    public function inscribe (User $user, Course $course) {
    	return ! $course->students->contains($user->student->id);
    }
    //Comprueba que algun estudiante cuenta si esta inscrito muy chingon
    //el contains nos dice si existe algun registro que coincida

	public function review (User $user, Course $course) {
		return ! $course->reviews->contains('user_id', $user->id);
	}
}
