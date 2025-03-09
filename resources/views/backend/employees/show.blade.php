@section('title', 'Employees')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Persnonal Detail</h4>
                        <div class="demo-inline-spacing mt-4">
                            <div class="list-group">
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Name') }}</strong>: {{ ucfirst($employee->user->name) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Email') }}</strong>: {{ $employee->user->email }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Nationality') }}</strong>: {{ $employee->country->name }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('City') }}</strong>: {{ $employee->city->name }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Address') }}</strong>: {{ $employee->address }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Marital Status') }}</strong>: {{ ucfirst($employee->marital_status) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Date of Birth') }}</strong>: {{ date("d F Y", strtotime($employee->date_of_birth)) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Company Detail</h4>
                        <div class="demo-inline-spacing mt-4">
                            <div class="list-group">
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Branch') }}</strong>: {{ ucfirst($employee->branch->name) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Branch Location') }}</strong>: {{ ucfirst($employee->branch->country->name) }} / {{ ucfirst($employee->branch->city->name) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Department') }}</strong>: {{ ucfirst($employee->department->name) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Designation') }}</strong>: {{ ucfirst($employee->position->name) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Position Level') }}</strong>: {{ ucfirst($employee->position_status) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Employment Status') }}</strong>: {{ ucfirst($employee->employment_type) }}</a>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><strong>{{ __('Joining Date') }}</strong>: {{ date("d F Y", strtotime($employee->joining_date)) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mt-5">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-6 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be
                                    certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check my-8 ms-2">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation">
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate
                                Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
