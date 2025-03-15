@section('title', 'Leave Types')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Leave Types') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.leave_type.create') }}" class="btn btn-secondary">{{ __('Add Leave Type') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Leave Type Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Max Days') }}</th>
                            <th>{{ __('Gender Specific') }}</th>
                            <th>{{ __('Aplicable For') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($leave_types as $leave_type)
                            <tr>
                                <td>{{ $leave_type->name }}</td>
                                <td>{{ $leave_type->category }}</td>
                                <td>{{ $leave_type->max_days }}</td>
                                <td>{{ ($leave_type->gender_specific == 1) ? 'Yes' : 'No' }}</td>
                                <td>{{ $leave_type->aplicable_for }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.leave_type.edit', $leave_type->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.leave_type.destroy', $leave_type->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Leave Types Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {
                $(document).on('click','.deleteRow', function (e) {
                    e.preventDefault();

                    const instance = $(this);
                    const url = $(this).attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this record?')) {

                        $('#loadingSpinner').show();
                        $.ajax({
                            method: "DELETE",
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                        }).done(function (response) {
                            setTimeout(() => {
                                $('#loadingSpinner').hide();
                                toastr.success(response.message);
                            }, 1000);
                            instance.closest('tr').fadeOut('slow', function() {
                                $(this).remove();
                            });
                        })
                        .fail(function(xhr){
                            handleAjaxError(xhr);
                        })
                        .always(function(){
                            $('#loadingSpinner').hide();
                        });
                    }
                    
                });
            });
        </script>
    @endpush
</x-app-layout>