@section('title', 'Leaves')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Leaves') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.leave.create') }}" class="btn btn-secondary">{{ __('Add Leave') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Name') }}</th>
                            {{-- <th>{{ __('Slect Type') }}</th>
                            <th>{{ __('Leave Status') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Days') }}</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Action') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->user->name }}</td>
                                <td>{{ $leave->status }}</td>
                                {{-- <td>{{ $leave->branch->name }}</td>
                                <td>{{ $leave->country->name }}</td>
                                <td>{{ $leave->city->name }}</td> --}}
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.leave.edit', $leave->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.leave.destroy', $leave->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Leaves Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>