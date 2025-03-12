@section('title', 'Bank Details')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Bank Details') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.bank_detail.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($bank_detail, [
                    'url' => $bank_detail->exists
                        ? route('backend.bank_detail.update', $bank_detail->id)
                        : route('backend.bank_detail.store'),
                    'method' => $bank_detail->exists ? 'PUT' : 'POST',
                    'id' => $bank_detail->exists ? 'bankDetailUpdate' : 'bankDetailCreate',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        @if (isset($employee) && $employee->user)
                            {!! Form::text('bank_name', $employee->user->name, ['class' => 'form-control', 'required' => true, 'readonly']) !!}
                        @else
                            {!! Form::select(
                                'employee_id',
                                ['' => 'Select Employee'] + $employees->pluck('name', 'id')->toArray(),
                                old('employee_id', $bank_detail->employee_id),
                                [
                                    'class' => 'form-control form-select select2',
                                    'id' => 'employee',
                                ],
                            ) !!}
                        @endif

                    </div>

                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Bank Details Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('bank_name', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Account Number', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('account_number', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Account Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('account_title', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Branch Code', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('branch_code', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <div class="col-12 col-md-4 mb-4">
                        {!! Form::label('name', 'Branch Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('branch_name', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($bank_detail->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#bankDetailCreate , #bankDetailUpdate', function(e) {
                    e.preventDefault();

                    const self = $(this);
                    const {
                        url,
                        token,
                        formData,
                        button,
                        loadingSpinner
                    } = getFormData(this);

                    let isValid = requestValidationHandler('input[required], select[required]');

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
                            toastr.success(response.message || 'Form submitted successfully.');
                            if (self.attr('id') === 'bankDetailCreate') {
                                self[0].reset();
                            }
                            self.find('.is-invalid').removeClass('is-invalid');
                            self.find('.invalid-feedback').remove();
                        })
                        .fail(function(xhr) {
                            handleAjaxError(xhr)
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
