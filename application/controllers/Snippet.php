<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Snippet extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
	}

	public function haha()
	{
		// $serial = 'ywz2ru';
		// $comment = $this->Read_model->getCommentSnippet($serial);
		// foreach ($comment as $k => $v) {
		// 	if ($v['id_comm'] == $v['author']) {
		// 		$comment[$k]['side'] = 'right';
		// 	} else {
		// 		$comment[$k]['side'] = 'left';
		// 	}
		// }
		// echo $this->input->user_agent();
		// var_dump($comment);
	}
	public function index()
	{
		$data['title'] = 'Snippet Hello World';

		$data['code'] = $this->Read_model->getAllSnippet();
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('snippet/index', $data);
		$this->load->view('templates/mainFooter', $data);
	}

	public function s($serial)
	{
		$data['code'] = $this->Read_model->getSingleSnippet(['t1.code_id' => $serial]);
		$data['fm_snippet'] = explode(',',$data['code']['code_cdn']);
		$data['tag_snippet'] = explode(',',$data['code']['code_tag']);
		$data['count_comm'] = $this->Read_model->countCommentLimited($serial);
		$data['comment'] = $this->Read_model->getCommentSnippet($serial,5);
		$data['comment'] = append_comment($data['comment']);

		$data['tag'] = $this->Read_model->getTagSnippet();
		
		for ($i=0; $i < count($data['fm_snippet']) ; $i++) { 
			$framework[$i] = $this->db->get_where('cdn',['id' => $data['fm_snippet'][$i]])->row_array();
		}
		$data['framework'] = $framework;
		if ($data['code']) {
			$data['title'] = $data['code']['code_title'];
			$this->load->view('templates/mainHeader', $data);
			$this->load->view('snippet/single', $data);
			$this->load->view('templates/mainFooter', $data);			
		}
	}

	public function p($serial)
	{
		$data['code'] = $this->Read_model->getSingleSnippet(['code_id' => $serial]);
		$data['framework'] = explode(',', $data['code']['code_cdn']);
		$this->load->view('snippet/thumbs',$data);
	}


// END OF FILE
}