@section('title', 'Leave')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Leave') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.leave.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($leave, [
                    'url' => $leave->exists
                        ? route('backend.leave.update', $leave->id)
                        : route('backend.leave.store'),
                    'method' => $leave->exists ? 'PUT' : 'POST',
                    'id' => $leave->exists ? 'leaveUpdate' : 'leaveCreate',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Leave Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    {{-- <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Leave Types', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'category',
                            ['' => 'Select Type'] + [
                                'sick' => 'Sick',
                                'earned' => 'Earned',
                                'unpaid' => 'Unpaid',
                                'maternity' => 'Maternity',
                                'paternity' => 'Paternity',
                                'religious' => 'Religious',
                                'annual' => 'Annual',
                            ],
                            old('category', $leave->category),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'category',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Maximum Days', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::number('max_days', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Aplicable For', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'aplicable_for',
                            ['' => 'Select Type'] + [
                                'all' => 'All',
                                'male' => 'Male',
                                'female' => 'Female',
                            ],
                            old('aplicable_for', $leave->aplicable_for),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'aplicable_for',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-3 my-4">
                        <label class="form-label">Gender Specific?</label><br>
                        <label class="switch">
                            <input type="hidden" name="gender_specific" value="0">
                            <input type="checkbox" name="gender_specific" value="1" {{ $leave->gender_specific ? 'checked' : '' }}>
                            >
                            <span class="slider round"></span>
                        </label>
                    </div> --}}

                    <div class="demo-inline-spacing">
                        {!! Form::submit($leave->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{-- @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#leaveTypeCreate , #leaveTypeUpdate', function (e) {
                    e.preventDefault();

                    const self = $(this);
                    const {url, token, formData, button, loadingSpinner} = getFormData(this);

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
                        method: "POST",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                    })
                    .done(function(response){
                        toastr.success(response.message);
                        loadingSpinner.hide();
                        button.prop('disabled', false);
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
    @endpush --}}
</x-app-layout>