<?php
/**
 * @package Codeigniter
 * @subpackage Application
 * @category Hook
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Booting;

require_once(BASEPATH.'helpers/directory_helper.php');

class Application
{
	/**
	 * Themes
	 * 
	 * @author Agung Dirgantara <agungmasda29@gmail.com>
	 */
	public function themes()
	{
		$data = array();

		foreach (directory_map(THEMES_PATH,3) as $module => $themes)
		{
			$module_name = str_replace('\\','',$module);

			if (is_dir(THEMES_PATH.'/'.$module))
			{
				$data = array_merge($data, array(
					$module_name => array(
						'themes' => array()
					)
				));

				foreach ($themes as $theme_folder => $theme_files)
				{
					if (is_array($theme_files) && in_array('theme.json', $theme_files))
					{
						$theme_json = json_decode(file_get_contents(THEMES_PATH.'/'.$module.$theme_folder.'theme.json'),TRUE);
						array_push(
							$data[$module_name]['themes'],
							array_merge((!empty($theme_json))?$theme_json:array(),array(
								'_path' => realpath(THEMES_PATH.'/'.$module.$theme_folder)
						)));
					}
				}
			}
		}

		$GLOBALS['modules_themes'] = $data;
		log_message('info','Themes loaded from hook');
	}
}

/* End of file Application.php */
/* Location : ./application/hooks/booting/Application.php */