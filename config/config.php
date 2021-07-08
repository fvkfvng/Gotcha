<?php
    // date thai

    function dateTh($date)
    {
        $date = explode("-", $date);

        $d = $date[2];
        $month = $date[1];

        if ($month == '01') {
            $m = 'ม.ค.';
        } elseif ($month == '02') {
            $m = 'ก.พ.';
        } elseif ($month == '03') {
            $m = 'มี.ค.';
        } elseif ($month == '04') {
            $m = 'เม.ย.';
        } elseif ($month == '05') {
            $m = 'พ.ค.';
        } elseif ($month == '06') {
            $m = 'มิ.ย.';
        } elseif ($month == '07') {
            $m = 'ก.ค.';
        } elseif ($month == '08') {
            $m = 'ส.ค.';
        } elseif ($month == '09') {
            $m = 'ก.ย.';
        } elseif ($month == '10') {
            $m = 'ต.ค.';
        } elseif ($month == '11') {
            $m = 'พ.ย. ';
        } elseif ($month == '12') {
            $m = 'ธ.ค.';
        }

        $y = $date[0] + 543;

        return $d.' '.$m.' '.$y;
    }
?>