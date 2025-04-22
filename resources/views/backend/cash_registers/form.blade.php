@section('title', 'Cash Register')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Add New Petty Cash') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.cash_register.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($cash_register, [
                    'url' => $cash_register->exists
                        ? route('backend.cash_register.update', $cash_register->id)
                        : route('backend.cash_register.store'),
                    'method' => $cash_register->exists ? 'PUT' : 'POST',
                    'id' => $cash_register->exists ? 'cashRegisterUpdate' : 'cashRegisterCreate',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::text('title', null, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('employee_id', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::select(
                                'employee_id',
                                ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                                old('employee_id', $cash_register->employee_id),
                                ['class' => 'form-control form-select select2', 'id' => 'employee', 'required' => true],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('opening_balance', 'Opining Balance', ['class' => 'form-label']) !!}
                            {!! Form::number('opening_balance', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-12">
                        {!! Form::label('notes', 'Notes', ['class' => 'form-label']) !!}
                        {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}

                        <div class="demo-inline-spacing">
                            {!! Form::submit($cash_register->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        @push('js')
            <script>
                $(document).ready(function() {
                    $(document).on('submit', '#cashRegisterCreate , #cashRegisterUpdate', function(e) {
                        e.preventDefault();

                        const self = $(this);

                        const {
                            url,
                            token,
                            formData,
                            button,
                            loadingSpinner
                        } = getFormData(self);

                        let isValid = requestValidationHandler.call(self, 'input[required], select[required]');
                        if (!isValid) {
                            toastr.error('Please fill all required fields.');
                            return;
                        }

                        button.prop('disabled', true).text('Processing...');
                        loadingSpinner.show();

                        $.ajax({
                                type: "POST",
                                url: url,
                                data: formData,
                                processData: false,
                                contentType: false,
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                }
                            })
                            .done(function(response) {
                                loadingSpinner.hide();
                                button.prop('disabled', false).text('Submit');
                                if (self.attr('id') === 'cashRegisterCreate') {
                                    self[0].reset();
                                    self.find('select').each(function() {
                                        $(this).val($(this).find('option:first').val()).trigger(
                                            'change');
                                    });
                                }
                                toastr.success(response.message);
                            })
                            .fail(function(xhr) {
                                handleAjaxError(xhr);
                            })
                            .always(function() {
                                loadingSpinner.hide();
                                button.prop('disabled', false).text('Submit');
                            });
                    });
                });
            </script>
        @endpush
</x-app-layout>
