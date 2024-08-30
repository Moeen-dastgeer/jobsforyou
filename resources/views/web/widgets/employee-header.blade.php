<div class="card rounded-0 mb-2">
    <div class="card-body">
        @php
            if ($user->cover_image == null) {
                $abc = asset('images/no-image1.jpg');
                $background ='background-image:url('.$abc.');';
            } else {
                $abc = asset('storage/images/'.$user->cover_image);
                $background ='background-image:url('.$abc.');';
            }
            
        @endphp
        <div style="{{$background}} background-size:100% 100%;" id="employer_background" class="p-4">
            @if($user->profile_image == null) 
            <img src="{{asset('images/dp.png')}}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;margin-top:100px;">
            @else
            <img src="{{asset('storage/images/'.$user->profile_image)}}" id="profile_img" class="img-fluid" style="height: 100px;width:100px;margin-top:100px;">               
            @endif
            
            {{-- @empty($user->profile_image)
                <img src="{{asset('images/dp.png')}}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;margin-top:100px;">
            @else
                <img src="{{asset('storage/images/'.$user->profile_image)}}" id="profile_img" class="img-fluid" style="height: 100px;width:100px;margin-top:100px;">                
            @endempty --}}
        </div>
    </div>
</div> 
<div class="card rounded-0 mt-2">
    <div class="card-body">
        <ul class="nav nav-pills account-tab">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('user.account')? 'navactive' : '' }}" href="{{route('user.account')}}">{{__('Account')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('user.skills')? 'navactive' : '' }}" href="{{route('user.skills')}}">{{__('Skills')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('user.applied-jobs')? 'navactive' : '' }}" href="{{route('user.applied-jobs')}}">{{__('Applied Jobs')}}</a>
            </li>
        </ul>
    </div>
</div>
