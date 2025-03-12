@section('title', 'Bank Details')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Bank Details') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.bank_detail.create') }}" class="btn btn-secondary">{{ __('Add Bank Detail') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Bank Name') }}</th>
                            <th>{{ __('Acc Number') }}</th>
                            <th>{{ __('Acc Title') }}</th>
                            <th>{{ __('Branch Code') }}</th>
                            <th>{{ __('Branch Name') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($bank_details as $bank_detail)
                            <tr>
                                <td>{{ $bank_detail->employee->user->name }}</td>
                                <td>{{ $bank_detail->bank_name }}</td>
                                <td>{{ $bank_detail->account_number }}</td>
                                <td>{{ $bank_detail->account_title }}</td>
                                <td>{{ $bank_detail->branch_code }}</td>
                                <td>{{ $bank_detail->branch_name }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.bank_detail.edit', $bank_detail->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.bank_detail.destroy', $bank_detail->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Bank Details Found') }}</td>
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
                $(document).on('click', '.deleteRow', function (e) {
                    e.preventDefault();

                    const instance = $(this);
                    const url = instance.attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this Bank Detail?')) {
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