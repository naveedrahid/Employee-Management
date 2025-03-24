@section('title', 'Employee Salary')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Employee Salary') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.employee_salary.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($employee_salary, [
                    'url' => $employee_salary->exists
                        ? route('backend.employee_salary.update', $employee_salary->id)
                        : route('backend.employee_salary.store'),
                    'method' => $employee_salary->exists ? 'PUT' : 'POST',
                    'id' => $employee_salary->exists ? 'salaryUpdate' : 'salaryCreate',
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Basic Salary', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::number('basic_salary', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'employee_id',
                            ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                            old('employee_id', $employee_salary->employee_id),
                            ['class' => 'form-control form-select select2', 'id' => 'employee']
                        ) !!}
                    </div>

                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Commission Type', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'commission_type',
                            ['' => 'Select Commission Type'] + ['fixed' => 'Fixed', 'percentage' => 'Percentage', 'none' => 'None'],
                            old('commission_type', $employee_salary->commission_type),
                            ['class' => 'form-control form-select select2', 'id' => 'commission_type']
                        ) !!}
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($employee_salary->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

     @push('js')
        <script>
            $(document).ready(function () {
                $(document).on('submit','#salaryCreate , #salaryUpdate', function (e) {
                    e.preventDefault();

                    const form = $(this);
                    const formData = new FormData(form[0]);
                    const url = form.attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const loadingSpinner = $('#loadingSpinner');
                    const button = form.find('input[type="submit"]');
                    button.prop('disabled', true);
                    
                    loadingSpinner.show();

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .done(function(response) {
                        if (form.attr('id') === 'salaryCreate') {
                            form[0].reset();
                            form.find('select').each(function() {
                                $(this).val($(this).find('option:first').val()).trigger('change');
                            });
                        }

                        toastr.success(response.message);
                        loadingSpinner.hide();
                        button.prop('disabled', false);
                    })
                    .fail(function(xhr) {
                        handleAjaxError(xhr);
                        loadingSpinner.hide();
                        button.prop('disabled', false);
                    })
                    .always(function() {
                        loadingSpinner.hide();
                        button.prop('disabled', false);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
