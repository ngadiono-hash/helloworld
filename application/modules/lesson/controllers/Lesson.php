<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	private function _temp_menu($lev)
	{
		$data['label'] = $this->Common_model->select_where('level','*',['name' => $lev],TRUE,TRUE);
		$slug = explode(' ',$data['label']['description']);
		$data['label']['slug'] = 'Dokumentasi '.$slug[0].' Tingkat '.$slug[1];
		$config['base_url'] = base_url('lesson/').$this->uri->segment(2);
		$config['total_rows'] = $this->Common_model->counting(
			'materi',['les_level'=>$lev,'les_publish'=>1]
		);
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['per_page'] = 9;

		$pageNow = $this->input->get('page');
		$page = ($pageNow) ? $pageNow : 1;
		$ilegal = ceil($config['total_rows']/$config['per_page']);
		// bug($config['total_rows']/9);
		if ($page > $ilegal) {
			not_found();
			die();
		}
		$offset = ($page - 1) * $config['per_page'];
		$all = $this->Common_model->select_where(
			'materi',
			'les_order,les_level,les_title,les_slug,les_content,les_update',
			['les_level' => $lev,'les_publish' => 1],
			TRUE,FALSE,
			['les_order','asc'],
			[$config['per_page'],$offset]
		);
		$config['attributes'] = array('class' => 'page-link');
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_link'] = 'start';
		$config['last_link'] = 'end';
		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		foreach ($all as $k) {
			$rest[] = [
				'num'			=> $k['les_order'],
				'level' 	=> $k['les_level'],
				'update'  => date('M d, Y',$k['les_update']),
				'title' 	=> $k['les_title'],
				'slug' 		=> $k['les_slug'],
				'link' 		=> base_url('lesson/docs/').create_slug($k['les_slug']),
				'content' => read_more($k['les_content'],200)
			];
		}
		$data['list'] = $rest;
		$data['title'] = 'My Note - Materi '.$data['label']['description'];
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('menu',$data);
		$this->load->view('templates/mainFooter');
	}

	private function _temp_main($meta)
	{

	}


	public function index()
	{
		$data['label'] = $this->Common_model->select_where('level','*','',TRUE,FALSE);
		$data['title'] = 'My Note - Materi JavaScript';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

	public function beginner()
	{
		$data['title'] = 'My Note - JavaScript Dasar';
		$data['list'] = $this->_temp_menu('beginner');
	}
	public function intermediate()
	{
		$data['title'] = 'My Note - JavaScript DOM';
		$data['list'] = $this->_temp_menu('intermediate');
	}
	public function advance()
	{
		$data['title'] = 'My Note - JavaScript Lajutan';
		$data['list'] = $this->_temp_menu('advance');
	}

	public function docs()
	{
		$meta  = $this->uri->segment(3);
		$meta = str_replace('-',' ',$meta);
		$checkMeta = $this->Common_model->check_materi($meta);
		if(!$checkMeta){
			not_found();
		} else {
			$this->load->library('disqus');
			$s = $checkMeta;
			$all = $this->Common_model->select_where(
				'materi',
				'les_title,les_slug',
				['les_level' => $s['les_level'],'les_publish' => 1],
				TRUE,FALSE,
				['les_order','asc']
			);
			$data['quiz'] = $this->Common_model->select_where(
				'quiz',
				'id,q_question,q_answer',
				['q_rel' => $s['les_id']]
			);
			$data['title'] = $s['les_slug'];
			$data['label'] = $this->Common_model->select_specific('level','description',['name' => $s['les_level']]);
			
			$key1 = getTags($s['les_content'],'h3');
			$key2 = getTags($s['les_content'],'h4');
			$keyword = array_merge($key1,$key2);
			
			$meta_key = strtolower('belajar javascript, '.$s['les_slug'].', '.implode(', ',$keyword));
			$data['lesson'] = [
				'id'  		=> $s['les_id'],
				'order' 	=> $s['les_order'],
				'title' 	=> $s['les_slug'],
				'titles' 	=> $s['les_title'],
				'meta' 		=> create_slug($s['les_slug']),
				'content' => $s['les_content'],
				'description' => read_more($s['les_content'],250),
				'keyword' => $meta_key,
				'hint'		=> $key1,
				'upload'	=> $s['les_upload'],
				'update'	=> $s['les_update'],
				'level'		=> $s['les_level'], 
				'disqus'  => $this->disqus->get_html()
			];
			foreach ($all as $key) {
				$data['lesson']['menu'][] = [
					'link' => base_url('lesson/docs/').create_slug($key['les_slug']),
					'title' => $key['les_slug']
				];
			}

			// select_where($table,$data,$where='',$array=TRUE,$single=FALSE,$order='',$limit='')
			$next = $this->Common_model->select_where(
				'materi','les_slug',['les_order >'=> $s['les_order'],'les_publish'=> 1,'les_level'=>$s['les_level']],TRUE,TRUE,['les_order','ASC'],1
			);
			$prev = $this->Common_model->select_where(
				'materi','les_slug',['les_order <'=>$s['les_order'],'les_publish'=> 1,'les_level'=>$s['les_level']],TRUE,TRUE,['les_order','DESC'],1
			);
			$data['linkNext'] = ($next) ? base_url('lesson/docs/'.create_slug($next['les_slug'])) : '#';
			$data['linkPrev'] = ($prev) ? base_url('lesson/docs/'.create_slug($prev['les_slug'])) : '#';
			$this->load->view('templates/mainHeader', $data);
			$this->load->view('single_lesson',$data);
			$this->load->view('templates/mainFooter');
		}
	}

	public function quiz()
	{
		$level = $this->uri->segment(3);
		$fetch = $this->Common_model->check_exist('level',['name'=>$level]);
		if (!$fetch) {
			not_found();
		} else {
			$data['quiz'] = $this->Common_model->select_where(
				'quiz',
				'id,q_question,q_answer',
				['q_level' => $level, 'q_active' => 1]
			);
			$data['title'] = 'My Note - Quiz JavaScript '.ucwords($level);
			$data['titles'] = $this->Common_model->select_specific('level','description',['name' => $level]);
			$this->load->view('templates/mainHeader', $data);
			$this->load->view('quiz',$data);
			$this->load->view('templates/mainFooter');
		}
	}

} // END