@section('title', 'Branch')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card position-relative">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">Create New Branch</h5>
                <div class="card-header">
                    <a href="{{ route('backend.branches.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($branch, [
                    'url' => $branch->exists ? route('backend.branches.update', $branch->id) : route('backend.branches.store'),
                    'method' => $branch->exists ? 'PUT' : 'POST',
                    'id' => $branch->exists ? 'branchUpdate' : 'branchCreate',
                ]) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        {!! Form::label('name', 'Branch Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-12 col-md-4">
                        {!! Form::label('country_id', 'Country', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'country_id',
                            ['' => 'Select Country'] + $countriesList,
                            old('country_id', $branch->country_id),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'country',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-4">
                        {!! Form::label('city_id', 'City Name', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::select(
                            'city_id',
                            ['' => 'Select City'] + ($citiesList[$branch->country_id] ?? []),
                            old('city_id', $branch->city_id),
                            [
                                'class' => 'form-control form-select select2',
                                'id' => 'city',
                            ],
                        ) !!}
                    </div>

                    <div class="col-12 col-md-12 mt-4">
                        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
                        {!! Form::textarea('address', old('address'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="demo-inline-spacing">
                        {!! Form::submit($branch->exists ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
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

                /* Create Branch / Update Branch */

                $(document).on('submit', '#branchCreate , #branchUpdate', function(e) {
                    e.preventDefault();

                    const form = $(this);
                    const formData = new FormData(this);
                    const url = $(this).attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const button = $(this).find('input[type="submit"]');
                    const loadingSpinner = $("#loadingSpinner");
                    button.prop('disabled', true);
                    loadingSpinner.show();
                    
                    $.ajax({
                            url: url,
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .done(function(response) {
                            loadingSpinner.hide();
                            button.prop('disabled', false);
                            toastr.success(response.message || 'Branch created successfully.');
                            if (form.attr('id') === 'branchCreate') {
                                form[0].reset();
                            }
                        })
                        .fail(function(xhr) {
                            handleAjaxError(xhr);
                        })
                        .always(function() {
                            button.prop('disabled', false);
                            loadingSpinner.hide();
                        });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                const cities = @json($citiesList);

                function populateCities(countryId, selectedCityId = null) {
                    const countryCities = cities[countryId] || {};
                    const $citySelect = $('#city');
                    $citySelect.empty().append(new Option('Select City', ''));

                    $.each(countryCities, function(cityId, cityName) {
                        $citySelect.append(new Option(cityName, cityId));
                    });

                    if (selectedCityId) {
                        $citySelect.val(selectedCityId);
                    }
                }

                const initialCountryId = $('#country').val();
                const initialCityId = '{{ old('city_id', $branch->city_id) }}';
                if (initialCountryId) {
                    populateCities(initialCountryId, initialCityId);
                }

                $('#country').on('change', function() {
                    const countryId = $(this).val();
                    populateCities(countryId);
                });
            });
        </script>
    @endpush
</x-app-layout>
