@section('title', 'Attendance Report')
{{-- @dd($attendances) --}}
    {{-- <h2>{{ $attendances->first()?->employee?->user?->name }} - Attendance</h2> --}}
    <x-app-layout>
        <x-calendar-grid
        :month="$month"
        :year="$year"
        :dates="$dates"
        :grouped="$grouped"
    />
    </x-app-layout>

