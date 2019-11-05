<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class U extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		reload_session();
		is_login();
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
	}

	public function haha(){
		
	}



	public function index()
	{
		// countNotifNavbar();
		$data['record'] = $this->Read_model->getHomeTimeLine();
		foreach ($data['record'] as $k => $v) {
			if ($v['timeline_cat'] == 1) {
				$query[$k] = $this->Read_model->getTutorialByid($v['line_tutor_id']);
				$data['record'][$k]['line_tutor_title'] = $query[$k]['judul'];
				$data['record'][$k]['line_tutor_slug'] = $query[$k]['slug'];
				$data['record'][$k]['line_tutor_meta'] = $query[$k]['meta'];
				$data['record'][$k]['line_tutor_cat'] = $query[$k]['kategori'];
				$data['record'][$k]['line_tutor_level'] = $query[$k]['level'];
				$data['record'][$k]['line_tutor_read'] = readMore($query[$k]['konten'],250);		
			}
		}

		_temp_user($data,'Beranda','index');
	}

	public function notification()//
	{
		$user = $this->Read_model->getDataUser();
		$security = $this->Read_model->getSecurityNotif($user['email']);
		$comment = $this->Read_model->getCommentNotif();
		$like = $this->Read_model->getLikedNotif();
		foreach ($security as $k => $v) {
			$security[$k]['type'] = 1;
		}
		foreach ($comment as $k => $v) {
			$comment[$k]['type'] = 2;
		}
		foreach ($like as $k => $v) {
			$like[$k]['type'] = 3;
		}
		$obj = array_merge($security,$comment,$like);
		$sort_by_date = array_column($obj,'created');
		array_multisort($sort_by_date,SORT_DESC,$obj);
		$result = array();
		foreach ($obj as $el) {
		  $result[date('d M Y',$el['created'])][] = $el;
		}
		$data['arr'] = $result;
		_temp_user($data,'Pemberitahuan','notification');
	}

	public function activity()
	{	

		$fetch = $this->Read_model->getDataUser();
		$data['name']			= $fetch['name'];
		$data['gender']		= $fetch['gender'];
		$data['icon_gen'] = ($data['gender'] == 'Laki-laki') ? 'fa-mars' : 'fa-venus';
		$data['bio']			= $fetch['bio'];

		$data['html_count'] = $this->Read_model->countProgress('1');
		$html = $this->Read_model->countTutorials('1');	
		$data['html_all'] = $html['public'];
		$data['html_pro'] = round(floor($data['html_count'] * 100 / $data['html_all']));

		$data['css_count'] = $this->Read_model->countProgress('2');
		$css = $this->Read_model->countTutorials('2');
		$data['css_all'] = $css['public'];
		$data['css_pro'] = round(floor($data['css_count'] * 100 / $data['css_all']));

		$data['js_count'] = $this->Read_model->countProgress('3');
		$js = $this->Read_model->countTutorials('3');
		$data['js_all'] = $js['public'];
		$data['js_pro'] = round(floor($data['js_count'] * 100 / $data['js_all']));

		_temp_user($data,'Timeline - ' . ucwords(getSession('sess_user')),'activity');	
	}

	public function profile()
	{
		$fetch = $this->Read_model->getDataUser();
		$data['provider']	= $fetch['provider'];
		$data['email']		= $fetch['email'];
		$data['name']			= $fetch['name'];
		$data['gender']		= $fetch['gender'];
		$data['icon_gen']  = ($data['gender'] == 'Laki-laki') ? 'fa-mars' : 'fa-venus';
		$data['web']			= $fetch['web'];
		$data['bio']			= $fetch['bio'];

		_temp_user($data,'Profil - '.ucwords(getSession('sess_user')),'profile');
	}

	public function snippet($p1='',$serial='')
	{
		$data['code'] = $this->Read_model->getAllSnippetByAuthor();
		if($p1 == '') {
			_temp_user($data,'Snippet Saya','code_user');		
		}

		elseif($p1 == 'create'){
			$data['tag'] = $this->Read_model->getTagSnippet();
			$data['jQuery'] 		= $this->Read_model->getCdnJquery();
			$data['framework'] 	= $this->Read_model->getAllListCdn();
			_temp_user($data,'Buat Snippet','code_create');				
		}

		elseif (($p1 == 'edit') && !empty($serial)) {
			$cek = $this->Read_model->getValidAuthSnippet($serial);
			if($cek == 0) {
				not_found();
			} else {
				$data['code'] = $this->Read_model->getSingleSnippet(['t1.code_id' => $serial]);
				$data['fm_snippet'] = explode(',',$data['code']['code_cdn']);
				$data['tag_snippet'] = explode(',',$data['code']['code_tag']);
				$data['tag'] = $this->Read_model->getTagSnippet();
				$data['framework'] = $this->Read_model->getAllListCdn();
				$data['jQuery'] 	 = $this->Read_model->getCdnJquery();
				_temp_user($data,"Edit Snippet - ".$data['code']['code_title'],'code_edit');				
			}
		}

		elseif($p1 == 'delete'){	
			if($serial){
				$this->Snippet_model->deleteSnippet($serial);
				$res = 1;
			}else{
				$res = 0;
			}
			echo json_encode($res);
		} else {
			not_found();
		}
	}	


// END OF FILE
}