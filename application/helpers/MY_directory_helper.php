<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Directory
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('validate_directory'))
{
	/**
	 * Validate directory
	 * 
	 * @param  string $path path
	 * @return string
	 */
	function validate_directory($path = '')
	{
		(!is_dir($path))?mkdir($path,0777,TRUE):FALSE;
		return realpath($path);
	}
}

if (!function_exists('copy_directory'))
{
	/**
	 * Copy directory
	 * 
	 * @param  string $source      source path
	 * @param  string $destination destination path
	 * @return boolean
	 */
	function copy_directory($source, $destination)
	{
	    $dir = opendir($source);
	    @mkdir($destination);
	    
	    while (FALSE !== ($file = readdir($dir)))
	    {
	        if (($file != '.' ) && ( $file != '..' ))
	        {
	            if (is_dir($source . '/' . $file))
	            {
	            	copy_directory($source . '/' . $file,$destination . '/' . $file);
	            }
	            else
	            {
	            	copy($source . '/' . $file,$destination . '/' . $file);
	            }
	        }
	    }

	    closedir($dir);
	    return TRUE;
	}
}

/* End of file MY_directory_helper.php */
/* Location : ./application/helpers/MY_directory_helper.php */