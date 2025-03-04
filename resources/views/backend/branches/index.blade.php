@section('title', 'Branches')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
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
                                    <a class="btn btn-icon btn-primary" href="{{ route('backend.branches.edit', $branch->id) }}"><i class="icon-base bx bx-edit-alt text-white"></i></a>
                                    <a class="btn btn-icon btn-danger" href="{{ route('backend.branches.destroy', $branch->id) }}"><i class="icon-base bx bx-trash text-white"></i></a>
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
</x-app-layout>