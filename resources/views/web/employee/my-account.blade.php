<x-app-layout>
    <main>
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-8">  
                        <x-front.employee-header />
                        <!-- Account info -->
                        <div class="card rounded-0 mt-3">
                            <div class="card-header">
                                <div class="title">
                                    <h4>{{__('Edit Account Info')}}</h4>
                                </div>
                            </div> 
                            <div class="card-body">
                                <form action="{{route('user.profile')}}" method="post" enctype="multipart/form-data">
                                    @CSRF
                                    <table class="table table-borderless ">
                                        <tr>
                                            <th></th>
                                            <td>
                                                @if (Session::has('profileStatus'))
                                                    <div class="alert alert-success">
                                                        {{ Session::get('profileStatus') }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Cover Image')}} <span class="small">(489px x 242px)</span></th>
                                            <td>
                                                <input type="file" name="cover_image" id="cover_image" class="form-control">
                                                @error('cover_image')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th style="width: 200px;">{{__('Profile Image')}}</th>
                                            <td>
                                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                                                @error('profile_image')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">{{__('Name')}}</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="first_name" placeholder="{{__('First Name')}}" value="{{old('first_name', $user->first_name)}}" class="form-control">
                                                        @error('first_name')
                                                            <div class="text-danger small">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="last_name" placeholder="{{__('Last Name')}}" value="{{old('last_name', $user->last_name)}}" class="form-control">
                                                        @error('last_name')
                                                            <div class="text-danger small">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{__('Email')}}</th>
                                            <td>
                                                <input type="text" name="email" value="{{old('email', $user->email)}}" class="form-control" readonly>
                                                @error('email')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <th>{{__('Phone')}}</th>
                                            <td>
                                                <input type="text" name="phone" value="{{old('phone', $user->phone)}}" class="form-control">
                                                @error('phone')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <th style="width: 200px;">{{__('Street Address')}}</th>
                                            <td>
                                                <input type="text" name="street_address" value="{{old('street_address', $user->street_address)}}" class="form-control">
                                                @error('street_address')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <th style="width: 200px;">{{__('Zip Code')}}</th>
                                            <td>
                                                <input type="text" name="zip_code" value="{{old('zip_code', $user->zip_code)}}" class="form-control">
                                                @error('zipcode')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <th style="width: 200px;">{{__('City')}}</th>
                                            <td>
                                                <input type="text" name="city" value="{{old('city', $user->city)}}" class="form-control">
                                                @error('city')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td><input type="submit" class="btn btn-primary" value="{{__('Update')}}"></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="card rounded-0 mt-3">
                            <div class="card-header">
                                <div class="title">
                                    <h4>{{__('Change Password')}}</h4>
                                </div>
                            </div>
                            <div class="card-body" id="changepassword">
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
                                <form action="{{route('change.password')}}?#changepassword" method="post">
                                    @CSRF
                                    <table class="table table-borderless ">
                                        <tr>
                                            <th style="width: 200px;">{{__('Current Password')}}</th>
                                            <th>
                                                <input type="password" name="current_password" class="form-control">
                                                @error('current_password')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>{{__('New Password')}}</th>
                                            <th>
                                                <input type="password" name="password" class="form-control">
                                                @error('password')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>{{__('Confirm Password')}}</th>
                                            <th>
                                                <input type="password" name="password_confirmation" class="form-control">
                                                @error('password_confirmation')
                                                    <div class="text-danger small">{{$message}}</div>
                                                @enderror
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th><input type="submit" class="btn btn-primary" value="{{__('Change Password')}}"></th>
                                        </tr>
                                    </table> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{-- <x-front.match-skills /> --}}
                        <x-front.recruiting />
                        {{-- <x-front.quiz /> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>
