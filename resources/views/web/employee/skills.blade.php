<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-8">  
                        <x-front.employee-header />
                        <!-- Account info -->
                        <div class="card rounded-0 mt-3">
                            <div class="card-header">
                                <div class="title">
                                    <h4>{{__('Skills')}}</h4>
                                </div>
                            </div> 
                            <div class="card-body">
                                <form action="{{route('user.skills')}}" method="post" enctype="multipart/form-data">
                                    @CSRF
                                    <table class="table table-borderless ">
                                        <tr>
                                            <th></th>
                                            <td>
                                                @if (Session::has('skillSuccess'))
                                                    <div class="alert alert-success">
                                                        {{ Session::get('skillSuccess') }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Title Of Your Profile')}}</th>
                                            <td>
                                                <input type="text" name="name" value="{{old('name',$skill->name)}}" class="form-control">
                                                @error('name')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{__('Level Of Studies')}}</th>
                                            <td>
                                                <select name="studies_level" class="form-select" >
                                                    <option value="">{{__('Select Level of studies')}}</option>
                                                    @foreach ($study_levels as $item)
                                                        <option value="{{$item->id}}" {{old('studies_level', $item->id) == $skill->studies_level_id?'selected':''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('studies_level')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Years Of Experiance')}}</th>
                                            <td>
                                                <select name="years_of_experiance" class="form-select" >
                                                    <option value="">{{__('Select years of experiance')}}</option>
                                                    @foreach ($years_eperiances as $item)
                                                        <option value="{{$item->id}}" {{old('years_of_experiance', $item->id) == $skill->years_of_experiance_id?'selected':''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('years_of_experiance')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Computer Skills Mastered')}}</th>
                                            <td>
                                                <input type="text" name="computer_skills" value="{{old('computer_skills', $skill->computer_skills)}}" class="form-control">
                                                @error('computer_skills')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Mastered Languages')}}</th>
                                            <td>
                                                <input type="text" name="mastered_languages" value="{{old('mastered_languages', $skill->mastered_languages)}}" class="form-control">
                                                @error('mastered_languages')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Linkedin Account')}}</th>
                                            <td>
                                                <input type="text" name="linkedin_account" value="{{old('linkedin_account', $skill->linkedin_account)}}" class="form-control">
                                                @error('linkedin_account')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td><input type="submit" class="btn btn-primary" value="{{__('Update')}}"></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="card rounded-0 mt-3">
                            <div class="card-header">
                                <div class="title">
                                    <h4>{{__('My CV')}}</h4>
                                </div>
                            </div> 
                            <div class="card-body">
                                 @if (Session::has('cvSuccess'))
                                    <div class="alert alert-success">
                                        {{ Session::get('cvSuccess') }}
                                    </div>
                                @endif
                                <form action="{{route('user.cv')}}" method="post" enctype="multipart/form-data">
                                    @CSRF
                                    <p>{{__('Only recruiters will be able to view your CV')}}.</p>
                                    <p>{{__('Only resumes in .pdf, .docx, .doc format are accepted')}}.</p>
                                    <input type="file" name="cv" class="form-control">
                                    @error('cv')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                    <button class="btn btn-primary mt-3"><i class="fa fa-upload" style="color: white !important;"></i> {{__('CV Upload')}}</button>
                                    <br /><br />
                                    <a href="{{asset('storage/cvs/'.$skill->cv)}}" download class="btn btn-primary mt-3">
                                        <i class="fa fa-file-pdf" style="color: white !important;"></i>  {{__('CV Download')}}
                                    </a>
                                </form>
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
