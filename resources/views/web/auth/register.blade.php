<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-4 pt-4">
                            <div class="header">
                                <div class="title text-center">
                                    <h2>{{__('Create Candidate Account')}}</h2>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ old('first_name') }}" name="first_name"
                                                    placeholder="{{ __('First Name') }}">
                                                @error('first_name')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ old('last_name') }}"
                                                    name="last_name" placeholder="{{ __('Last Name') }}">
                                                @error('last_name')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="{{ __('Enter email') }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" placeholder="{{ __('Phone') }}">
                                        @error('phone')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="gender" id="" class="form-select">
                                                    <option value="">{{ __('Select Gender') }}</option>
                                                    <option value="Male" {{ _('Male') }}>Male</option>
                                                    <option value="Female" {{ _('Female') }}>Female</option>
                                                    <option value="Other" {{ _('Other') }}>Other</option>
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city"
                                                    placeholder="{{ __('City') }}">
                                                @error('city')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="{{ __('Enter Password') }}">
                                        @error('password')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="{{ __('Confirm Password') }}">
                                        @error('password_confirmation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    {{ old('terms') == 'checked' ? 'checked' : '' }} name="terms"
                                                    id="flexCheckDefault">
                                                <label class="form-check-label agree" for="flexCheckDefault">
                                                    {{ __('I acknowledge having read and accepted the T& Cs') }}
                                                </label>
                                                @error('terms')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
