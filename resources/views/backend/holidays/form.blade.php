@section('title', 'Holiday')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Add New Holiday') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.holiday.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($holiday, [
                    'url' => $holiday->exists ? route('backend.holiday.update', $holiday->id) : route('backend.holiday.store'),
                    'method' => $holiday->exists ? 'PUT' : 'POST',
                    'id' => $holiday->exists ? 'holidayUpdate' : 'holidayCreate',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('name', 'Holiday Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('date', 'Date', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::text('date', old('date', $holiday->date), ['class' => 'form-control', 'id' => 'holidayDate', 'required' => true]) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-12">
                        {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="demo-inline-spacing">
                        {!! Form::submit($holiday->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
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
                flatpickr("#holidayDate", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $(document).on('submit', '#holidayCreate , #holidayUpdate', function(e) {
                    e.preventDefault();

                    const self = $(this);

                    const isValid = requestValidationHandler.call(self,
                        'input[required], select[required], textarea[required]',
                    );

                    if (!isValid) {
                        toastr.error('Please fill all required fields.');
                        return;
                    }

                    const {
                        url,
                        token,
                        formData,
                        button,
                        loadingSpinner
                    } = getFormData(this);
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
                            },
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            button.prop('disabled', false).text('Submit');
                            if (self.attr('id') === 'holidayCreate') {
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
