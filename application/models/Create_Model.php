<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
    // 'tutors'    = 'tutors';
    $this->tutorLev = 'tutor_lev';
    $this->tutorCat = 'tutor_cat';

    // 'snip'      = 'snip';
    // 'snip'_help = 'snip_help';

    // 'users'    = 'users';
    // 'user_cookie'  = 'user_cookie';
    // 'user_valid'   = 'user_valid';
    $this->progres = 'user_progress';
    $this->notif   = 'user_notif';
    // 'login_attempt'     = 'login_attempt';

    // 'timeline'  = 'timeline';
    // 'comment'   = 'comment';
    // 'secure'   = 'secure';
    // 'liked' = 'liked';

    $this->cdn = 'cdn';
    $this->bug  = 'bug';
	}

// ================= TUTORIAL

// ================= SNIPPET
  public function insertSnippet()
  {

	  $code_id = getRandStr(6);
    $count = $this->db->get_where('snip',['code_id' => $code_id]);
    if ($count->num_rows() > 0) {
    	$code_id = getRandStr(6);
    }
    $jquery = [$this->input->post('jquery')];
    $framework = [$this->input->post('framework')];
    $cdn = array_merge($jquery,$framework);
    if ($jquery[0] == '') {
      array_shift($cdn);
    }
    if ($framework[0] == '') {
      array_pop($cdn);
    }
    $data_snippets = [
      'code_id'     => $code_id,
      'code_author' => getSession('sess_id'),
      'code_title'  => trim(htmlspecialchars($this->input->post('title',true))),
      'code_desc'   => trim(htmlspecialchars($this->input->post('description',true))),
      'code_cdn'    => (!empty($cdn)) ? implode(',', $cdn) : null,
      'code_tag'    => $this->input->post('tag'),
      'code_html'   => htmlentities($this->input->post('html')),
      'code_css'    => htmlentities($this->input->post('css')),
      'code_js'     => htmlentities($this->input->post('js')),
      'code_upload' => time(),
      'code_update' => time(),
      'code_publish' => $this->input->post('public')
    ];
    $data_timeline = [
    	'category' => 2,
    	'user' 		 => getSession('sess_id'),
    	'relation' => $code_id,
    	'created'  => time(),
    	'publish'  => $this->input->post('public')
    ];
    $this->db->insert('snip',$data_snippets);
    $this->db->insert('timeline',$data_timeline);
    return true;
  }

  public function insertCdn()
  {
    if (getSession('sess_role') != 1) {
      $author = getSession('sess_id');
    } else {
      $author = 1;
    }    
    $cdn = $this->input->post('cdn[]');
    $cdn = implode(',', $cdn);
    $data = [
      'cdn_author' => $author,
      'cdn_name' => htmlspecialchars($this->input->post('cdn_name')),
      'cdn_version' => $this->input->post('cdn_version'),
      'cdn_link' => $cdn
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
    $order = $this->db->where(['snip_category'=> $category, 'snip_bin' => 0 ])->from('tutors')->count_all_results();  
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
    $this->db->insert('tutors',$data_tutor);
    $this->db->insert('timeline',$data_timeline);
  }

// END OF CREATE MODEL
}