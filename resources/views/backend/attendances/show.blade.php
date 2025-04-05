@section('title', 'Attendance Report')

<x-app-layout>
    <x-calendar-grid 
        :month="$month" 
        :year="$year" 
        :dates="$dates" 
        :statuses="$statuses" 
        :checkIns="$checkIns" 
        :checkOuts="$checkOuts" 
    />
</x-app-layout>