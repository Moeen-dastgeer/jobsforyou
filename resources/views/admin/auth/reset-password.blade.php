<x-admin-guest-layout>
    <x-slot name="desc"></x-slot>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="input-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{old('email', $request->email)}}"  autofocus >
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
        <div class="input-group mt-3">
            <input type="password" name="password"  class="form-control" placeholder="Password">
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
        <div class="input-group mt-3">
            <input type="password" name="password_confirmation"  class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>    
        </div>
        @error('password_confirmation')
            <span class="invalid-feedback is-invalid d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror
        <div class="row mt-3">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</x-admin-guest-layout>
