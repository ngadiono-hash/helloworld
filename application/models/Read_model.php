<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Read_model extends CI_Model 
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

    $this->time  = 'timeline';
    $this->com   = 'comment';
    $this->sec   = 'secure';
    $this->liked = 'liked';

    $this->cdn  = 'cdn';
    $this->bug  = 'bug';
	}

	public function checkExist($table,$where=[])
	{
	  $this->db->where($where);
		$cek = $this->db->get($table);
		return $cek->num_rows();
	}

// ================= NOTIFICATION
	public function getNewNotif()
	{
		$this->db->select('comment AS c, liked AS l, security AS s');
		$this->db->where('user',getSession('sess_id'));
		$this->db->where('comment',1);
		$this->db->or_where('liked',1);
		$this->db->or_where('security',1);
		return $this->db->get($this->notif)->row_array();
	}
	public function countNotifCom()
	{
		$this->db->select('t1.id');
		$this->db->from('comment AS t1');
		$this->db->join('snip AS t2','t1.id_target = t2.code_id');
		$this->db->where([
			't1.id_user !=' => getSession('sess_id'),
			't1.status' => 1, 
			't2.code_author' => getSession('sess_id'), 
		]);
		$x = $this->db->get();
		return $x->num_rows();
	}
	public function countNotifLike()
	{
		$this->db->select('t1.id');
		$this->db->from('liked AS t1');
		$this->db->join('snip AS t2','t1.id_target = t2.code_id');
		$this->db->where([
			't1.id_user !=' => getSession('sess_id'),
			't1.status' => 1, 
			't2.code_author' => getSession('sess_id'), 
		]);
		$x = $this->db->get();
		return $x->num_rows();		
	}
	public function countNotifSec($where)
	{
		$this->db->select('id');
		$this->db->where($where);
		$x = $this->db->get('secure');
		return $x->num_rows();		
	}
	public function getCommentNotif()
	{
		$this->db->select('
			t1.message AS message,
			t1.created,
			t1.id AS anchor,
			t1.status AS status,
			t2.u_username AS commentator,
			t2.u_image AS image,
			t3.code_title AS post,
			t3.code_id AS id,
			t3.code_author AS author
		');
		$this->db->from('comment AS t1');
		$this->db->join('users AS t2', 't1.id_user = t2.u_id');
		$this->db->join('snip AS t3', 't1.id_target = t3.code_id');
		$this->db->where([
			't1.id_user !=' => getSession('sess_id'), 
			't3.code_author' => getSession('sess_id'),
		]);
		return $this->db->get()->result_array();
	}
	public function getLikedNotif()
	{
		$this->db->select('
			t1.created,
			t1.status AS status,
			t2.u_username AS liker,
			t2.u_image AS image,
			t3.code_title AS post,
			t3.code_id AS id,
		');
		$this->db->from('liked AS t1');
		$this->db->join('users AS t2', 't1.id_user = t2.u_id');
		$this->db->join('snip AS t3', 't1.id_target = t3.code_id');
		$this->db->where([
			't1.id_user !=' => getSession('sess_id'),
			't3.code_author' => getSession('sess_id'),
		]);
		return $this->db->get()->result_array();
	}

	public function getSecurityNotif($email)
	{
		$this->db->select('ip,agent,created,status');
		$this->db->where('user',$email);
		return $this->db->get($this->sec)->result_array();
	}

// ================= TUTORIAL
	public function getTyping($category)
	{
		$query = $this->db->get_where($this->tutorCat,['_id' => $category])->row_array();
		return $query['_code'];
	}	
	public function checkMeta($meta)
	{
		$this->db->select('snip_meta');
		$this->db->from($this->tutor);
		$this->db->where('snip_meta', $meta);
		return $this->db->get()->num_rows();    
	}
	public function getListMenuByLevel($level)
	{
		$this->db->select('
			tutors.snip_title AS title,
			tutors.snip_slug AS slug,
			tutors.snip_meta AS meta
		');
		$this->db->join('tutor_lev','tutor_lev._id = tutors.snip_level');
		$this->db->where([
			'tutor_lev._name' => $level,
			'tutors.snip_publish' => 1,
		]);
		$this->db->order_by("tutors.snip_order", "asc");
		return $this->db->get($this->tutor)->result_array();
	}  
	public function getAllTutorialByCat($category)
	{
		$this->db->select('
			tutors.snip_id AS id,
			tutors.snip_title AS title,
			tutors.snip_slug AS slug,
			tutors.snip_meta AS meta,
			tutor_cat._name AS category,
			tutor_lev._name AS level
		');
		$this->db->join('tutor_lev','tutor_lev._id = tutors.snip_level');
		$this->db->join('tutor_cat','tutor_cat._id = tutors.snip_category');
		$this->db->where(['tutors.snip_category' => $category,'tutors.snip_bin' => 0, 'tutors.snip_publish' => 1]);
		$this->db->order_by('tutors.snip_order','asc');
		return $this->db->get($this->tutor)->result_array();
	}
	public function getTutorialByMeta($category,$meta)
	{
		$this->db->select('
			tutors.snip_id AS id,
			tutors.snip_order AS order,
			tutors.snip_title AS judul,
			tutors.snip_slug AS slug,
			tutors.snip_meta AS meta,
			tutors.snip_content AS konten,
			tutors.snip_code AS kode,
			tutors.snip_update AS update,
			tutors.snip_publish AS publish,
			tutor_cat._name AS kategori,
			tutor_lev._name AS level,
		');
		$this->db->join('tutor_lev','tutor_lev._id = tutors.snip_level');
		$this->db->join('tutor_cat','tutor_cat._id = tutors.snip_category');
		$this->db->where([
			'tutors.snip_category' => $category,
			'tutors.snip_meta' => $meta,
			'tutors.snip_bin' => 0,

		]);
		return $this->db->get($this->tutor)->row_array();
	}  
	public function getNextTutorial($order,$level)
	{
		$this->db->select('
			tutors.snip_meta AS meta,
			tutors.snip_title AS title,
			tutors.snip_slug AS slug
		');
		$this->db->join('tutor_lev','tutor_lev._id = tutors.snip_level');
		$this->db->where([
			'tutor_lev._name' => $level,
			'tutors.snip_order >' => $order,
			'tutors.snip_publish' => 1
		]);
		$this->db->limit(1);
		$this->db->order_by('tutors.snip_order','asc');
		return $this->db->get($this->tutor)->row_array();
	}

	public function getLevelNameByCat($category)
	{
		$this->db->select('_name AS Lname');
		$this->db->where('_cat',$category);
		return $this->db->get($this->tutorLev)->result_array();
	}



// ================= SNIPPET
	public function getAllSnippet()
	{
		$this->db->select('
			snip.code_id AS code_id,
			snip.code_title AS code_title,
			snip.code_desc AS code_desc,
			snip.code_html AS code_html,
			snip.code_css AS code_css,
			snip.code_js AS code_js,
			snip.code_update AS code_update,
			snip.code_upload AS code_upload,
			snip.code_publish AS code_publish,
			users.u_username AS user_author,
			users.u_image AS image_author
		');
		$this->db->join('users','users.u_id = snip.code_author');
		$this->db->order_by('snip.code_upload','desc');
		return $this->db->get($this->snip)->result_array();		

	}

	public function getSingleSnippet($where)
	{
		$this->db->select('
			t2.u_id AS id_author,
			t2.u_username AS user_author,
			t2.u_image AS image_author,
			t1.code_id AS code_id,
			t1.code_title AS code_title,
			t1.code_desc AS code_desc,
			t1.code_html AS code_html,
			t1.code_css AS code_css,
			t1.code_js AS code_js,
			t1.code_update AS code_update,
			t1.code_upload AS code_upload,
			t1.code_publish AS code_publish,
			t1.code_like AS code_like
		');
		$this->db->from('snip AS t1');
		$this->db->join('users AS t2','t1.code_author = t2.u_id');
		$this->db->where($where);
		return $this->db->get()->row_array();
	}

	public function getFrameCdnOfSnippet($serial)
	{
		return $this->db->get_where('snip_help',['id_snippet' => $serial])->row_array();
	}

	public function getAllSnippetByAuthor()
	{
		$this->db->select('

		');
		$this->db->where('code_author',getSession('sess_id'));
		$this->db->order_by('code_upload','desc');
		return $this->db->get('snip')->result_array();
	}

	public function getValidAuthSnippet($serial)
	{
		$this->db->select('t1.u_id');
		$this->db->from('users AS t1');
		$this->db->join('snip AS t2','t2.code_author = t1.u_id');
		$this->db->where(['t2.code_id' => $serial, 't1.u_id' => getSession('sess_id')]);
		return $this->db->get()->num_rows();
	}

	public function getAllListCdn()
	{
		$this->db->where(['id !=' => 1]);
		$this->db->order_by('cdn_name','asc');
		$x = $this->db->get('cdn');
		return $x->result_array();
	}  

	public function getCdnJquery()
	{
		$this->db->where('id', 1);
		$this->db->order_by('cdn_name','asc');
		$x = $this->db->get('cdn');
		return $x->result_array();
	}

	public function getCommentSnippet($serial,$limit,$addWhere=[])
	{
		$this->db->select('
			t1.id,
			t1.message AS message,
			t1.created AS created,
			t2.u_id AS id_comm,
			t2.u_username AS name_comm,
			t2.u_image AS img_comm,
			t3.code_author AS author
		');
		$this->db->from('comment AS t1');
		$this->db->join('users AS t2','t1.id_user = t2.u_id');
		$this->db->join('snip AS t3','t1.id_target = t3.code_id');
		$this->db->where(['t1.id_target' => $serial]);
		$this->db->where($addWhere);
		$this->db->order_by('t1.created','desc');
		$this->db->limit($limit);
		return $this->db->get()->result_array();
	}
	public function countCommentLimited($page,$id=[])
	{
		$this->db->from('comment');
		$this->db->where(['id_target' => $page]);
		$this->db->where($id);
		return $this->db->count_all_results();
	}

// ================= USER PAGE
	public function getViewAllNotif($user)
	{
		// $this->db->select('type AS t,created AS c,ip AS i,agent AS a, relation AS r');
		// $this->db->where('user',$user);
		// return $this->db->get($this->notif)->result_array();
	}

	public function getHomeTimeLine()
	{
		$this->db->select('
			users.u_username AS line_user,
			users.u_image AS line_pic,
			snip.code_id AS line_code_id,
			snip.code_title AS line_code_title,
			snip.code_desc AS line_code_desc,
			tutors.snip_id AS line_tutor_id,
			timeline.id AS timeline_id,
			timeline.category AS timeline_cat,
			timeline.relation AS timeline_rel,
			timeline.created AS timeline_time
		');
		$this->db->join('tutors','tutors.snip_id = timeline.relation','left');
		$this->db->join('snip','snip.code_id = timeline.relation','left');
		
		$this->db->join('users','users.u_id = timeline.user');
		$this->db->where('timeline.publish',1);
		$this->db->order_by('timeline.created','desc');
		return $this->db->get($this->time)->result_array();
	}

	public function getTutorialByid($id)
	{
		$this->db->select('
			tutors.snip_id AS id,
			tutors.snip_order AS order,
			tutors.snip_title AS judul,
			tutors.snip_slug AS slug,
			tutors.snip_meta AS meta,
			tutors.snip_content AS konten,
			tutors.snip_code AS kode,
			tutors.snip_update AS update,
			tutor_cat._name AS kategori,
			tutor_lev._name AS level,
		');
		$this->db->join('tutor_lev','tutor_lev._id = tutors.snip_level');
		$this->db->join('tutor_cat','tutor_cat._id = tutors.snip_category');
		$this->db->where([
			'tutors.snip_id' => $id,
			'tutors.snip_publish' => 1,
			'tutors.snip_bin' => 0,

		]);
		return $this->db->get($this->tutor)->row_array();
	}

	public function countTutorials($category)
	{
		$resultDB = [];
		$a = $this->db->where(['snip_category'=> $category ])->from($this->tutor);
		$resultDB['total'] = $a->count_all_results();
		$b = $this->db->where(['snip_category'=> $category, 'snip_publish' => 1 ])->from($this->tutor);
		$resultDB['public'] = $b->count_all_results();
		$c = $this->db->where(['snip_category'=> $category, 'snip_publish' => 0 ])->from($this->tutor); 
		$resultDB['draft'] = $c->count_all_results();
		return $resultDB;
	}

	public function getProgress($user)
	{
		$this->db->select('tutors.snip_id AS id');
		$this->db->from($this->tutor);
		$this->db->join($this->progres, 'user_progress.id_snip = tutors.snip_id');
		$this->db->where('user_progress.id_user', $user);
		$this->db->order_by('tutors.snip_order', 'asc');
		return $this->db->get()->result_array();
	}

	public function countProgress($cat)
	{
		$this->db->select('snip_id');
		$this->db->from($this->tutor);
		$this->db->join($this->progres, 'user_progress.id_snip = tutors.snip_id');
		$this->db->where('user_progress.id_user', getSession('sess_id'));
		$this->db->where('tutors.snip_category', $cat);
		$results = $this->db->get();
		return $results->num_rows();
	}

	// public function getProgressTime($id)
	// {
	// 	$x = $this->db->get_where($this->progres,['id_snip' => $id])->result_array();
	// 	return $x[0]['time'];
	// }  
	public function getOldPhoto($id)
	{
		return $this->db->select('u_image')->get_where($this->user,['u_id' => $id])->row_array();
	}
// ================= MAIN USER
	public function checkUserFb($fb=[])
	{
		if(!empty($fb)){
			$this->db->select('u_id');
			$this->db->from($this->user);
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
				$this->db->insert($this->user, $data);
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
		// $session_id = getSession('sess_id');
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
		return $this->db->get($this->user)->row_array();
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
		return $this->db->get($this->user)->row_array();
	}

	public function getUserDataByEmailActive($email)
	{
		$this->db->select('
			u_email AS email,
			u_password AS password
		');
		$this->db->where(['u_email' => $email, 'u_active' => 1]);
		return $this->db->get($this->user)->row_array();
	}
	public function getAttempt($email,$ip,$agent)
	{
		$this->db->select('
			log_att AS attempt,
			log_time AS time,
		');
		$this->db->where(['log_email'=>$email,'log_ip'=>$ip,'log_agent'=>$agent]);
		return $this->db->get($this->att)->row_array();
	}
	public function getTokenUrl($token)
	{
		$this->db->select('email AS e, token AS t, created AS c');
		$this->db->where(['token' => $token]);
		return $this->db->get($this->valid)->row_array();
	}
	public function countTokenByEmail($email)
	{
		$this->db->where('email', $email);
		return $this->db->get($this->valid)->num_rows();
	}
	// public function countAttempt($email,$ip,$agent) 
	// {
	// 	$this->db->from($this->att);
	// 	$this->db->where();
	// 	return $this->db->get()->num_rows();
	// }	

// ================= ADMINISTRATOR
	function Ignited_dt($select,$table,$where,$order)
	{
		$this->datatables->select($select);
		$this->datatables->from($table);
		$this->datatables->where($where);
		$this->db->order_by($order,'asc');
		return $this->datatables->generate();
	}	
	public function getAllLevelName()
	{
		$this->db->select('_id AS level_id, _cat AS category_id, _name AS level_name');
		$this->db->order_by('_cat','asc');
		return $this->db->get($this->tutorLev)->result_array();
	}
	public function getAllCategoryName()
	{
		$this->db->select('_id AS category_id, _name AS category_name');
		$this->db->order_by('_id','asc');
		return $this->db->get($this->tutorCat)->result_array();
	}    

	public function getLevelName($level)//
	{
		return $this->db->get_where($this->tutorLev,['id_level' => $level])->row_array();
	}


	public function getLevel($category,$level)
	{
		$aa = $this->db->select('_name')->get_where($this->tutorLev,['_cat' => $category])->result_array();
		for ($i=0; $i < count($level); $i++) { 
			$ab[$i] = $this->db->where(['snip_level' => $level[$i], 'snip_bin' => 0])->from($this->tutor)->count_all_results();
		}
		$ac = [];
		foreach ($aa as $key => $ax) {
			$ac [] = ['level_name' => $ax['_name'], 'counter' =>$ab[$key] ];
		}
		return $ac;
	}

	public function getTutorialByOrder($category_id,$order)
	{
		return $this->db->get_where($this->tutor,['snip_order'=>$order,'snip_category'=>$category_id])->row_array();
	}

	public function getTutorITimeline($id)
	{
		$x = $this->db->select('publish')->where(['relation' => $id])->get($this->time)->row_array();
		return $x['publish'];
	}
	// public function getTutorialById($id) // duplikat
	// {
	//   return $this->db->get_where($this->tutor,['snip_id' => $id])->row_array(); 
	// }

	public function getNextTutor($category_id,$order)
	{
		$this->db->where('snip_order >',$order);
		$this->db->where('snip_category',$category_id);
		$this->db->limit(1);
		$this->db->order_by('snip_order', 'ASC');
		$query = $this->db->get($this->tutor)->row_array(); 
		return $query['snip_order'];
	}  

	public function getPrevTutor($category_id,$order)
	{
		$this->db->where('snip_order <',$order);
		$this->db->where('snip_category',$category_id);
		$this->db->limit(1);
		$this->db->order_by('snip_order', 'DESC');
		$query = $this->db->get($this->tutor)->row_array(); 
		return $query['snip_order'];
	}
	public function getStatusPublic($id)
	{
		$query = $this->db->get_where($this->tutor,['snip_id' => $id])->row_array();
		return $query['snip_publish'];
	}








// END OF READ MODEL
}