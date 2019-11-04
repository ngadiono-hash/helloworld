<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Snippet extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function haha()
	{

	}
	public function index() // ok
	{
		$data['title'] = 'Snippet Hello World';
		$data['code'] = $this->Common_model->select_fields_where_join(
			'snip AS t1',
			't1.code_id AS code_id,t1.code_title AS code_title,t2.u_username AS user_author,t2.u_image AS image_author',
			[
				['table' => 'users AS t2', 'condition' => 't2.u_id = t1.code_author', 'type' => '']
			],
			['t1.code_publish' => 1],
			['t1.code_upload','desc']			
		);
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('index', $data);
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
			$this->load->view('single', $data);
			$this->load->view('templates/mainFooter', $data);			
		}
	}

	public function p($serial) // ok
	{
		$data['code'] = $this->Common_model->select_fields_where(
			'snip',
			'code_id,code_title,code_cdn,code_html,code_css,code_js',			
			['code_id' => $serial],
			true
		);
		$library_id = explode(',', $data['code']['code_cdn']);
		foreach ($library_id as $k) {
			$cdn[] = $this->Common_model->select_fields_where('snip_cdn','cdn_link',['id' => $k],true);
		}
		for ($i = 0; $i < count($cdn); $i++) {
			$data['extract'][$i] = popu($cdn[$i]['cdn_link']);
		}
		$this->load->view('thumbs',$data);
	}


// END OF FILE
}