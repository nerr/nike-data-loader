Nike Plus Running Data Loader
================
Output json data.

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