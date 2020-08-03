<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage MY_Security
 * @category Core
 * @author Agung Dirgantara <agungmasda29@gmail.com>
*/

class MY_Security extends CI_Security
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Set password
	 * 
	 * @param string
	 */
	public function set_password($string)
	{
		return sha1($string);
	}

	/**
	 * Match password
	 * 
	 * @param  string $saved_password encrypted string
	 * @param  string $set_password   plain text
	 * @return boolean
	 */
	public function match_password($saved_password = NULL, $set_password = NULL)
	{
		return ($this->set_password($set_password) == $saved_password);
	}

	/**
	 * Get request key
	 * 
	 * @return string
	 */
	public function get_request_key($key = NULL)
	{
		$ci =& get_instance();

		if (method_exists($ci,'post'))
		{
			return (!empty($ci->input->get_request_header($key)))?$ci->input->get_request_header($key, TRUE):$ci->post($key);
		}
		else
		{
			return (!empty($ci->input->get_request_header($key)))?$ci->input->get_request_header($key, TRUE):$ci->input->post($key);
		}
	}
}

/* End of file MY_Security.php */
/* Location: ./application/core/MY_Security.php */