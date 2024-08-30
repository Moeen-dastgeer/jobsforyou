<x-admin-app-layout>
    <x-slot name="title">Add Quiz</x-slot>
    <x-slot name="contentHeader">
        <div class="col-sm-6">
            <h1 class="m-0">Quiz</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Quiz</a></li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </div><!-- /.col -->
    </x-slot>
    <x-slot name="footer">
        <script>
            $(document).ready(function(){
                $(document).on('submit', '#add_quiz', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url:'{{route("admin.quizzes.store")}}',
                        type:'POST',
                        data:new FormData(this),
                        processData:false,
                        contentType:false,
                        success:function(data){
                            $('.clean').html('');
                            jQuery.each(data.error, function(key, val) {
                                // console.log(val[0].replace(/.[0-9]/g,'').replace('_',' '));
                                $('#'+key.replace('.','')+'_error').html(val[0].replace(/.[0-9]/g,'').replace('_',' '));
                            });
                        }
                    });
                });
                $(document).on('click','.remove_question',function(e) {
                    e.preventDefault();
                    $(this).closest('.rowremove_question').remove();
                });
                var i = 2, j = 1;
                $('#add_question').on('click',function(e) {
                    e.preventDefault();
                    $('#question_list').prepend(`<hr><div class="rowremove_question"><div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question"> Question `+i+` <span class="text-danger">*</span></label>
                                    <input type="text" name="question[]" class="form-control" placeholder="Write Question">
                                    <p class="text-danger small clean" id="question`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="first_option[]" class="form-control" placeholder="Write first option">
                                    <p class="text-danger small clean" id="first_option`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="second_option[]" class="form-control" placeholder="Write second option">
                                    <p class="text-danger small clean" id="second_option`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="third_option[]" class="form-control" placeholder="Write third option">
                                    <p class="text-danger small clean" id="third_option`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="fourth_option[]" class="form-control" placeholder="Write fourth option">
                                    <p class="text-danger small clean" id="fourth_option`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="answer[]" class="form-control">
                                        <option value="">Select correct answer</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                    <p class="text-danger small clean" id="answer`+j+`_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-warning w-100 remove_question">Remove Question</button>
                                </div>
                            </div>
                        </div></div>`);
                        i = i + 1;
                        j = j + 1;
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
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-arrow-circle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- ./card-header  -->
                <form method="POST" id="add_quiz" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Quiz Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Quiz Name ( Required )">
                                    <p class="text-danger small clean" id="name_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="level">Level <span class="text-danger">*</span></label>
                                    <select name="level" id="level" class="form-control form-control-sm">
                                        <option value="">Select Quiz Level</option>
                                        <option value="Beginner level">Beginner level</option>
                                        <option value="Middle level">Middle level</option>
                                        <option value="High level">High level</option>
                                    </select>
                                    <p class="text-danger small clean" id="level_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration">Duration <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="duration" id="duration" placeholder="Quiz duration ( Required )">
                                    <p class="text-danger small clean" id="duration_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="img" id="img" style="height:auto;" class="form-control form-control-sm">
                                    <p class="text-danger small clean" id="img_error"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">Descriptin <span class="text-danger">*</span></label>
                                    <textarea name="desc" id="desc" class="form-control form-control-sm" id="desc" rows="3" placeholder="Write description"></textarea>
                                    <p class="text-danger small clean" id="desc_error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 text-center"><h5>Add Quiz Questions</h5></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question"> Question 1 <span class="text-danger">*</span></label>
                                    <input type="text" name="question[]" class="form-control" placeholder="Write Question">
                                    <p class="text-danger small clean" id="question0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="first_option[]" class="form-control" placeholder="Write first option">
                                    <p class="text-danger small clean" id="first_option0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="second_option[]" class="form-control" placeholder="Write second option">
                                    <p class="text-danger small clean" id="second_option0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="third_option[]" class="form-control" placeholder="Write third option">
                                    <p class="text-danger small clean" id="third_option0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="fourth_option[]" class="form-control" placeholder="Write fourth option">
                                    <p class="text-danger small clean" id="fourth_option0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="answer[]"  class="form-control">
                                        <option value="">Select correct answer</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                    <p class="text-danger small clean" id="answer0_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-danger w-100" id="add_question">Add More Question</button>
                                </div>
                            </div>
                        </div>
                        <div id="question_list"></div>
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
