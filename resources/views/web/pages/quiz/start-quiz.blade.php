<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card rounded-0" id="status">
                            <div class="card-header">
                                <div class="title ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="mt-2">{{__('Quiz')}}</h3>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                            <h3 class="mt-2" id="end_time"></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-5">
                                <form method="post" id="formSubmit">
                                    @csrf
                                    @method('post')
                                    @php $i = 1; @endphp
                                    <input type="hidden" name="attmid" value="{{ $attmid }}">
                                    @foreach ($questions as $question)
                                        @php
                                            $id = $question->id;
                                        @endphp
                                        <div class="p-3">
                                            <div class="fw-bold">Question. {{ $i }}
                                                {{ $question->question }}</div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group my-2">
                                                       A. <input type="radio" id="{{ $i }}_op1" name="q[{{$i}}]" value="1"> 
                                                        <label for="{{ $i }}_op1">{{ $question->option1 }}</label>
                                                    </div>
                                                    <div class="form-group my-2">
                                                       B. <input type="radio" id="{{ $i }}_op2" name="q[{{$i}}]" value="2"> 
                                                        <label for="{{ $i }}_op2">{{ $question->option2 }}</label>
                                                    </div>
                                                    <div class="form-group my-2">
                                                       C. <input type="radio" id="{{ $i }}_op3" name="q[{{$i}}]" value="3"> 
                                                        <label for="{{ $i }}_op3">{{ $question->option3 }}</label>
                                                    </div>
                                                    <div class="form-group my-2">
                                                       D. <input type="radio" id="{{ $i }}_op4" name="q[{{$i}}]" value="4"> 
                                                        <label for="{{ $i }}_op4">{{ $question->option4 }}</label>
                                                    </div>
                                                </div>
                                                @php
                                                    $i = $i + 1;
                                                @endphp
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="submited">{{__('Submit')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        <script>
            var mint = {{$quiz->duration}};
            var total_seconds = 60 * mint;
            var c_minutes = parseInt(total_seconds / 60);
            var c_seconds = parseInt(total_seconds % 60);
            var timer;
            function CheckTime() {
                document.getElementById("end_time").innerHTML = 'Left Time '+ c_minutes + ': ' + c_seconds ;
                if (total_seconds <= 0) {
                    score();
                } else {
                    total_seconds = total_seconds - 1;
                    c_minutes = parseInt(total_seconds / 60);
                    c_seconds = parseInt(total_seconds % 60);
                    timer = setTimeout(CheckTime, 1000);
                }
            }
            timer = setTimeout(CheckTime, 1000);
            
            $(document).on('submit','#formSubmit', function(e) {
                e.preventDefault();
                score();
            });

            function score(){
                clearInterval(timer);
                // $('#submited').attr('disabled',true);
                $.ajax({
                    url:"{{ route('submit-quiz', $quiz->id) }}",
                    type:'POST',
                    data: $('#formSubmit').serialize(),
                    beforeSend:function() {
                        console.log('submitting');
                    },
                    success:function(data){
                        if (data.status == 'Passed') {
                            $('#status').html(`<div class="card-body py-5 my-5 text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="border rounded-circle p-5" style="width: 125px;"><i class="fa fa-check fs-1 fw-1" style="color:green !important;"></i></div>
                                </div>
                                <p class="my-2">{{__('Your quiz has been submitted.')}}</p>
                                <p class="text-danger my-2">{{__('Congratulations, You have Passed this test')}}.</p>
                                <p class="my-2">{{__('You got :marks marks', ['marks'=>'`+data.marks+`'])}}</p><br>
                                <a href="{{url('/')}}" class="btn btn-primary mt-3">{{__('Return on Home')}}</a>
                            </div>`);
                        } else {
                            $('#status').html(`<div class="card-body py-5 my-5 text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="border rounded-circle p-5" style="width: 125px;"><i class="fa fa-times fs-1 fw-1" style="color:red !important;"></i></div>
                                </div>
                                <p class="my-2">{{__('Your quiz has been submitted.')}}</p>
                                <p class="text-danger my-2">{{__('Sorry, Please try again')}}.</p>
                                <p class="my-2">{{__('You got :marks marks', ['marks'=>'`+data.marks+`'])}}</p><br>
                                <a href="{{url('/')}}" class="btn btn-primary mt-3">{{__('Return on Home')}}</a>
                            </div>`);
                        } 
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
