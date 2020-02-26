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
		$resultDB['total'] = $this->Common_model->count_record('materi','id',['les_level' => $cat]);
		$resultDB['public'] = $this->Common_model->count_record('materi','id',['les_level' => $cat, 'les_publish' => 1]);
		$resultDB['draft'] = $this->Common_model->count_record('materi','id',['les_level' => $cat, 'les_publish' => 0]);
		return $resultDB;
	}

	private function getLevel($cat,$lev)
	{
		$ac = [];
		$aa = $this->Common_model->select_fields_where('tutor_lev','_name',['_cat' => $cat]);
		for ($i=0; $i < count($lev); $i++) {
			$ab[$i] = $this->Common_model->count_record('materi','id',['snip_level' => $lev[$i], 'snip_bin' => 0]);
		}
		foreach ($aa as $key => $ax) {
			$ac [] = ['level_name' => $ax['_name'], 'counter' => $ab[$key] ];
		}
		return $ac;
	}

	private function onModalAdd($table,$data,$order)
	{
		// return $this->Common_model->select_fields($table,$data,false,true,$order);
	}
	public function tes()
	{
		
	}
// =================== DASHBOARD
	public function index()
	{
		$data['kkk'] = '';
		_temp_admin($data,'Welcome Admin','index');
	}

	public function less()
	{
		$third = $this->uri->segment(3);
		$data['label'] = $this->Common_model->select_specific('level','description',['name'=>$third]);
		if (!empty($third)) {
			$data['getLesson'] = 'xhra/read_lesson/'.$third;
			_temp_admin($data,'Lesson JavaScript '.$third,'lesson_table');
		} else {
			not_found();
		}
	}

	public function editor()
	{
		$label = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		if(!empty($label) && !empty($order)){
			// select_where($table,$data,$where,$array=TRUE,$single=FALSE,$order='',$limit='')
			$edit = $this->Common_model->select_where(
				'materi','*',['les_order'=>$order,'les_level'=>$label],TRUE,TRUE
			);
			$data['id'] 		= $edit['les_id'];
			$data['order'] 	= $edit['les_order'];
			$data['label'] 	= $edit['les_level'];
			$data['titles'] = $edit['les_title'];
			$data['slug'] 	= $edit['les_slug'];
			$data['meta'] 	= $edit['les_meta'];
			$data['content']= $edit['les_content'];
			$data['code'] 	= $edit['les_length'];
			$data['upload'] = $edit['les_upload'];
			$data['update'] = $edit['les_update'];
			$data['public'] = $edit['les_publish'];
			$data['link'] = base_url('lesson/docs/'.$data['meta']);
			if($data['public'] == 1){
		    $data['btn'] = 'btn-success';
		    $data['icon']  = '<i class="fa fa-globe-asia"></i>';
			} else {
		    $data['btn'] = 'btn-danger';
		    $data['icon']  = '<i class="fa fa-code"></i>';
			}
			$next = $this->Common_model->select_where(
				'materi','les_order',['les_order >'=>$order,'les_level'=>$label],TRUE,FALSE,['les_order','ASC'],1
			);
			$prev = $this->Common_model->select_where(
				'materi','les_order',['les_order <'=>$order,'les_level'=>$label],TRUE,FALSE,['les_order','DESC'],1
			);
			$data['linkNext'] = ($next) ? base_url('a/editor/'.$label.'/'.$next[0]['les_order']) : '#';
			$data['linkPrev'] = ($prev) ? base_url('a/editor/'.$label.'/'.$prev[0]['les_order']) : '#';
			_temp_admin($data,'Edit - '.$edit['les_slug'],'lesson_edit');
		}
	}


// END OF FILE
}