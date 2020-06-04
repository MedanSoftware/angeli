<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage URL
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @param	string	$uri
 * @param   boolean $query_string
 * @param	string	$protocol
 * @return	string
 */
function site_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	return get_instance()->config->site_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

/**
 * Base URL
 *
 * Create a local URL based on your basepath.
 * Segments can be passed in as a string or an array, same as site_url
 * or a URL to a file can be passed in, e.g. to an image file.
 *
 * @param	string	$uri
 * @param   boolean $query_string
 * @param	string	$protocol
 * @return	string
 */
function base_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	return get_instance()->config->base_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

/**
 * Get current URL
 * 
 * @param  boolean $query_string
 * @return string
 */
function current_url($query_string = TRUE)
{
	return base_url(!empty(uri_string())?uri_string().config_item('url_suffix'):'').(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

if (!function_exists('api_url'))
{
	/**
	 * Get API URL
	 * 
	 * @param  string $uri
	 * @return string
	 */
	function api_url($uri = '')
	{
		return (isset($_SERVER['API_URL']) ? $_SERVER['API_URL'] : base_url('api')).$uri;
	}
}

if (!function_exists('module_link'))
{
	/**
	 * Module link
	 * 
	 * @param  string $path append the path
	 * @return string
	 */
	function module_link($path = NULL)
	{
		$path = (!empty($path))?$path:'';
		$module = (!empty(get_instance()->router->fetch_module()))?get_instance()->router->fetch_module():get_instance()->router->fetch_class();
		return reduce_double_slashes(base_url($module.'/'.$path));
	}
}

if (!function_exists('get_http_build_query'))
{
	/**
	 * HTTP build query
	 * 
	 * @return string
	 */
	function get_http_build_query()
	{
		return (!empty(get_instance()->input->get()))?'?'.http_build_query(get_instance()->input->get()):FALSE;
	}
}

/* End of file MY_url_helper.php */
/* Location : ./application/helpers/MY_url_helper.php */