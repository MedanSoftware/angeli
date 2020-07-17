<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage RESTful_API
 * @category Libraries
 * @author Agung Dirgantara <agungmasda29@gmail.com>
*/

use chriskacerguis\RestServer\RestController;

class RESTful_API extends RestController
{
	/**
	 * RESTful header
	 * 
	 * @var string
	 */
	protected $header;

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_data($this->request());
	}

	/**
	 * Request
	 * 
	 * @param  string $key
	 * @return string
	 */
	protected function request($key = null)
	{
		return $this->{$this->request->method}($key);
	}

	/**
	 * Set header
	 * 
	 * @param  mixed $header
	 * 
	 * @return RESTful_API
	 */
	protected function set_header($header = RESTful_API::HTTP_OK)
	{
		$this->header = $header;
		return $this;
	}

	/**
	 * Send response
	 * 
	 * @param  string $status
	 * @param  array  $data
	 * @param  string $message
	 */
	protected function send_response($status = 'success', $data = array(), $message = '')
	{
		$response[config_item('rest_status_field_name')] = $status;
		(!empty($data))?$response[config_item('rest_data_field_name')] = $data:FALSE;
		(!empty($message))?$response[config_item('rest_message_field_name')] = $message:FALSE;
		$this->response($response, $this->header);
	}
}

/* End of file RESTful_API.php */
/* Location: ./application/core/RESTful_API.php */