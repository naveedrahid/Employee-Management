@section('title', 'Employee Salary')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Employee Salaries') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.employee_salary.create') }}" class="btn btn-secondary">{{ __('Add Salary') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('Salary') }}</th>
                            <th>{{ __('Commision') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($employee_salaries as $employee_salary)
                            <tr>
                                <td>{{ $employee_salary->employee->user->name }}</td>
                                <td>{{ $employee_salary->basic_salary }}</td>
                                <td>{{ $employee_salary->commission_type }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.employee_salary.edit', $employee_salary->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.employee_salary.destroy', $employee_salary->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Employee Salary Found') }}</td>
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
                /* Delete Branch */
                $('.deleteRow').on('click', function (e) {
                    e.preventDefault();

                    const instance = $(this);
                    const url = instance.attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this Employee Salary?')) {
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