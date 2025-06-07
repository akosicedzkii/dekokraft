<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$password = "";
$ip_server = "localhost"; 
if($ip_server != "localhost" and $ip_server != "::1"){

	$password = "";
}
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'your_dedicated_user',
	'password' => 'your_strong_password',
	'database' => 'main_new',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => ((ENVIRONMENT == 'developement') ? TRUE : FALSE),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
