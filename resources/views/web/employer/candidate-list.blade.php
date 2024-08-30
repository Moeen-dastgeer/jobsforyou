<x-app-layout>
    <x-employer-layout>
        <div class="card my-2 py-2">
            <div class="card-body">
                <h4 class="pb-0">{{__('Candidate List')}}</h4>
                <hr>
                <div class="border job-box">    
                    @forelse ($applys as $apply)
                        <div class="row">
                            <div class="col-md-2" style="width: 100px;">
                                <img src="{{ asset('storage/images/' . $apply->profile_image) }}"
                                    style="width: 100px; height:80px;" class="img-fluid border p-1 jobimg" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="mt-3">{{$apply->first_name.' '.$apply->last_name}}</h4>
                                <ul class="mt-4 list-inline">
                                    <li class="list-inline-item"> <i class="fa fa-envelope"></i> {{$apply->email}}</li>
                                    <li class="list-inline-item"> <i class="fa fa-phone"></i> {{$apply->phone}}</li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <a href="{{asset('storage/cvs/'.$apply->cv_path)}}" class="btn btn-primary my-5" download>
                                    <i class="fas fa-file-download"></i> {{__('CV Download')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div>
                            <h1 class="text-center my-5">{{__('NOT FOUND')}}</h1>
                        </div>
                    @endforelse
                </div>
            </div>
    </x-employer-layout>
    <x-slot name="footer"></x-slot>
</x-app-layout>
