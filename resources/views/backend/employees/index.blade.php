@section('title', 'Employees')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Employees') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.employee.create') }}"
                        class="btn btn-secondary">{{ __('Add Employee') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('email') }}</th>
                            <th>{{ __('Gender') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($employees as $employee)
                            <tr>
                                <td>
                                    <img src="{{ $employee->image ? asset('storage/' . $employee->image) : asset('admin/img/placeholder.jpg') }}"
                                        width="70" height="70" alt="" style="background-size: cover">
                                </td>
                                <td>{{ $employee->user->name }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->user->email }}</td>
                                <td>
                                    <div class="demo-inline-spacing">
                                        <span
                                            class="badge text-bg-{{ $employee->status == 'active' ? 'success' : 'danger' }}">{{ $employee->status }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.employee.edit', $employee->id) }}">
                                        <i class="icon-base bx bx-edit-alt text-white"></i>
                                    </a>
                                    <a class="btn btn-icon btn-danger deleteEmployee"
                                        href="{{ route('backend.employee.destroy', $employee->id) }}">
                                        <i class="icon-base bx bx-trash text-white"></i>
                                    </a>
                                    <a class="btn btn-icon btn-secondary"
                                        href="{{ route('backend.employee.show', $employee->id) }}">
                                        <i class="icon-base bx bx-low-vision text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Employees Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                $('.deleteEmployee').on('click', function(e) {
                    e.preventDefault();

                    const instance = $(this);
                    const url = instance.attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this Employee?')) {
                        $('#loadingSpinner').show();

                        $.ajax({
                                url: url,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': token
                                },
                            })
                            .done(function(response) {
                                setTimeout(() => {
                                    $('#loadingSpinner').hide();
                                    toastr.success(response.message);
                                }, 1000);
                                instance.closest('tr').fadeOut('slow', function() {
                                    $(this).remove();
                                });
                            })
                            .fail(function(xhr) {
                                $('#loadingSpinner').hide();
                                handleAjaxError(xhr);
                            })
                            .always(function() {
                                $('#loadingSpinner').hide();
                            });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
