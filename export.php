<?php
//header('Content-type: text/calendar; charset=utf-8');
//header('Content-Disposition: inline; filename=calendar.ics');

function icaldate($date)
{
    $dt = time($date);
    return gmdate('Ymd',$dt).'T'. gmdate('His',$dt). 'Z';
}

include_once('getEvents.php');
$db = connect();
$events = getEventsByDate($db, time());

$eol = "\r\n";
echo('BEGIN:VCALENDAR'.$eol);
echo('VERSION:2.0'.$eol);
echo('PRODID:-//hacksw/handcal//NONSGML v1.0//EN'.$eol);
foreach($events as $event)
{
    echo('BEGIN:VEVENT'.$eol);
    echo('UID:' . md5($event['id']) . '@kiwi-calendar'.$eol);
    echo('DTSTAMP:'.icaldate($event['dtstart']).$eol);
    echo('DTSTART:'.icaldate($event['dtstart']).$eol);
    echo('DTEND:'.icaldate($event['dtend']).$eol);
    echo('SUMMARY:'.$event['description'].$eol);
    echo('END:VEVENT'.$eol);
}

echo('END:VCALENDAR');

?>
