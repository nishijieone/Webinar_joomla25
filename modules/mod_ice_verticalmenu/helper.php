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
 
 
/* no direct access*/
defined('_JEXEC') or die('Restricted access');


require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php';

jimport('joomla.base.tree');
jimport('joomla.utilities.simplexml');
require_once("libs/menucore.php");
require_once("libs/simplexml.php");

class modIceVerticalmenuHelper
{
	
	var $_params 	= null;
	var $moduleid	= 0;
	var $_module 	= null;
	
	public function __construct($module = null, $params = array())
	{
		if(!empty($module))
		{
			$this->_module = $module;
			$this->moduleid = $module->id;
			$this->loadMediaFiles($params, $module);
		}
		$this->_params = $params;
	}
	
	function buildXML($params)
	{
		$menu 	= new IceMenuVTree($params);
		$items 	= &JSite::getMenu();
        $start  = $params->get('startLevel');
        $end    = $params->get('endLevel');
        $sChild = $params->get('showAllChildren');         
        
        if($end<$start && $end!=0){ return ""; }
            
        if(!$sChild){ $end = $start;}  
          
		// Get Menu Items
		$rows = $items->getItems('menutype', $params->get('menutype'));
        foreach($rows as $key=>$val)
        {             
            if(!(($end!=0 && $rows[$key]->level>=$start && $rows[$key]->level<=$end) ||($end==0 && $rows[$key]->level>=$start)))
            {
                unset($rows[$key]);
            }
        }         
		$maxdepth = $params->get('maxdepth',10);
		
		// Build Menu Tree root down(orphan proof - child might have lower id than parent)
		$user 	= &JFactory::getUser();
		$ids 	= array();
		$ids[1] = true;
		$last 	= null;
		$unresolved = array();
		
		// pop the first item until the array is empty if there is any item		
		if(is_array($rows))
		{
			while(count($rows) && !is_null($row = array_shift($rows)))
			{
				if(array_key_exists($row->parent_id, $ids))
				{
					$row->ionly = $params->get('menu_images_link');
					$menu->addNode($params, $row);
					// record loaded parents
					$ids[$row->id] = true;
				}
				else
				{
					// no parent yet so push item to back of list
					// SAM: But if the key isn't in the list and we dont _add_ this is infinite, so check the unresolved queue
					if(!array_key_exists($row->id, $unresolved) || $unresolved[$row->id] < $maxdepth)
					{
						array_push($rows, $row);
						// so let us do max $maxdepth passes
						// TODO: Put a time check in this loop in case we get too close to the PHP timeout
						if(!isset($unresolved[$row->id])) $unresolved[$row->id] = 1;
						else $unresolved[$row->id]++;
					}
				}
			}
		}
		return $menu->toXML();
	}

	function &getXML($type, &$params, $decorator)
	{
		static $xmls;

		if(!isset($xmls[$type]))
		{
			$cache 			= &JFactory::getCache('mod_ice_verticalmenu');
			$string 		= $cache->call(array('modIceVerticalmenuHelper', 'buildXML'), $params);
			$xmls[$type] 	= $string;
		}

		// Get document
		$xml = new IceSimpleVXml();
		$xml->loadString($xmls[$type]);
		$doc = &$xml->document;

		$menu	= &JSite::getMenu();
		$active	= $menu->getActive();
		$start	= $params->get('startLevel');
		$end	= $params->get('endLevel');
		$sChild	= $params->get('showAllChildren');
		$path	= array();

		// Get subtree
		if($doc && is_callable($decorator))
		{
			$doc->map($decorator, array('end'=>$end, 'children'=>$sChild));
		}
		return $doc;
	}

