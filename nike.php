<?php
    if($_GET['num'] > 0)
        $num = $_GET['num'];
    else
        $num = 5;

    require_once 'class/nikeplusphp.4.5.php';
    $n = new NikePlusPHP($_GET['user'], $_GET['pass']);

    $num++;

    $activites = $n->activities($num);

    foreach($activites as $key => $value)
    {
        $run['id'] = $value->activityId;
        $run['date'] = date('Y-m-d', strtotime($value->startTimeUtc));
        $run['duration'] = gmdate("H:i:s", $value->metrics->duration/1000);
        $run['distance'] = number_format($value->metrics->distance, 1).'km';
        $run['pace'] = gmdate("i's''", $value->metrics->duration/1000/$value->metrics->distance);
        $run['avghr'] = $value->metrics->averageHeartRate;
        $run['fuel'] = $value->metrics->fuel;

        $runs['activitys'][$run['date']] = $run;
    }

    krsort($runs['activitys']);

    $all = $n->allTime();
    $runs['summary']['alltimedistance'] = number_format($all->lifetimeTotals->distance, 1).'km';
    $runs['summary']['thismounthdistance'] = number_format($all->homepageStats->totalDistance, 1).'km';

    echo $_GET['callback'].'('.json_encode($runs).')';
?>