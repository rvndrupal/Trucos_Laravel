public function index()
    {
    	$courses = Course::withCount(['students'])     //para contar cuantos estudiantes
		    ->with('category', 'teacher', 'reviews')
		    ->where('status', Course::PUBLISHED)
		    ->latest()   //el ultimo el orden
		    ->paginate(12);

        return view('home', compact('courses'));
    }

    //como se manda a llamar 

    @section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            @forelse($courses as $course)
                <div class="col-md-3">
                    @include('partials.courses.card_course')
                </div>
            @empty
                <div class="alert alert-dark">{{ __("Todavía no estás suscrito a ningún curso") }}</div>
            @endforelse
        </div>
    </div>
@endsection

//archivo include

<div class="card card-01">
    <img
        class="card-img-top"
        src="{{ $course->pathAttachment() }}"
        alt="{{ $course->name }}"
    />
    <div class="card-body">
        <span class="badge-box"><i class="fa fa-check"></i></span>
        <h4 class="card-title">{{ $course->name }}</h4>
        <hr />
        <div class="row justify-content-center">
            @include('partials.courses.rating', ['rating' => $course->custom_rating])  //para las estrellas la funcion de abajo se manda a llamar
        </div>
        <hr />
        <span class="badge badge-danger badge-cat">{{ $course->category->name }}</span> //poca madre para la relacion con with IMPORTANTE
        <p class="card-text">
            {{ str_limit($course->description, 100) }}
        </p>
        <a
            href="{{ route('courses.detail', $course->slug) }}"
            class="btn btn-course btn-block"
        >
            {{ __("Más información") }}
        </a>
    </div>
</div>

//funcion para el reating.
Modelo curso

public function getCustomRatingAttribute () {
		return $this->reviews->avg('rating');  //avg promedio
	}
