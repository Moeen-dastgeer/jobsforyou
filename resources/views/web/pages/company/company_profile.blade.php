<x-app-layout>
    <x-company-layout :coverimg="$company->cover_image" :profileimg="$company->profile_image" :companyid="$company->slug">
        <!-- Account info -->
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 rounded-0 mt-3">
                    <div class="card-header">
                        <div class="title">
                            <h4>{{__('About')}}</h4>
                        </div>
                    </div>  
                    <div class="card-body">
                        <div>{!! $company->about !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 rounded-0 mt-3">
                    <div class="card-header">
                        <div class="title">
                            <h4>{{__('Profile')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>{{__('Industry')}}</td>
                                <td>{{ $company->industry }}</td>
                            </tr>
                            <tr>
                                <td>{{__('Street Address')}}</td>
                                <td>{{ $company->street_address }}</td>
                            </tr>
                            <tr>
                                <td>{{__('City')}}</td>
                                <td>{{ $company->city }}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-company-layout>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
