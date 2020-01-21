<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$autoload['packages'] = array();

$autoload['libraries'] = array(
	'database',
	'session',
	'form_validation',
	'datatables',
	'email',
	'facebook',
	'pagination'
);

$autoload['drivers'] = array();

$autoload['helper'] = array('url','file','new','template','security','cookie');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array();
