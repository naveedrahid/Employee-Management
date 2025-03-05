@section('title', 'Branches')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Branches') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.branches.create') }}" class="btn btn-secondary">{{ __('Add Branch') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Branch Name') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('City') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($branches as $branch)
                            <tr>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->country->name }}</td>
                                <td>{{ $branch->city->name }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.branches.edit', $branch->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteBranch"
                                        href="{{ route('backend.branches.destroy', $branch->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">{{ __('No Branches Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            div#loadingSpinner {
                position: fixed;
                left: 0;
                right: 0;
                margin: auto;
                top: 0;
                bottom: 0;
                z-index: 99;
                background: #00000036;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            div#loadingSpinner i {
                color: #007bff;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                /* Delete Branch */
                $('.deleteBranch').on('click', function (e) {
                    e.preventDefault();

                    const instance = $(this);
                    const url = instance.attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this Branch?')) {
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
