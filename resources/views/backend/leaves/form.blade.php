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
                    'url' => $leave->exists ? route('backend.leave.update', $leave->id) : route('backend.leave.store'),
                    'method' => $leave->exists ? 'PUT' : 'POST',
                    'id' => $leave->exists ? 'leaveUpdate' : 'leaveCreate',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 mb-3 col-md-4">
                        {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        @if (auth()->user()->hasRole('super-admin'))
                            {!! Form::select(
                                'employee_id',
                                ['' => 'Select Type'] + $users->pluck('name', 'id')->toArray(),
                                old('employee_id', $leave->employee_id),
                                [
                                    'class' => 'form-control form-select select2',
                                    'required' => true
                                ],
                            ) !!}
                        @else
                            {!! Form::hidden('employee_id', $users->first()?->id) !!}
                            {!! Form::text('employee_id', auth()->user()->name, ['class' => 'form-control', 'readonly']) !!}
                        @endif
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        {!! Form::label('name', 'Leave Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'leave_status',
                            ['' => 'Select Status'] + [
                                'full day' => 'Full Day',
                                'half day' => 'Half Day',
                                'many days' => 'Many Days',
                            ],
                            old('leave_status', $leave->leave_status),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'leave_status',
                                'required' => true
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        {!! Form::label('name', 'Leave Type', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'leave_type_id',
                            ['' => 'Select Leave Type'] + $leave_type_id->pluck('category', 'id')->toArray(),
                            old('leave_type_id', $leave->leave_type_id),
                            [
                                'class' => 'form-control form-select select2',
                                'required' => true
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-3 " id="start_date_col">
                        {!! Form::label('name', 'Start Date', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::date('start_date', old('start_date', $leave->start_date), [
                            'class' => 'form-control',
                            'id' => 'start_date',
                        ]) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-3" id="end_date_col">
                        {!! Form::label('name', 'End Date', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::date('end_date', old('end_date', $leave->end_date), [
                            'class' => 'form-control',
                            'id' => 'end_date',
                        ]) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-3">
                        {!! Form::label('name', 'Total Days', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::number('total_days', old('total_days', $leave->total_days ?? 0), [
                            'class' => 'form-control',
                            'min' => 0,
                            'step' => 1,
                            'id' => 'total_days',
                            'required' => true
                        ]) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-3">
                        {!! Form::label('name', 'Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'status',
                            [
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ],
                            old('status', $leave->status),
                            [
                                'class' => 'form-control form-select select2',
                                'required' => true
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 mb-3 col-md-12">
                        {!! Form::label('name', 'Reason', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::textarea('reason', old('reason', $leave->reason), [
                            'class' => 'form-control',
                            'required' => true
                        ]) !!}
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($leave->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
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
                flatpickr("#start_date , #end_date", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                function toggleDateFields() {
                    var status = $('#leave_status').val();
                    switch (status) {
                        case 'full day':
                            $('#start_date_col').show();
                            $('#start_date').prop('required', true);
                            $('#end_date_col').hide();
                            $('#total_days').val('0').prop('readonly', false)
                                .removeClass('form-control-plaintext').addClass('form-control');
                            break;
                        case 'half day':
                            $('#start_date').prop('required', false);
                            $('#end_date').prop('required', false);
                            $('#start_date_col').hide();
                            $('#end_date_col').hide()
                            $('#total_days').val(0.5).prop('readonly', true)
                                .addClass('form-control-plaintext').removeClass('form-control');
                            break;
                        case 'many days':
                            $('#start_date').prop('required', true);
                            $('#end_date').prop('required', true);
                            $('#start_date_col').show();
                            $('#end_date_col').show();
                            $('#total_days').val('0').prop('readonly', false)
                                .removeClass('form-control-plaintext').addClass('form-control');
                            break;
                        default:
                            $('#start_date_col, #end_date_col').hide();
                            $('#start_date').prop('required', false);
                            $('#end_date').prop('required', false);
                            $('#total_days').val('0').prop('readonly', false)
                                .removeClass('form-control-plaintext').addClass('form-control');
                            break;
                    }
                }

                // Call function on load (in case of edit page)
                toggleDateFields();

                // Call function on change
                $('#leave_status').change(function() {
                    toggleDateFields();
                });
            });
        </script>

        {{-- Create & Update Ajax Script --}}

        <script>
            $(document).ready(function() {

                $(document).on('submit', '#leaveCreate , #leaveUpdate', function(e) {
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
                        'input[required], select[required], textarea[required], number[required]'
                    );

                    if (!isValid) {
                        toastr.error('Please fill all required fields.');
                        return false;
                    }

                    button.prop('disabled', true);
                    loadingSpinner.show();

                    $.ajax({
                            type: "POST",
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            button.prop('disabled', false);
                            if (self.attr('id') === 'leaveCreate') {
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
                            button.prop('disabled', false);
                            loadingSpinner.hide();
                        });
                });
            });
        </script>
    @endpush
</x-app-layout>
