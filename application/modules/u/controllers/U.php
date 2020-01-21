<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Common_model');
		$this->load->model('User_model');
	}

	public function Name()
	{
		$data['snippet']['total'] = $this->Common_model->count_record(
			'snip','id',['code_author' => getSession('sess_id')]
		);
		$data['snippet']['public'] = $this->Common_model->count_record(
			'snip','id',['code_author' => getSession('sess_id'),'code_publish' => 1]
		);
	}

	private function getDataCurrentUser()
	{
		$query = $this->Common_model->select_fields_where(
			'users',
			'u_id AS uid,u_provider AS provider,u_role AS role,u_username AS username,u_password AS password,u_email AS email,u_gender AS gender,u_name AS name,u_bio AS bio,u_web AS web,u_register AS register',
				['u_id' => getSession('sess_id')],
				true
		);
		return $query;
	}

	public function progress()
	{
		$this->load->model('User_model');
		echo $this->User_model->dataOnTable();
	}
	// ===================================================

	public function index()
	{
		$data['user'] = $this->getDataCurrentUser();
		$code = $this->Common_model->select_fields_where(
			'snip','*',['code_author' => getSession('sess_id'), 'code_publish' => 1],false,true,['code_upload','desc']
		);
		if (!empty($code)) {
			foreach ($code as $k => $v) {
				$code[$k]['comment'] = $this->Common_model->count_record('user_comment','id',['id_target' => $v['code_id']],true);
			}
			$draft = $this->Common_model->select_fields_where(
				'snip','*',['code_author' => getSession('sess_id'), 'code_publish' => 0],false,true,['code_upload','desc']
			);
			if (!empty($draft)) {
				foreach ($draft as $k => $v) {
					$draft[$k]['comment'] = $this->Common_model->count_record('user_comment','id',['id_target' => $v['code_id']],true);
				}
				$data['draft'] = $draft;
			}
			$data['code'] =  $code;
		}
		$book = $this->Common_model->select_fields_where_join(
			'snip AS t1',
			'
			t1.code_id,t1.code_title,t1.code_desc,t1.code_cdn,t1.code_tag,
			t1.code_html,t1.code_css,t1.code_js,t1.code_update,t1.code_upload,t1.code_publish,t1.code_like,
			t2.u_id AS id_author,
			t2.u_username AS user_author,
			t2.u_image AS image_author
			',
			[
				['table' => 'users AS t2', 'condition' => 't1.code_author = t2.u_id', 'type' => ''],
				['table' => 'user_book AS t3', 'condition' => 't1.code_id = t3.id_target', 'type' => ''],
			],
			['t3.id_user' => getSession('sess_id')],'',false
		);
		$html = $this->User_model->countTutorials('1');
		$css = $this->User_model->countTutorials('2');
		$js = $this->User_model->countTutorials('3');

		$last = $this->Common_model->select_fields_where_join(
			'tutors',
			'snip_title,snip_slug,snip_meta,_name,timing',
			[
				['table' => 'tutor_lev', 'condition' => 'tutor_lev._id = tutors.snip_level', 'type' => ''],
				['table' => 'user_progress', 'condition' => 'user_progress.id_snip = tutors.snip_id', 'type' => '']
			],
			['user_progress.id_user' => getSession('sess_id')],
			['timing','desc'],
			false			
		);

		$data['title'] = 'Dashboard - '.getSession('sess_user');
		$data['book'] = $book;
		$data['last'] = $last;
		$data['html'] = [
			'prog' 		=> $this->User_model->countProgress('1'),
			'all'	  	=> $html['public'] 
		];
		$data['css'] = [
			'prog' 		=> $this->User_model->countProgress('2'),
			'all'	  	=> $css['public'] 
		];
		$data['js'] = [
			'prog' 		=> $this->User_model->countProgress('3'),
			'all'	  	=> $js['public'] 
		];


		
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('dashboard',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	public function timeline() // ok
	{
		$data['fetch'] = $this->getDataCurrentUser();
		$record = $this->Common_model->select_fields_where_join(
			'timeline AS t1',
			'
				t4.u_username AS line_user,
				t4.u_image AS line_pic,
				t3.code_id AS line_code_id,
				t3.code_title AS line_code_title,
				t3.code_desc AS line_code_desc,
				t2.snip_id AS line_tutor_id,
				t1.id AS timeline_id,
				t1.category AS timeline_cat,
				t1.relation AS timeline_rel,
				t1.created AS timeline_time
				',
				[
					['table' => 'tutors AS t2','condition' => 't2.snip_id = t1.relation', 'type' => 'left'],
					['table' => 'snip AS t3','condition' => 't3.code_id = t1.relation', 'type' => 'left'],
					['table' => 'users AS t4','condition' => 't4.u_id = t1.user', 'type' => ''],
				],
				['t1.publish' => 1],
				['t1.created','desc']
		);
		foreach ($record as $k => $v) {
			if ($v['timeline_cat'] == 1) {
				$query[$k] = $this->Common_model->select_fields_where_join(
					'tutors AS t1',
					'
						t1.snip_id AS id,
						t1.snip_title AS judul,
						t1.snip_slug AS slug,
						t1.snip_meta AS meta,
						t1.snip_content AS konten,
						t2._name AS kategori,
						t3._name AS level,
					',
					[
						['table' => 'tutor_cat AS t2','condition' => 't2._id = t1.snip_category', 'type' => ''],
						['table' => 'tutor_lev AS t3','condition' => 't3._id = t1.snip_level', 'type' => '']
					],
					['t1.snip_id' => $v['line_tutor_id'],'t1.snip_publish' => 1,'t1.snip_bin' => 0],'',true
				);
				$record[$k]['line_tutor_title'] = $query[$k]['judul'];
				$record[$k]['line_tutor_slug'] = $query[$k]['slug'];
				$record[$k]['line_tutor_meta'] = $query[$k]['meta'];
				$record[$k]['line_tutor_cat'] = $query[$k]['kategori'];
				$record[$k]['line_tutor_level'] = $query[$k]['level'];
				$record[$k]['line_tutor_read'] = read_more($query[$k]['konten'],250);
			}
		}
		$data['user'] = $this->getDataCurrentUser();
		$data['record'] = $record;
		$data['title'] = 'Timeline - '.getSession('sess_user');
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('timeline',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	public function delete($param)
	{
		$auth = $this->Common_model->select_spec('snip','code_author',['code_id' => $param]);
		if ($auth == getSession('sess_id')) {
			$this->Common_model->delete('snip',['code_id' => $param]);
			$this->Common_model->delete('user_comment',['id_target' => $param]);
			$this->Common_model->delete('user_liked',['id_target' => $param]);
			$this->Common_model->delete('timeline',['relation' => $param]);
		}
		redirect('u');
	}

	public function create($param)
	{
		if (empty($param)) {
			not_found();
		} else {
			if ($param == 'snippet') {
				$data['tag'] = $this->Common_model->select_fields_where(
					'snip_cat','*',[],false,true,['category_name','asc']
				);
				$data['jQuery'] = $this->Common_model->select_fields_where(
					'snip_cdn','*',['id' => 1],false,true,['cdn_name','desc']
				);
				$data['framework'] 	= $this->Common_model->select_fields_where(
					'snip_cdn','*',['id !=' => 1],false,true,['cdn_name','asc']
				);
				$data['title'] = 'Buat Snippet';
				$this->load->view('templates/mainHeader', $data);
				$this->load->view('create_snippet',$data);
				$this->load->view('templates/mainFooter',$data);	
			}
		}
	}

	public function edit($param)
	{
		if (empty($param)) {
			not_found();
		} else {
			$serial = $this->uri->segment(4);
			if ($param == 'snippet' && !empty($serial)) {
				$cek = $this->User_model->getValidAuthSnippet($serial);
				if($cek == 0) {
					not_found();
				} else {
					$framework = $this->Common_model->select_fields_where(
						'snip_cdn','*',['id !=' => 1],false,true,['cdn_name','asc']
					);
					$jQuery = $this->Common_model->select_fields_where(
						'snip_cdn','*',['id' => 1],false,true,['cdn_name','desc']
					);
					$tag = $this->Common_model->select_fields_where(
						'snip_cat','*',[],false,true,['category_name','asc']
					);
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
						['t1.code_id' => $serial],'',true
					);
					$tag_id = explode(',',$code['code_tag']);
					$cdn_id = (!empty($code['code_cdn'])) ? explode(',',$code['code_cdn']) : [];
					$frame_id = [];
					if(in_array(1,$cdn_id)){
						$frame_id = array_slice($cdn_id,1);
					}

					$data = [
						'code' => $code,
						'tag_snippet' => $tag_id,
						'tag' => $tag,
						'cdn_snippet' => $cdn_id,
						'frame_id' => $frame_id,
						'jQuery' => $jQuery,
						'framework' => $framework
					];
					$data['title'] = 'Edit Snippet - '.$data['code']['code_title'];
					$this->load->view('templates/mainHeader', $data);
					$this->load->view('edit_snippet',$data);
					$this->load->view('templates/mainFooter',$data);	
				}			
			} else {
				not_found();
			}
		}
	}

	public function notification() //
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

	public function activity() // ok
	{

		// _temp_user($data,'Timeline - ' . ucwords(getSession('sess_user')),'activity');
	}

	public function profile() // ok
	{

		$data['fetch'] = $this->getDataCurrentUser();
		$data['title'] = 'Profil - '.ucwords(getSession('sess_user'));
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('edit_profile',$data);
		$this->load->view('templates/mainFooter',$data);
	}




// END OF FILE
}