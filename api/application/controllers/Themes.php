<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Themes
 * @category RESTful Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Themes extends RESTful_API
{	
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * REST-API METHODS
	 * ----------------------------------------------------------------------------------------------------
	 */

	/**
	 * Modules themes
	 *
	 * @param      string  $module  Module name
	 */
	public function index_get($module = NULL)
	{
		$active_themes = array();

		if (!empty($module) && array_key_exists($module, $GLOBALS['modules_themes']))
		{
			$this->set_header(RESTful_API::HTTP_OK)->send_response('success', $GLOBALS['modules_themes'][$module]);
		}
		else
		{
			foreach (array_keys($GLOBALS['modules_themes']) as $module)
			{
				$active_themes[$module] = active_theme($module);
			}

			$this->set_header(RESTful_API::HTTP_OK)->send_response('success', array('active_themes' => $active_themes, 'modules_themes' => $GLOBALS['modules_themes']));
		}
	}

	/**
	 * Activate theme
	 *
	 * @param      string  $module  Module name
	 * @param      string  $theme   Theme slug
	 */
	public function activate_get($module = NULL, $theme = NULL)
	{
		$change_theme = filter_var(activate_theme($module, $theme), FILTER_VALIDATE_BOOLEAN);
		$this->set_header(($change_theme)?RESTful_API::HTTP_OK:RESTful_API::HTTP_BAD_REQUEST)->send_response(($change_theme)?'success':'failed', array());
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * CALLABLE METHODS
	 * ----------------------------------------------------------------------------------------------------
	 */
	
	public function test()
	{
		
	}
}

/* End of file Themes.php */
/* Location : ./application/controllers/Themes.php */