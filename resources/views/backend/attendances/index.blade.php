@section('title', 'Employee Salary')
<x-app-layout>
    @foreach ($attendances as $attendance)
    <a href="{{ route('backend.attendance.show', $attendance->id) }}">asdasad</a>
    @endforeach
</x-app-layout>