@section('title', 'Employee Attendance')

<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Positions') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.attendance.create') }}"
                        class="btn btn-secondary">{{ __('Add Attendance') }}</a>
                </div>
            </div>
        </div>
        <div class="accordion mt-4" id="accordionExample">
            @foreach ($attendances as $date => $records)
                @php
                    $collapseId = 'accordion' . \Illuminate\Support\Str::slug($date);
                @endphp

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button type="button" class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                            data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                            {{ \Carbon\Carbon::parse($date)->format('d M Y (D)') }}
                        </button>
                    </h2>

                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Check In</th>
                                        <th>Check In Status</th>
                                        <th>Check Out</th>
                                        <th>Check Out Status</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->employee?->user?->name ?? 'N/A' }}</td>
                                            <td>{{ $record->check_in ?? '-' }}</td>
                                            <td>{{ ucfirst($record->check_in_status) ?? '-' }}</td>
                                            <td>{{ $record->check_out ?? '-' }}</td>
                                            <td>{{ ucfirst($record->check_out_status) ?? '-' }}</td>
                                            <td>{{ $record->ip_address ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
