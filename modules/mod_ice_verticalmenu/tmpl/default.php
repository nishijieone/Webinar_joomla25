<?php
/**
 * IceMegaMenu Extension for Joomla 1.6 By IceTheme
 * 
 * 
 * @copyright	Copyright (C) 2008 - 2011 IceTheme.com. All rights reserved.
 * @license		GNU General Public License version 2
 * 
 * @Website 	http://www.icetheme.com/Joomla-Extensions/icemegamenu.html
 * @Support 	http://www.icetheme.com/Forums/IceMegaMenu/
 *
 */
 
 
$icemegamenu->render($params, 'modIceVerticalMenuXMLCallback');

if($use_js && modIceVerticalmenuHelper::enableJS( $params )){
	
?>  
<script type="text/javascript">
    window.addEvent('domready', function() {
		if(document.getElementById('iceverticalmenu')!= null)
		var myVerticalMenu = new MenuMatic({id:'iceverticalmenu',
			subMenusContainerId: 'iceVerticalSubMenusContainer',
			effect:'<?php echo $js_effect;?>',
			duration:<?php echo $js_duration;?>,
			physics:<?php echo $js_physics;?>,
			orientation: 'vertical',
			hideDelay:<?php echo $js_hideDelay;?>,
			opacity:<?php echo $js_opacity;?>
		});
    });
</script>
<?php
 }
 else{
	?>

	<?php
 }
?>