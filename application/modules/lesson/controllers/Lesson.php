<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// is_send_ajax();
		$this->load->model('Common_model');
	}

	public function haha()
	{
		$data = 'id,page,code';
    $where = ['code' => 404];
    
		$x = $this->Common_model->select_fields_where('bug',$data,$where);
		var_dump($x);
	}

	public function index()
	{
		$data['title'] = 'Menu Pelajaran di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

}