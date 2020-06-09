<?php
/**
 * @package Codeigniter
 * @subpackage System Tables
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class System_tables extends MY_Model
{
	public $tables;

	public function __construct()
	{
		parent::__construct();
		$this->tables = array_diff(get_class_methods(self::class), ['__construct', '__get', 'set_db', 'get_tables', 'table_exists', 'get_fields', 'field_exists']);
	}

	/**
	 * Setting
	 * -------------------------------------------------
	 * @return array
	 */
	public function setting()
	{
		return array(
			'fields' => array(
				// default fields
				'id'			=> ['type' => 'BIGINT','unsigned' => TRUE,'auto_increment' => TRUE],
				'group'			=> ['type' => 'VARCHAR','constraint' => 120,'default' => NULL],
				'prefix'		=> ['type' => 'VARCHAR','constraint' => 120,'default' => NULL],
				'name'			=> ['type' => 'VARCHAR','constraint' => 120,'default' => NULL],
				'value'			=> ['type' => 'LONGTEXT','default' => NULL],
				'indexing'		=> ['type' => 'BOOLEAN','default' => FALSE],
				'indexing_on'	=> ['type' => 'VARCHAR','constraint' => 120,'default' => NULL],
				'description' 	=> ['type' => 'TINYTEXT','default' => NULL],

				// date of occurrence
				'created_at'	=> ['type' => 'DATETIME'],
				'updated_at'	=> ['type' => 'DATETIME','default' => NULL],
				'deleted_at'	=> ['type' => 'DATETIME','default' => NULL]
			),
			'primary_keys' => array('id'),
			'keys' => array()
		);
	}
}

/* End of file System_tables.php */
/* Location : ./application/models/_installation/System_tables.php */