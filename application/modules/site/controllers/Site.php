<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Site
 * @category MX Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Site extends MX_Controller
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
		$this->template->site('home');
	}

	public function filemanager()
	{
		$this->template->site('filemanager');
	}
}

/* End of file Site.php */
/* Location : ./site/controllers/Site.php */