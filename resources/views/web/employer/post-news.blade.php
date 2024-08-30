<x-app-layout>
    <x-employer-layout>
     <div class="card rounded-0 mt-3">
            <div class="card-header">
                <div class="title">
                    <h4>{{__('Create News')}}</h4>
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
                <form action="{{ route('company.news.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group mt-3">
                        <label for="post">{{__('Description')}}</label>
                        <textarea id="summernote" name="description" placeholder="{{__('Write News Description')}}">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="img">{{__('News Image')}}</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                        @error('cover_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" value="{{__('Create News')}}">
                    </div>
                </form>
            </div>
        </div>
    </x-employer-layout>
    <x-slot name="footer"></x-slot>
</x-app-layout>