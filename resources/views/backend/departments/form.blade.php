@section('title', 'Department')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Create New Department') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.department.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($department, [
                    'url' => $department->exists
                        ? route('backend.department.update', $department->id)
                        : route('backend.department.store'),
                    'method' => $department->exists ? 'PUT' : 'POST',
                    'id' => $department->exists ? 'departmentUpdate' : 'departmentCreate',
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Department Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Branch Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'branch_id',
                            ['' => 'Select Branch'] + $branches->pluck('name', 'id')->toArray(),
                            old('branch_id', $department->branch_id),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'branch',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('country', 'Country', ['class' => 'form-label']) !!}
                        {!! Form::text('country', old('country', optional($department->country)->name), [
                            'class' => 'form-control',
                            'id' => 'country',
                            'readonly' => 'true',
                        ]) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('city', 'City', ['class' => 'form-label']) !!}
                        {!! Form::text('city', old('country', optional($department->city)->name), [
                            'class' => 'form-control',
                            'id' => 'city',
                            'readonly' => 'true',
                        ]) !!}
                    </div>

                    <div class="demo-inline-spacing">
                        {!! Form::submit($department->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @push('js')
        {{-- Load branch with country & city --}}
        <script>
            $(document).ready(function() {
                $('#branch').on('change', function() {
                    let branchId = $(this).val();
                    let branches = @json($branches);

                    if (branchId) {
                        let selectedBranch = branches.find(branch => branch.id == branchId);
                        $('#country').val(selectedBranch.country.name);
                        $('#city').val(selectedBranch.city.name);
                    } else {
                        $('#country').val('');
                        $('#city').val('');
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $(document).on('submit', '#departmentCreate , #departmentUpdate', function (e) {
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
                    .done(function (response) {
                        loadingSpinner.hide();
                        button.prop('disabled', false);
                        toastr.success(response.message || 'Department created successfully.');
                        if (form.attr('id') === 'departmentCreate') {
                            form[0].reset();
                        }
                    })
                    .fail(function (xhr) {
                        handleAjaxError(xhr);
                    })
                    .always(function () {
                        button.prop('disabled', false);
                        loadingSpinner.hide();
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
