<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
		
		$this->tutor 	  = 'tutors';
		$this->tutorLev = 'tutor_lev';
		$this->tutorCat = 'tutor_cat';

		$this->snip 	   = 'snip';
		$this->snip_help = 'snip_help';

		$this->user 	 = 'users';
		$this->cookie  = 'user_cookie';
		$this->valid   = 'user_valid';
		$this->progres = 'user_progress';
		$this->notif   = 'user_notif';
		$this->att     = 'login_attempt';

		$this->cdn 	= 'cdn';
		$this->time = 'timeline';
		$this->com  = 'comment';
		$this->bug 	= 'bug';
	}

// ================= TUTORIAL

// ================= SNIPPET
  public function deleteSnippet($serial)
  {
    $this->db->delete($this->snip,['_id' => $serial]);
    $this->db->delete($this->snip_help,['id_snippet' => $serial]);
  }	
// ================= USER PAGE
// ================= MAIN USER
	public function deleteToken($email)
	{
		$this->db->delete($this->valid,['email' => $email]);
	}

	public function deleteUser($email)
	{
		$this->db->delete($this->user,['u_email' => $email]);
	}

	public function deleteAttempt($email)
	{
		$this->db->where('log_email',$email);
		$this->db->delete($this->att);
	}	

	public function deleteCookie($token)
	{
		$this->db->delete($this->cookie,['token' => $token]);
	}


// =================== ADMINISTRATOR
  public function deleteTutorial($id)
  {
    $data = ['snip_bin' => 1, 'snip_order' => 0];
    $this->db->set($data)->where('snip_id', $id);
    return $this->db->update($this->tutor);
  }

  public function deleteUserByAdmin($id)
  {
		$this->db->where('u_id', $id);
		return $this->db->delete('user');
  }











// END OF DELETE MODEL
}