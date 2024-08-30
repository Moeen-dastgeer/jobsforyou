<div class="card rounded-0 py-3">
    <div class="card-body">
        <h5>{{__('Recruiting companies')}}</h5>
        <hr class="breakdown">
        <div class="row">
            @forelse ($recuritings as $item)
               <div class="col-md-4">
                    <a href="{{route('company.profile',$item->slug)}}">
                        @if($item->profile_image == null) 
                        <img src="{{asset('images/dp.png')}}" id="profile_img" class="img-fluid border" style="height: 100px;width:100px;margin-top:100px;">
                        @else
                        <img src="{{ asset('storage/images/'.$item->profile_image) }}" class="jobimg" />               
                        @endif
                        
                    </a>
                </div> 
            @empty
                <div class="col-md-12 text-center">
                    <h2>NOT FOUND</h2>
                </div>
            @endforelse
        </div>
    </div>
</div>
