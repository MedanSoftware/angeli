<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Template
 * @category Library
 * @author Agung Dirgantara <agungmasda29@gmail.com>
*/

require_once(APPPATH.'helpers/themes_helper.php');

class Template
{
	protected $ci;

	protected $module;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	/**
	 * Site template
	 * 
	 * @param  string $page
	 * @param  array  $content_data
	 */
	public function site($page = NULL, $content_data = array())
	{
		$this->ci->template_engine->initialize(array(
			'view_paths' => array(
				THEMES_PATH.'/site/'.active_theme('site').'/views' => THEMES_PATH.'/site/'.active_theme('site').'/views'
			),
			'adapter' => 'twig'
		));

		$data['themes']['url'] = base_url(backslash_to_slash(str_replace(APPPATH, '', THEMES_PATH).'/site/'.active_theme('site')));
		$data['themes']['assets_url'] = isset($_SERVER['ASSETS_URL'])?isset($_SERVER['ASSETS_URL']):base_url(backslash_to_slash(str_replace(FCPATH, '', ASSETS_PATH)));
		$this->ci->template_engine->render($page, array_merge($content_data, $data));
	}

	/**
	 * User template
	 * 
	 * @param  string $page
	 * @param  array  $content_data
	 */
	public function user($page = NULL, $content_data = array())
	{
		$this->ci->template_engine->initialize(array(
			'view_paths' => array(
				THEMES_PATH.'/user/'.active_theme('user').'/views' => THEMES_PATH.'/user/'.active_theme('user').'/views'
			),
			'adapter' => 'twig'
		));

		$data['themes']['url'] = base_url(backslash_to_slash(str_replace(APPPATH, '', THEMES_PATH).'/user/'.active_theme('user')));
		$data['themes']['assets_url'] = isset($_SERVER['ASSETS_URL'])?isset($_SERVER['ASSETS_URL']):base_url(backslash_to_slash(str_replace(FCPATH, '', ASSETS_PATH)));
		$this->ci->template_engine->render($page, array_merge($content_data, $data));
	}

	/**
	 * Maintenance template
	 * 
	 * @param  string $page
	 * @param  array  $content_data
	 */
	public function maintenance($page = NULL, $content_data = array())
	{
		$this->ci->template_engine->initialize(array(
			'view_paths' => array(
				THEMES_PATH.'/maintenance/'.active_theme('maintenance').'/views' => THEMES_PATH.'/maintenance/'.active_theme('maintenance').'/views'
			),
			'adapter' => 'twig'
		));

		$data['themes']['url'] = base_url(backslash_to_slash(str_replace(APPPATH, '', THEMES_PATH).'/maintenance/'.active_theme('maintenance')));
		$data['themes']['assets_url'] = isset($_SERVER['ASSETS_URL'])?isset($_SERVER['ASSETS_URL']):base_url(backslash_to_slash(str_replace(FCPATH, '', ASSETS_PATH)));
		$this->ci->template_engine->render($page, array_merge($content_data, $data));
	}

	/**
	 * Get config file
	 * 
	 * @param  string  $module
	 * @param  string  $filename
	 * @param  boolean $regex
	 * @param  boolean $decode
	 * @return mixed
	 */
	public function config_file($module = NULL, $filename = '/theme\.json/i', $regex = TRUE, $decode = TRUE)
	{
		$path = THEMES_PATH.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.active_theme($module).DIRECTORY_SEPARATOR;

		if ($regex)
		{
			$theme_path = directory_map(THEMES_PATH.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.active_theme($module), TRUE, FALSE);
			$config_file = preg_grep($filename, is_array($theme_path)?$theme_path:array());

			if ($config_file)
			{
				$config_file = array_shift($config_file);
			}
			else
			{
				$config_file = FALSE;
			}
		}
		else
		{
			$config_file = $filename;
		}

		if ($config_file && file_exists($path.$config_file))
		{
			$file_content = file_get_contents($path.$config_file);

			return ($decode)?json_decode($file_content):$file_content;
		}
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */