<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-5 py-5 px-2">
                            <div class="header">
                                <div class="title text-center">
                                    <h2>Set New Password</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="post">
                                    @CSRF
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{old('email', $request->email)}}" name="email" placeholder="Enter Email Address">
                                        @error('email')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        @error('password')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100">Request New Password</button>
                                    </div>
                                </form>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <a href="{{route('login')}}">Login</a>
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