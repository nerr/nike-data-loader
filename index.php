<?php
    include 'config.php';
    var_dump($config);

    require_once 'class/nikeplusphp.4.5.php';
    $n = new NikePlusPHP($config['user'], $config['pass']);

    $activites = $n->activities(1);

    foreach($activites as $key => $value)
    {
        var_dump($value);

        $run['id'] = $value->activityId;
        $run['date'] = $value->startTimeUtc;
        $run['duration'] = $value->metrics->duration;
        $run['distance'] = $value->metrics->distance;
        $run['fuel'] = $value->metrics->fuel;

        $runs['activitys'][] = $run;
    }

    $all = $n->allTime();
    $runs['summary']['alltimedistance'] = $all->lifetimeTotals->distance;
    $runs['summary']['thismounthdistance'] = $all->homepageStats->totalDistance;

    //echo json_encode($runs);
?>