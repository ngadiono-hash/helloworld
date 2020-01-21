<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}


	private function _temp_menu($cat)
	{
		$config['base_url'] = base_url('lesson/').$this->uri->segment(2);
		$config['total_rows'] = $this->Common_model->count_record(
			'tutors','id',['snip_category' => $cat, 'snip_bin' => 0, 'snip_publish' => 1]
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
		$all_category_by_cat = $this->Common_model->select_fields_where_join(
			'tutors AS t1',
			't1.snip_order AS id,t1.snip_title AS title,t1.snip_slug AS slug,t1.snip_meta AS meta,t1.snip_content AS content,t1.snip_update AS update, t2._name AS level,t3._name AS category',
			[
				['table' => 'tutor_lev AS t2', 'condition' => 't2._id = t1.snip_level', 'type' => ''],
				['table' => 'tutor_cat AS t3', 'condition' => 't3._id = t1.snip_category', 'type' => '']
			],
			['t1.snip_category' => $cat, 't1.snip_bin' => 0, 't1.snip_publish' => 1],
			['t1.snip_order','desc'],
			false,true,[$config['per_page'],$offset]
		);
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_link'] = 'start';
		$config['last_link'] = 'end';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_open'] = '<li>';
		$this->pagination->initialize($config);
		foreach ($all_category_by_cat as $k) {
			$rest[] = [
				'id'				=> $k['id'],
				'category' 	=> $k['category'],
				'update'    => date('d M Y',$k['update']),
				'level' 		=> $k['level'],
				'title' 		=> $k['title'],
				'slug' 			=> $k['slug'],
				'link' 			=> base_url('lesson/').$k['category'].'/'.$k['meta'],
				'content'   => read_more($k['content'],200)
			];
		}
		$data['list'] = append_tutor($rest);
		$data['title'] = 'Hello World - Materi '.strtoupper($k['category']);
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('menu',$data);
		$this->load->view('templates/mainFooter');
	}

	private function _temp_main($meta,$cat,$arr)
	{
		$meta  = $this->uri->segment(3);
		$checkMeta = $this->Common_model->check_exist('tutors',['snip_meta' => $meta]);
		if(!$checkMeta){
			not_found();
		} else {
			$tutor_public = $this->Common_model->select_spec('tutors','snip_publish',['snip_meta' => $meta]);
			if($tutor_public == 0){
				not_found();
			} else {
				$this->load->library('disqus');
				$q = $this->Common_model->select_fields_where_join(
					'tutors AS t1',
					'
					t1.snip_id AS id,t1.snip_order AS order,t1.snip_title AS judul,
					t1.snip_slug AS slug,t1.snip_meta AS meta,t1.snip_content AS konten,
					t1.snip_code AS kode,t1.snip_upload AS upload,t1.snip_update AS update,t1.snip_publish AS publish,
					t2._name AS kategori,
					t3._name AS level
					',
					[
						['table' => 'tutor_cat AS t2', 'condition' => 't2._id = t1.snip_category', 'type' => ''],
						['table' => 'tutor_lev AS t3', 'condition' => 't3._id = t1.snip_level', 'type' => '']
					],
					['t1.snip_category' => $cat, 't1.snip_meta' => $meta, 't1.snip_bin' => 0],
					'',true
				);
				$menu = $this->Common_model->select_fields_where_join(
					'tutors AS t1',
					'snip_meta AS meta,snip_title AS title,snip_slug AS slug',
					[
						['table' => 'tutor_lev AS t2', 'condition' => 't2._id = t1.snip_level', 'type' => '']
					],
					['t2._name' => $q['level'],'t1.snip_publish' => 1],
					['t1.snip_order','asc'],
					false,true
				);
				$data['title'] = $q['slug'];
				$keyword = getTags($q['konten'],'h3');
				$keyword = implode(',', $keyword);
				$keyword = strtolower('belajar '.$q['kategori'].',belajar '.$q['level'].','.$q['judul'].','.$keyword);
				$data['lesson'] = [
					'id'  		=> $q['id'],
					'order' 	=> $q['order'],
					'title' 	=> $q['slug'],
					'titles' 	=> $q['judul'],
					'meta' 		=> $q['meta'],
					'content' => $q['konten'],
					'description' => read_more($q['konten'],250),
					'keyword' => $keyword,
					'upload'	=> $q['upload'],
					'update'	=> $q['update'],
					'category'=> $q['kategori'],
					'level'		=> $q['level'],
					'btn'			=> $arr[0],
					'logo'		=> $arr[1],
					'tmDark'	=> $arr[2],
					'tmLight' => $arr[3],
					'menu'    => $menu,
					'disqus'  => $this->disqus->get_html()
				];
				
				$this->load->view('templates/mainHeader', $data);
				$this->load->view('main_lesson',$data);
				$this->load->view('templates/mainFooter');
			}
		}
	}


	public function index()
	{
		$data['title'] = 'Materi Belajar di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	public function html($meta='')
	{
		if (empty($meta)) {
			$this->_temp_menu(1);
		} else {
			$this->_temp_main($meta,1,['btn-html','html_logo.png','#E44D26','#EE8F77']);
		}
	}

	public function css($meta='')
	{
		if (empty($meta)) {
			$this->_temp_menu(2);
		} else {
			$this->_temp_main($meta,2,['btn-css','css_logo.png','#264DE4','#778FEE']);
		}
	}

	public function javascript($meta='')
	{
		if (empty($meta)) {
			$this->_temp_menu(3);
		} else {
			$this->_temp_main($meta,3,['btn-js','js_logo.png','#F3BE30','#F7D26E']);
		}
	}

} // END