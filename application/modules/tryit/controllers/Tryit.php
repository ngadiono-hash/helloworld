<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tryit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common');
	}

	public function file()
	{
		$meta = $this->uri->segment(3);
		$where = " LOWER(title)='".str_replace('-',' ',$meta)."' ";
		$data['snippet'] = $this->Common->check_segment('snippet',$where);
		if ($data['snippet']) {
			$data['title'] = 'Tryit - '. $data['snippet']['title'];
			$this->load->view('play',$data);
		} else {
			not_found(404);
		}
	}



}