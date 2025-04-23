@section('title', 'Holidays')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{ __('Manage Holidays') }}</h5>
                <div class="card-header">
                    <a href="{{ route('backend.holiday.create') }}" class="btn btn-secondary">{{ __('Add Holiday') }}</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Holiday Name') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($holidays as $holiday)
                            <tr>
                                <td>{{ $holiday->name }}</td>
                                <td>{{ formatHolidayDate($holiday->date) }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status-toggle" data-id="{{ $holiday->id }}"
                                            {{ $holiday->status == 'active' ? 'checked' : '' }}>
                                        <span
                                            class="slider {{ $holiday->status == 'active' ? 'bg-success' : 'bg-danger' }}"></span>
                                    </label>
                                </td>
                                <td>{{ $holiday->description }}</td>
                                <td>
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('backend.holiday.edit', $holiday->id) }}"><i
                                            class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger deleteRow" href="javascript:void(0);"
                                        data-destroy="{{ $holiday->id }}"><i
                                            class="icon-base bx bx-trash text-white"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('No Holidays Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                /* background-color: #ff3e1d; */
                transition: .4s;
                border-radius: 34px;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked+.slider {
                /* background-color: #71dd37; */
            }

            input:checked+.slider:before {
                transform: translateX(26px);
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.status-toggle', function() {

                    const status = $(this).is(':checked') ? 'active' : 'inactive';
                    const id = $(this).data('id');
                    const $slider = $(this).next('.slider');
                    const loadingSpinner = $('#loadingSpinner');

                    loadingSpinner.show();

                    $.ajax({
                            url: "/backend/holidays/status/" + id,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: status,
                            },
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            if (status === 'active') {
                                $slider.removeClass('bg-danger').addClass('bg-success');
                            } else {
                                $slider.removeClass('bg-success').addClass('bg-danger');
                            }
                            toastr.success(response.message);
                        })
                        .fail(function(xhr, status, error) {
                            toastr.error('Error updating status. Please try again.');
                            loadingSpinner.hide();
                            console.error(xhr.responseText);
                        });

                });

                // Delete Row

                $(document).on('click', '.deleteRow', function(e) {
                    e.preventDefault();

                    const self = $(this);
                    const id = $(this).data('destroy');
                    const url = "{{ route('backend.holiday.destroy', ':id') }}".replace(':id', id);
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const loadingSpinner = $('#loadingSpinner');

                    if (confirm('Are you sure you want to delete this Holiday?')) {
                        loadingSpinner.show();

                        $.ajax({
                                type: "DELETE",
                                url: url,
                                headers: {
                                    'X-CSRF-TOKEN': token
                                },
                            })
                            .done(function(response) {
                                loadingSpinner.hide();
                                toastr.success(response.message);
                                self.closest('tr').fadeOut('slow', function() {
                                    self.remove();
                                });
                            })
                            .fail(function(xhr) {
                                loadingSpinner.hide();
                                handleAjaxError(xhr)
                            });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
