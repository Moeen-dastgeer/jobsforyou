<main>
    <section class="p-0 bg-light" style="min-height: 80vh;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card rounded-0 mb-2">
                        
                        <div class="card-body">
                            @php
                                if ($user->cover_image == '') {
                                    $abc = asset('images/no-image1.jpg');
                                    $background ='background-image:url('.$abc.');';
                                } else {
                                    $abc = asset('storage/images/'.$user->cover_image);
                                    $background ='background-image:url('.$abc.');';
                                }
                            @endphp
                            <div style="{{$background}} background-size:100% 100%;" id="employer_background" class="cover-img p-4 ">
                                @empty($user->profile_image)
                                    <img src="{{asset('images/dp.png')}}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;margin-top:100px;">
                                @else
                                    <img src="{{asset('storage/images/'.$user->profile_image)}}" id="profile_img" class="img-fluid" style="height: 100px;width:100px;margin-top:100px;">
                                @endempty
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-0 mt-2">
                        <div class="card-body">
                            <ul class="nav nav-pills account-tab">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.account') ? 'navactive' : '' }}"
                                        href="{{ route('company.account') }}">
                                        {{__('Account')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.post-your-job') ? 'navactive' : '' }}"
                                        href="{{ route('company.post-your-job') }}">{{__('Post Job')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.posted-jobs-list') ? 'navactive' : '' }}"
                                        href="{{ route('company.posted-jobs-list') }}">{{__('Jobs List')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.news.create') ? 'navactive' : '' }}"
                                        href="{{ route('company.news.create') }}">{{__('Create News')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.news.index') ? 'navactive' : '' }}"
                                        href="{{ route('company.news.index') }}">{{__('News')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{$slot}}
                </div>
            </div>
        </div>
    </section>
</main>
