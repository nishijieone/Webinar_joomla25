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

class JPVersion 
{
	var $_version	= '1.0.0';
	var $_versionid	= 'Unicorn';
	var $_date	= '2011-11-22';
	var $_status	= 'Stable Release';


	function getVersion() {
		return $this->_version;
	}
	
	function getVersionId()
	{
		return ' ('.$this->_versionid.')';
	}


	function getRevision() {
		return '' .$this->_revision. ' (' .$this->_date. ')';
	}
}

?>
