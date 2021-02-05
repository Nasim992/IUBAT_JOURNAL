<?php 
 
$assigndate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

echo $assigndate;

$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

echo $date;

$month = date("M",strtotime($date));  
 
echo $month;

?>