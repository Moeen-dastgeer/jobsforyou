<x-admin-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"></li>
            </ol>
        </div><!-- /.col -->
    </x-slot>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_companies}}</h3>
                    <p>Companies</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ship"></i>
                </div>
                <a href="{{route('admin.companies')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$total_candidates}}</h3>
                    <p>Candidates</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{route('admin.candidates')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total_categories}}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('admin.jobcategories.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total_quiz}}</h3>
                    <p>Quiz</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="{{route('admin.quizzes.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Companies</h5>
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
                        {{-- <th>Address</th> --}}
                        {{-- <th>City</th> --}}
                        {{-- <th>Zip Code</th>  --}}
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>
                                @if ($company->profile_image == null)
                                    <img src="{{ asset('images/dp.png') }}" alt="" style="width: 30px;height:30px;">
                                @else
                                    <img src="{{ asset('storage/images/' . $company->profile_image) }}" alt="" style="width: 30px;height:30px;">
                                @endif
                            </td>
                            <td>{{ $company->company_name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->phone }}</td>
                            {{-- <td>{{ $company->street_address }}</td> --}}
                            {{-- <td>{{ $company->city }}</td> --}}
                            {{-- <td>{{ $company->zip_code }}</td> --}}
                            <td>
                                <a href="{{ url('admin/companies/' . $company->id . '/' . $company->status) }}"
                                    class="btn btn-sm btn-warning mx-2">
                                    {{ $company->status }}
                                </a>
                            </td>
                            

                            <td>
                                <a href="{{ url('admin/companies/view/'.$company->id)}}" class="btn btn-sm btn-primary mx-2">
                                    View
                                </a>

                                <a href="{{ url('admin/companies/delete/'.$company->id)}}" class="btn btn-sm btn-danger mx-2">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Not Found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
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
