@section('title', 'Expense')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Add New Expense') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.expense.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($expense, [
                    'url' => $expense->exists ? route('backend.expense.update', $expense->id) : route('backend.expense.store'),
                    'method' => $expense->exists ? 'PUT' : 'POST',
                    'id' => $expense->exists ? 'expenseUpdate' : 'expenseCreate',
                    'enctype' => 'multipart/form-data',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::text('title', null, ['class' => 'form-control', 'required' => true]) !!}
                            <input type="hidden" name="cash_register_id" value="{{ $latestCashRegister }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('employee_id', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::select(
                                'employee_id',
                                ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                                old('employee_id', $expense->employee_id),
                                ['class' => 'form-control form-select select2', 'id' => 'employee', 'required' => true],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('amount', 'Amount', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::number('amount', null, ['class' => 'form-control', 'id' => 'amount', 'required' => true]) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::select(
                                'status',
                                ['' => 'Select Status'] + ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'],
                                old('status', $expense->status),
                                ['class' => 'form-control form-select select2', 'id' => 'employee', 'required' => true],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('approved_by', 'Approved By', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::select(
                                'approved_by',
                                ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                                old('approved_by', $expense->approved_by),
                                ['class' => 'form-control form-select select2', 'id' => 'employee', 'required' => true],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('receipt', 'Receipt', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::file('receipt', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('remaining_balance', 'Remaining Balance', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::number('remaining_balance', $lastExpense->remaining_balance, [
                                'class' => 'form-control',
                                'id' => 'remaining_balance',
                                'readonly' => true,
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-12">
                        {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="demo-inline-spacing">
                        {!! Form::submit($expense->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @push('js')
        <script>
            const latestRemainingBalance = @json($latestBalance);

            $(document).ready(function() {
                $('#amount').on('input', function() {
                    let amount = parseFloat($(this).val()) || 0;
                    let newRemaining = latestRemainingBalance - amount;

                    // Round to 2 decimal places
                    newRemaining = newRemaining.toFixed(2);

                    $('#remaining_balance').val(newRemaining);
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $(document).on('submit', '#expenseCreate , #expenseUpdate' , function (e) {
                    e.preventDefault();

                    const self = $(this);
                    let isValid = requestValidationHandler.call(self, 'input[required], select[required]');
                    
                    if (!isValid) {
                        toastr.error('Please fill all required fields.');
                        return;
                    }
                    
                    const {url, token, formData, button, loadingSpinner} = getFormData(self);

                    loadingSpinner.show();
                    button.prop('disabled', true).text('Processing...');

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
                    .done(function (response){
                        loadingSpinner.hide();
                        button.prop('disabled', false).text('Submit');
                        if (self.attr('id') === 'expenseCreate') {
                            self[0].reset();
                            self.find('select').each(function(){
                                $(this).val($(this).find('option:first').val()).trigger('change');
                            });
                        }
                        toastr.success(response.message);
                    })
                    .fail(function(xhr){
                        handleAjaxError(xhr);
                    })
                    .always(function(){
                        loadingSpinner.hide();
                        button.prop('disabled', false).text('Submit');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
