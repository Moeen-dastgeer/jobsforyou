<main>
    <section class="p-0 bg-light" style="min-height: 80vh;">
        <div class="container py-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card rounded-0 mb-2">
                        <div class="card-body">
                            @if ($coverimg == null)
                                <div style="background-image:url({{ asset('images/no-image1.jpg') }}); background-size:100% 100%; position:relative;height: 300px;" id="employer_background" class="cover-img">
                            @else
                                <div style="background-image:url({{ asset('storage/images/' . $coverimg) }});position:relative;height: 300px;" id="employer_background" class="cover-img">
                            @endif
                            @if ($profileimg ==  null)
                                <img src="{{ asset('images/dp.png') }}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;position:absolute;left:5px;bottom:5px;">
                            @else
                                <img src="{{ asset('storage/images/' . $profileimg) }}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;position:absolute;left:5px;bottom:5px;">
                            @endif
                             </div>
                        </div>
                    </div>
                    <div class="card rounded-0 mt-2">
                        <div class="card-body">
                            <ul class="nav nav-pills account-tab">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.profile', $companyid) ? 'navactive' : '' }}"
                                        href="{{ route('company.profile', $companyid) }}">
                                        {{__('Account')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.offers', $companyid) ? 'navactive' : '' }}"
                                        href="{{ route('company.offers', $companyid) }}">{{__('Offers')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('company.newz', $companyid) ? 'navactive' : '' }}"
                                        href="{{ route('company.newz', $companyid) }}">{{__('News')}}</a>
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
