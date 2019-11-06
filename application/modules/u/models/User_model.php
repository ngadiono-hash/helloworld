<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}
	public function countProgress($cat)
	{
		$this->db->select('snip_id');
		$this->db->from('tutors');
		$this->db->join('user_progress', 'user_progress.id_snip = tutors.snip_id');
		$this->db->where('user_progress.id_user', getSession('sess_id'));
		$this->db->where('tutors.snip_category', $cat);
		$results = $this->db->get();
		return $results->num_rows();
	}
	public function countTutorials($category)
	{
		$resultDB = [];
		$a = $this->db->where(['snip_category'=> $category ])->from('tutors');
		$resultDB['total'] = $a->count_all_results();
		$b = $this->db->where(['snip_category'=> $category, 'snip_publish' => 1 ])->from('tutors');
		$resultDB['public'] = $b->count_all_results();
		$c = $this->db->where(['snip_category'=> $category, 'snip_publish' => 0 ])->from('tutors'); 
		$resultDB['draft'] = $c->count_all_results();
		return $resultDB;
	}	
	public function getValidAuthSnippet($serial)
	{
		$this->db->select('t1.u_id');
		$this->db->from('users AS t1');
		$this->db->join('snip AS t2','t2.code_author = t1.u_id');
		$this->db->where(['t2.code_id' => $serial, 't1.u_id' => getSession('sess_id')]);
		return $this->db->get()->num_rows();
	}	
}