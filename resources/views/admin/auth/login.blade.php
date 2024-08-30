<x-admin-guest-layout>
    <x-slot name="desc">Sign in to start your session</x-slot>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="input-group">
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>     
        @error('email')
            <span class="invalid-feedback is-invalid d-block"  role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror  
        <div class="input-group mt-3">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{old('password')}}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>      
        </div>
        @error('password')
            <span class="invalid-feedback is-invalid d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror     
        <div class="row mt-3">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember_me" checked>
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
            {{-- <p class="mb-1"><a href="{{ route('admin.password.request') }}">I forgot my password</a></p> --}}
        </div>
    </form>
</x-admin-guest-layout>
