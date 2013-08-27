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

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$model = $this->getModel('logs');

foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_jplogs&view=log&log='.$item); ?>"><?php echo $item; ?></a>
		</td>
		<td>
			<?php echo $model->getLenght($item); ?>
		</td>
	</tr>
<?php endforeach; ?>
