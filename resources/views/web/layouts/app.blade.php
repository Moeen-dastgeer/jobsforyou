<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Yesjob4you')}}</title>
	 <link rel="icon" href="{{asset('web/images/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('web/plugins/bootstrap-5.1.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/plugins/fontawesome-free-6.0.0/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/owl-crousel-custtom.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('web/plugins/summernote/summernote-lite.css') }}">
    
</head>

<body>
    <header>
        <div class="container">
            <div class="row py-3">
                <div
                    class="col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center justify-content-md-start justify-content-lg-start">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-dark text-decoration-none">
                        <img src="{{ asset('web/images/logo.jpeg') }}" alt="" height="50">
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                    <form action="{{route('companies')}}" method="GET" class="d-flex justify-content-center" style="width: 100%;">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" name="q" class="form-control form-control-sm rounded-start"
                                placeholder="{{__('Search...')}}">
                            <button class="btn btn-primary rounded-end" type="submit" id="button-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 d-flex  justify-content-sm-center justify-content-md-end justify-content-lg-end">
                    <p class="fw-bold mt-2">
                        @php
                            $current_locale = app()->getLocale();
                            $available_locales = config('app.available_locales');
                        @endphp
                        <div class="dropdown mt-2">
                            @foreach($available_locales as $locale_name => $available_locale)
                                @if($available_locale == $current_locale)
                                    <button class="btn btn-default dropdown-toggle" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('web/images/flags/flag_'.$available_locale.'.png')}}" class="flag" alt=""> {{ $locale_name }}
                                    </button>
                                @endif
                            @endforeach
                            <ul class="dropdown-menu" aria-labelledby="language">
                                @foreach($available_locales as $locale_name => $available_locale)
                                    @if($available_locale !== $current_locale)
                                        <li><a class="dropdown-item" href="{{url('language/'.$available_locale)}}"> <img src="{{asset('web/images/flags/flag_'.$available_locale.'.png')}}" class="flag" alt=""> {{ __($locale_name) }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @auth
                            @if (Auth()->user()->role_id == 1)
                                <div class="dropdown mt-2">
                                    <a class="dropdown-toggle btn btn-link text-dark text-decoration-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{Auth()->user()->first_name.' '.Auth()->user()->last_name}}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{url('user/account')}}">{{__('Account')}}</a></li>
                                        <li><a class="dropdown-item" href="{{url('user/view-resume')}}">{{__('View Resume')}}</a></li>
                                        <li><a class="dropdown-item" href="{{url('user/applied-jobs')}}">{{__('Applied Jobs')}}</a></li>
                                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a></li>
                                    </ul>
                                </div>
                            @else
                                <div class="dropdown mt-2">
                                    <a class="dropdown-toggle btn btn-link text-dark text-decoration-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{Auth()->user()->company_name}}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{url('company/account')}}"">{{__('Account')}}</a></li>
                                        <li><a class="dropdown-item" href="{{url('company/post-your-job')}}">{{__('Create Job')}}</a></li>
                                        <li><a class="dropdown-item" href="{{url('company/posted-jobs-list')}}">{{__('Jobs')}}</a></li>
                                        <li><a class="dropdown-item" href="{{route('company.news.create')}}">{{__('Create News')}}</a></li>
                                        <li><a class="dropdown-item" href="{{route('company.news.index')}}">{{__('News')}}</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a></li>
                                    </ul>
                                </div>  
                            @endif
                            
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form>
                        @else
                            <div class="mt-2">
                                <i class="fa fa-user"></i> 
                                <a href="{{route('login')}}" class="btn btn-link text-dark text-decoration-none">{{__('Login')}}</a>/
                                <a href="{{route('register')}}" class="btn btn-link text-dark text-decoration-none">{{__('Register')}}</a>
                            </div>
                        @endauth
                    </p>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-md bg-dark rounded rounded-0 bg-theme" aria-label="Menu">
        <div class="container d-flex flex-wrap">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"> 
                        <a class="nav-link link-light pr-4 fw-700 text-uppercase {{ Route::is('companies') ? 'nav-active' : '' }}" href="{{ route('companies') }}">{{__('Companies')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light px-4 fw-700 text-uppercase {{ Route::is('jobs') ? 'nav-active' : '' }}" href="{{ route('jobs') }}">{{__('Jobs')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light px-4 fw-700 text-uppercase {{ Route::is('news') ? 'nav-active' : '' }}" href="{{ route('news') }}">{{__('News')}}</a>
                    </li>
                    
                   
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    @if (Auth()->user()->role_id == 2)
                        <li class="nav-item">
                            <a class="nav-link link-light btn btn-success btn-sm px-4 fw-700 text-uppercase" href="{{url('company/post-your-job')}}">{{__('Post Your Job')}}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link link-light btn btn-success btn-sm px-4 fw-700 text-uppercase" href="{{route('register-company')}}">{{__('Register Company')}}</a>
                    </li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- header code area end -->
    {{ $slot }}
    <section>
        <div class="footer">
            <hr>
            <div class="container">
                <footer class="py-5">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <a href="index.html" class="d-flex align-items-center text-dark text-decoration-none">
                                <img src="{{ asset('web/images/logo.jpeg')}}" alt="" height="70">
                            </a>
                            <p class="text-justify py-3">
                                Yesjob4you is a comprehensive online job portal designed to connect job seekers with their dream opportunities and assist employers in finding top talent.
                            </p>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <h3 class="py-2">{{__('Contact Us')}}</h3>
                            <ul class="nav flex-column py-3 footer-list">
                                <li class="nav-item"><a href="javascript:void(0);"
                                        class="nav-link p-0 custom-links"><i class="fa fa-envelope"></i>
                                        info@yesjob4you.com</a></li>
                               
                                <li class="nav-item"><a href="javascript:void(0);"
                                        class="nav-link p-0 custom-links"><i class="fa fa-mobile"></i>
                                        +212661117612</a></li>
                                
                            </ul>
                        </div>
                        <div class="col-12 col-md-4">
                            <h3 class="py-2">{{__('Userfull Links')}}</h3>
                            <ul class="nav flex-column py-3 footer-list">
                                <li class="nav-item"><a href="{{route('companies')}}"
                                        class="nav-link p-0 custom-links"><i class="fa fa-angle-right"></i>
                                        {{__('Recruiters')}}</a></li>  
                                <li class="nav-item"><a href="{{route('jobs')}}" class="nav-link p-0 custom-links"><i
                                            class="fa fa-angle-right"></i> {{__('Job Offers')}}</a></li>
                               
                                <li class="nav-item"><a href="{{route('news')}}" class="nav-link p-0 custom-links"><i
                                            class="fa fa-angle-right"></i> {{__('Latest News')}}</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </footer>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container pt-4">
                <div class="d-flex justify-content-between">
                    <p>©
                        {{date('Y')}} yesjob4you.com. All rights reserved.
                    </p>
                    <ul class="list-unstyled d-flex">
                        <li class="ms-2"><a href="https://web.facebook.com/Yesjob4you" target="_blank"><i class='fab fa-facebook fa-2x'></i></a></li>
                       
                        <li class="ms-2"><a href="https://www.instagram.com/yesjob4you/"><i class='fab fa-instagram fa-2x' target="_blank"></i></a></li>
						<li class="ms-2"><a href="https://www.linkedin.com/company/yesjob4you/?viewAsMember=true"><i class='fab fa-linkedin fa-2x'target="_blank"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    {{-- <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{ asset('web/plugins/jquery-3.6.0/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/plugins/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/plugins/summernote/summernote-lite.js')}}"></script>
    <script src="{{ asset('web/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
                $('#profile_image').on('change',function(){
                    var src = URL.createObjectURL(this.files[0]);
                    document.getElementById('profile_img').src = src;
                });
                $('#cover_image').on('change',function(){
                    var src = URL.createObjectURL(this.files[0]);
                    //alert(src);
                    $('#employer_background').css('background-image', 'url('+src+')');
                    // document.getElementById('profile_img')
                });
            $('#summernote').summernote({
                placeholder: 'Write about your company',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });
        });
    </script>
    {{$footer}}
</body>

</html>
