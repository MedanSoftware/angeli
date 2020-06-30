<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Themes
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('active_theme'))
{
	/**
	 * Get active theme
	 * 
	 * @param  string $module
	 * @return string
	 */
	function active_theme($module = NULL)
	{
		$default_theme = 'default';

		if ($module == NULL)
		{
			return $default_theme;
		}
		else
		{
			if (array_key_exists($module, $GLOBALS['modules_themes']))
			{
				if (db_has_table('setting', 'system'))
				{
					if (class_exists('Angeli\Model\System\Setting'))
					{
						$system_setting = Angeli\Model\System\Setting::where(array(
							'group' => 'themes',
							'prefix' => 'active_theme_',
							'name' => $module
						));

						if (!empty($system_setting->first()))
						{
							// check theme is exists
							if (array_search(trim($system_setting->first()->value), array_column($GLOBALS['modules_themes'][$module]['themes'], 'slug')) !== FALSE)
							{
								return trim($system_setting->first()->value);
							}
						}
					}

					return $default_theme;
				}
			}
		}

		return $default_theme;
	}
}

if (!function_exists('activate_theme'))
{
	/**
	 * Activate theme
	 * 
	 * @param  string $module
	 * @param  string $theme
	 * @return boolean
	 */
	function activate_theme($module = NULL, $theme = NULL)
	{
		if (array_key_exists($module, $GLOBALS['modules_themes']))
		{
			if (db_has_table('setting', 'system'))
			{
				// check theme is exists
				if (array_search($theme, array_column($GLOBALS['modules_themes'][$module]['themes'], 'slug')) !== FALSE)
				{
					$system_setting = new Angeli\Model\System\Setting;
					$system_setting->group = 'themes';
					$system_setting->prefix = 'active_theme_';
					$system_setting->name = $module;
					$system_setting->value = $theme;
					$system_setting->save();

					return TRUE;
				}
			}
		}

		return FALSE;
	}
}

if (!function_exists('amp_html'))
{
	/**
	 * Get AMP HTML request
	 * 
	 * @return boolean
	 */
	function amp_html()
	{
		return filter_var(get_instance()->input->get('amp_html'),FILTER_VALIDATE_BOOLEAN);
	}
}


/* End of file themes_helper.php */
/* Location : ./application/helpers/themes_helper.php */