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
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
	}

	function not_found()
	{
		$data['title'] = 'Not Found';
		$this->load->view('home/404',$data);
	}

// =================== DASHBOARD
	public function index()
	{
		$data['html'] = $this->Read_model->countTutorials('1');		
		$data['level_html'] = $this->Read_model->getLevel('1',['h1','h2','h3']);
		$data['css'] = $this->Read_model->countTutorials('2');
		$data['level_css'] 	= $this->Read_model->getLevel('2',['c1','c2','c3']);
		$data['js'] = $this->Read_model->countTutorials('3');
		$data['level_js'] 	= $this->Read_model->getLevel('3',['j1','j2','j3']);
		_temp_admin($data,'Welcome Administrator','index');
	}

	public function html()
	{
		$data['cat_name'] = $this->Read_model->getAllCategoryName();
		$data['lev_name'] = $this->Read_model->getAllLevelName();		
		$data['jsonUrl'] = 'xhra/dt_read_html';
		_temp_admin($data,'Tutorial HTML','tutorial_table');
	}

	public function css()
	{
		$data['cat_name'] = $this->Read_model->getAllCategoryName();
		$data['lev_name'] = $this->Read_model->getAllLevelName();
		$data['jsonUrl'] = 'xhra/dt_read_css';
		_temp_admin($data,'Tutorial CSS','tutorial_table');		
	}

	public function javascript()
	{
		$data['cat_name'] = $this->Read_model->getAllCategoryName();
		$data['lev_name'] = $this->Read_model->getAllLevelName();
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
			$edit = $this->Read_model->getTutorialByOrder($cat_id,$order);
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
			$next = $this->Read_model->getNextTutor($cat_id,$order);
			$prev = $this->Read_model->getPrevTutor($cat_id,$order);
			$data['linkNext'] = ($next) ? base_url('a/tutorial/'.$catName.'/'.$next) : '#';
			$data['linkPrev'] = ($prev) ? base_url('a/tutorial/'.$catName.'/'.$prev) : '#';
			_temp_admin($data,'Edit - '.$edit['snip_slug'],'tutorial_edit');
		} else {
			$this->not_found();
		}
	}

	public function cdn()
	{
		$data['jsonUrl'] = 'a/dt_cdn_list';
		_temp_admin($data,'Admin - List CDN','cdn_table');
	}

	public function users()
	{
		$data['jsonUrl'] = 'xhra/dt_users_list';
		_temp_admin($data,'Admin - List Users','users_table');		
	}

// END OF FILE
}