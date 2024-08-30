<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-5 py-5 px-2">
                            <div class="header">
                                <div class="title text-center px-5">
                                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <!-- Password -->
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Enter Password" name="password" required autocomplete="current-password" />
                                        @error('password')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Confirm') }}
                                        </button>
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