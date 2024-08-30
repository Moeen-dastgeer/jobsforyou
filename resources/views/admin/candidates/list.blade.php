<x-admin-app-layout>
    <x-slot name="title">Candidates</x-slot> 
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Candidates</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Candidate</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div><!-- /.col -->
    </x-slot>
    <x-slot name="footer"></x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(!empty(session('message')))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>{{session('message')}}
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Candidates</h5>
                            </div>
                            <div class="col-md-6 text-right">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-sm table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zip Code</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $candidate)
                                    <tr>
                                        <td>{{$candidate->id}}</td>
                                        <td>
                                            @if ($candidate->profile_image == null)
                                            <img src="{{asset('images/dp.png')}}" alt="" style="width: 30px;height:30px;">
                                            @else
                                                <img src="{{asset('storage/images/'.$candidate->profile_image)}}" alt="" style="width: 30px;height:30px;">
                                            @endif
                                        </td>
                                        <td>{{$candidate->first_name.' '.$candidate->last_name}}</td>
                                        <td>{{$candidate->email}}</td>
                                        <td>{{$candidate->phone}}</td>
                                        <td>{{$candidate->gender}}</td>
                                        <td>{{$candidate->street_address}}</td>
                                        <td>{{$candidate->city}}</td>
                                        <td>{{$candidate->zip_code}}</td>
                                        <td>
                                            <a href="{{url('admin/candidates/'.$candidate->id.'/'.$candidate->status)}}" class="btn btn-sm btn-warning mx-2">
                                                {{$candidate->status}}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">Not Found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": true, "autoWidth": false
                });
            });
        </script>
    </x-slot>
</x-admin-app-layout>