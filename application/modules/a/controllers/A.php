<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class A extends CI_Controller
{
// =================== CONSTRUCT
	public function __construct()
	{
		parent::__construct();
		reload_session();
		is_logged();
		is_admin();
		$this->load->model('Common_model');
	}

	private function countMateri($level)
	{
		$DB = [];
		$DB['nam'] = ucwords($level);
		$DB['lin'] = base_url().'a/less/'.$level;
		$DB['all'] = $this->Common_model->counting('materi',['les_level' => $level]);
		$DB['pub'] = $this->Common_model->counting('materi',['les_level' => $level,'les_publish' => 1]);
		$DB['dra'] = $this->Common_model->counting('materi',['les_level' => $level,'les_publish' => 0]);
		return $DB;
	}

	public function tes()
	{
		
	}
// =================== DASHBOARD
	public function index()
	{
		$data['t']['b'] = $this->countMateri('beginner');
		$data['t']['i'] = $this->countMateri('medium');
		$data['t']['a'] = $this->countMateri('advance');
		_temp_admin($data,'Welcome Admin','index');
	}

	public function less()
	{
		$third = $this->uri->segment(3);
		$data['label'] = $this->Common_model->select_specific('level','description',['name'=>$third]);
		if (!empty($third)) {
			$data['getData'] = 'xhra/read_lesson/'.$third;
			_temp_admin($data,'Table '.$data['label'],'lesson_table');
		} else {
			not_found();
		}
	}

	public function editor()
	{
		$label = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		if (in_array($label,['beginner','medium','advance'])) {
			$lb = 'js';
		} else {
			$lb = 'bla';
		}
		if(!empty($label) && !empty($order)){
			$edit = $this->Common_model->select_where(
				'materi','*',['les_order'=>$order,'les_level'=>$label],TRUE,TRUE
			);
			$data['id'] 		= $edit['les_id'];
			$data['order'] 	= $edit['les_order'];
			$data['label'] 	= $edit['les_level'];
			$data['titles'] = $edit['les_title'];
			$data['slug'] 	= $edit['les_slug'];
			$data['meta'] 	= create_slug($edit['les_slug']);
			$data['content']= $edit['les_content'];
			$data['code'] 	= $edit['les_length'];
			$data['upload'] = $edit['les_upload'];
			$data['update'] = $edit['les_update'];
			$data['public'] = $edit['les_publish'];
			$data['link'] = base_url($lb.'/docs/'.$data['meta']);
			if($data['public'] == 1){
		    $data['btn'] = 'btn-success';
		    $data['icon']  = '<i class="fa fa-globe-asia"></i>';
			} else {
		    $data['btn'] = 'btn-danger';
		    $data['icon']  = '<i class="fa fa-code"></i>';
			}
			$next = $this->Common_model->select_where(
				'materi','les_order,les_slug',['les_order >'=>$order,'les_level'=>$label],TRUE,FALSE,['les_order','ASC'],1
			);
			$prev = $this->Common_model->select_where(
				'materi','les_order,les_slug',['les_order <'=>$order,'les_level'=>$label],TRUE,FALSE,['les_order','DESC'],1
			);
			$data['linkNext'] = $next ? base_url('a/editor/'.$label.'/'.$next[0]['les_order']) : '#';
			$data['slugNext'] = $next ? $next[0]['les_slug'] : '';
			$data['linkPrev'] = $prev ? base_url('a/editor/'.$label.'/'.$prev[0]['les_order']) : '#';
			$data['slugPrev'] = $prev ? $prev[0]['les_slug'] : '';
			_temp_admin($data,'Edit - '.$edit['les_slug'],'lesson_edit');
		}
	}



	public function quiz()
	{
		$third = $this->uri->segment(3);
		$data['label'] = $this->Common_model->select_specific('level','description',['name'=>$third]);
		$data['quiz'] = $this->Common_model->select_where(
			'materi','les_id,les_title',['les_level'=>$third],true,false,['les_order','asc']
		);
		if (!empty($third)) {
			$data['getData'] = 'xhra/read_quiz/'.$third;
			_temp_admin($data,'Quiz '.$data['label'],'quiz_table');
		} else {
			not_found();
		}
	}


// END OF FILE
}