<x-app-layout>
    <x-employer-layout>
        <div class="card rounded-0 mt-3">
            <div class="card-header">
                <div class="title">
                    <h4>{{__('Post Job')}}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('company.createjob') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <table class="table table-borderless ">
                        <tr>
                            <th></th>
                            <td>
                                @if (Session::has('created'))
                                    <div class="alert alert-success">
                                        {{ Session::get('created') }}
                                    </div>
                                @endif
                                @if (Session::has('notcreated'))
                                    <div class="alert alert-success">
                                        {{ Session::get('notcreated') }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Company Image')}} </th>
                            <td>
                                <input type="file" name="cover_img" id="cover_img" class="form-control">
                                @error('cover_img')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            @php
                                $lang = app()->getLocale();
                            @endphp
                            <th style="width: 200px;">{{__('Job Category')}}</th>
                            <th>
                                <select name="job_category" id="job_category" class="form-select">
                                    <option value="">{{__('Select a category')}}</option>
                                    @foreach ($job_categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('job_category') == $item->id ? 'selected' : '' }}>{{ ($item->{'name_'.$lang}) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('job_category')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Job Type')}}</th>
                            <th>
                                <select name="job_type" id="job_type" class="form-select">
                                    <option value="">{{__('Select a type')}}</option>
                                    @foreach ($job_types as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('job_type') == $item->id ? 'selected' : '' }}>{{ ($item->{'name_'.$lang}) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('job_type')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Title for your Job')}}</th>
                            <th>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                @error('title')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Job Description')}}</th>
                            <th>
                                <textarea name="job_description" id="summernote" 
                                    class="form-control">{{ old('job_description') }}</textarea>
                                @error('job_category')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Location')}}</th>
                            <th>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="country" placeholder="{{__('Country')}}" class="form-control"
                                            value="{{ old('country') }}">
                                        @error('country')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" name="city" placeholder="{{__('City')}}" class="form-control"
                                            value="{{ old('city') }}">
                                        @error('city')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" name="zipcode" placeholder="{{__('Zip Code')}}" class="form-control"
                                            value="{{ old('zipcode') }}">
                                        @error('zipcode')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Salary Range')}}</th>
                            <th>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="min_salary" value="{{ old('min_salary') }}"
                                            class="form-control" placeholder="{{__('Min Salary')}}">
                                        @error('min_salary')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-1 pt-2 text-center">
                                        -
                                    </div>
                                    <div class="col">
                                        <input type="text" name="max_salary" value="{{ old('max_salary') }}"
                                            class="form-control" placeholder="{{__('Max Salary')}}">
                                        @error('max_salary')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Salary Type')}}</th>
                            <th>
                                <select name="salary_type" class="form-select">
                                    <option value="">{{__('Select Salary Type')}}</option>
                                    @foreach ($salary_types as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('salary_type') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('salary_type')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Experiance')}}</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="experiance" id="experiance" class="form-select">
                                            <option value="">{{__('Select Experiance')}}</option>
                                            @foreach ($experiances as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('experiance') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('experiance')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="min_experiance_year"
                                            value="{{ old('min_experiance_year') }}" class="form-control"
                                            placeholder="{{__('Minimum Experiance Years')}}">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">{{__('Job Functions')}}</th>
                            <th>
                                <input type="text" class="form-control" name="job_functions"
                                    value="{{ old('job_functions') }}" placeholder="{{__('human, resourse, hrm etc')}}.">
                                @error('job_category')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <label for="terms">
                                    <input type="checkbox" id="terms" name="terms"
                                        {{ old('terms') == 'on' ? 'checked' : '' }}>
                                    {{__('You agree to our Terms of Use and Privacy Policy and acknowledge that you are the rightful owner of this item and using Jobs to find a genuine buyer')}}.
                                </label>
                                @error('terms')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button class="btn btn-primary">{{__('Post Job')}}</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </x-employer-layout>
    <x-slot name="footer">
        <script>
            $(function () {
                // Summernote
                $('#summernote').summernote({
                    height:550,
                });
             })

        </script>
    </x-slot>
</x-app-layout>
