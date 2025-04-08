@section('title', 'Employee Attendance')

<x-app-layout>
    <div class="space-y-4">
        @foreach($employees as $employee)
            <div class="p-4 border rounded">
                <h3>{{ $employee->user->name }}</h3>
                <a href="{{ route('backend.attendance.show', $employee->id) }}" 
                   class="text-blue-600 hover:underline">
                    View Attendance
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>