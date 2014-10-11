<?php
if(str_replace( '\\', '/',$_SERVER['DOCUMENT_ROOT']) == SCRIPTPATH) 
	{ 
	define('_ABS_PATH_pC', '');
	}
else 
	{
	define('_ABS_PATH_pC', SCRIPTPATH);
	}
require_once($_SERVER['DOCUMENT_ROOT'].'/'. _ABS_PATH_pC .'/conf.php');
class C_Config
	{
	private $_D7AD312E33A3C3094DFB8AEFD75A1575 = '';
	protected $debug;  private $default_js = array();
	private $default_css = array();
	private $load_initial_js = array();
	private $load_initial_css = array();
	private $load_jquery_plugins = array();
	public function __construct() 
		{  
		}
	public function set_jqplot_config()
		{
		$this->_D7AD312E33A3C3094DFB8AEFD75A1575 = SCRIPTPATH;
		$this->debug = (defined('DEBUG'))?DEBUG:false;
		$this->default_js = array('jquery.jqplot');
		$this->default_css = array('jquery.jqplot');
		$this->load_initial_js = array_merge($this->default_js, explode(',', ADDITIONAL_JS_FILES));
		$this->load_initial_css = array_merge($this->default_css, explode(',',ADDITIONAL_CSS_FILES));
		}
	public function get_jqplot_plugin_list()
		{
		return $this->load_jquery_plugins;  
		}    
	public function get_scriptpath()
		{  
		return $this->_D7AD312E33A3C3094DFB8AEFD75A1575;  
		}    
	public function get_default_js_to_load()
		{  
		return $this->default_js;
		}    
	public function get_default_css_to_load()
		{  
		return$this->default_css;  
		}   	
	} 	 
?>
