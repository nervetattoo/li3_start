<div id=content>
Rendered
</div>

<script type="text/javascript" src="/js/app.js"></script>
<?php
/**
 * If you dont use Backbone (which is awesome) just remove this script,
 * and most likely you'll want to remove all of `AppController::bootstrap`
 * which is meant to provision and fire up a backbone app instead
 * of regular server side rendered html
 */
?>
<script type="text/javascript">
;$(function(){
    /**
     * This starts a class App that inherits Backbone.Controller
     * The App is by default found in `webroot/js/app.js`
     */
    if (typeof window.App != "undefined") {
        window.app = new App();
        Backbone.history.start();
    }
});
</script>
