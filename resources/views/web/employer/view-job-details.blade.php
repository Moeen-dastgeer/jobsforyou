<x-app-layout>
    <x-employer-layout>
        <div class="card rounded-0 mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title">
                            <h4>{{__('Detail Post Your Job')}}</h4>
                        </div>
                    </div>  
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{ route('company.posted-jobs-list') }}" class="btn btn-sm btn-primary"> {{__('Back')}} </a>
                    </div>
                </div>
            </div> 
            @php
                    $lang = app()->getLocale();
                @endphp
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
                        <th style="width: 200px;">{{__('Company Image')}} </th>
                        <td><img src="{{ asset('storage/images/' . $job->cover_img) }}" style="width: 45%" alt=""></td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Job Category')}}</th>
                        <td>{{($job->{'category_'.$lang})}}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Job Type')}}</th>
                        <td>{{($job->{'type_'.$lang})}}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Title for your Job')}}</th>
                        <td>{{ $job->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Job Description')}}</th>
                        <td>{{ $job->job_description }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Country')}}</th>
                        <td>{{ $job->country }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('City')}}</th>
                        <td>{{ $job->city }}</td>
                    </tr>
                    {{-- <tr>
                        <th style="width: 200px;">{{__('Zip Code')}}</th>
                        <td>{{ $job->zipcode }}</td>
                    </tr> --}}
                    <tr>
                        <th style="width: 200px;">{{__('Salary Range')}}</th>
                        <td>{{ $job->min_salary }} - {{ $job->max_salary }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Salary Type')}}</th>
                        <td>{{ $job->salarytype }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Experiance')}}</th>
                        <td>{{ $job->experiance }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">{{__('Job Functions')}}</th>
                        <td>{{ $job->job_functions }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </x-employer-layout>
    <x-slot name="footer"></x-slot>
</x-app-layout>
