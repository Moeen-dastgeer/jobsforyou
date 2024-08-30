<x-app-layout>
    <x-employer-layout>
        <div class="card my-2 py-2">
            <div class="card-body">
                <h4 class="pb-0">{{__('All Your Posted Jobs List')}}</h4>
                <hr>
                @forelse ($post_jobs as $job)
                    <div class="border job-box">
                        <div class="row">
                            <div class="col-md-2" style="width: 100px;">
                                @if ($job->cover_img == null)
                                    <img src="{{ asset('images/no-image.png') }}" class="img-fluid border p-1 jobimg" />
                                @else
                                    <img src="{{ asset('storage/images/' . $job->cover_img) }}"
                                        style="width: 100px; height:80px;" class="img-fluid border p-1 jobimg" />
                                @endif
                            </div>  
                            <div class="col-md-7">
                                <h4 class="mt-3">{{ $job->name }}</h4>
                                <p class="job-location mt-4">
                                    <span><i class="fa fa-users"></i> {{$job->total_candidate}} {{__('Candidate Intersetd')}}</span>
                                    <a href="{{url('company/candidate-list',$job->id)}}" class="text-decoration-none text-reset">
                                        <i class="fa fa-list"></i> {{__('Candidate List')}}
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('company.editjob', $job->id) }}"
                                    class="btn btn-primary px-1 mb-1">{{__('Edit Job')}}</a>
                                <a href="{{ route('company.deletejob', $job->id) }}"
                                    class="btn btn-primary px-1 mb-1">{{__('Delete Job')}}</a>
                                <a href="{{ route('company.view-job-details', $job->slug) }}"
                                    class="btn btn-primary px-1">{{__('View Details')}}</a>  
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-canter">
                        <h1 class="text-gray">{{__('NOT FOUND JOB')}}</h1>
                    </div>
                @endforelse
                <div class="job-box d-flex justify-content-center">
                    {{ $post_jobs->links() }}
                </div>
            </div>
        </div>
    </x-employer-layout>
    <x-slot name="footer"></x-slot>
</x-app-layout>
