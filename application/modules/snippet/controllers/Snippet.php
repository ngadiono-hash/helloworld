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
		$code = [];
		$code = $this->Common_model->select_fields_where_join(
			'snip AS t1',
			't1.code_id,t1.code_title,t1.code_like AS liked,t1.code_view AS view,t2.u_username AS user_author,t2.u_image AS image_author',
			[
				['table' => 'users AS t2', 'condition' => 't2.u_id = t1.code_author', 'type' => '']
			],
			['t1.code_publish' => 1],
			['t1.code_upload','desc']
		);
		foreach ($code as $k => $v) {
			$code[$k]['comment'] = $this->Common_model->count_record('user_comment','id',['id_target' => $v['code_id']],true);
		}
		$data = [
			'title' => 'Snippet Hello World',
			'code'  => $code,
		];

		$this->load->view('templates/mainHeader', $data);
		$this->load->view('index', $data);
		$this->load->view('templates/mainFooter', $data);
	}

	public function s($serial)
	{
		$check = $this->Common_model->check_exist('snip',['code_id' => $serial, 'code_publish' => 1]);
		if (!$check) {
			$data['exist'] = false;
			$data['code'] = [];
			$data['title'] = 'Oops';
		} else {
			$code = $this->Common_model->select_fields_where_join(
				'snip AS t1',
				'
				t1.code_id,t1.code_title,t1.code_desc,t1.code_cdn,t1.code_tag,
				t1.code_html,t1.code_css,t1.code_js,t1.code_update,t1.code_upload,t1.code_publish,t1.code_like,
				t2.u_id AS id_author,
				t2.u_username AS user_author,
				t2.u_image AS image_author
				',
				[
					['table' => 'users AS t2', 'condition' => 't1.code_author = t2.u_id', 'type' => '']
				],
				['t1.code_id' => $serial, 't1.code_publish' => 1],'',true
			);
			$fm_id = explode(',',$code['code_cdn']);
			for ($i = 0; $i < count($fm_id) ; $i++) {
				$framework[$i] = $this->Common_model->select_fields_where(
					'snip_cdn',
					'id,cdn_name,cdn_version,cdn_link',
					['id' => $fm_id[$i]],
					true
				);
			}
			$tag = explode(',',$code['code_tag']);
			for ($i = 0; $i < count($tag) ; $i++) {
				$tags[$i] = $this->Common_model->select_fields_where(
					'snip_cat','category_id,category_name',['id' => $tag[$i]],true
				);
			}
			$count_comm = $this->Common_model->count_record(
				'user_comment','id',['id_target' => $serial],true
			);
			$comment = $this->Common_model->select_fields_where_join(
				'user_comment AS t1',
				't1.id,t1.message AS message,t1.created AS created,
				t2.u_id AS id_comm,t2.u_username AS name_comm,t2.u_image AS img_comm,
				t3.code_author AS author',
				[
					['table' => 'users AS t2', 'condition' => 't1.id_user = t2.u_id', 'type' => ''],
					['table' => 'snip AS t3', 'condition' => 't1.id_target = t3.code_id', 'type' => ''],
				],
				['t1.id_target' => $serial],
				['t1.created','desc'],
				false,true,5
			);
			$like = false;
			if(startSession('sess_id')) {
				$like = $this->Common_model->check_exist(
					'user_liked',['id_user' => getSession('sess_id'),'id_target' => $serial]
				);				
			}
			$data = [
				'exist' => true,
				'title' => $code['code_title'],
				'code' => $code,
				'fm_snippet' => $fm_id,
				'framework' => $framework,
				'tags_snippet' => $tags,
				'count_comm' => $count_comm,
				'comment' => (!empty($comment)) ? append_comment($comment) : [],
				'like' => ($like) ? 'active' : ''
			];
		}
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('single_snippet', $data);
		$this->load->view('templates/mainFooter', $data);			
	}

	public function p($serial) // ok
	{
		$check = $this->Common_model->check_exist('snip',['code_id' => $serial]);
		if (!$check) {
			not_found();
		} else {
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
			$this->load->view('thumbs_snippet',$data);
		}
	}


// END OF FILE
}