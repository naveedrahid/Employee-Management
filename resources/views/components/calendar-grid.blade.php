<div class="container">
    <h3>Attendance Sheet - {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h3>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dates as $date)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($date)->format('d M Y (D)') }}</td>
                    <td>{{ $statuses[$date] ?? 'Absent' }}</td>
                    <td>{{ $checkIns[$date] ?? 'N/A' }}</td>
                    <td>{{ $checkOuts[$date] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>