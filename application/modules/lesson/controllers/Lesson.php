<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	private function _temp_menu($lev)
	{
		$data['label'] = $this->Common_model->select_where(
			'level',
			'name,description,content',
			['name' => $lev],
			TRUE,TRUE
		);
		$config['base_url'] = base_url('lesson/').$this->uri->segment(2);
		$config['total_rows'] = $this->Common_model->counting(
			'materi',['les_level'=>$lev,'les_publish'=>1]
		);
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['per_page'] = 9;

		$page = ($this->input->get('page')) ? $this->input->get('page') : 1;
		$ilegal = round($config['total_rows']/$config['per_page']);
		if ($page > $ilegal) {
			not_found();
			die();
		}
		$offset = ($page - 1) * $config['per_page'];
		$all = $this->Common_model->select_where(
			'materi',
			'les_order,les_level,les_title,les_slug,les_meta,les_content,les_update',
			['les_level' => $lev,'les_publish' => 1],
			TRUE,FALSE,
			['les_order','asc'],
			[$config['per_page'],$offset]
		);
		$config['attributes'] = array('class' => 'page-link');
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_link'] = 'start';
		$config['last_link'] = 'end';
		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		foreach ($all as $k) {
			$rest[] = [
				'num'			=> $k['les_order'],
				'level' 	=> $k['les_level'],
				'update'    => date('M d, Y',$k['les_update']),
				'title' 		=> $k['les_title'],
				'slug' 			=> $k['les_slug'],
				'link' 			=> base_url('lesson/docs/').$k['les_meta'],
				'content'   => read_more($k['les_content'],200)
			];
		}
		$data['list'] = $rest;
		$data['title'] = 'Hello World - Materi '.$data['label']['description'];
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('menu',$data);
		$this->load->view('templates/mainFooter');
	}

	private function _temp_main($meta)
	{
		$meta  = $this->uri->segment(3);
		$checkMeta = $this->Common_model->check_exist('materi',['les_meta' => $meta,'les_publish' => 1]);
		if(!$checkMeta){
			not_found();
		} else {
			$this->load->library('disqus');
			$s = $this->Common_model->select_where(
				'materi',
				'les_id,les_order,les_level,les_title,les_slug,les_meta,les_content,les_upload,les_update',
				['les_meta' => $meta],
				TRUE,TRUE
			);
			$all = $this->Common_model->select_where(
				'materi',
				'les_meta,les_title,les_slug',
				['les_level'=>$s['les_level'],'les_publish'=>1],
				TRUE,FALSE,
				['les_order','asc']
			);
			$data['title'] = $s['les_slug'];
			$keyword = getTags($s['les_content'],'h3');
			$keyword = (!empty($keyword)) ? implode(',', $keyword) : '';
			$keyword = strtolower('belajar javascript, belajar '.$s['les_title'].', '.$keyword);
			$data['lesson'] = [
				'id'  		=> $s['les_id'],
				'order' 	=> $s['les_order'],
				'title' 	=> $s['les_slug'],
				'titles' 	=> $s['les_title'],
				'meta' 		=> $s['les_meta'],
				'content' => $s['les_content'],
				'description' => read_more($s['les_content'],250),
				'keyword' => $keyword,
				'upload'	=> $s['les_upload'],
				'update'	=> $s['les_update'],
				'level'		=> $s['les_level'], 
				'disqus'  => $this->disqus->get_html()
			];
			foreach ($all as $key) {
				$data['lesson']['menu'][] = [
					'link' => base_url('lesson/docs/').$key['les_meta'],
					'title' => $key['les_slug']
				];
			}
			$this->load->view('templates/mainHeader', $data);
			$this->load->view('single_lesson',$data);
			$this->load->view('templates/mainFooter');
		}
	}


	public function index()
	{
		$data['title'] = 'Materi JavaScript';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	public function beginner()
	{
		$data['title'] = 'Dasar-dasar JavaScript';
		$data['list'] = $this->_temp_menu('beginner');
	}
	public function intermediate()
	{
		$data['title'] = 'DOM JavaScript';
		$data['list'] = $this->_temp_menu('intermediate');
	}
	public function advanced()
	{
		$data['title'] = 'JavaScript Lajutan';
		$data['list'] = $this->_temp_menu('advanced');
	}

	public function docs($meta)
	{
		$this->_temp_main($meta);
	}





	// public function html($meta='')
	// {
	// 	if (empty($meta)) {
	// 		$this->_temp_menu(1);
	// 	} else {
	// 		$this->_temp_main($meta,1,['btn-html','html_logo.png','#E44D26','#EE8F77']);
	// 	}
	// }

	// public function css($meta='')
	// {
	// 	if (empty($meta)) {
	// 		$this->_temp_menu(2);
	// 	} else {
	// 		$this->_temp_main($meta,2,['btn-css','css_logo.png','#264DE4','#778FEE']);
	// 	}
	// }

	// public function javascript($meta='')
	// {
	// 	if (empty($meta)) {
	// 		$this->_temp_menu(3);
	// 	} else {
	// 		$this->_temp_main($meta,3,['btn-js','js_logo.png','#F3BE30','#F7D26E']);
	// 	}
	// }

} // END