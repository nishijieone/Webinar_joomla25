<!--<!DOCTYPE html>-->
<!--<html lang="en" xmlns="http://www.w3.org/1999/html">-->
<!--<head>-->
<!--<title>Claydata::Weekly Webinar </title>-->
<!--<meta charset="UTF-8"/>-->
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
<!--&lt;!&ndash;<link rel="stylesheet" href="css/bootstrap.css" />&ndash;&gt;-->

<!--<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet"/>-->
<!--<link href="css/styles_webinar.css" type="text/css" media="all" rel="stylesheet"/>-->
<!--<link rel="stylesheet" href="css/jquery.countdown.css">-->
<!--<link href="css/min_timer.css" rel="stylesheet">-->

<!--&lt;!&ndash;-->
<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />-->
<!--&ndash;&gt;-->
<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>-->
<!--<style type="text/css">-->
<!--#defaultCountdown {-->
<!--width: 240px;-->
<!--height: 40px;-->
<!--margin: 10px;-->
<!--}-->
<!--</style>-->

<!--&lt;!&ndash;<script />&ndash;&gt;-->
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<!--&lt;!&ndash;for select &ndash;&gt;-->
<!--<script src="js/jquery.min.js"></script>-->
<!--<script src="js/jquery.easing.1.3.js"></script>-->
<!--<script src="js/jquery.skitter.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.countdown.js"></script>-->
<!--&lt;!&ndash;-->
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>&ndash;&gt;-->
<!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
<!--<script src="js/timer.js"></script>-->
<!--<script src="js/timer.jquery.min.js"></script>-->

<!--<link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon"/>-->

<!--&lt;!&ndash;jQurey countdown timer&ndash;&gt;-->
<!--<script type="text/javascript">-->
<!--$(function () {-->
<!--var austDay = new Date();-->
<!--austDay = new Date(austDay.getFullYear(), 8 - 1, 21, 13);-->
<!--$('#defaultCountdown').countdown({until: austDay});-->
<!--//$('#noDays').countdown({until: 10080, format: 'HMS'});-->
<!--$('#year').text(austDay.getFullYear());-->
<!--//alert(austDay.getFullYear());-->
<!--});-->
<!--</script>-->

<!--&lt;!&ndash;jQurey dialog&ndash;&gt;-->
<!--<script>-->
<!--//jQurey dialog-->
<!--$(function () {-->
<!--var dialogOpts = {-->
<!--position: [1170, 500]-->
<!--};-->
<!--$("#dialog").dialog(dialogOpts);-->
<!--});-->
<!--$('#dialog').parent().css({position: "fixed"});-->
<!--</script>-->

<!--&lt;!&ndash; timer btn &ndash;&gt;-->
<!--<script>-->
<!--var isTimerPaused = false;-->
<!--var isTimerStarted = false;-->
<!--$(document).ready(function () {-->
<!--var val = "";-->
<!--$('#btn_start').click(function () {-->

<!--val = $('#sel_timer option:selected').val();-->
<!--console.log("val = " + val);-->
<!--try {-->
<!--startTime = parseInt(val, 10);-->
<!--console.log(startTime);-->
<!--} catch (e) {-->
<!--startTime = 300;-->
<!--console.log();-->
<!--}-->

<!--if (isTimerPaused) {-->
<!--console.log("paused");-->
<!--$('#noDays').countdown('resume');-->
<!--isTimerPaused = false;-->
<!--}-->

<!--if (!isTimerStarted) {-->
<!--$('#noDays').countdown({until: startTime, format: 'HMS'});-->
<!--isTimerStarted = true;-->
<!--console.log("start if");-->
<!--} else {-->
<!--//if()-->

<!--$('#noDays').countdown('option', {until: startTime, format: 'HMS'});-->
<!--console.log("else");-->
<!--}-->
<!--console.log("End");-->


<!--});-->

<!--$('#btn_stop').click(function () {-->
<!--if (!isTimerPaused) {-->
<!--$('#noDays').countdown('pause');-->
<!--isTimerPaused = true;-->
<!--}-->
<!--//$('#noDays').countdown('option', {until: +10});//restart-->
<!--});-->
<!--});-->

<!--</script>-->

<!--</head>-->

<?php
//TODO Modified the header insert css, javascript
//TODO Need clock show up, and menu?

defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
      lang="<?php echo $this->language; ?>">
<head>
    <jdoc:include type="head"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles_webinar.css"
          type="text/css"/>
    <!--    <script type="text/javascript" src="/templates/blackwhite/js/customer.js"></script>-->

</head>


<script src="js/customer.js"></script>

<body>
<div id="wrapper">
    <div id="header">
        <div id="claydata-logo">
        </div>
        <jdoc:include type="modules" name="top" style="xhtml"/>
    </div>

    <!-- Content -->
    <div id="container">
        <jdoc:include type="message" />
        <jdoc:include type="component" />
        <jdoc:include type="modules" name="breadcrumbs" style="xhtml"/>
        <div class="slideshow">
            <div class="box_skitter box_skitter_large">
                <ul>
                    <li><a href="#cube"><img src="images/example/005.jpg" class="cube"/></a>

                        <div class="label_text"><p>Welcome to Weekly Webinar @Claydata</p></div>
                    </li>
                    <li><a href="#cubeRandom"><img src="images/example/006.png" class="cubeRandom"/></a>

                        <div class="label_text"><p>PuttyHelp Platform</p></div>
                    </li>
                    <li><a href="#block"><img src="images/example/007.jpg" class="block"/></a>

                        <div class="label_text"><p>eScript </p></div>
                    </li>
                    <!--<li><a href="#cubeStop"><img src="images/example/004.jpg" class="cubeStop" /></a><div class="label_text"><p>eScript</p></div></li>-->
                </ul>
            </div>
        </div>

    </div>
</div>

</body>
</html>