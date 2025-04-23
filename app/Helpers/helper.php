<?php

function FormatHolidayDate($dateStr)
{
    if (strpos($dateStr, 'to') !== false) {
        [$start, $end] = explode(' to ', $dateStr);
        $startDate = date('F j Y', strtotime($start));
        $endDate = date('F j Y', strtotime($end));
        return "$startDate To $endDate";
    } else {
        $singleDate = date('F j Y', strtotime($dateStr));
        return $singleDate;
    }
}
