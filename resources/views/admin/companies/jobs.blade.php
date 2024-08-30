<x-admin-app-layout>
    <x-slot name="title">Jobs</x-slot> 
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Jobs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">company</a></li>
                <li class="breadcrumb-item active">Jobs</li>
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
                                <h5>Jobs List</h5>
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
                                    <th>Job Title</th>
                                    <th>Candidate Intersetd</th>
                                    <th class="text-center">Candidate List</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i=1;
                                @endphp
                                @forelse ($jobs as $job)
                                    <tr class="text-center">
                                        <td>{{$i++}}</td>
                                        <td>
                                            @if ($job->cover_img == null)
                                                 <img src="{{asset('images/dp.png')}}" alt="" style="width: 30px;height:30px;">
                                            @else
                                                <img src="{{asset('storage/images/'.$job->cover_img)}}" alt="" style="width: 30px;height:30px;">
                                            @endif
                                        </td>
                                        <td>{{$job->name}}</td>
                                        <td>
                                                {{$job->total_candidate}}
                                            
                                        </td>
                                        <td>
                                            <a href="{{url('admin/company/candidate-list',$job->id)}}">
                                                <i class="fa fa-list"></i>
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