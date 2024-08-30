<x-app-layout>
    <main>
        <section class="sectionbg">
            <div class="container py-2">
                @auth
                @else
                    <div class="row d-flex">
                        <div class="col-lg-8 col-md-12 mt-2">
                            <img src="{{ asset('web/images/hero-img.png') }}" style="height: 410px;"
                                class="img-fluid w-100">
                        </div>
                        <div class="col-lg-4 col-md-12 mt-2">
                            <div class="card bg-white p-1 border-0" style="min-height: 410px;">
                                <div class="card-body">
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('register') }}"  autocomplete="off">
                                        <input type="hidden" autocomplete="false">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group my-2">
                                                    <input type="text" class="form-control form-control-lg login-form-input"
                                                        value="{{ old('first_name') }}" name="first_name"
                                                        placeholder="{{ __('First Name') }}">
                                                    @error('first_name')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group my-2">
                                                    <input type="text" class="form-control form-control-lg login-form-input"
                                                        value="{{ old('last_name') }}" name="last_name"
                                                        placeholder="{{ __('Last Name') }}">
                                                    @error('last_name')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group my-2">
                                                    <input type="text" class="form-control form-control-lg login-form-input" name="email"
                                                        value="{{ old('email') }}" autocomplete="off"
                                                        placeholder="{{ __('Enter email') }}">
                                                    @error('email')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group my-2">
                                                    <input type="text" class="form-control form-control-lg login-form-input" name="phone"
                                                        value="{{ old('phone') }}" placeholder="{{ __('Phone') }}">
                                                    @error('phone')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group my-2">
                                                    <select name="gender" id="" class="form-select form-select-lg login-form-input">
                                                        <option value="">{{ __('Select Gender') }}</option>
                                                        <option value="Male" {{ _('Male') }}>Male</option>
                                                        <option value="Female" {{ _('Female') }}>Female</option>
                                                        <option value="Other" {{ _('Other') }}>Other</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group my-2">
                                                    <input type="text" class="form-control form-control-lg login-form-input" name="city"
                                                        placeholder="{{ __('City') }}">
                                                    @error('city')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group my-2">
                                                    <input type="password" class="form-control form-control-lg login-form-input" name="password"
                                                        placeholder="{{ __('Enter Password') }}">
                                                    @error('password')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group my-2">
                                                    <input type="password" class="form-control form-control-lg login-form-input"
                                                        name="password_confirmation"
                                                        placeholder="{{ __('Confirm Password') }}">
                                                    @error('password_confirmation')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        {{ old('terms') == 'checked' ? 'checked' : '' }} name="terms"
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label agree" for="flexCheckDefault">
                                                        {{ __('I acknowledge having read and accepted the T&Cs') }}
                                                    </label>
                                                    @error('terms')
                                                        <div class="text-danger ">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group my-2 mt-2">
                                                    <button class="btn btn-primary btn-lg w-100">{{ __('Register') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                    @php
                        $lang = app()->getLocale();
                    @endphp
                    <div class="card py-5 border-0">
                        <div class="card-body">
                            <h1 class="fw-bold fs-1 text-center">{{ __('Latest Jobs') }}</h1>
                            <div class="row">
                                @forelse ($jobs as $job)
                                    <div class="col-12 col-md-6">
                                        <div class="job-box">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3 col-12 text-center">
                                                    <a href="{{ route('job', $job->slug) }}"><img
                                                            src="{{ asset('storage/images/' . $job->cover_img) }}"
                                                            class="img-fluid jobimg border-0" style="width: 110px;" /></a>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-12">
                                                    <a href="{{ route('job', $job->slug) }}" class="text-decoration-none">
                                                        <h5 class="mt-4"><strong>{{ $job->name }}</strong> </h5>
                                                    </a>
                                                    <ul class="mt-4 list-inline">
                                                        <li class="list-inline-item">{{ date('m-d-Y') }}</li>
                                    
                                                        <li class="list-inline-item"><i class="fa fa-tag"></i>
                                                            | {{ $job->{'category_' . $lang} }}</li>
                                                        <li class="list-inline-item"><i class="fa fa-location"></i>
                                                            | {{ $job->city . ', ' . $job->country }}</li>
                                                        {{-- <li class="list-inline-item">| {{ $job->{'type_' . $lang} }}</li> --}}
                                                        {{-- <li class="list-inline-item">|
                                                            ${{ rtrim(rtrim(number_format($job->min_salary, 2), 0), '.') }} -
                                                            ${{ rtrim(rtrim(number_format($job->max_salary, 2), 0), '.') }}
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-gray text-center">{{ __('NOT FOUND JOBS') }}</h1>
                                @endforelse
                            </div>
                            <div class="job-box d-flex justify-content-center">
                                <a href="{{ url('jobs') }}" class="btn btn-primary btn-lg px-4">{{ __('More Jobs') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card py-3 my-3 border-0">
                        <div class="card-head">
                            <h1 class="text-center fs-1 fw-bold py-5">Recruiting Centers</h1>
                        </div>
                        <div class="card-body">
                            <div class="owl-carousel testimony owl-theme px-5">
                                @foreach ($companies as $company)
                                    <div class="item shadow-sm">
                                        <img src="{{ asset('storage/images/'.$company->profile_image) }}" style="min-height: 200px;" class="img-fluid border p-3">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card py-3 my-3 border-0">
                        <div class="card-head">
                            <h1 class="text-center fs-1 fw-bold py-5">Job Categories</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-2 row-cols-1">
                                @foreach ($jobcategories as $item)
                                    <div class="col categorybox">
                                        <div><img
                                                src="{{ asset('storage/images/jobcategories/' . $item->img_path) }}"
                                                alt=""></div>
                                        <div class="mt-2">
                                            <a href="{{ url('search') }}?job_category={{ $item->slug }}"
                                                class="categories">{{ $item->{'name_' . $lang} }}<br />({{ $item->jobs }})</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> 
                    
                    <div class="card my-5 py-3 border-0">
                        <div class="row">
                            <div class="col-md-4 p-5 text-center">
                                <!-- <img src="{{ asset('web/images/icon/31.png') }}" class="py-1" alt=""> -->
                                <i class="fa fa-briefcase mb-2" style="font-size: 60px;"></i>
                                <h1 class="fw-bold pt-2">{{ number_format($total_posts) }}</h1>
                                <h2>{{ __('Live Jobs') }}</h2>
                                <p>{{ __('Candidates can apply on these jobs') }}</p>
                            </div>
                            <div class="col-md-4 p-5 text-center">
                                <!-- <img src="{{ asset('web/images/icon/32.png') }}" class="py-1" alt=""> -->
                                <i class="fa fa-building mb-2" style="font-size: 60px;"></i>
                                <h1 class="fw-bold pt-2">{{ number_format($total_employers) }}</h1>
                                <h2>{{ __('Total Companies') }}</h2>
                                <p>{{ __('We Are Looking for Skilled Employees') }}</p>
                            </div>
                            <div class="col-md-4 p-5 text-center">
                                <!-- <img src="{{ asset('web/images/icon/33.png') }}" class="py-1" alt=""> -->
                                <i class="fa fa-users mb-2" style="font-size: 60px;"></i>
                                <h1 class="fw-bold pt-2">{{ number_format($total_employes) }}</h1>
                                <h2>{{ __('Total Candidate') }}</h2>
                                <p>{{ __('We are ready to Imporve people lives') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
       {{-- <div class="container py-5">
        <div class="card py-3 my-3 border-0">
            <div class="card-head">
                <h1 class="text-center fs-1 fw-bold py-5">Thousandes of people already using yesjob4you.com</h1>
            </div>
            <div class="card-body">
                @foreach ($users as $user)                    
                    <div style="width: 130px;display:inline-block;">
                        <img src="{{ asset('storage/images/'.$user->profile_image) }}" style="width: 120px;height: 120px;" class="rounded-circle p-3">
                        <h6 class="text-center text-bold">
                            {{ $user->first_name.' '.$user->last_name }}
                        </h6>
                    </div>
                @endforeach
                <div style="width: 100px;display:inline-block;">
                    <div class="rounded-circle" style="background-color:lightgray;">
                        <h2 class="fs-1 fw-1 text-center" style="line-height:100px;">+1</h2>
                    </div>
                    <h6 class="text-center text-bold">
                        You
                    </h6>
                </div>
            </div>
        </div>
       </div>
        --}}
        <section class="bg-theme py-5">
            <div class="container py-5">
                <div class="row row-cols-lg-5 row-cols-md-2 row-cols-sm-2 text-center d-flex justify-content-center">
                    <div class="col my-2  d-flex justify-content-center">
                        <div class="rounded-circle p-5 contact-cricle">
                            <a href="{{ route('companies') }}" class="text-decoration-none">
                                <i class="fa fa-building"></i>
                                <h1 class="secondlastimgh2">{{ __('Companies') }}</h1>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col my-2  d-flex justify-content-center">
                        <div class="rounded-circle p-5 contact-cricle">
                            <a href="{{ route('jobs') }}" class="text-decoration-none">
                                <i class="fa fa-briefcase"></i>
                                <h1 class="secondlastimgh2">{{ __('Jobs') }}</h1>
                            </a>
                        </div>
                    </div>
                    <div class="col my-2  d-flex justify-content-center">
                        <div class="rounded-circle p-5 contact-cricle">
                            <i class="fa fa-headset"></i>
                            <h1 class="secondlastimgh2">{{ __('Live Chat') }}</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
