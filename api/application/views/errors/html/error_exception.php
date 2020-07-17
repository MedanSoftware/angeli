<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type:application/json');

$debug_backtrace = array();

foreach ($exception->getTrace() as $error) {
	if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0) {
		array_push($debug_backtrace, array(
			'file' => $error['file'],
			'line' => $error['line'],
			'function' => $error['function']
		));
	}
}

exit(json_encode(array(
	'status' => 'error',
	'message' => $exception->getMessage(),
	'data' => array(
		'type' => get_class($exception),
		'filename' => $exception->getFile(),
		'line' => $exception->getLine(),
		'debug_backtrace' => $debug_backtrace
	)
)));