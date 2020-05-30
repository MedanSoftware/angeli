<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Validation
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('valid_json'))
{
	/**
	 * Valid JSON
	 * 
	 * @param  string $json
	 * @return boolean
	 */
	function valid_json($json = NULL)
	{
		json_decode($json);
		return (json_last_error() == JSON_ERROR_NONE);
	}	
}
/* End of file validation_helper.php */
/* Location : ./application/helpers/validation_helper.php */