<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-8">
                        <x-front.employee-header />
                        <div class="card my-5 py-2">
                            <div class="card-body">
                                <h4 class="pb-0">{{__('You have applied on these Jobs')}}</h4>
                                <hr>
                                @php
                                    $lang = app()->getLocale();
                                @endphp
                                @forelse ($jobs as $job)
                                    <div class="border job-box">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3 col-12 text-center">
                                                @if ($job->cover_img == null)
                                                    <img src="{{asset('images/dp.png')}}" class="img-fluid border p-1 jobimg" style="width: 110px;" />
                                                @else
                                                     <img src="{{asset('storage/images/'.$job->cover_img)}}" class="img-fluid border p-1 jobimg" style="width: 110px;" />
                                                @endif
                                            </div>
                                            <div class="col-md-8 col-sm-9 col-12">
                                                <h5 class="mt-4"><strong>{{$job->name}} @</strong> {{$job->company_name}}</h5>
                                                <ul class="mt-4 list-inline">
                                                    <li class="list-inline-item"><i class="fa fa-location"></i> {{$job->city.', '.$job->country}}</li>
                                                    <li class="list-inline-item"><i class="fa fa-tag"></i> {{($job->{'category_'.$lang})}}</li>
                                                    <li class="list-inline-item">| {{($job->{'type_'.$lang})}}</li>
                                                    <li class="list-inline-item">| ${{rtrim(rtrim(number_format($job->min_salary,2),0),'.')}} - ${{rtrim(rtrim(number_format($job->max_salary,2),0),'.')}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-12 text-center">
                                                <a href="{{route('job',$job->slug)}}" class="btn btn-primary mt-5">{{__('View Details')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-gray text-center">{{__('NOT FOUND JOBS')}}</h1>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-front.recruiting />
                        {{-- <x-front.quiz /> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>