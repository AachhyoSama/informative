<?php

use App\NepaliCalender\NepaliCalendar;

function getLangValue($value)
{
    if (!$value) {
        return null;
    }
    if (app()->getLocale() == 'np') {
        return $value['np'];
    }
    return $value['en'];
}

    //Nep to eng dateeng('2076-12-30') or dateeng(2076-12-30',true) for leading 0 & false for not leading 0
    function dateeng($date, $lead = true)
    {
        $lib = new NepaliCalendar();
        $date = str_replace('/', '-', $date);
        $a = explode("-", $date);
        $b = explode(" ", $a[2]);
        $cd = $lib->nep_to_eng($a[0], $a[1], $b[0]);
        $cd = (array)$cd;
        if ($lead == false) { //return the leading zero date
            return $cd['year'] . "-" . $cd['month'] . "-" . $cd['date'];
        } else {
            ($cd['month'] > 9) ? $m = $cd['month'] : $m = "0" . $cd['month'];
            ($cd['date'] > 9) ? $d = $cd['date'] : $d = "0" . $cd['date'];
            return $cd['year'] . "-" . $m . "-" . $d;
        }
    }

    function datenep($date, $num_date = null)
    {
        $lib = new NepaliCalendar();
        $date = str_replace('/', '-', $date);
        $a = explode("-", $date);
        $b = explode(" ", $a[2]);
        $cd = $lib->eng_to_nep($a[0], $a[1], $b[0]);
        $cd = (array)$cd;
        if ($num_date == true) {
            return $cd['year'] . " " . $cd['nmonth'] . " " . $cd['date'] . " गते " . $cd['day'];
        } else {
            (getStandardNumber($cd['month']) > 9) ? $m = $cd['month'] : $m = "0" . $cd['month'];
            (getStandardNumber($cd['date']) > 9) ? $d = $cd['date'] : $d = "0" . $cd['date'];
            return getStandardNumber($cd['year'] . "-" . $m . "-" . $d);
        }
    }
    //get standarrd number
    function getStandardNumber($input)
    {
        $nepali_numsets = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        $standard_numsets = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $result = str_replace($nepali_numsets, $standard_numsets, $input);
        return strtoupper(trim($result));
    }

    function nepaliMonth($number)
    {
        $calender = new NepaliCalendar();
        return $calender->get_month_nepali($number);
    }

    function nepaliNumber($number)
    {
        $calender = new NepaliCalendar();
        return $calender->ENG_TO_NEP_NUM($number);
    }

