<x-app-layout>
    <x-company-layout :coverimg="$company->cover_image" :profileimg="$company->profile_image" :companyid="$company->slug">
        
        @forelse ($news as $newz)
            <div class="card rounded-0 border-0 news my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{route('company.profile',$newz->slug)}}">
                                <img src="{{ asset('storage/images/' . $newz->profile_image) }}" class="img" />
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="mt-2">
                                <a href="{{route('company.profile',$newz->slug)}}"><span>{{ $newz->company_name }}</span></a> <br />
                                <a href="#"
                                    class="text-decoration-none link-dark">{{ date('F d m Y', strtotime($newz->created_at)) }}</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-unstyled d-flex">
                               <li class="ms-2"><a href="https://web.facebook.com/Yesjob4you" target="_blank"><i class='fab fa-facebook fa-2x'></i></a></li>
                        
                        <li class="ms-2"><a href="https://www.instagram.com/yesjob4you/" target="_blank"><i class='fab fa-instagram fa-2x'></i></a></li>
						<li class="ms-2"><a href="https://www.linkedin.com/company/yesjob4you/" target="_blank"><i class='fab fa-linkedin fa-2x'></i></a></li>
                            </ul>
                        </div>
                    </div>
					
                    <div class="post">
                        <p class="my-2">{!! $newz->post !!}</p>
                        <img src="{{ asset('storage/images/' . $newz->img_path) }}" class="img-fluid w-100 my-3 border"
                            alt="">
                        @if (Session::has('commentSuccess'))
                            <div class="alert alert-success">
                                {{ Session::get('commentSuccess') }}
                            </div>
                        @endif
                        @if (Session::has('commentDanger'))
                            <div class="alert alert-danger">
                                {{ Session::get('commentDanger') }}
                            </div>
                        @endif
                        <form action="{{ route('company.news.comment') }}" method="post">
                            @CSRF
                            <input type="hidden" name="news_id" value="{{ $newz->id }}">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"> <i class="fa fa-comment"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="{{__('Write comment')}}"
                                            name="comment" value="{{ old('comment') }}" aria-label="{{__('Write comment')}}"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    @error('comment')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                   @auth
                                                       <button type="submit" class="btn btn-primary w-100">{{__('Comment')}}</button>
                                                    @else
                                                        <a href="javascript:void(0)" onclick="alert('Please Login Before comment.')" class="btn btn-primary w-100">{{__('Comment')}}</a>
                                                    @endauth
                                </div>
                            </div>
                        </form>

                        @foreach ($comments as $comment)
                            @if ($comment->news_id == $newz->id)
                                <div class="row mt-2">
                                    <div class="col-md-3 d-flex">
                                        <a href="{{route('company.profile',$comment->slug)}}"><img src="{{ asset('storage/images/' . $comment->profile_image) }}"
                                            style="width: 40px; height:40px;" /></a>
                                        <ul style="list-style: none;font-size:11px;" class="mt-1">
                                            <li><a href="{{route('company.profile',$comment->slug)}}">
                                                @if ($comment->role_id == 2)
                                                    {{ $newz->company_name }}
                                                @else
                                                    {{ $newz->first_name . ' ' . $newz->last_name }}
                                                @endif </a>
                                            </li>
                                            <li>{{ date('F d m Y', strtotime($comment->created_at)) }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7 pt-3">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <h1 class="text-center">NOT FOUND</h1>
        @endforelse

        <div class="job-box d-flex justify-content-center">
            {{ $news->links() }}
        </div>
    </x-company-layout>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
