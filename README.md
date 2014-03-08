Nike Plus Running Data Loader
================
Output json data.


http://nerrsoft.com/post/2013-09-01-get-nike-plus-running-data

Example
```html
//-- load nike plus running data
var url = "http://yourhost/index.php?callback=?";
$(function(){
    var jq = jQuery.noConflict();
    jq.getJSON(url).done(function(data){
        jq.each(data.activitys, function(i, act){
            jq("#nikeplus").append(act.date + " Dist. " + act.distance + " AvgPace " + act.pace + "
");
        });
    });
});
```