<?php
/**
 * @package LiveUpdate
 * @copyright Copyright ©2011 Nicholas K. Dionysopoulos / AkeebaBackup.com
 * @license GNU LGPLv3 or later <http://www.gnu.org/copyleft/lesser.html>
 */

defined('_JEXEC') or die();

/**
 * Configuration class for your extension's updates. Override to your liking.
 */
class LiveUpdateConfig extends LiveUpdateAbstractConfig
{
	var $_extensionName			= 'com_jplogs';
	var $_extensionTitle		= 'Jplogs';
	var $_updateURL				= 'http://www.joomlanetprojects.com/index.php?option=com_ars&view=update&task=stream&format=xml&id=4';
	var $_requiresAuthorization	= true;
	var $_versionStrategy		= 'vcompare';
	
	function __construct()
	{
		$this->_cacerts = dirname(__FILE__).'/../assets/cacert.pem';
		
		parent::__construct();
	}
}
