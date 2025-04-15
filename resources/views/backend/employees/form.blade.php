@section('title', 'Account')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('backend.employee.create') }}"><i
                                    class="icon-base bx bx-user icon-sm me-1_5"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.employee.create') }}"><i
                                    class="icon-base bx bx-bell icon-sm me-1_5"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.employee.create') }}"><i
                                    class="icon-base bx bx-link-alt icon-sm me-1_5"></i> Connections</a>
                        </li>
                    </ul>
                </div>
                <div class="card mb-6">
                    <!-- Account -->
                    <div class="card-body pt-4 position-relative">
                        {!! Form::model($employee, [
                            'url' => $employee->exists ? route('backend.employee.update', $employee->id) : route('backend.employee.store'),
                            'method' => $employee->exists ? 'PUT' : 'POST',
                            'id' => $employee->exists ? 'employeeUpdate' : 'employeeCreate',
                            'enctype' => 'multipart/form-data',
                            'novalidate' => true,
                        ]) !!}

                        @csrf

                        <div id="loadingSpinner" style="display: none; text-align: center;">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                        </div>

                        <div class="row g-6">
                            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                <img src="{{ asset('admin/img/placeholder.jpg') }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                                        {!! Form::file('image', ['class' => 'account-file-input', 'id' => 'upload', 'hidden' => true]) !!}
                                    </label>
                                    <div>Allowed JPG, Wepb or PNG.</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'user_id',
                                        ['' => 'Select Employee'] + $employeeData['users']->pluck('name', 'id')->toArray(),
                                        old('user_id', $employee->user_id),
                                        ['class' => 'select2 form-select', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Branch Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'branch_id',
                                        ['' => 'Select Branch'] + $employeeData['branches']->pluck('name', 'id')->toArray(),
                                        old('branch_id', $employee->branch_id ?? ''),
                                        ['class' => 'select2 form-select', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Department Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'department_id',
                                        ['' => 'Select Branch'] + $employeeData['departments']->pluck('name', 'id')->toArray(),
                                        old('department_id', $employee->department_id ?? ''),
                                        ['class' => 'select2 form-select', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Position Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'position_id',
                                        ['' => 'Select Position'] + $employeeData['positions']->pluck('name', 'id')->toArray(),
                                        old('position_id', $employee->position_id ?? ''),
                                        ['class' => 'select2 form-select', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Country Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'country_id',
                                        ['' => 'Select Country'] + $employeeData['countries']->pluck('name', 'id')->toArray(),
                                        old('country_id', $employee->country_id ?? ''),
                                        ['class' => 'select2 form-select', 'id' => 'country', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'City Name', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'city_id',
                                        ['' => 'Select City'] + $employeeData['cities']->pluck('name', 'id')->toArray(),
                                        old('city_id', $employee->city_id ?? ''),
                                        ['class' => 'select2 form-select', 'id' => 'city', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Employment Type', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'employment_type',
                                        ['' => 'Select Employment'] + [
                                            'full-time' => 'Full Time',
                                            'part-time' => 'Part Time',
                                            'contract' => 'Contract',
                                            'probationary' => 'Probationary',
                                        ],
                                        old('employment_type', $employee->employment_type),
                                        ['class' => 'form-control form-select select2', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Position Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'position_status',
                                        ['' => 'Select Position'] + [
                                            'intern' => 'Intern',
                                            'junior' => 'Junior',
                                            'senior' => 'Senior',
                                            'lead' => 'Lead',
                                        ],
                                        old('position_status', $employee->position_status),
                                        ['class' => 'form-control form-select select2', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Joining Date', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::text('joining_date', old('joining_date', $employee->joining_date), [
                                        'class' => 'form-control',
                                        'id' => 'joining_date',
                                        'required' => true,
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Date of birth', ['class' => 'form-label']) !!} (<small class="text-warning">Optinal</small>)
                                    {!! Form::text('dob', old('dob', $employee->dob), [
                                        'class' => 'form-control',
                                        'id' => 'dob',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Address', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::textarea('address', old('address', $employee->address), [
                                        'class' => 'form-control',
                                        'required' => true,
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Gender', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'gender',
                                        ['' => 'Select Gender'] + [
                                            'male' => 'Male',
                                            'female' => 'Female',
                                            'other' => 'Other',
                                        ],
                                        old('gender', $employee->gender),
                                        ['class' => 'form-control form-select select2', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Marital Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'marital_status',
                                        ['' => 'Select Marital Status'] + [
                                            'married' => 'Married',
                                            'single' => 'Single',
                                            'divorced' => 'Divorced',
                                            'widowed' => 'Widowed',
                                        ],
                                        old('marital_status', $employee->marital_status),
                                        ['class' => 'form-control form-select select2', 'required' => true],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="input-inner">
                                    {!! Form::label('name', 'Employee Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'status',
                                        ['' => 'Select Status'] + [
                                            'active' => 'Active',
                                            'inactive' => 'Inactive',
                                        ],
                                        old('status', $employee->status),
                                        ['class' => 'form-control form-select select2', 'required' => true],
                                    ) !!}
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            {!! Form::submit($employee->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary me-3']) !!}
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                $(document).on('submit', '#employeeCreate , #employeeUpdate', function(e) {
                    e.preventDefault();

                    const self = $(this);
                    const {
                        url,
                        token,
                        formData,
                        button,
                        loadingSpinner
                    } = getFormData(this);

                    let isValid = requestValidationHandler.call(self,
                        'input[required], select[required], textarea[required]'
                    );

                    if (!isValid) {
                        toastr.error('Please fill all required fields.');
                        return false;
                    }

                    button.prop('disabled', true);
                    loadingSpinner.show();

                    $.ajax({
                            url: url,
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            button.prop('disabled', false);
                            if (self.attr('id') === 'employeeCreate') {
                                self[0].reset();
                                self.find('select').each(function() {
                                    $(this).val($(this).find('option:first').val()).trigger(
                                        'change');
                                });
                            }
                            toastr.success(response.message || 'Form submitted successfully.');
                        })
                        .fail(function(xhr) {
                            handleAjaxError(xhr);
                        })
                        .always(function() {
                            button.prop('disabled', false);
                            loadingSpinner.hide();
                        });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                const cities = @json($employeeData['cities']);

                let cityMap = {};
                cities.forEach(city => {
                    if (!cityMap[city.country_id]) {
                        cityMap[city.country_id] = [];
                    }
                    cityMap[city.country_id].push({
                        id: city.id,
                        name: city.name
                    });
                });

                $('#city').prop('disabled', true);

                function populateCities(countryId, selectedCityId = null) {
                    const $citySelect = $('#city');
                    $citySelect.empty().append(new Option('Select City', ''));

                    if (cityMap[countryId]) {
                        cityMap[countryId].forEach(city => {
                            $citySelect.append(new Option(city.name, city.id));
                        });

                        $citySelect.prop('disabled', false);
                    } else {
                        $citySelect.prop('disabled', true);
                    }

                    if (selectedCityId) {
                        $citySelect.val(selectedCityId);
                    }
                }

                $('#country').on('change', function() {
                    const countryId = $(this).val();
                    populateCities(countryId);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                flatpickr("#joining_date , #dob", {
                    dateFormat: "Y-m-d",
                });

                $('#upload').change(function(e) {
                    let file = e.target.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#uploadedAvatar').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
