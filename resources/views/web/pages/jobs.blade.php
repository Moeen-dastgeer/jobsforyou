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
                                    <h3>{{__('Jobs List')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0">
                            <div class="card-body">
                                
                                @php
                                    $lang = app()->getLocale();
                                @endphp
                                @forelse ($jobs as $job)  
                                    <div class="border job-box">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3 col-12 text-center">
                                                <a href="{{route('job',$job->slug)}}">
                                                    @if($job->cover_img == null) 
                                                        <img src="{{asset('images/dp.png')}}" id="profile_img" class="img-fluid border p-1 jobimg" style="width: 110px;">
                                                    @else
                                                    <img src="{{asset('storage/images/'.$job->cover_img)}}" class="img-fluid border p-1 jobimg" style="width: 110px;" />               
                                                    @endif
                                                    
                                                </a>
                                            </div>
                                            <div class="col-md-8 col-sm-9 col-12">
                                                <a href="{{route('job',$job->slug)}}" class="text-decoration-none"><h5 class="mt-4"><strong>{{$job->name}} @</strong> <span class="text-dark">{{$job->company_name}}</span></h5></a>
                                                <ul class="mt-4 list-inline">
                                                    <li class="list-inline-item"><i class="fa fa-location"></i> {{$job->city.', '.$job->country}}</li>
                                                    <li class="list-inline-item"><i class="fa fa-tag"></i> {{($job->{'category_'.$lang})}}</li>
                                                    <li class="list-inline-item">| {{($job->{'type_'.$lang})}}</li>
                                                    <li class="list-inline-item">| ${{rtrim(rtrim(number_format($job->min_salary,2),0),'.')}} - ${{rtrim(rtrim(number_format($job->max_salary,2),0),'.')}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-12 text-center">
                                                @auth
                                                    @if (Auth()->user()->role_id == 1)
                                                        <a href="{{ route('job.apply-now', $job->slug) }}"
                                                        class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
                                                    @else
                                                        <a href="#" onclick="alert('Login on candidate account for apply on jobs.')" class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-gray text-center">{{__('NOT FOUND JOBS')}}</h1>
                                @endforelse
                                <div class="job-box d-flex justify-content-center">
                                    {{ $jobs->links() }}
                                </div>
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