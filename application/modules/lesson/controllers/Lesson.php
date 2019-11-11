<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function index()
	{
		$data['title'] = 'Menu Pelajaran di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	private function _temp($meta,$cat,$arr)
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
				$q = $this->Common_model->select_fields_where_join(
					'tutors AS t1',
					'
					t1.snip_id AS id,t1.snip_order AS order,t1.snip_title AS judul,
					t1.snip_slug AS slug,t1.snip_meta AS meta,t1.snip_content AS konten,
					t1.snip_code AS kode,t1.snip_update AS update,t1.snip_publish AS publish,
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
				$next = $this->Common_model->select_fields_where_join(
					'tutors AS t1',
					'snip_meta AS meta,snip_title AS title,snip_slug AS slug',
					[
						['table' => 'tutor_lev AS t2', 'condition' => 't2._id = t1.snip_level', 'type' => '']
					],
					['t2._name' => $q['level'],'t1.snip_order >' => $q['order'],'t1.snip_publish' => 1],
					['t1.snip_order','asc'],
					true,true,1
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
				$data = [
					'id'  		=> $q['id'],
					'order' 	=> $q['order'],
					'title' 	=> $q['slug'],
					'titles' 	=> $q['judul'],
					'meta' 		=> $q['meta'],
					'content' => $q['konten'],
					'code'		=> $q['kode'],
					'update'	=> $q['update'],
					'category'=> $q['kategori'],
					'level'		=> $q['level'],
					'btn'			=> $arr[0],
					'logo'		=> $arr[1],
					'tmDark'	=> $arr[2],
					'tmLight' => $arr[3],
					'next' 		=> ($next) ? $next : [],
					'menu'    => $menu
				];
				$this->load->view('templates/edHeader', $data);
				$this->load->view('main_lesson',$data);
				$this->load->view('templates/edFooter');
			}
		}
	}

	public function html()
	{
		$meta  = $this->uri->segment(3);
		$this->_temp($meta,1,['btn-html','html_logo.png','#E44D26','#EE8F77']);
	}

	public function css()
	{
		$meta  = $this->uri->segment(3);
		$this->_temp($meta,2,['btn-css','css_logo.png','#264DE4','#778FEE']);
	}

	public function javascript()
	{
		$meta  = $this->uri->segment(3);
		$this->_temp($meta,3,['btn-js','js_logo.png','#F3BE30','#F7D26E']);
	}

} // END