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
                        $isWeekend = in_array($dayOfWeek, ['Saturday', 'Sunday']);
                        $isHoliday = isset($holidays[$date]);
                        $holidayName = $isHoliday ? $holidays[$date] : null;
                        $status = strtolower($record['status'] ?? '');
                    @endphp
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>
                            @if ($isWeekend)
                                Weekend ({{ $dayOfWeek }})
                            @elseif($isHoliday)
                             Holiday {{ $holidayName }}
                            @else
                                {{ \Carbon\Carbon::parse($date)->format('d M Y (D)') }}
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-btn bg-label-{{ 
                                $isWeekend ? 'secondary' :
                                ($isHoliday ? 'info' :
                                ($status === 'present' ? 'success' :
                                ($status === 'late' ? 'warning' :
                                ($status === 'half-day' ? 'dark' : 'danger'))))
                            }}">
                                {{ 
                                    $isWeekend ? 'Weekend' :
                                    ($isHoliday ? $holidayName :
                                    ($status ?: 'Absent'))
                                }}
                            </span>
                        </td>
                        <td>{{ $record['check_in'] ?? '' }}</td>
                        <td>{{ $record['check_out'] ?? '' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
