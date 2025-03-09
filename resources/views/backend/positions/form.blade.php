@section('title', 'Positions')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Positions') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.position.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($position, [
                    'url' => $position->exists ? route('backend.position.update', $position->id) : route('backend.position.store'),
                    'method' => $position->exists ? 'PUT' : 'POST',
                    'id' => $position->exists ? 'positionUpdate' : 'positionCreate',
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Positions Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Department Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'department_id',
                            ['' => 'Select Department'] + $departments,
                            old('department_id', $position->department_id),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'department',
                            ],
                        ) !!}
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($position->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#positionCreate , #positionUpdate', function(e) {
                    e.preventDefault();

                    const form = $(this);
                    const formData = new FormData(this);
                    const url = form.attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const button = $(this).find('input[type="submit"]');
                    const loadingSpinner = $("#loadingSpinner");
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
                            }
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            button.prop('disabled', false);
                            toastr.success(response.message || 'Positions created successfully.');
                            if (form.attr('id') === 'positionCreate') {
                                form[0].reset();
                            }
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
