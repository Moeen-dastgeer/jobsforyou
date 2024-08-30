<x-admin-app-layout>
    <x-slot name="title">Candidates</x-slot> 
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Candidates</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Candidates</a></li>
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
                                <h5>Candidates List</h5>
                            </div>
                            <div class="col-md-6 text-right">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-sm table-condensed table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Candidate Title</th>
                                    <th>Email Address</th>
                                    <th>Contact No</th>
                                    <th>Resume</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i=1;
                                @endphp
                                @forelse ($applys as $apply)
                                    <tr class="text-center">
                                        <td>{{$i++}}</td>
                                        <td>
                                            @if ($apply->profile_image != '')
                                                <img src="{{asset('storage/images/'.$apply->profile_image)}}" alt="" style="width: 30px;height:30px;">
                                            @endif
                                        </td>
                                        <td>{{$apply->first_name.' '.$apply->last_name}}</td>
                                        <td>
                                            {{$apply->email}}
                                            
                                        </td>
                                        <td>
                                            {{$apply->email}}
                                        </td>
                                        <td>
                                            <a href="{{asset('storage/cvs/'.$apply->cv_path)}}" class="btn btn-primary" download>
                                                <i class="fas fa-file-download"></i> CV Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">Not Found!</td>
                                    </tr>
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