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
                                    <h3>{{ __('Jobs Details') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 mb-2">
                            <div class="card-body">
                                <div class="title text-center">
                                    @auth
                                        @if (Auth()->user()->role_id == 1)
                                            <a href="{{ route('job.apply-now', $job->slug) }}"
                                                class="btn btn-primary px-3 mt-5 w-100">{{ __('Apply Now') }}</a>
                                        @else
                                            <a href="#" onclick="alert('Login on candidate account for apply on jobs.')"
                                                class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 ">
                            <div class="card-body">
                                <table class="table table-borderless ">
                                    <tr>
                                        <th></th>
                                        <td>
                                            @if (Session::has('deletedjob'))
                                                <div class="alert alert-success">
                                                    {{ Session::get('deletedjob') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Company Image') }} </th>
                                        <td>
                                            @if($job->cover_img == null) 
                                                <img src="{{asset('images/dp.png')}}" id="profile_img" style="width: 60%" alt="">
                                            @else
                                                <img src="{{ asset('storage/images/' . $job->cover_img) }}" style="width: 60%" alt="">               
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @php
                                        $lang = app()->getLocale();
                                    @endphp
                                    <tr>
                                        <th style="width: 200px;">{{ __('Job Category') }}</th>
                                        <td>{{ $job->{'category_' . $lang} }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Job Type') }}</th>
                                        <td>{{ $job->{'type_' . $lang} }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Title for your Job') }}</th>
                                        <td>{{ $job->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Job Description') }}</th>
                                        <td>{{ $job->job_description }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Country') }}</th>
                                        <td>{{ $job->country }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('City') }}</th>
                                        <td>{{ $job->city }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th style="width: 200px;">{{ __('Zip Code') }}</th>
                                        <td>{{ $job->zipcode }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th style="width: 200px;">{{ __('Salary Range') }}</th>
                                        <td>{{ $job->min_salary }} - {{ $job->max_salary }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Salary Type') }}</th>
                                        <td>{{ $job->salarytype }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Experiance') }}</th>
                                        <td>{{ $job->experiance }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">{{ __('Job Functions') }}</th>
                                        <td>{{ $job->job_functions }}</td>
                                    </tr>
                                </table>
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
