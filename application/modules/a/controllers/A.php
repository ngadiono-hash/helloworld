<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class A extends CI_Controller
{
// =================== CONSTRUCT
	public function __construct()
	{
		parent::__construct();
		reload_session();
		is_login();
		is_admin();
		$this->load->model('Common_model');
	}

	private function countTutorials($cat)
	{
		$resultDB = [];
		$resultDB['total'] = $this->Common_model->count_record('tutors','id',['snip_category' => $cat]);
		$resultDB['public'] = $this->Common_model->count_record('tutors','id',['snip_category' => $cat, 'snip_publish' => 1]);
		$resultDB['draft'] = $this->Common_model->count_record('tutors','id',['snip_category' => $cat, 'snip_publish' => 0]);
		return $resultDB;
	}

	private function getLevel($cat,$lev)
	{
		$ac = [];
		$aa = $this->Common_model->select_fields_where('tutor_lev','_name',['_cat' => $cat]);
		for ($i=0; $i < count($lev); $i++) {
			$ab[$i] = $this->Common_model->count_record('tutors','id',['snip_level' => $lev[$i], 'snip_bin' => 0]);
		}
		foreach ($aa as $key => $ax) {
			$ac [] = ['level_name' => $ax['_name'], 'counter' => $ab[$key] ];
		}
		return $ac;
	}

	private function onModalAdd($table,$data,$order)
	{
		return $this->Common_model->select_fields($table,$data,false,true,$order);
	}

// =================== DASHBOARD
	public function index()
	{
		$data['html'] = $this->countTutorials('1');
		$data['level_html'] = $this->getLevel('1',['h1','h2','h3']);
		$data['css'] = $this->countTutorials('2');
		$data['level_css'] 	= $this->getLevel('2',['c1','c2','c3']);
		$data['js'] = $this->countTutorials('3');
		$data['level_js'] 	= $this->getLevel('3',['j1','j2','j3']);
		_temp_admin($data,'Welcome Administrator','index');
	}

	public function html()
	{
		$data['cat_name'] = $this->onModalAdd('tutor_cat','_id AS category_id, _name AS category_name',['_id','asc']);
		$data['lev_name'] = $this->onModalAdd('tutor_lev','_id AS level_id, _cat AS category_id, _name AS level_name',['_cat','asc']);
		$data['jsonUrl'] = 'xhra/dt_read_html';
		_temp_admin($data,'Tutorial HTML','tutorial_table');
	}

	public function css()
	{
		$data['cat_name'] = $this->onModalAdd('tutor_cat','_id AS category_id, _name AS category_name',['_id','asc']);
		$data['lev_name'] = $this->onModalAdd('tutor_lev','_id AS level_id, _cat AS category_id, _name AS level_name',['_cat','asc']);
		$data['jsonUrl'] = 'xhra/dt_read_css';
		_temp_admin($data,'Tutorial CSS','tutorial_table');
	}

	public function javascript()
	{
		$data['cat_name'] = $this->onModalAdd('tutor_cat','_id AS category_id, _name AS category_name',['_id','asc']);
		$data['lev_name'] = $this->onModalAdd('tutor_lev','_id AS level_id, _cat AS category_id, _name AS level_name',['_cat','asc']);
		$data['jsonUrl'] = 'xhra/dt_read_js';
		_temp_admin($data,'Tutorial JAVASCRIPT','tutorial_table');
	}

	// public function deleted()
	// {
	// 	$data['jsonUrl'] = 'a/dt_deleted_tutorial';
	// 	_temp_admin($data,'Tutorial DELETED','tutorial_table');
	// }

	public function tutorial()
	{
		$catName = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		if(!empty($catName) && !empty($order)){
			if ($catName == 'html'){
				$data['cat_name'] = 'html';
		    $data['theme'] = 'wrap-html';
		    $cat_id = '1';
		  } elseif ($catName == 'css'){
		  	$data['cat_name'] = 'css';
		  	$data['theme'] = 'wrap-css';
		  	$cat_id = '2';
		  } else {
		  	$data['cat_name'] = 'javascript';
		  	$data['theme'] = 'wrap-js';
		  	$cat_id = '3';
		  }
			$edit = $this->Common_model->select_fields_where(
				'tutors','*',['snip_order' => $order,'snip_category' => $cat_id],true
			);
			// debug($edit);
			$data['id'] 		= $edit['snip_id'];
			$data['order'] 	= $edit['snip_order'];
			$data['titlex'] = $edit['snip_title'];
			$data['slug'] 	= $edit['snip_slug'];
			$data['meta'] 	= $edit['snip_meta'];
			$data['content']= htmlentities($edit['snip_content']);
			$data['code'] 	= $edit['snip_code'];
			$data['upload'] = $edit['snip_upload'];
			$data['update'] = $edit['snip_update'];
			$data['public'] = $edit['snip_publish'];
			if($data['public'] == 1){
		    $data['btn'] = 'btn-ok';
		    $data['fa']  = '<i class="fa fa-globe-asia"></i>';
			} else {
		    $data['btn'] = 'btn-no';
		    $data['fa']  = '<i class="fa fa-code"></i>';
			}
			$next = $this->Common_model->select_spec(
				'tutors','snip_order',['snip_order >' => $order, 'snip_category',$cat_id],['snip_order', 'ASC'],1
			);
			$prev = $this->Common_model->select_spec(
				'tutors','snip_order',['snip_order <' => $order, 'snip_category',$cat_id],['snip_order', 'DESC'],1
			);
			$data['linkNext'] = ($next) ? base_url('a/tutorial/'.$catName.'/'.$next) : '#';
			$data['linkPrev'] = ($prev) ? base_url('a/tutorial/'.$catName.'/'.$prev) : '#';
			_temp_admin($data,'Edit - '.$edit['snip_slug'],'tutorial_edit');
		}
	}

	public function cdn()
	{
		$data['jsonUrl'] = 'xhra/dt_cdn_list';
		_temp_admin($data,'Admin - List CDN','cdn_table');
	}

	public function users()
	{
		$data['jsonUrl'] = 'xhra/dt_users_list';
		_temp_admin($data,'Admin - List Users','users_table');
	}

// END OF FILE
}