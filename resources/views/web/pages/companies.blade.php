<x-app-layout>
    <main>
        <x-front.filter />
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="card rounded-0 mb-2">
                    <div class="card-body">
                        <div class="title pt-2">
                            <h3>{{__('List of companies')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
                            @forelse ($companies as $company)
                                <div class="col">
                                    <div class="card profilebox">
                                        @php
                                            if ($company->cover_image == null) {
                                                $abc = asset('images/no-image1.jpg');
                                                $background ='background-image:url('.$abc.');';
                                            } else {
                                                $abc = asset('storage/images/'.$company->cover_image);
                                                $background ='background-image:url('.$abc.');';
                                            }
                                            
                                        @endphp
                                        <div style="{{$background}} background-size:100% 100%; min-height:150px;width:100%; position:relative;"  class="cover-img border-bottom">
                                            @if($company->profile_image == null) 
                                            <img src="{{asset('images/dp.png')}}" id="profile_img" class="card-img-top border" alt="no image" style="height: 60px;width:60px;position:absolute;left:5px;bottom:-25px;">
                                            @else
                                            <img src="{{asset('storage/images/'.$company->profile_image)}}" class="card-img-top border" alt="{{$company->company_name}}" style="height: 60px;width:60px;position:absolute;left:5px;bottom:-25px;">               
                                            @endif
                                            
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{route('company.profile',$company->slug)}}" class="text-dark text-decoration-none">{{$company->company_name}}</a>
                                            </h5>
                                            <p class="card-text">{!! substr(strip_tags($company->about), 0, 90) !!}...</p>
                                            <a href="{{ route('company.offers', $company->slug) }}" class="btn btn-primary px-5">{{$company->jobs}} {{__('Offers')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h1 class="text-center ">{{__('NOT FOUND COMPANIES')}}</h1>
                            @endforelse
                        </div>
                        <div class="job-box d-flex justify-content-center">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>
