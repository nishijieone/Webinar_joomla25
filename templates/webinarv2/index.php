<?php
//TODO Modified the header insert css, javascript
//TODO Need clock show up, and menu?

defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
      lang="<?php echo $this->language; ?>">
<head>
    <jdoc:include type="head"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/skitter.styles.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles_webinar.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/min_timer.css"
          type="text/css"/>

    <script type="text/javascript"
            src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.min.js"></script>
    <script type="text/javascript"
            src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript"
            src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.skitter.js"></script>
    <script type="text/javascript"
            src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/customer.js"></script>
</head>


<body>
<div id="wrapper">
    <div id="header">
        <div id="header-top">
            <div id="claydata-logo">
            </div>
            <div id="claydata-clock">
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>
            </div>
        </div>

        <div id="mainmenu">
            <jdoc:include type="modules" name="mainmenu" style="xhtml"/>
        </div>

    </div>

    <!-- Content -->
    <div id="container">
        <?php if ($this->countModules('slideshow')) { ?>
            <div id="slideshow">
                <jdoc:include type="modules" name="slideshow" style="block"/>
            </div>
        <?php } ?>

        <?php if ($this->countModules('promo1 + promo2 + promo3 + promo4')) { ?>
        <!-- Promo -->
        <div class="promo">
            <?php if ($this->countModules('promo1')) { ?>
                <div class="promo1">
                    <jdoc:include type="modules" name="promo1" style="block"/>
                </div>
            <?php } ?>
            <?php if ($this->countModules('promo2')) { ?>
                <div class="promo2">
                    <jdoc:include type="modules" name="promo2" style="block"/>
                </div>
            <?php } ?>
            <?php if ($this->countModules('promo3')) { ?>
                <div class="promo3">
                    <jdoc:include type="modules" name="promo3" style="block"/>
                </div>
            <?php } ?>
        </div>
            <!-- Promo -->
        <?php } ?>

        <!-- execsum -->
        <?php if ($this->countModules('execsum-block')) { ?>
            <div class="execsum-block">
            <jdoc:include type="modules" name="execsum-block" style="block"/>
            </div>
        <?php } ?>
        <!-- execsum -->

        <!-- component -->
        <div id="component">
            <jdoc:include type="message" />
            <jdoc:include type="component" />
        </div>
        <!-- component -->
    </div>


</div>
</div>
</div>

</body>
</html>