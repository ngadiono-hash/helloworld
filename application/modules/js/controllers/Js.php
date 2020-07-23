<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Js extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common');
	}

	private function _temp_menu($lev)
	{
		$pageNow = $this->input->get('page');
		$data['label'] = $this->Common->select_where('level','*',['name' => $lev],TRUE,TRUE);
		$slug = explode(' ',$data['label']['description']);
		$data['label']['slug'] = 'Dokumentasi '.$slug[0].' Tingkat '.$slug[1];
		$data['title'] = 'My Note - Materi '.$data['label']['description'];
		$rows = $this->Common->counting('materi',['les_level'=>$lev,'les_publish'=>1]);
		if ($rows < 0) :
			$data['available'] = false;			
		else :
			$data['available'] = true;
			$config = [
				'base_url' => base_url('js/').$this->uri->segment(2),
				'total_rows' => $rows,
				'page_query_string' => true,
				'use_page_numbers' => true,
				'query_string_segment' => 'page',
				'per_page' => 9,
				'attributes' => ['class'=>'page-link'],
				'next_link' => '<i class="fa fa-angle-double-right"></i>',
				'prev_link' => '<i class="fa fa-angle-double-left"></i>',
				'first_link' => 'start',
				'last_link' => 'end',
				'full_tag_open' => '<ul class="pagination justify-content-center">',
				'full_tag_close' => '</ul>',
				'num_tag_open' => '<li class="page-item">',
				'num_tag_close' => '</li>',
				'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
				'cur_tag_close' => '</a></li>',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>'
			];
			$page = ($pageNow) ? $pageNow : 1;
			$ilegal = ceil($config['total_rows']/$config['per_page']);
			if ($page > $ilegal) {
				$data['available'] = false;
			} else {
				$offset = ($page - 1) * $config['per_page'];
				$all = $this->Common->select_where(
					'materi',
					'les_order,les_level,les_title,les_slug,les_content,les_update',
					['les_level' => $lev,'les_publish' => 1],
					TRUE,FALSE,
					['les_order','asc'],
					[$config['per_page'],$offset]
				);

				$this->pagination->initialize($config);
				foreach ($all as $k) {
					$rest[] = [
						'num'			=> $k['les_order'],
						'level' 	=> $k['les_level'],
						'update'  => date('M d, Y',$k['les_update']),
						'title' 	=> $k['les_title'],
						'slug' 		=> $k['les_slug'],
						'link' 		=> base_url('js/docs/').create_slug($k['les_slug']),
						'content' => read_more($k['les_content'],200)
					];
				}
				$data['list'] = $rest;
			}
		endif;
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('menu',$data);
		$this->load->view('templates/mainFooter');
	}

	public function beginner()
	{
		$data['title'] = 'My Note - JavaScript Dasar';
		$data['list'] = $this->_temp_menu('beginner');
	}
	public function medium()
	{
		$data['title'] = 'My Note - JavaScript DOM';
		$data['list'] = $this->_temp_menu('medium');
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
		$checkMeta = $this->Common->check_materi($meta);
		if(!$checkMeta){
			not_found();
		} else {
			$this->load->library('disqus');
			$s = $checkMeta;
			$all = $this->Common->select_where(
				'materi',
				'les_title,les_slug',
				['les_level' => $s['les_level'],'les_publish' => 1],
				TRUE,FALSE,
				['les_order','asc']
			);
			$data['title'] = $s['les_slug'];
			$news = $this->Common->select_where('materi','les_slug,les_title',['les_publish'=> 1],true,false,['les_update','DESC'],4);
			foreach ($news as $key) {
				$data['news'][] = [
					'link' => base_url('js/docs/').create_slug($key['les_slug']),
					'title' => $key['les_slug']
				];
			}
			$data['label'] = $this->Common->select_specific('level','description',['name' => $s['les_level']]);
			
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
					'link' => base_url('js/docs/').create_slug($key['les_slug']),
					'title' => $key['les_slug']
				];
			}

			$next = $this->Common->select_where(
				'materi','les_slug',['les_order >'=> $s['les_order'],'les_publish'=> 1,'les_level'=>$s['les_level']],TRUE,TRUE,['les_order','ASC'],1
			);
			$prev = $this->Common->select_where(
				'materi','les_slug',['les_order <'=>$s['les_order'],'les_publish'=> 1,'les_level'=>$s['les_level']],TRUE,TRUE,['les_order','DESC'],1
			);
			$data['linkNext'] = ($next) ? base_url('js/docs/'.create_slug($next['les_slug'])) : '';
			$data['linkPrev'] = ($prev) ? base_url('js/docs/'.create_slug($prev['les_slug'])) : '';
			$this->load->view('templates/mainHeader', $data);
			$this->load->view('single_lesson',$data);
			$this->load->view('templates/mainFooter');
		}
	}

	public function quiz()
	{
		$data['title'] = 'My Note - Quiz JavaScript';
		$data['category'] = $this->Common->select_join(
			'quiz',
			'name,description',
			[['table' => 'level','condition' => 'quiz.q_level = level.name','type' => '']],
			'',true,false,
			'q_level',
			'level.id ASC'
		);
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('quiz',$data);
		$this->load->view('templates/mainFooter');
	}

} // END