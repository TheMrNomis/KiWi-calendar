<?php
$days = array(
    1 => "Lun",
    2 => "Mar",
    3 => "Mer",
    4 => "Jeu",
    5 => "Ven",
    6 => "Sam",
    7 => "Dim"
);

$daysFull = array(
    1 => "Lundi",
    2 => "Mardi",
    3 => "Mercredi",
    4 => "Jeudi",
    5 => "Vendredi",
    6 => "Samedi",
    7 => "Dimamche"
);

$months = array(
    1 => "Janvier",
    2 => "Fevrier",
    3 => "Mars",
    4 => "Avril",
    5 => "Mai",
    6 => "Juin",
    7 => "Juillet",
    8 => "Août",
    9 => "Septembre",
    10 => "Octobre",
    11 => "Novembre",
    12 => "Décembre"
);

/**
 * @brief gets a pretty formatted hour string
 *
 * @param $datetime: the strtotime() representation of the time to show
 *
 * @return a string containing the time (pretty printed)
 */
function printableHour($datetime)
{
    $hour = date('G', $datetime);
    $minutes = date('I', $datetime);

    $ret = $hour.'h';
    if($minutes != '00')
        $ret .= $minutes;

    return $ret;
}

/**
 * @brief gets a pretty formatted date and time interval
 *
 * @param $dtstart: the start datetime of the time interval
 * @param $dtend: the end datetime of the time interval
 *
 * @return a string containing the french representation of the interval
 */
function printableDateTime($dtstart, $dtend)
{
    if(date('Y-m-d', $dtstart) == date('Y-m-d', $dtend))
        return 'Le '.date('Y-m-d', $dtstart).', de '.printableHour($dtstart).' à '.printableHour($dtend);
    else
    {
        $stringDateTime = 'Du ';
        if(date('Y', $dtstart) != date('Y', $dtend))
            $stringDateTime .= printableDate($dtstart, true, true);
        else if(date('n', $dtstart) != date('n', $dtend))
            $stringDateTime .= printableDate($dtstart, true);
        else
            $stringDateTime .= printableDate($dtstart);

        $stringDateTime .= ' à '.printableHour($dtstart).' au '.printableDate($dtend, true, true).' à '.printableHour($dtend);

        return $stringDateTime;
    }
}

/**
 * @brief gets a pretty formatted date
 *
 * @param $datetime: the datetime to print
 * @param $useMonth: should the function print the month?
 * @param $useYear: should the function print the year?
 *
 * @return a string containing the well-formatted date
 */
function printableDate($datetime, $useMonth = false, $useYear = false)
{
    global $days, $daysFull, $months;

    $year = date('Y', $datetime);
    $month = $months[date('n', $datetime)];
    $day = date('j', $datetime);
    $dayInWeek = strtolower($daysFull[date('N', $datetime)]);

    $ret = $dayInWeek.' '.$day;
    if($useMonth)
        $ret .= ' '.$month;
    if($useYear)
        $ret .= ' '.$year;

    return $ret;
}
?>
