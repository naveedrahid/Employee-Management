<div class="container">
    <h3>Attendance Sheet - {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h3>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Status</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped as $employeeId => $data)
                @foreach ($dates as $date)
                    @php
                        $record = $data['records'][$date] ?? null;
                    @endphp
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($date)->format('d M Y (D)') }}</td>
                        <td>{{ $record['status'] ?? 'Absent' }}</td>
                        <td>{{ $record['check_in'] ?? '-' }}</td>
                        <td>{{ $record['check_out'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
