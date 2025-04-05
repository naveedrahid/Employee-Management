@if (empty($checkIn))
    <li class="nav-item check_in_check_out"><a href="{{ route('backend.attendance.checkIn') }}" id="checkIn"
            class="btn btn-primary m-0">{{ __('Check In') }}</a></li>
@endif
@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#checkIn', function(e) {
                e.preventDefault();

                // Laravel Se Route Aur Text Pass Karna
                const checkOutRoute = @json(route('backend.attendance.checkOut'));
                const checkOutText = @json(__('Check Out'));

                const checkOutButton = `<a href="${checkOutRoute}" id="checkOut"
            class="btn btn-primary m-0">${checkOutText}</a>`;

                const url = $(this).attr('href');
                const token = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData();
                formData.append('_token', token);
                const button = $('#checkIn');

                // Disable button aur text change karo
                button.prop('disabled', true).text('Checking In...');

                $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .done(function(response) {
                        toastr.success(response.message);
                        button.remove();
                        e
                        $('.check_in_check_out').append(checkOutButton);
                    })
                    .fail(function(xhr) {
                        button.prop('disabled', false).text('Check In');

                        if ($('#checkIn').length === 0) {
                            $('.check_in_check_out').html(`<a href="${url}" id="checkIn"
                            class="btn btn-primary m-0">Check In</a>`);
                        }

                        toastr.error(xhr.responseJSON.message);
                    });
            });
        });
    </script>
@endpush
