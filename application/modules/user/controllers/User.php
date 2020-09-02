<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage User
 * @category MX Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class User extends MX_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_title'] = 'Page Title';
		$this->template->user('home', $data);
	}

	public function sign_in()
	{

	}
}

/* End of file User.php */
/* Location : ./user/controllers/User.php */