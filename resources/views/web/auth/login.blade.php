<x-app-layout>
    <main>
        <section class="bg-light">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card my-5 py-4 mx-3">
                            <div class="header">
                                <div class="title text-center">
                                    <h2>{{__('Login')}}</h2>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if(Session::has('fail'))
                                    <div class="alert alert-danger">
                                    {{Session::get('fail')}}
                                    </div>
                                @endif
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control " placeholder="{{__('Enter Email Address')}}">
                                        @error('email')
                                            <span class="invalid-feedback is-invalid d-block"  role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{__('Enter Password')}}">
                                        @error('password')
                                            <span class="invalid-feedback is-invalid d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                          <label for="remember"><input type="checkbox" class="mt-2" name="remember" id="remember" > {{__('Remember me')}}</label>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary px-4">{{__('Login')}}</button>
                                        </div>
                                    </div>  
                                </form>
                                <div class="row pt-3">
                                    <div class="col-md-7">
                                        <a href="{{route('password.request')}}" class="text-primary text-decoration-none">{{__('I forget my password?')}}</a>
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-end">
                                        <a href="{{route('register')}}" class="text-primary text-decoration-none">{{__('Create an account')}}</a>
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