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
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Employee Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'employee_id',
                            ['' => 'Select Employee'] + $employees->pluck('user.name', 'id')->toArray(),
                            old('employee_id', $asset->employee_id),
                            ['class' => 'form-control form-select select2', 'id' => 'employee'],
                        ) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('asset_name', 'Asset Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('asset_name', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('asset_code', 'Asset Code', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('asset_code', $asset->exists ? $asset->asset_code : sprintf('%04d', $employees->count() + 1), ['class' => 'form-control', 'required' => true, 'readonly']) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('assigned_date', 'Assigned Date', ['class' => 'form-label']) !!}
                        {!! Form::date('assigned_date', old('assigned_date', $asset->assigned_date), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('return_date', 'Return Date', ['class' => 'form-label']) !!}
                        {!! Form::date('return_date', old('return_date', $asset->return_date), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                        {!! Form::select(
                            'status',
                            ['' => 'Select Status'] + ['assigned'=> 'Assigned', 'not assigned' => 'Not Assigned', 'return' => 'Return'],
                            old('status', $asset->status),
                            ['class' => 'form-control form-select select2', 'id' => 'status'],
                        ) !!}
                    </div>
                   
                    <div class="col-12 col-md-3">
                        {!! Form::label('condition', 'Condition', ['class' => 'form-label']) !!}
                        {!! Form::select(
                            'condition',
                            ['' => 'Select Condition'] + ['new'=> 'New', 'used' => 'Used', 'broken' => 'Broken'],
                            old('condition', $asset->condition),
                            ['class' => 'form-control form-select select2', 'id' => 'condition'],
                        ) !!}
                    </div>
                    
                    <div class="col-12 col-md-3">
                        {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                        {!! Form::textarea('description', old('description', $asset->description), ['class' => 'form-control']) !!}
                    </div>

                    {{-- <div class="col-12 col-md-3">
                        {!! Form::label('name', 'Branch Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'branch_id',
                            ['' => 'Select Branch'] + $branches->pluck('name', 'id')->toArray(),
                            old('branch_id', $asset->branch_id),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'branch',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('country', 'Country', ['class' => 'form-label']) !!}
                        {!! Form::text('country', old('country', optional($asset->country)->name), [
                            'class' => 'form-control',
                            'id' => 'country',
                            'readonly' => 'true',
                        ]) !!}
                    </div>

                    <div class="col-12 col-md-3">
                        {!! Form::label('city', 'City', ['class' => 'form-label']) !!}
                        {!! Form::text('city', old('country', optional($asset->city)->name), [
                            'class' => 'form-control',
                            'id' => 'city',
                            'readonly' => 'true',
                        ]) !!}
                    </div> --}}

                    <div class="demo-inline-spacing">
                        {!! Form::submit($asset->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
