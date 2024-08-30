<x-admin-app-layout>
    <x-slot name="title">Edit Job Category</x-slot>
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Job Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Job Category</a></li>
                <li class="breadcrumb-item active">Edit New</li>
            </ol>
        </div><!-- /.col -->
    </x-slot>
    <x-slot name="footer">
        <script>
            $(document).ready(function(){
                $('#img').on('change',function() {
                    var src = URL.createObjectURL(this.files[0]);
                    document.getElementById('show_img').src = src;
                });
            });
        </script>
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Edit New</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.jobcategories.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-arrow-circle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- ./card-header -->
                <form method="post" action="{{ route('admin.jobcategories.update', $jobcateogry->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_en">Job Category Name En<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name_en" id="name_en"
                                value="{{ old('name_en', $jobcateogry->name_en) }}" placeholder="Job Category Name En">
                            @error('name_en')
                                <div class="text-danger smal">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_fr">Job Category Name Fr<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name_fr" id="name_fr"
                                value="{{ old('name_fr', $jobcateogry->name_fr) }}" placeholder="Job Category Name Fr">
                            @error('name_fr')
                                <div class="text-danger smal">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="img">Image <span class="text-danger">*</span></label>
                            <input type="file" name="img" id="img" style="height:auto;" class="form-control form-control-sm">
                            @error('img')
                                <div class="text-danger smal">{{$message}}</div>
                            @enderror
                            @if ($jobcateogry->img_path != null && $jobcateogry->img_path != '')
                                <img src="{{asset('storage/images/jobcategories/'.$jobcateogry->img_path)}}" alt="" class="mt-3" style="width: 50px;height:50">
                            @else    
                                <img src="" id="show_img" alt="" class="mt-3" style="width: 50px;height:50">
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Update</button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</x-admin-app-layout>
