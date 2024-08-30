<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card rounded-0 mb-2">
                            <div class="card-body">
                                <div class="name p-3">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{route('job.apply-now',$job->slug)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <h4 class="py-2">{{__('Apply for the offer')}}: <strong>{{$job->name}}</strong></h4>
                                        <p class="my-3">{{__('Your CV will be sent directly to the recruitment department of the company')}} " <strong>{{$job->company_name}}</strong> ".</p>
                                        <div class="form-group mt-3">
                                            <label for="cv">{{__('Upload CVs in .doc, .docx and .pdf format are accepted')}}</label>
                                            <input type="file" name="cv" id="cv" class="form-control" placeholder="Upload CV">
                                            @error('cv')
                                                <div class="text-danger samll">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="message">Message</label>
                                            <textarea name="message" id="message" cols="30" rows="8" class="form-control" 
                                            placeholder="{{__('Express your intrest for this position')}}">{{old('message')}}</textarea>
                                            @error('message')
                                                <div class="text-danger samll">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group my-3">
                                            <button type="submit" class="btn btn-primary mt-3">{{__('Apply Now')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>
