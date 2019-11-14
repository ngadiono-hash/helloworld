<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
    $this->tutor    = 'tutors';
    $this->tutorLev = 'tutor_lev';
    $this->tutorCat = 'tutor_cat';

    $this->snip      = 'snip';
    $this->snip_help = 'snip_help';

    $this->user    = 'users';
    $this->cookie  = 'user_cookie';
    $this->valid   = 'user_valid';
    $this->progres = 'user_progress';
    $this->notif   = 'user_notif';
    $this->att     = 'login_attempt';

    $this->cdn  = 'cdn';
    $this->time = 'timeline';
    $this->com  = 'comment';
    $this->bug  = 'bug';
	}

// ================= NOTIFICATION
  public function updateNotif($set,$where)
  {
    return $this->db->update($this->notif,$set,$where);
  }

// ================= TUTORIAL

// ================= SNIPPET
  public function updateLiked($action,$id_post,$countLike);
  {
    // if ($action == 'add') {
    //   $this->db->update('snip',['code_like' => ($countLike + 1)],['code_id' => $id_post]);
    // } else {
    //   if ($countLike != 0) {
    //     $this->db->update('snip',['code_like' => ($countLike - 1)],['code_id' => $id_post]);
    //   } else {
    //     return true;
    //   }
    // }
  }
  public function updateCdn()
  {
    $id = $this->input->post('cdn_id');
    $name = $this->input->post('cdn_name');
    $version = $this->input->post('cdn_version');
    $link = $this->input->post('cdn[]');
    $link = implode(',', $link);
    $data = [
      'cdn_name' => $name,
      'cdn_version' => $version,
      'cdn_js' => $link
    ];
    $this->db->where('id', $id);
    $this->db->update('cdn', $data);
  }
  public function updateSnippet()
  {
    // $code_id = $this->input->post('id');
    // $jquery = [$this->input->post('jquery')];
    // $framework = [$this->input->post('framework')];
    // $cdn = array_merge($jquery,$framework);
    // if ($jquery[0] == '') {
    //   array_shift($cdn);
    // }
    // if ($framework[0] == '') {
    //   array_pop($cdn);
    // }
    // $set_snippets = [
    //   'code_title'  => trim(htmlspecialchars($this->input->post('title',true))),
    //   'code_desc'   => trim(htmlspecialchars($this->input->post('description',true))),
    //   'code_cdn'    => (!empty($cdn)) ? implode(',', $cdn) : null,
    //   'code_tag'    => $this->input->post('tag'),
    //   'code_html'   => htmlentities($this->input->post('html')),
    //   'code_css'    => htmlentities($this->input->post('css')),
    //   'code_js'     => htmlentities($this->input->post('js')),
    //   'code_update' => time(),
    //   'code_publish'=> $this->input->post('public')
    // ];
    // $set_timeline = ['publish' => $this->input->post('public')];
    // $this->db->update('snip',$set_snippets,['code_id' => $code_id]);
    // $this->db->update('timeline',$set_timeline,['relation' => $code_id]);
    // return true;
  }
// ================= USER PAGE
	public function updateMarkReadAll($user)
	{
		// $this->db->set('isNew',0);
		// $this->db->where('user',$user);
		// $this->db->or_where('user',getSession('sess_id'));
		// $this->db->update($this->notif);
	}

  public function updatePhotoPassword($data,$id)
  {
    return $this->db->update($this->user,$data,['u_id' => $id]);    
  }
  public function updateProfile()
  {
    $id   = getSession('sess_id');
    $set_profile = [
      'u_modified'  => time(),
      'u_name'      => trim($this->input->post('name',true)),
      'u_gender'    => $this->input->post('gender'),
      'u_bio'       => trim($this->input->post('bio',true)),
      'u_web'       => $this->input->post('web')
    ];
    return $this->db->update($this->user,$set_profile,['u_id' => $id]);
  }



// ============== ADMINISTRATOR
  public function updateTutorial()
  {
    // $id = $this->input->post('id');
    // $desc = $this->input->post('desc');
    // $desc = preg_replace('/&nbsp;/',' ', $desc);
    // $set_tutor = [
    //   'snip_title'      => ucwords($this->input->post('title')),
    //   'snip_slug'       => $this->input->post('slug'),
    //   'snip_code'       => $this->input->post('code'),
    //   'snip_content'    => $desc,
    //   'snip_meta'       => trim(create_slug($this->input->post('slug'))),
    //   'snip_update'     => time()
    // ];
    // return $this->db->update($this->tutor,$set_tutor,['snip_id' => $id]);
  } 

  public function updatePublish($id)
  {
    // $this->db->update($this->tutor,['snip_publish' => 1],['snip_id' => $id]);    
    // $this->db->update($this->time,['publish' => 1],['relation' => $id]);
  }
  public function updateDraft($id)
  {
    // $this->db->update($this->tutor,['snip_publish' => 0],['snip_id' => $id]);    
    // $this->db->update($this->time,['publish' => 0],['relation' => $id]);
  }
  public function updateTitle()
  {
    // $id = $this->input->post('id');
    // $title = $this->input->post('title');
    // return $this->db->update($this->tutor,['snip_title' => $title],['snip_id' => $id]);
  }
  public function updateSlug()
  {
    // $id = $this->input->post('id');
    // $slug  = $this->input->post('slug');
    // $slug  = str_replace(',','', $slug);
    // $meta  = create_slug($slug); 
    // $data = [ 
    //   'snip_slug' => trim($slug),
    //   'snip_meta' => trim($meta) 
    // ];
    // $this->db->update($this->tutor, $data, ['snip_id' => $id]);
  }

  public function updateUserRole($id,$role)
  {
  	if($role == 3){
  		$this->db->set('u_role','2')->where('u_id',$id);
  	} else {
  		$this->db->set('u_role','3')->where('u_id',$id);
  	}
  	return $this->db->update($this->user);
  }










// END OF UPDATE MODEL
}