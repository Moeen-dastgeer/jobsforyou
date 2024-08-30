<x-admin-app-layout>
    <x-slot name="title">Add Job Category</x-slot>
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Job Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Job Category</a></li>
                <li class="breadcrumb-item active">Add New</li>
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
                            <h4>Add New</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.jobcategories.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-arrow-circle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- ./card-header -->
                <form method="POST" action="{{ route('admin.jobcategories.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_en">Job Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name_en" id="name_en"
                                value="{{ old('name_en') }}" placeholder="Job Category Name En">
                            @error('name_en')
                                <div class="text-danger smal">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_fr">Job Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name_fr" id="name_fr"
                                value="{{ old('name_fr') }}" placeholder="Job Category Name ">
                            @error('name_fr')
                                <div class="text-danger smal">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="img">Image <span class="text-danger">*</span></label>
                            <input type="file" name="img" id="img" style="height:auto;"
                                class="form-control form-control-sm">
                            @error('img')
                                <div class="text-danger smal">{{ $message }}</div>
                            @enderror
                            <img src="" id="show_img" alt="" class="mt-3" style="width: 50px;height:50">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Save</button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</x-admin-app-layout>
