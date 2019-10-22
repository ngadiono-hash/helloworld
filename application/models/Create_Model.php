<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
    $this->tutor    = 'tutors';
    $this->tutorLev = 'tutor_lev';
    $this->tutorCat = 'tutor_cat';

    // 'snip'      = 'snip';
    // 'snip'_help = 'snip_help';

    $this->user    = 'users';
    $this->cookie  = 'user_cookie';
    $this->valid   = 'user_valid';
    $this->progres = 'user_progress';
    $this->notif   = 'user_notif';
    $this->att     = 'login_attempt';

    $this->time  = 'timeline';
    // 'comment'   = 'comment';
    $this->sec   = 'secure';
    // 'liked' = 'liked';

    $this->cdn = 'cdn';
    $this->bug  = 'bug';
	}

// ================= TUTORIAL

// ================= SNIPPET
  public function insertSnippet()
  {

	  $code_id = getRandStr(6);
    $count = $this->db->where('_id',$code_id)->get('snip');
    if ($count->num_rows() > 0) {
    	$code_id = getRandStr(6);
    }
    $data_snippets = [
      '_id'     		=> $code_id,
      'code_author' => getSession('sess_id'),
      'code_title'  => trim($this->input->post('title',true)),
      'code_desc'   => trim($this->input->post('description',true)),
      'code_html'   => htmlentities($this->input->post('html')),
      'code_css'    => htmlentities($this->input->post('css')),
      'code_js'     => htmlentities($this->input->post('js')),
      'code_upload' => time(),
      'code_update' => time(),
      'code_publish' => $this->input->post('public')
    ];
    $data_helpers = [
      'id_snippet'    => $code_id,
      'cdn_framework' => $this->input->post('framework'),
      'cdn_jquery'    => $this->input->post('jquery')
    ];
    $data_timeline = [
    	'category' => 2,
    	'user' 		 => getSession('sess_id'),
    	'relation' => $code_id,
    	'created'  => time(),
    	'publish'  => $this->input->post('public')
    ];
    $this->db->insert('snip',$data_snippets);
    $this->db->insert('snip_help',$data_helpers);
    $this->db->insert($this->time,$data_timeline);
    return true;
  }

  public function addCdn()//
  {
    $name = $this->input->post('cdn_name');
    $version = $this->input->post('cdn_version');
    $link = $this->input->post('cdn_link');
    $type = $this->input->post('cdn_type');
    $data = [
      'cdn_name' => $name,
      'cdn_type' => $type,
      'cdn_version' => $version,
      'cdn_link' => $link
    ];
    $this->db->insert('cdn',$data);
  }
  public function insertComment($id,$comment)
  {
    $data_comment = [
      'id_user' => getSession('sess_id'),
      'id_target' => $id,
      'message' => htmlentities($comment),
      'created' => time()
    ];
    $this->db->insert('comment',$data_comment);
    return $this->db->insert_id(); 
  }
// ================= USER PAGE
// ================= MAIN USER
	public function insertToken($user_token=[])
	{
		$this->db->insert($this->valid,$user_token);
	}

	public function insertRegister($user_data)
	{
		$this->db->insert($this->user, $user_data);
	}

	public function insertAttempt($email)
	{
		$data = [
			'log_time' => time(),
			'log_email' => $email,
			'log_ip' => getIp(),
			'log_agent' => $_SERVER['HTTP_USER_AGENT'],
			'log_att' => 0
		];
		$this->db->insert($this->att,$data);
	}	

	public function insertCookie($dataCookie=[])
	{
		$data = [
			'created' 	=> time(),
			'expired' 	=> $dataCookie['expired'],
			'token' 		=> $dataCookie['token'],
			'email' 		=> $dataCookie['email'],
			'ip'  			=> $dataCookie['ip'],
			'agent' 		=> $dataCookie['agent']
		];
		$this->db->insert($this->cookie,$data);
		setcookie('c_user',$dataCookie['token'],$dataCookie['expired'],'/');
	}	

	public function insertBug($data)
	{
		$this->db->insert($this->bug,$data);
	}

	public function insertNotifLogin($notif=[])
	{
		$data = [
      'user'    => $notif['user'],
      'ip'      => $notif['ip'],
      'agent'   => $notif['agent'],
			'created' => $notif['created'],
		];
		$this->db->insert($this->sec,$data);
	}	

  public function insertLiked($id)
  {
    $data = [
      'id_user' => getSession('sess_id'),
      'id_target' => $id,
      'created' => time()
    ];
    $this->db->insert('liked',$data);
  }

// ================= ADMINISTRATOR
  public function insertTutorial()
  {
    $category = $this->input->post('category');
    $id = getRandStr(6);
    if($category == 1){
    	$id = 'h'.$id;
    } elseif ($category == 2) {
    	$id = 'c'.$id;
    } else {
    	$id = 'j'.$id;
    }
    $order = $this->db->where(['snip_category'=> $category, 'snip_bin' => 0 ])->from($this->tutor)->count_all_results();  
    $data_tutor = [
    	'snip_id'				=> $id,
      'snip_order'    => $order + 1,
      'snip_title'    => ucwords($this->input->post('title')),
      'snip_slug'     => $this->input->post('slug'),
      'snip_level'    => $this->input->post('level'),
      'snip_category' => $category,
      'snip_meta'     => trim(create_slug($this->input->post('slug'))),
      'snip_upload'   => time(),
      'snip_update'   => time()
    ];
    $data_timeline = [
    	'category' 	=> 1,
    	'user' 			=> getSession('sess_id'),
    	'relation'	=> $id,
    	'created'		=> time(),
    	'publish'		=> 0
    ];
    $this->db->insert($this->tutor,$data_tutor);
    $this->db->insert($this->time,$data_timeline);
  }

// END OF CREATE MODEL
}