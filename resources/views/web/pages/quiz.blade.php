<x-app-layout>
    <main>
        <x-front.filter />
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card rounded-0 mb-2">
                            <div class="card-body">
                                <div class="title pt-2">
                                    <h3>{{__('Quiz')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse ($quizzes as $quiz)
                                <div class="col-md-6">
                                    <div class="card p-3 mt-4">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('storage/images/' . $quiz->img_path) }}" style="width: 150px; height:150px;">
                                            <p class="mt-2"><a href="{{ route('starting-quiz-intro', $quiz->slug) }}" class="quiz-title">{{ $quiz->name }}</a></p>
                                            <span>{{__('Duration')}}: {{ $quiz->duration }} minutes</span><br />
                                            @auth
                                                @if (Auth()->user()->role_id == 1)
                                                    <a href="{{ route('starting-quiz-intro',  $quiz->slug) }}" class="btn btn-primary w-100 mt-3 p-2">{{__('Start the Test')}}</a>
                                                @else
                                                    <a href="#" onclick="alert('Login on candidate account for quiz.')" class="btn btn-primary w-100 mt-3 p-2">{{__('Start the Test')}}</a>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-3 p-2">{{__('Start the Test')}}</a>
                                            @endauth
                                            
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <h2>{{__('NOT FOUND')}}</h2>
                                </div>
                            @endforelse
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            {{ $quizzes->links() }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-front.recruiting />
                        <x-front.quiz />
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
