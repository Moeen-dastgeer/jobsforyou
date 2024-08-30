<x-app-layout>
    <x-company-layout :coverimg="$company->cover_image" :profileimg="$company->profile_image" :companyid="$company->slug">
        <div class="card rounded-0 mt-3">
            <div class="card-header">
                <div class="title">
                    <h4>{{ __('Offers') }}</h4>
                </div>
            </div>
            <div class="card-body">
                @php
                    $lang = app()->getLocale();
                @endphp
                @forelse ($offers as $offer)
                    <div class="border job-box">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-12 text-center">
                                <a href="{{ route('job', $offer->slug) }}"><img
                                        src="{{ asset('storage/images/' . $offer->cover_img) }}"
                                        class="img-fluid border p-1 jobimg" style="width: 110px;" /></a>
                            </div>
                            <div class="col-md-8 col-sm-9 col-12">
                                <a href="{{ route('job', $offer->slug) }}" class="text-decoration-none">
                                    <h5 class="mt-4"><strong>{{ $offer->name }} @</strong>
                                        <span class="text-dark">{{ $offer->company_name }}</span>
                                    </h5>
                                </a>
                                <ul class="mt-4 list-inline">
                                    <li class="list-inline-item"><i class="fa fa-location"></i>
                                        {{ $offer->city . ', ' . $offer->country }}</li>
                                    <li class="list-inline-item"><i class="fa fa-tag"></i>
                                        {{ $offer->{'category_' . $lang} }}
                                    </li>
                                    <li class="list-inline-item">| {{ $offer->{'type_' . $lang} }}</li>
                                    <li class="list-inline-item">|
                                        ${{ rtrim(rtrim(number_format($offer->min_salary, 2), 0), '.') }} -
                                        ${{ rtrim(rtrim(number_format($offer->max_salary, 2), 0), '.') }}</li>
                                </ul>
                            </div>
                            <div class="col-md-2 col-sm-12 col-12 text-center">
                                @auth
                                    @if (Auth()->user()->role_id == 1)
                                        <a href="{{ route('job.apply-now', $offer->slug) }}"
                                            class="btn btn-primary px-3 mt-5">{{ __('Apply Now') }}</a>
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
                @empty
                    <h1 class="text-gray text-center">{{ __('NOT FOUND JOBS') }}</h1>
                @endforelse
            </div>
        </div>
    </x-company-layout>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