	function render(&$params, $callback)
	{				
		switch($params->get('menu_style', 'list'))
		{
			case 'list_flat' :
				break;
				
			case 'horiz_flat' :
				break;

			case 'vert_indent' :
				break;

			default :
				// Include the new menu class
				$xml = modIceVerticalmenuHelper::getXML($params->get('menutype'), $params, $callback);
				if($xml)
				{
					$class = $params->get('class_sfx');
					$xml->addAttribute('class', 'iceverticalmenu'.$class);
					
					if($tagId = $params->get('tag_id'))
					{
						$xml->addAttribute('id', $tagId);
					}
					$result = JFilterOutput::ampReplace($xml->toString((bool)$params->get('show_whitespace')));
					$result = str_replace(array("&lt;","&gt;","&#34;","&quot;","&#39;"), array("<",">",'"','"',"'"), $result);
					$result = str_replace(array('<ul/>', '<ul />'), '', $result);
					echo $result;
				}
				break;
		}
	}
	
	/**
	 * check K2 Existed ?
	 */
	public static function isK2Existed()
	{
		return is_file(JPATH_SITE.DS.  "components" . DS . "com_k2" . DS . "k2.php");	
	}
	/**
	 *  check the folder is existed, if not make a directory and set permission is 755
	 *
	 *
	 * @param array $path
	 * @access public,
	 * @return boolean.
	 */
	public static function makeDir($path)
	{
		$folders = explode('/', ($path));
		$tmppath =  JPATH_SITE.DS.'images'.DS.'icethumbs'.DS;
		
		if(!file_exists($tmppath))
		{
			JFolder::create($tmppath, 0755);
		} 
		for($i = 0; $i < count($folders) - 1; $i ++)
		{
			if(! file_exists($tmppath . $folders [$i]) && ! JFolder::create($tmppath . $folders [$i], 0755))
			{
				return false;
			}	
			$tmppath = $tmppath . $folders [$i] . DS;
		}		
		return true;
	}	
	/**
	 *  check the folder is existed, if not make a directory and set permission is 755
	 *
	 *
	 * @param array $path
	 * @access public,
	 * @return boolean.
	 */
	public static function renderThumb($path, $width=100, $height=100, $title='', $isThumb=true)
	{
		
		if($isThumb&& $path)
		{
			$path 		= str_replace(JURI::base(), '', $path);
			$imagSource = JPATH_SITE.DS. str_replace('/', DS,  $path);
			
			if(file_exists($imagSource))
			{
				$path =  $width."x".$height.'/'.$path;
				$thumbPath = JPATH_SITE.DS.'images'.DS.'icethumbs'.DS. str_replace('/', DS,  $path);
				
				if(!file_exists($thumbPath))
				{
					$thumb = PhpThumbFactory::create($imagSource);  
					if(!self::makeDir($path))
					{
							return '';
					}		
					$thumb->adaptiveResize($width, $height);
					$thumb->save($thumbPath); 
				}
				$path = JURI::base().'images/icethumbs/'.$path;
			} 
		}
		return $path;
	}
	/**
	 * Load Modules Joomla By position's name
	 */
	public function loadModulesByPosition($position='')
	{
		$modules = JModuleHelper::getModules($position);
		if($modules)
		{
			$document = &JFactory::getDocument();
			$renderer = $document->loadRenderer('module');
			$output='';
			foreach($modules  as $module)
			{
				$output .= '<div class="lof-module">'.$renderer->render($module, array('style' => 'raw')).'</div>';
			}
			return $output;
		}
		return ;
	}
	/**
	 * load css - javascript file.
	 * 
	 * @param JParameter $params;
	 * @param JModule $module
	 * @return void.
	 */
	public function loadMediaFiles($params, $module)
	{
		global $app;
		$app 			= JFactory::getApplication();
		$theme_style 	= $params->get("theme_style","default");
		
		if(!defined("MOD_ICEVERTICALMENU"))
		{
			JHTML::_('behavior.mootools');
			$document = &JFactory::getDocument();
			
			$css = "templates/".$app->getTemplate()."/html/".$module->module."/css/".$theme_style."_iceverticalmenu.css";
			if(is_file($css)) {
				$document->addStyleSheet($css);
			} else {
				$css = JURI::base().'modules/'.$module->module.'/themes/'.$params->get('theme_style','default').'/css/'.$theme_style.'_iceverticalmenu.css';
				$document->addStyleSheet($css);
			}
           
			if(!$params->get("use_js", 1)) {
                $document->addStyleSheet(JURI::base().'modules/'.$module->module.'/themes/'.$params->get('theme_style','default').'/css/'.$theme_style.'_notjs.css');   
            }
			//Load js files
			if(!defined("JQUERY_LOADED")) {
				define("JQUERY_LOADED", 1);
			}
            if($params->get("use_js", 1) && self::enableJS($params)) {   
				if(!defined("MOD_LOAD_MEGAMENU")){
					$document->addScript(JURI::root().'modules/'.$module->module.'/assets/js/icemegamenu.js');
					define("MOD_LOAD_MEGAMENU", 1);
				}
            } 
			define("MOD_ICEVERTICALMENU", 1);
		}
	}
	public static function enableJS( $params = ""){
		$theme_style = $params->get("theme_style", "default");
		if(in_array($theme_style, array( "css3" ))){
			return false;
		}
		return true;
	}
	
