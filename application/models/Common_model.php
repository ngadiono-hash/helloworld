<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		// $this->load->library('Datatables');
	}
// ================= READ QUERY
	function Ignited_dt($select,$table,$where,$order)
	{
		$this->datatables->select($select);
		$this->datatables->from($table);
		$this->datatables->where($where);
		$this->db->order_by($order,'asc');
		return $this->datatables->generate();
	}	
	function check_exist($table,$where)
	{
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	function count_record($table,$data,$where)
	{
		$this->db->select($data);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function select_spec($tbl,$data,$where,$order='',$limit='')
	{
		$this->db->select($data);
		$this->db->from($tbl);
		$this->db->where($where);
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
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->$data;
		}
	}
	function select_fields($tbl,$data,$single=FALSE,$resultArray=TRUE,$order_by='',$group_by='')
	{
		if(is_array($data)){
			$this->db->select($data[0],$data[1]);
		}else{
			$this->db->select($data);
		}
		if($group_by !== ''){
			$this->db->group_by($group_by);
		}
		if($order_by !== ''){
			if(is_array($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}else{
				$this->db->order_by($order_by);
			}
		}
		$query = $this->db->get($tbl);
		if ($query) {
			if ($single == TRUE) {
				if($resultArray === false) {
					return $query->row();
				}elseif($resultArray === true){
					return $query->row_array();
				}
			} else {
				if($resultArray === false){
					return $query->result();
				}elseif($resultArray === true){
					return $query->result_array();
				}
			}
		} else {
			return $this->db->error();
		}
	}
	function select_fields_where($tbl,$data,$where,$single=FALSE,$array=TRUE,$order_by='',$like='',$field='',$value='',$group_by='')
	{
		if(is_array($data) && isset($data[1])){
			$this->db->select($data[0],$data[1]);
		}else{
			$this->db->select($data);
		}
		$this->db->from($tbl);
		if ($like != '') {
			$this->db->like('LOWER(' . $field . ')', strtolower($value));
			$this->db->like($like);
		}
		$this->db->where($where);
		if($group_by != ''){
			$this->db->group_by($group_by);
		}
		if($order_by !== ''){
			if(is_array($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}else{
				$this->db->order_by($order_by);
			}
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			if ($single == TRUE) {
				if($array === TRUE){
					return $query->row_array();
				}else{
					return $query->row();
				}
			} else {
				if($array === TRUE){
					return $query->result_array();
				}else{
					return $query->result();
				}
			}
		} else {
		// query returned no results
			return FALSE;
		}
	}
	function select_fields_where_join($tbl,$data,$joins='',$where='',$order_by='',$single=FALSE,$array=TRUE,$limit='',$field='',$value='',$group_by='')
	{
		if (is_array($data) and isset($data[1])) {
			$this->db->select($data[0],$data[1]);
		} else {
			$this->db->select($data);
		}
		$this->db->from($tbl);
		// Fourth Param is For Escaping, i-e CI should use backTicks on a join or not.
		if ($joins != '') {
			foreach ($joins as $k => $v) {
				$this->db->join($v['table'], $v['condition'], $v['type'],(isset($v['escape'])?$v['escape']:TRUE));
			}
		}
		if ($value !== '') {
			$this->db->like('LOWER(' . $field . ')', strtolower($value));
		}
		if ($where != '') {
			$this->db->where($where);
		}
		if($group_by != ''){
			$this->db->group_by($group_by);
		}
		if($order_by != ''){
			if(is_array($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}else{
				$this->db->order_by($order_by);
			}
		}
		if($limit != ''){
			if(is_array($limit)){
				$this->db->limit($limit[0],$limit[1]);
			}else{
				$this->db->limit($limit);
			}
		}
		$query = $this->db->get();
		if($query == FALSE ){
			echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message();
			return FALSE;
		}
		if ($query->num_rows() !== NULL && $query->num_rows() > 0) {
			if ($single == TRUE) {
				if($array === true){
					return $query->row_array();
				}else{
					return $query->row();
				}
			} else {
				if($array === true) {
					return $query->result_array();
				}else{
					return $query->result();
				}
			}
		} else {
			return FALSE;
		}
	}











	function select_fields_where_like($tbl = '', $data, $where = '', $single = FALSE, $field, $value,$group_by = '',$order_by = '')
	{
		$this->db->select($data);
		$this->db->from($tbl);
		$this->db->like('LOWER(' . $field . ')', strtolower($value));
		if ($where != '') {
			$this->db->where($where);
		}
		if($group_by != ''){
			$this->db->group_by($group_by);
		}
		if($order_by !== ''){
			if(is_array($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}else{
				$this->db->order_by($order_by);
			}
		}
		$query = $this->db->get();
		//return $this->db->last_query();
		if ($query->num_rows() > 0) {
		// query returned results
			if ($single == TRUE) {
				return $query->row();
			} else {
				return $query->result();
			}
		} else {
		// query returned no results
			return FALSE;
		}
	}
	function select_fields_where_like_orLikes($tbl = '', $data, $where = '', $single = FALSE, $field, $value, $orLikes = '',$group_by = '')
	{
		$this->db->select($data);
		$this->db->from($tbl);
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
		//return $this->db->last_query();
		if ($query->num_rows() > 0) {
		// query returned results
			if ($single == TRUE) {
				return $query->row();
			} else {
				return $query->result();
			}
		} else {
		// query returned no results
			return FALSE;
		}
	}
	function select_fields_where_like__orLikes_join($tbl = '', $data, $joins = '', $where = '', $single = FALSE, $field = '', $value = '', $orLikes = '', $group_by='',$order_by = '',$limit = '')
	{
		if (is_array($data) and isset($data[1])){
			$this->db->select($data[0],$data[1]);
		}else{
			$this->db->select($data);
		}
		$this->db->from($tbl);
		if ($joins != '') {
			foreach ($joins as $k => $v) {
				$this->db->join($v['table'], $v['condition'], $v['type']);
			}
		}
		if ($value !== '') {
			$this->db->like('LOWER(' . $field . ')', strtolower($value));
		}
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
		if($order_by != ''){
			if(is_array($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}else{
				$this->db->order_by($order_by);
			}
		}
		if($limit != ''){
			if(is_array($limit)){
				$this->db->limit($limit[0],$limit[1]);
			}else{
				$this->db->limit($limit);
			}
		}
		$query = $this->db->get();
		//return $this->db->last_query();
		if ($query->num_rows() > 0) {
		// query returned results
			if ($single == TRUE) {
				return $query->row();
			} else {
				return $query->result();
			}
		} else {
		// query returned no results
			return FALSE;
		}
	}





	//Common AutoComplete Queries
	function get_autoComplete($tbl, $data, $field, $value, $where = '', $group_by = false, $limit = '')
	{
		$this->db->select($data);
		$this->db->from($tbl);
		if ($where != '') {
			$this->db->where($where);
		}
		$this->db->like('LOWER(' . $field . ')', strtolower($value));
		if ($group_by == true) {
			$this->db->group_by($field);
		}
		if ($limit != '') {
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		return $query->result();
	}
	function get_autoCompleteJoin($PTable, $joins = '', $where = '', $data, $field, $value, $group_by = false)
	{
		$this->db->select($data);
		$this->db->from($PTable);
		if ($joins != "") {
			foreach ($joins as $k => $v) {
				$this->db->join($v['table'], $v['condition'], $v['type']);
			}
		}
		if ($where != '') {
			$this->db->where($where);
		}
		$this->db->like('LOWER(' . $field . ')', strtolower($value));
		if ($group_by == true) {
			$this->db->group_by($field);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}

// ================= INSERT QUERY
	function insert_record($tbl, $data)
	{
		$query = $this->db->insert($tbl,$data);
		if ($query) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	//Insert Record If Don't Exist Else Update the Record
	function insert_or_update($tbl, $data, $field, $id,$where)
	{
		$this->db->where($where);
		$q = $this->db->get($tbl);
		if ( $q->num_rows() > 0 )
		{
			$this->db->where($field,$id);
			$this->db->update($tbl,$data);
			$affectedRows = $this->db->affected_rows();
			if($affectedRows){
				return TRUE;
			}else{
				return FALSE;
			}
		} else {
			$this->db->set($field, $id);
			$this->db->insert($tbl,$data);
			$insertedID = $this->db->insert_id();
			if($insertedID > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	function insert_multiple($tbl, $data)
	{
		$query = $this->db->insert_batch($tbl, $data);
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
	function update($tbl,$data,$where)
	{
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($tbl);
		$affectedRows = $this->db->affected_rows();
		if ($affectedRows) {
			return true;
		} else {
			return $this->db->error();
		}
	}
	function update_query($tbl, $field, $id, $data)
	{
		$this->db->where($field, $id);
		$this->db->update($tbl, $data);
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
	function delete($table , $where=NULL)
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

		//Common DataTables Queries
		function  select_fields_joined_DTM($data, $PTable, $joins = '', $where = '',$where_in_column ='', $where_in_data = '', $group_by = '', $addColumn = '', $editColumn = '',$unsetColumn = '')
		{
			if(is_array($PTable)){

				if(is_array($data)){
					$this->datatables->select($data[0],$data[1]);
				}else{
					$this->datatables->select($data);
				}
				if ($unsetColumn != '') {
					$this->datatables->unset_column($unsetColumn);
				}
				$this->datatables->from($PTable);
				if ($joins != '') {
					foreach ($joins as $k => $v) {
						$this->datatables->join($v['table'], $v['condition'], $v['type']);
					}
				}
				if ($where != '') {
					if(is_array($where) && array_key_exists("QueryCondition",$where)){
						$this->datatables->where($where["QueryCondition"],$where[0],$where[1]);
					}else{
						$this->datatables->where($where);
					}
				}
				if($where_in_data !== ''){
					$this->datatables->where_in($where_in_column,$where_in_data);
				}
				if($group_by != ''){
					$this->datatables->group_by($group_by);
				}
				if ($addColumn != '') {
					foreach($addColumn as $columnKey=>$columnValue ) {
						if(!is_array($columnValue) && is_string($columnValue)){
							$this->datatables->add_column($columnKey, $columnValue);
						}else{
							$this->datatables->add_column($columnKey, $columnValue[0],$columnValue[1]);
						}
					}
				}
				if ($editColumn != ''){
					foreach($editColumn as $arrayKey=>$arrayValue){
						$this->datatables->edit_column($arrayValue[0],$arrayValue[1],$arrayValue[2]);
					}
				}
				$result = $this->datatables->generate();
			}else{
				$result = $this->select_fields_joined_DT($data, $PTable, $joins, $where ,$where_in_column, $where_in_data , $group_by , $addColumn , $editColumn ,$unsetColumn);
			}
			return $result;
		}
		function  select_fields_joined_DT($data, $PTable, $joins = '', $where = '',$where_in_column ='', $where_in_data = '', $group_by = '', $addColumn = '', $editColumn = '',$unsetColumn = '')
		{
			if(is_array($data)){
				$this->datatables->select($data[0],$data[1]);
			}else{
				$this->datatables->select($data);
			}
			if ($unsetColumn != '') {
				$this->datatables->unset_column($unsetColumn);
			}
			$this->datatables->from($PTable);
			if ($joins != '') {
				foreach ($joins as $k => $v) {
					$this->datatables->join($v['table'], $v['condition'], $v['type']);
				}
			}
			if($where != '') {
				if(is_array($where) && array_key_exists("QueryCondition",$where)){
					$this->datatables->where($where["QueryCondition"],$where[0],$where[1]);
				}else{
					$this->datatables->where($where);
				}
			}
			if($where_in_data !== ''){
				$this->datatables->where_in($where_in_column,$where_in_data);
			}
			if($group_by != ''){
				$this->datatables->group_by($group_by);
			}
			if($addColumn != '') {
				foreach($addColumn as $columnKey=>$columnValue ) {
					if(!is_array($columnValue) && is_string($columnValue)){
						$this->datatables->add_column($columnKey, $columnValue);
					}else{
						$this->datatables->add_column($columnKey, $columnValue[0],$columnValue[1]);
					}
				}
			}
			if($editColumn != ''){
				foreach($editColumn as $arrayKey=>$arrayValue){
					$this->datatables->edit_column($arrayValue[0],$arrayValue[1],$arrayValue[2]);
				}
			}
			$result = $this->datatables->generate();
			return $result;
		}
		function  select_fields_joined_DTO($data, $PTable, $joins = '', $where = '',$where_in_column ='', $where_in_data = '', $group_by = '',$order_by = '', $addColumn = '', $editColumn = '',$unsetColumn = '')
		{
			if(is_array($data)){
				$this->datatables->select($data[0],$data[1]);
			}else{
				$this->datatables->select($data);
			}
			if ($unsetColumn != '') {
				$this->datatables->unset_column($unsetColumn);
			}
			$this->datatables->from($PTable);
			if ($joins != '') {
				foreach ($joins as $k => $v) {
					$this->datatables->join($v['table'], $v['condition'], $v['type']);
				}
			}
			if($where != '') {
				if(is_array($where) && array_key_exists("QueryCondition",$where)){
					$this->datatables->where($where["QueryCondition"],$where[0],$where[1]);
				}else{
					$this->datatables->where($where);
				}
			}
			if($where_in_data !== ''){
				$this->datatables->where_in($where_in_column,$where_in_data);
			}
			if($order_by != ''){
				$this->datatables->order_by($order_by);
			}
			if($group_by != ''){
				$this->datatables->group_by($group_by);
			}
			if($addColumn != '') {
				foreach($addColumn as $columnKey=>$columnValue ) {
					if(!is_array($columnValue) && is_string($columnValue)){
						$this->datatables->add_column($columnKey, $columnValue);
					}else{
						$this->datatables->add_column($columnKey, $columnValue[0],$columnValue[1]);
					}
				}
			}
			if($editColumn != ''){
				foreach($editColumn as $arrayKey=>$arrayValue){
					$this->datatables->edit_column($arrayValue[0],$arrayValue[1],$arrayValue[2]);
				}
			}
			$result = $this->datatables->generate();
			return $result;
		}
		//Importing of File Using Import Library Added To The Application..
		function Import_FileImportLibrary_CSV($table,$data){
			$this->db->insert($table, $data);
		}
		// Function for run query
		function get_query_record($query)
		{
			$result=$this->db->query($query);
			if($result->num_rows() > 0)
			{
				return $result;
			}
		}

		//Function For DropDowns. Updating The Classic Style From Parexons Company.
		function classic_dropdown($table, $option, $key, $value, $where)
		{
			//Lets Put Little Checks On Required Parameters
			if(!isset($table) || empty($table)){
				return false;
			}
			if(!isset($option) || empty($option)){
				return false;
			}
			if(!isset($key) || empty($key)){
				return false;
			}
			if(!isset($value) || empty($value)){
				return false;
			}
			$this->db->select('*');
			$this->db->from($table);
			if($where !== ''){
				$this->db->where($where);
			}
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$data[''] = $option;
				foreach($query->result() as $row)
				{
					$data[$row->$key] = $row->$value;
				}
				return $data;
			}
		}
		// Dynamic Function For Drop Down With Select Option
		public function dropdown_wd_option($table, $option, $key, $value, $where)
		{
			$this->db->select('*');
			$this->db->where($where);
			$query = $this->db->get($table);
			if($query->num_rows() > 0)
			{
				$data[''] = $option;
				foreach($query->result() as $row)
				{
					$data[$row->$key] = $row->$value;
				}
				return $data;
			}
		}
		public function insert_else_ignore($table,$data)
		{
			$query = $this->db->get_where($table,$data);
			$count = $query->num_rows(); //counting result from query
			if ($count === 0) {
				$this->db->insert($table, $data);
				return true;
			}
		}
		public function get_row_order_desc($tbl = '', $data, $single = FALSE,$order_by = '')
		{
			$this->db->select($data);
			$this->db->from($tbl);
			if($order_by !== ''){
				if(is_array($order_by)){
					$this->db->order_by($order_by[0],$order_by[1]);
				}else{
					$this->db->order_by($order_by);
				}
			}
			$query = $this->db->get();
			//return $this->db->last_query();
			if ($query->num_rows() > 0) {
				// query returned results
				if ($single == TRUE) {
					return $query->row();
				} else {
					return $query->result();
				}
			} else {
				// query returned no results
				return FALSE;
			}
		}

	} //End 