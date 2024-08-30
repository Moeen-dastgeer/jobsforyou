<x-admin-guest-layout>
    <x-slot name="desc">You forgot your password? Here you can easily retrieve a new password.</x-slot>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="input-group">
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback is-invalid d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror
        <br />
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Email Password Reset Link') }}</button>
            </div>
            <!-- /.col -->
            <div class="col-12">
                <p class="mt-3 mb-1">
                    <a href="{{route('admin.login')}}">Login</a>
                </p>
            </div>
        </div>
    </form>
</x-admin-guest-layout>
