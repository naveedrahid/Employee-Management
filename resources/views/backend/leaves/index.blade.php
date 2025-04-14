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
                            <th width="20%">{{ __('Name') }}</th>
                            <th width="10%">{{ __('Start Date') }}</th>
                            <th width="10%">{{ __('End Date') }}</th>
                            <th width="5%">{{ __('Days') }}</th>
                            <th width="10%">{{ __('status') }}</th>
                            <th width="35%">{{ __('Reason') }}</th>
                            @if (auth()->user()->hasRole('super-admin'))
                                <th width="10%">{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>
                                    <p><strong>{{ $leave->employee->user->name ?? '' }}</strong></p>
                                    <p class="m-0"><strong><small>Slect Type</small></strong>:
                                        <small>{{ $leave->leaveType->category ?? '' }}</small></p>
                                    <p class="m-0"><strong><small>Leave Status</small></strong>:
                                        <small>{{ $leave->leave_status ?? '' }}</small></p>
                                </td>
                                <td>{{ $leave->start_date ?? '' }}</td>
                                <td>{{ $leave->end_date ?? '' }}</td>
                                <td>{{ $leave->total_days ?? '' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-{{ $leave->status == 'rejected' ? 'danger' : ($leave->status == 'approved' ? 'success' : 'warning') }} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ ucfirst($leave->status) }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item change-status" href="javascript:void(0);" data-id="{{ $leave->id }}" data-status="approved">Approve</a></li>
                                            <li><a class="dropdown-item change-status" href="javascript:void(0);" data-id="{{ $leave->id }}" data-status="rejected">Reject</a></li>
                                        </ul>
                                    </div>
                                </td>                                
                                <td>
                                    <p>{{ $leave->reason }}</p>
                                </td>
                                @if (auth()->user()->hasRole('super-admin'))
                                    <td>
                                        <a class="btn btn-icon btn-primary"
                                            href="{{ route('backend.leave.edit', $leave->id) }}"><i
                                                class="icon-base bx bx-edit-alt text-white"></i></a>
                                        <a class="btn btn-icon btn-danger deleteRow"
                                            href="{{ route('backend.leave.destroy', $leave->id) }}"><i
                                                class="icon-base bx bx-trash text-white"></i></a>
                                    </td>
                                @endif
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
    @push('js')
        <script>
            $(function () {
                $(document).on('click', '.change-status', function () {

                    const leaveId = $(this).data('id');
                    const status = $(this).data('status');
                    const loading = $('#loadingSpinner');
                    const button = $(this).closest('.btn-group').find('.dropdown-toggle');
                    
                    button.prop('disabled', true);
                    loading.show();
                    
                    $.ajax({
                        url: '/backend/leaves/' + leaveId + '/change-status',
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                    })
                    .done(function (response) {   
                        if (response.status === 'approved') {
                            button.removeClass('btn-warning').addClass('btn-success').text('Approved');
                        } else if (response.status === 'rejected') {
                            button.removeClass('btn-warning').addClass('btn-danger').text('Rejected');
                        }                     
                        loading.hide();
                        button.prop('disabled', false);
                        toastr.success(response.message);
                        
                    })
                    .fail(function (xhr) {
                        loading.hide();
                        handleAjaxError(xhr);
                    })
                    .always(function () {
                        loading.hide();
                        button.prop('disabled', false);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>