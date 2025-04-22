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
                        $dayOfWeek = \Carbon\Carbon::parse($date)->format('l');
                    @endphp
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>
                            @if ($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday')
                                Weekend
                            @else
                                {{ \Carbon\Carbon::parse($date)->format('d M Y (D)') }}
                            @endif
                        </td>
                        <td>
                            @php
                                $isWeekend = in_array($dayOfWeek, ['Saturday', 'Sunday']);
                                $status = strtolower($record['status'] ?? ''); // lowercase for consistent matching
                            @endphp
                        
                            <span class="badge badge-btn bg-label-{{ 
                                $isWeekend ? 'secondary' :
                                ($status === 'leave' ? 'info' :
                                ($status === 'present' ? 'success' :
                                ($status === 'late' ? 'warning' :
                                ($status === 'half-day' ? 'dark' : 'danger'))))
                            }}">
                                {{ $isWeekend ? 'Weekend' : ($status ?: 'Absent') }}
                            </span>
                        </td>
                        <td>{{ $record['check_in'] ?? '-' }}</td>
                        <td>{{ $record['check_out'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
