<x-admin-app-layout>
    <x-slot name="title">Change Password</x-slot> 
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div><!-- /.col -->
    </x-slot>
    <x-slot name="footer"></x-slot>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header rounded-0">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('admin.change.password')}}">  
                    @CSRF
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Current Password</label>
                            <input type="password" name="current_password" value="{{old('currentPassword')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter current password">
                            @error('current_password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Name Password</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="Name Password">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary rounded-0">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>