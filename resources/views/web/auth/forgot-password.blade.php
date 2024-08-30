<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-5 py-5 px-2">
                            <div class="header">
                                <div class="title text-center">
                                    <h2>{{__('Forget Password')}}</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{route('password.email')}}" method="post">
                                    @CSRF
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" name="email" placeholder="{{__('Enter Email Address')}}">
                                        @error('email')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100">Request New Password</button>
                                    </div>
                                </form>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <a href="{{route('login')}}">{{__('Login')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>