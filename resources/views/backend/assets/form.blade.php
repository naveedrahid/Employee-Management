@section('title', 'Asset')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Asset') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.asset.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($asset, [
                    'url' => $asset->exists ? route('backend.asset.update', $asset->id) : route('backend.asset.store'),
                    'method' => $asset->exists ? 'PUT' : 'POST',
                    'id' => $asset->exists ? 'assetUpdate' : 'assetCreate',
                    'enctype' => 'multipart/form-data',
                    'novalidate' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::select(
                                'employee_id',
                                ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                                old('employee_id', $asset->employee_id),
                                ['class' => 'form-control form-select select2', 'id' => 'employee', 'required' => true],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('asset_name', 'Asset Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                            {!! Form::text('asset_name', null, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>
                    @if (!$asset->exists)
                        <div class="col-12 mb-3 col-md-4">
                            <div class="input-inner">
                                {!! Form::label('asset_code', 'Asset Code', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                                {!! Form::text('asset_code', $formattedCode, ['class' => 'form-control', 'required' => true, 'readonly']) !!}
                            </div>
                        </div>
                    @endif

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('assigned_date', 'Assigned Date', ['class' => 'form-label']) !!}
                            {!! Form::date('assigned_date', old('assigned_date', $asset->assigned_date), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('return_date', 'Return Date', ['class' => 'form-label']) !!}
                            {!! Form::date('return_date', old('return_date', $asset->return_date), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'status',
                                ['' => 'Select Status'] + ['assigned' => 'Assigned', 'not assigned' => 'Not Assigned', 'return' => 'Return'],
                                old('status', $asset->status),
                                ['class' => 'form-control form-select select2', 'id' => 'status'],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('condition', 'Condition', ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'condition',
                                ['' => 'Select Condition'] + ['new' => 'New', 'used' => 'Used', 'broken' => 'Broken'],
                                old('condition', $asset->condition),
                                ['class' => 'form-control form-select select2', 'id' => 'condition'],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('serial_number', 'Serial Number', ['class' => 'form-label']) !!}
                            {!! Form::text('serial_number', old('serial_number', $asset->serial_number), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-4">
                        <div class="input-inner">
                            {!! Form::label('model', 'Model', ['class' => 'form-label']) !!}
                            {!! Form::text('model', old('model', $asset->model), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('brand', 'Brand', ['class' => 'form-label']) !!}
                            {!! Form::text('brand', old('brand', $asset->brand), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <div class="input-inner">
                            {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-12 mb-3 col-md-12">
                        <div class="input-inner">
                            {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                            {!! Form::textarea('description', old('description', $asset->description), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($asset->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#assetCreate , #assetUpdate', function(e) {
                    e.preventDefault();

                    const self = this;
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
                        return;
                    }

                    loadingSpinner.show();
                    button.prop('disabled', true).text('Processing...');

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
                        loadingSpinner.hide();
                        button.prop('disabled', false).text('Submit');
                        if (self.id === 'assetCreate') {
                            $(self).trigger('reset');
                            $(self).find('select').each(function () {
                                $(this).val($(this).find('option:first').val()).trigger('change');
                            });
                        }
                        toastr.success(response.message || 'Form submitted successfully.');
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
