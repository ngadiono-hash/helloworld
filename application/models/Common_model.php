<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
// ================= READ QUERY
	function Ignited_dt($select,$table,$where)
	{
		$this->datatables->select($select);
		$this->datatables->from($table);
		$this->datatables->where($where);
		return $this->datatables->generate();
	}

	function Ignited_join($select,$table,$tb,$fk,$tp,$where)
	{
		$this->datatables->select($select);
		$this->datatables->from($table);
		$this->datatables->join($tb,$fk,$tp);
		$this->datatables->where($where);
		$this->db->order_by('materi.les_order','asc');
		return $this->datatables->generate();		
	}

	function check_exist($table,$where)
	{
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function check_materi($meta)
	{
		$where = "LOWER(les_slug)='".$meta."' AND les_publish='1'";
		$this->db->where($where);
		$query = $this->db->get('materi');
		return ($query->num_rows() > 0) ? $query->row_array() : FALSE;
	}

	function counting($table,$where='')
	{
		$this->db->from($table);
		if ($where != '') {
			$this->db->where($where);
		}
		return $this->db->count_all_results();
	}

	function select_where($table,$data,$where='',$array=TRUE,$single=FALSE,$order='',$limit='',$group='')
	{
		if (is_array($data) && isset($data[1])) {
			$this->db->select($data[0],$data[1]);
		} else {
			$this->db->select($data);
		}
		$this->db->from($table);
		if ($where != '') {
			$this->db->where($where);
		}
		if($order !== ''){
			if(is_array($order)){
				$this->db->order_by($order[0],$order[1]);
			}else{
				$this->db->order_by($order);
			}
		}
		if($limit != ''){
			if(is_array($limit)){
				$this->db->limit($limit[0],$limit[1]);
			}else{
				$this->db->limit($limit);
			}
		}
		if($group != ''){
			$this->db->group_by($group);
		}
		$query = $this->db->get();
		if ($query) {
			if ($single == TRUE) {
				if($array === FALSE) {
					return $query->row();
				}elseif($array === TRUE){
					return $query->row_array();
				}
			} else {
				if($array === FALSE){
					return $query->result();
				}elseif($array === TRUE){
					return $query->result_array();
				}
			}
		} else {
			return FALSE;
		}
	}

	function select_specific($table,$data,$where)
	{
		$this->db->select($data);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		if ($query) {
			return $query->row()->$data;
		} else {
			return $this->db->error();
		}
	}
	function select_like($table,$data,$where,$single=FALSE,$field,$value,$orLikes='',$group_by='')
	{
		$this->db->select($data);
		$this->db->from($table);
		$this->db->like('LOWER(' . $field . ')', strtolower($value));
		if($orLikes != '' and is_array($orLikes)){
			foreach($orLikes as $key=>$array){
				$this->db->or_like('LOWER('.$array['field'].')', strtolower($array['value']));
			}
		}
		if ($where != '') {
			$this->db->where($where);
		}
		if($group_by != ''){
			$this->db->group_by($group_by);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			if ($single == TRUE) {
				return $query->row();
			} else {
				return $query->result();
			}
		} else {
			return FALSE;
		}
	}

	function select_join($table,$data,$join,$where='',$group,$order)
	{
		$this->db->select($data);
		$this->db->from($table);
		foreach ($joins as $k => $v) {
			$this->db->join($v['table'], $v['condition'], $v['type'],(isset($v['escape'])?$v['escape']:TRUE));
		}
		if ($where != '') {
			$this->db->where($where);
		}
		if($group != ''){
			$this->db->group_by($group);
		}
		if($order !== ''){
			if(is_array($order)){
				$this->db->order_by($order[0],$order[1]);
			}else{
				$this->db->order_by($order);
			}
		}
		$query = $this->db->get();
		if ($query) {
			if ($single == TRUE) {
				if($array === FALSE) {
					return $query->row();
				}elseif($array === TRUE){
					return $query->row_array();
				}
			} else {
				if($array === FALSE){
					return $query->result();
				}elseif($array === TRUE){
					return $query->result_array();
				}
			}
		} else {
			return FALSE;
		}

	}

// ================= INSERT QUERY
	function insert_record($table,$data)
	{
		$query = $this->db->insert($table,$data);
		if ($query) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	function insert_multiple($table, $data)
	{
		$query = $this->db->insert_batch($table, $data);
		return $query;
	}

	function insert_multiple_ignore_duplicate($tbl, $data){
		$this->db->trans_start();
		foreach ($data as $item) {
			$insert_query = $this->db->insert_string($tbl, $item);
			$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
			$this->db->query($insert_query);
		}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return FALSE;
		}else{
			return TRUE;
		}
	}

// ================= UPDATE QUERY
	function update($table,$data,$where)
	{
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($table);
		$affectedRows = $this->db->affected_rows();
		if ($affectedRows) {
			return true;
		} else {
			return $this->db->error();
		}
	}
	function update_query($table, $field, $id, $data)
	{
		$this->db->where($field, $id);
		$this->db->update($table, $data);
		$affectedRows = $this->db->affected_rows();
		if ($affectedRows) {
			return TRUE;
		} else {
			return $this->db->error();
		}
	}

	function update_query_array($tbl, $fields, $data)
	{
		$this->db->where($fields);
		$this->db->update($tbl, $data);
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows) {
			return $afftectedRows;
		} else {
			return $this->db->_error_message();
		}
	}

// DELETE QUERY
	function delete($table,$where=NULL)
	{
		if(!empty($where))
		{
			$this->db->where($where);
		}
		if($this->db->delete($table))
		{
			return $this->db->affected_rows();
		}
	}


	} //End 