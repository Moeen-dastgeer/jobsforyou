<x-app-layout>
    <x-employer-layout>
     <div class="card rounded-0 mt-3">
            <div class="card-header">
                <div class="title">
                    <h4>{{__('Edit News')}}</h4>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('newsSuccess'))
                    <div class="alert alert-success">
                        {{ Session::get('newsSuccess') }}
                    </div>
                @endif
                 @if (Session::has('newsDanger'))
                    <div class="alert alert-success">
                        {{ Session::get('newsDanger') }}
                    </div>
                @endif
                <form action="{{ route('company.news.update') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group mt-3">
                        <label for="post">{{__('Description')}}</label>
                        <textarea id="summernote" name="description" placeholder="{{__('Write News Description')}}">{{ old('description',$news->post) }}</textarea>
                        <input type="hidden" value="{{$news->id}}" name="id">
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <img src="{{asset('storage/images/'.$news->img_path)}}" id="profile_img2" class="img-fluid" width="200px" height="200px">
                        <input type="file" name="cover_image" id="profile_image2" class="form-control">
                        @error('cover_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" value="{{__('Update News')}}">
                    </div>
                </form>
            </div>
        </div>
    </x-employer-layout>
    <x-slot name="footer">
        <script>
        $('#profile_image2').on('change',function(){
                    var src2 = URL.createObjectURL(this.files[0]);
                    document.getElementById('profile_img2').src = src2;
                });
        </script>
    </x-slot>
</x-app-layout>