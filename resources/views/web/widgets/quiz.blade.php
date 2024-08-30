<div class="card rounded-0 py-3 mt-4">
    <div class="card-body">
        <h5>{{ __('Quiz') }}</h5>
        <hr class="breakdown">
        <div class="row">
            @forelse ($quizzes as $quiz)
                <div class="col-md-4">
                    @auth
                        @if (Auth()->user()->role_id == 1)
                            <a href="{{ route('starting-quiz-intro', $quiz->slug) }}"><img
                            src="{{ asset('storage/images/' . $quiz->img_path) }}" class="jobimg" /></a>
                        @else
                                <a href="#" onclick="alert('Login on candidate account for quiz.')"><img
                            src="{{ asset('storage/images/' . $quiz->img_path) }}" class="jobimg" /></a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"><img
                            src="{{ asset('storage/images/' . $quiz->img_path) }}" class="jobimg" /></a>
                    @endauth
                </div>
            @empty
                <div class="col-md-12">
                    <h2>{{ __('NOT FOUND') }}</h2>
                </div>
            @endforelse
        </div>
    </div>
</div>
