<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Filemanager
 * @category MX Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Filemanager extends MX_Controller
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
		$config = $this->load->config('filemanager', TRUE);
		$root = BASEPATH.'../uploads/';
		$app = new RFM\Application();
		$local = new RFM\Repository\Local\Storage($config);
		$local->setRoot($root, TRUE, FALSE);
		$app->setStorage($local);
		$app->api = new RFM\Api\LocalApi();
		$app->run();
	}
}

/* End of file Filemanager.php */
/* Location : ./application/controllers/Filemanager.php */