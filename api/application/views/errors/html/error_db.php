<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type:application/json');
exit(json_encode(array(
	'status' => 'error',
	'message' => $heading.' | '.$message,
	'data' => array()
)));