	/**
	 * get a subtring with the max length setting.
	 * 
	 * @param string $text;
	 * @param int $length limit characters showing;
	 * @param string $replacer;
	 * @return tring;
	 */
	public static function substring($text, $length = 100, $isStripedTags=true,  $replacer='...')
	{
		$string = $isStripedTags? strip_tags($text):$text;
		return JString::strlen($string) > $length ? JString::substr($string, 0, $length).$replacer: $string;
	}
}

if(!defined('modIceMegaMenuXMLCallbackDefined'))
{
	function modIceMegaMenuXMLCallbackDefinedXMLCallback(&$node, $args)
	{
		$user	= &JFactory::getUser();
		$menu	= &JSite::getMenu();
		$active	= $menu->getActive();
		$path	= isset($active) ? array_reverse($active->tree) : null;
	
		if(($args['end']) &&($node->attributes('level') >= $args['end']))
		{
			$children = $node->children();
			foreach($node->children() as $child)
			{
				if($child->name() == 'ul')
				{
					$node->removeChild($child);
				}
			}
		}
	
		if($node->name() == 'ul')
		{
			foreach($node->children() as $child)
			{
				if($child->attributes('access') > $user->get('aid', 0))
				{
					$node->removeChild($child);
				}
			}
		}
	
		if(($node->name() == 'li') && isset($node->ul))
		{
			$node->addAttribute('class', 'parent');
		}
	
		if(isset($path) &&(in_array($node->attributes('id'), $path) || in_array($node->attributes('rel'), $path)))
		{
			if($node->attributes('class'))
			{
				$node->addAttribute('class', $node->attributes('class').' active');
			}
			else
			{
				$node->addAttribute('class', 'active');
			}
		}
		else
		{
			if(isset($args['children']) && !$args['children'])
			{
				$children = $node->children();
				foreach($node->children() as $child)
				{
					if($child->name() == 'ul')
					{
						$node->removeChild($child);
					}
				}
			}
		}
	
		if(($node->name() == 'li') &&($id = $node->attributes('id')))
		{
			if($node->attributes('class'))
			{
				$node->addAttribute('class', $node->attributes('class').' item'.$id);
			}
			else
			{
				$node->addAttribute('class', 'item'.$id);
			}
		}
	
		if(isset($path) && $node->attributes('id') == $path[0])
		{
			$node->addAttribute('id', 'current');
		}
		else
		{
			$node->removeAttribute('id');
		}
		$node->removeAttribute('rel');
		$node->removeAttribute('level');
		$node->removeAttribute('access');
	}
	define('modIceMegaMenuXMLCallbackDefined', true);
}
?>