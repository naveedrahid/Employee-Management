<x-app-layout>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permissions
                            @can('create permission')
                                <a href="{{ url('backend/permissions/create') }}" class="btn btn-primary float-end">Add Permission</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @can('update permission')
                                                <a href="{{ url('backend/permissions/' . $permission->id . '/edit') }}"
                                                    class="btn btn-success">Edit</a>
                                            @endcan

                                            @can('delete permission')
                                                <a href="{{ url('backend/permissions/' . $permission->id . '/delete') }}"
                                                    class="btn btn-danger mx-2">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>