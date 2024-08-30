<section class="p-0 jobsearch">
    <div class="container py-2">
        @php
                    $lang = app()->getLocale();
                @endphp
        <h1 class="text-center text-white pb-3 fs-1 fw-bold">{{__('The Easiest Way to Get Your New Job')}}</h1>
        <p class="text-center text-white pb-3 fs-4">{{__('We offer :jobs jobs vacation right now', ['jobs'=>$total_jobs])}}</p>
        <form method="get" action="{{url('search')}}">
            <div class="row searchformbg">
                <div class="col-md-3 my-1">
                    <select class="form-select border-0" name="job_category">
                        <option value="">{{__('Job Category')}}</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->slug }}" {{$category== $cat->slug ? 'selected':''}}>{{ ($cat->{'name_'.$lang}) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 my-1">
                    <select class="form-select border-0" name="city">
                        <option value="">{{__('Job Location')}}</option>
                        @foreach ($cities as $cit)
                            <option value="{{ $cit->city }}" {{$city == $cit->city ? 'selected':''}}>{{ $cit->city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 my-1">
                    <input type="text" class="form-control border-0" name="q" value="{{$q}}" placeholder="{{__('Type Your Keyword')}}">
                </div>
                <div class="col-md-3 my-1">
                    <button class="btn btn-success w-100">{{__('Search')}}</button>
                </div>
            </div>
        </form>
        <div class="mx-2 mt-3 ">
            <ul class="list-unstyled d-flex justify-content-center">
                <li class="ms-4"><a href="#"><i class='fab fa-facebook fa-2x' style="color: whitesmoke !important;"></i></a></li>
                <li class="ms-4"><a href="#"><i class='fab fa-twitter fa-2x' style="color: whitesmoke !important;"></i></a></li>
                <li class="ms-4"><a href="#"><i class='fab fa-instagram fa-2x' style="color: whitesmoke !important;"></i></a></li>
            </ul>
        </div>
    </div>
</section>
