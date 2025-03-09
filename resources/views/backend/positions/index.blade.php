@section('title', 'Positions')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Positions') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.position.create') }}" class="btn btn-secondary">{{ __('Add Position') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Position Name') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($positions as $position)
                            <tr>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->department->name }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.position.edit', $position->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow"
                                        href="{{ route('backend.position.destroy', $position->id) }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Positions Found') }}</td>
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
                $(document).on('click','.deleteRow' , function (e) {
                    e.preventDefault();

                    const self = $(this);
                    const url = $(this).attr('href');
                    const token = $('meta[name="csrf-token"]').attr('content');

                    if (confirm('Are you sure you want to delete this Position?')) {
                        $('#loadingSpinner').show();
                        
                        $.ajax({
                            url: url,
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                        })
                        .done(function(response){
                            setTimeout(() => {
                                $('#loadingSpinner').hide();
                                toastr.success(response.message);
                                self.closest('tr').fadeOut('slow', function(){
                                    self.remove();
                                });
                            }, 1000);
                        })
                        .fail(function(xhr){
                            $('#loadingSpinner').hide();
                            handleAjaxError(xhr)
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