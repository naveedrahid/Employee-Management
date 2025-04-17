@section('title', 'Expenses')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Expenses') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.expense.create') }}" class="btn btn-secondary">{{ __('Add New Expense') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Hand By') }}</th>
                            <th>{{ __('Oppening Balance') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @forelse ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->title }}</td>
                                <td>{{ $expense->employee->user->name }}</td>
                                <td>{{ $expense->opening_balance }}</td>
                                <td>{{ $expense->notes }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.expense.edit', $expense->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.expense.destroy', $expense->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Expense Found!') }}</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            // $(document).ready(function() {
            //     $('.deleteRow').on('click', function (e) {
            //         e.preventDefault();

            //         const instance = $(this);
            //         const url = instance.attr('href');
            //         const token = $('meta[name="csrf-token"]').attr('content');

            //         if (confirm('Are you sure you want to delete this Cash Register?')) {
            //             $('#loadingSpinner').show();
                        
            //             $.ajax({
            //                 url: url,
            //                 method: 'DELETE',
            //                 headers: {
            //                     'X-CSRF-TOKEN': token
            //                 },
            //             })
            //             .done(function(response) {
            //                 setTimeout(() => {
            //                     $('#loadingSpinner').hide();
            //                     toastr.success(response.message);
            //                 }, 1000);
            //                 instance.closest('tr').fadeOut('slow', function() {
            //                     $(this).remove();
            //                 });
            //             })
            //             .fail(function(xhr) {
            //                 $('#loadingSpinner').hide();
            //                 handleAjaxError(xhr);
            //             })
            //             .always(function() {
            //                 $('#loadingSpinner').hide();
            //             });
            //         }
            //     });
            // });
        </script>
    @endpush
</x-app-layout>