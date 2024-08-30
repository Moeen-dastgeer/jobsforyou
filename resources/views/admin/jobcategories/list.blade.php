<x-admin-app-layout>
    <x-slot name="title">Job Categories</x-slot> 
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Job Categories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Job Category</a></li>
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
                                <h5>Job Categories</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('admin.jobcategories.create')}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus-square"></i> Job Category</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-sm table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name En</th>
                                    <th>Name Fr</th>
                                    <th>Image</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobcategories as $jobCategory)
                                    <tr>
                                        <td>{{$jobCategory->id}}</td>
                                        <td>{{$jobCategory->name_en}}</td>
                                        <td>{{$jobCategory->name_fr}}</td>
                                        <td>
                                            @if ($jobCategory->img_path != null)
                                                <img src="{{asset('images/dp.png')}}" alt="" style="width:33px;">                                            
                                            @else
                                                <img src="{{asset('storage/images/jobcategories/'.$jobCategory->img_path)}}" alt="" >
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.jobcategories.edit',$jobCategory->id)}}" class="btn btn-sm btn-warning mx-2">
                                                <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.jobcategories.destroy', $jobCategory->id) }}" method="POST" class="form-inline">
                                                @csrf 
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger mx-2"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
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