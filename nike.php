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

        $runs['activitys'][] = $run;
    }

    $all = $n->allTime();
    $runs['summary']['alltimedistance'] = number_format($all->lifetimeTotals->distance, 1).'km';
    $runs['summary']['thismounthdistance'] = number_format($all->homepageStats->totalDistance, 1).'km';

    echo $_GET['callback'].'('.json_encode($runs).')';
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28003762-3', 'nerrsoft.com');
  ga('send', 'pageview');

</script>