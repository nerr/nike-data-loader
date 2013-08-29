<?php
    include('config.php');

    require_once 'class/nikeplusphp.4.5.php';
    $n = new NikePlusPHP($config['user'], $config['pass']);

    $activites = $n->activities(5);

    foreach($activites as $key => $value)
    {
        $run['id'] = $value->activityId;
        $run['date'] = date('Y-m-d', strtotime($value->startTimeUtc));
        $run['duration'] = gmdate("H:i:s", $value->metrics->duration/1000);
        $run['distance'] = number_format($value->metrics->distance, 1).'km';
        $run['fuel'] = $value->metrics->fuel;

        $runs['activitys'][] = $run;
    }

    $all = $n->allTime();
    $runs['summary']['alltimedistance'] = number_format($all->lifetimeTotals->distance, 1).'km';
    $runs['summary']['thismounthdistance'] = number_format($all->homepageStats->totalDistance, 1).'km';

    echo json_encode($runs);
?>