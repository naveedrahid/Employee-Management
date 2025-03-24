@if ($checkOut && empty($checkOut->check_out))
    <li class="nav-item check_in_check_out"><a href="{{ route('backend.attendance.checkOut') }}" id="checkOut"
            class="btn btn-primary m-0">{{ __('Check Out') }}</a></li>
@endif
@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#checkOut', function(e) {
                e.preventDefault();

                const checkInRoute = @json(route('backend.attendance.checkIn'));
                const checkInText = @json(__('Check In'));

                const checkInButton = `<a href="${checkInRoute}" id="checkIn"
                class="btn btn-primary m-0">${checkInText}</a>`;

                const url = $(this).attr('href');
                const token = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData();
                formData.append('_token', token);

                const button = $('.check_in_check_out').prop('disabled', true).text('Checking Out...');

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
                        $('#checkOut').remove();
                        button.prop('disabled', false).text('');
                        $('.check_in_check_out').append(checkInButton);
                    })
                    .fail(function(xhr) {
                        button.prop('disabled', false).text('Check Out');
                        toastr.error(xhr.responseJSON.message);
                    });
            });
        });
    </script>
@endpush
