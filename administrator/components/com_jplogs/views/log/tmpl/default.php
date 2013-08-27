<?php
/**
 * @version		1.0.0 jp logs $
 * @package		jplogs
 * @copyright   Copyright © 2010 - All rights reserved.
 * @license		GNU/GPL
 * @author		kim
 * @author mail administracion@joomlanetprojects.com
 * @website		http://www.joomlanetprojects.com
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jplogs&view=log&&log='.JRequest::getVar('log', '', 'get')); ?>" method="post" name="adminForm" id="jp_logs-form" class="form-validate">
<pre class="code">
	<?php echo $this->log; ?>
</pre>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>