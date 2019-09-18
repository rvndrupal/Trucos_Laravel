Route::get('/{course}', 'CourseController@show')->name('courses.detail');  //le pasas directamente en lugar del id los detalles del curso

//funcion en el modelo para tomar el slug

public function getRouteKeyName() {
		return 'slug';
	}