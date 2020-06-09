<?php
/**
 * @package Codeigniter
 * @subpackage Setting
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli\Model\System;

class Setting extends Eloquent_Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	public $timestamps	= TRUE;

	protected $table 		= 'setting';
	protected $guarded		= array();
	protected $hidden 		= array();
	protected $fillable 	= array();
	protected $connection 	= 'system';
}

/* End of file Setting.php */
/* Location : ./application/models/_system/Setting.php */