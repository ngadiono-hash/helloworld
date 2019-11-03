<?php defined('BASEPATH') OR exit('No direct script access allowed');

class At_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

// ==================== CREATE QUERY 
	public function insertToken($data_token)
	{
		$this->db->insert('validate',$data_token);
	}
	public function insertRegister($data_user)
	{
		$this->db->insert('users', $data_user);
	}
	public function insertAttempt($email)
	{
		$data = [
			'log_time'  => time(),
			'log_email' => $email,
			'log_ip'    => getIp(),
			'log_agent' => $_SERVER['HTTP_USER_AGENT'],
			'log_att'   => 0
		];
		$this->db->insert('login',$data);
	}	
	public function insertCookie($data_cookie)
	{
		$data = [
			'created' 	=> time(),
			'expired' 	=> $data_cookie['expired'],
			'token' 		=> $data_cookie['token'],
			'email' 		=> $data_cookie['email'],
			'ip'  			=> $data_cookie['ip'],
			'agent' 		=> $data_cookie['agent']
		];
		$this->db->insert('user_cookie',$data);
		setcookie('c_user',$data_cookie['token'],$data_cookie['expired'],'/');
	}	
	public function insertBug($data)
	{
		$this->db->insert('bug',$data);
	}
	public function insertNotifLogin($data_notif)
	{
		$data = [
			'user'    => $data_notif['user'],
			'ip'      => $data_notif['ip'],
			'agent'   => $data_notif['agent'],
			'created' => $data_notif['created'],
		];
		$this->db->insert('secure',$data);
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

// ==================== READ QUERY
	public function checkUserFb($fb)
	{
		if(!empty($fb)){
			$this->db->select('u_id');
			$this->db->from('users');
			$this->db->where(['u_provider' => $fb['provider'], 'u_id' => $fb['uid']]);
			$prevQuery = $this->db->get();
			$prevCheck = $prevQuery->num_rows();
			if($prevCheck > 0){
				$prevResult = $prevQuery->row_array();
				$data = [
					'sess_id'    => $prevResult['u_id'],
					'sess_role'  => $prevResult['u_role'],
					'sess_user'  => $prevResult['u_username'],
					'sess_reg'   => $prevResult['u_register'],
					'sess_image' => $prevResult['u_image']
				];
				$this->session->set_userdata($data);
				return true;
			} else {
				$data = [
					'u_id'        => $fb['uid'],
					'u_provider'  => $fb['provider'],
					'u_role'      => $fb['role'],
					'u_username'  => $fb['username'],
					'u_email'     => $fb['email'],
					'u_active'    => 1,
					'u_register'  => time(),
					'u_modified'  => time(),
					'u_image'     => $fb['image'],
					'u_name'      => $fb['name'],
					'u_gender'    => $fb['gender']
				];
				$this->db->insert('users', $data);
				$data = [
					'sess_id'    => $fb['uid'],
					'sess_role'  => $fb['role'],
					'sess_user'  => $fb['username'],
					'sess_reg'   => time(),
					'sess_image' => $fb['image']
				];
				$this->session->set_userdata($data);
				return true;
			}
		}
	}

	public function getDataUser()
	{
		$this->db->select('
			u_id AS uid,
			u_provider AS provider,
			u_username AS username,
			u_password AS password,
			u_email AS email,
			u_gender AS gender,
			u_name AS name,
			u_bio AS bio,
			u_web AS web
		');
		$this->db->where('u_id',getSession('sess_id'));
		return $this->db->get('users')->row_array();
	}

	public function getUserDataByEmail($email)
	{
		$this->db->select('
			u_id AS id,
			u_username AS username,
			u_email AS email,
			u_active AS active,
			u_register AS register,
			u_role AS role,
			u_password AS password,
			u_image AS image
		');
		$this->db->where('u_email',$email);
		return $this->db->get('users')->row_array();
	}

	public function getUserDataByEmailActive($email)
	{
		$this->db->select('
			u_email AS email,
			u_password AS password
		');
		$this->db->where(['u_email' => $email, 'u_active' => 1]);
		return $this->db->get('users')->row_array();
	}
	public function getAttempt($email,$ip,$agent)
	{
		$this->db->select('
			log_att AS attempt,
			log_time AS time,
		');
		$this->db->where(['log_email'=>$email,'log_ip'=>$ip,'log_agent'=>$agent]);
		return $this->db->get('login')->row_array();
	}
	public function getTokenUrl($token)
	{
		$this->db->select('email AS e, token AS t, created AS c');
		$this->db->where(['token' => $token]);
		return $this->db->get('validate')->row_array();
	}
	public function countTokenByEmail($email)
	{
		$this->db->where('email', $email);
		return $this->db->get('validate')->num_rows();
	}
	public function countAttempt($email,$ip,$agent) 
	{
		$this->db->from('login');
		$this->db->where();
		return $this->db->get()->num_rows();
	}

// ==================== UPDATE QUERY
	public function updateActivate($email)
	{
		return $this->db->update('users',['u_active' => 1],['u_email' => $email]);
	}

	public function updatePassword($email,$password)
	{
		return $this->db->update('users',['u_password' => $password],['u_email' => $email]);
	}

	public function updateAttempt($now,$email,$ip,$agent)
	{
		$where = ['log_email' => $email,'log_ip' => $ip,'log_agent' => $agent];
		$this->db->set('log_att','`log_att`+1',FALSE);
		$this->db->set('log_time',$now);
		$this->db->where($where);
		return $this->db->update('login');
	}

	public function updateResetAttempt($now,$email,$ip,$agent)
	{
		$where = ['log_email' => $email,'log_ip' => $ip,'log_agent' => $agent];
		$set = ['log_att' => 0,'log_time'=>$now];
		return $this->db->update('login',$set,$where);
	}

// ==================== DELETE QUERY
	public function deleteToken($email)
	{
		$this->db->delete('validate',['email' => $email]);
	}

	public function deleteUser($email)
	{
		$this->db->delete('users',['u_email' => $email]);
	}

	public function deleteAttempt($email)
	{
		$this->db->delete('login',['log_email' => $email]);
	}	

	public function at_deleteCookie($token)
	{
		$this->db->delete('user_cookie',['token' => $token]);
	}

	public function deleteComment($id)
	{
		return $this->db->delete('user_comment',['created' => $id]);
	}

} // END
