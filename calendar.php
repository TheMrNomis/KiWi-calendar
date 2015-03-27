<?php
#  if(!isset($_POST["y"]))
#  {
#    header("Location:.");
#    exit;
#  }
  header('Content-type: text/calendar; charset=utf-8');
  header('Content-Disposition: inline; filename=kiwicalendar.ics');
  include("./getEvents.php");

  $icalheader = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:KiWiCalendar v1.0//EN
";
  $icalfooter = "END:VCALENDAR";

  $events = getEvents();


  echo $icalheader;
  foreach($events as $event)
  {
    echo "BEGIN:VEVENT
SUMMARY:".$event["titre"]."
DTSTART:".date("Ymd\THis",strtotime($event["dtstart"]))."
DTEND:".date("Ymd\THis",strtotime($event["dtend"]))."
LOCATION:".$event["localisation"]."
CATEGORIES:"."<TODO : categorie>"."
DESCRIPTION:".$event["description"]."
END:VEVENT\n";
  }
  echo $icalfooter;
?>
