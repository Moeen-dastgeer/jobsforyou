<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card rounded-0">
                            <div class="card-header">
                                <div class="title text-center">
                                    <h3>{{__('Quiz')}}</h3>
                                </div>
                            </div>
                            <div class="card-body text-center py-5">
                                 @if (Session::has('message'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                <img src="{{ asset('storage/images/' . $quiz->img_path) }}" style="width: 200px; height:200px;">
                                <p class="mt-1"><a href="{{ route('start-quiz', $quiz->slug) }}" class="quiz-title">{{ $quiz->name }}</a></p>
                                <p class="mt-1">{{$quiz->level}}</p>
                                <p class="mt-1">{{__('Duration')}}: {{ $quiz->duration }} {{__('minutes')}}</p>
                                <p class="mt-1">{{ $quiz->description }}</p>
                                <a href="{{ route('start-quiz', $quiz->slug) }}"  class="btn btn-primary w-50 mt-3 p-2">{{__('Start the Test')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        <script type="text/javascript">
            var windowObjectReference = null; // global variable  target="PromoteFirefoxWindowName" onclick="openFFPromotionPopup(); return false;"
            let windowFeatures = 'height=700,width=1350,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes';
            function openFFPromotionPopup() {
                if (windowObjectReference == null || windowObjectReference.closed){
                    windowObjectReference = window.open("{{ route('start-quiz', $quiz->id) }}","myWindow", windowFeatures);
                } else {
                    windowObjectReference.focus();
                };
            }
        </script>
    </x-slot>
</x-app-layout>
