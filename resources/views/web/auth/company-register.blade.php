<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-4 pt-4">
                            <div class="header">
                                <div class="title text-center">
                                    <h2>{{ __('Company Account') }}</h2>
                                </div>
                            </div>
                            <div class="card-body p-4"> 
                                <form method="POST" action="{{ route('register-company') }}">
                                    @csrf
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" value="{{ old('company_name') }}"
                                            name="company_name" placeholder="{{ __('Company Name') }}">
                                        @error('company_name')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" value="{{ old('email') }}"
                                            name="email" placeholder="{{ __('Enter email') }}">
                                        @error('email')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" placeholder="{{ __('Phone') }}">
                                        @error('phone')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="city"
                                            placeholder="{{ __('City') }}" value="{{old('city')}}">
                                        @error('city')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="{{ __('Enter Password') }}">
                                        @error('password')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="{{ __('Confirm Password') }}">
                                        @error('password_confirmation')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4 mt-3">
                                        <label class=" agree" for="terms">
                                            <input type="checkbox" name="terms" id="terms">
                                            {{ __('I acknowledge having read and accepted the T& Cs') }}
                                        </label>
                                        @error('terms')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <button type="submit"
                                                class="btn btn-primary px-5">{{ __('Register') }}</button>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                            <a href="{{ route('login') }}"
                                                class="mt-3 text-primary text-decoration-none">{{ __('Login') }}</a>
                                        </div>
                                    </div>
                                </form>
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
