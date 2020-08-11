<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Js extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common');
	}

	// private function linkLevels()
	// {
	// 	$all = $this->Common->select_where('level','name,names,description');
	// 	foreach ($all as $key) {
	// 		$a[] = ['link' => base_url('a/less/').$key['names'], 'title' => $key['description']];
	// 	}
	// 	return $a;
	// }

	public function files()
	{
		$data['title'] = 'JavaScript List';
		
		$map = $this->Common->select_join(
			'level',
			'level.id,names,description,les_title,les_slug,les_order',
			[['table'=>'materi','condition'=>'level.names = materi.les_level','type'=>'']],
			['les_publish'=>1],true,false,'','level.id ASC'
		);

		// $levels = $this->Common->select_where('level','names,description');
		// $m = [];
		// foreach ($levels as $k) {
		// 	$materi = $this->Common->select_where('materi','les_level,les_order,les_title,les_slug',['les_level'=>$k['names']]);
		// 	uasort($materi, function ($a, $b) {
		// 	    if ($a['les_order'] == $b['les_order']) return 0;
		// 	    return ($a['les_order'] < $b['les_order']) ? -1 : 1;
		// 	});
		// 	array_push($m,$materi);
		// }
		// var_dump($m);
		
		// bug($result);
		uasort($map, function ($a, $b) {
	    if ($a['les_order'] == $b['les_order']) return 0;
	    return ($a['les_order'] < $b['les_order']) ? -1 : 1;
		});
		foreach ($map as $element) {
			$result[$element['id']][] = $element;
		}
		ksort($result);
		$data['menu'] = array_values($result);
		// bug($data['menu']);
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('js-menu',$data);
		$this->load->view('templates/mainFooter');
	}

	public function docs()
	{
		$meta  = $this->uri->segment(3);
		$meta = str_replace('-',' ',$meta);
		$where = "LOWER(les_slug)='".$meta."' AND les_publish='1'";
		$checkMeta = $this->Common->check_segment('materi',$where);
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
			$data['label'] = $this->Common->select_specific('level','description',['names' => $s['les_level']]);
			
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
			$this->load->view('js-lesson',$data);
			$this->load->view('templates/mainFooter');
		}
	}


	public function quiz()
	{
		$data['title'] = 'My Note - Quiz JavaScript';
		$cat = $this->Common->select_where('quiz','q_level','',true,false,'q_level ASC','','q_level');
		foreach ($cat as $k) {
			if ($k['q_level'] == 'a') $name = 'JavaScript Dasar';
			if ($k['q_level'] == 'b') $name = 'JavaScript Medium';
			if ($k['q_level'] == 'c') $name = 'JavaScript Lanjutan';
			$category[] = ['key'=>$k['q_level'],'name'=>$name];
		}
		$data['category'] = $category;
		$this->load->view('templates/mainHeader', $data);
		$this->load->view('js-quiz',$data);
		$this->load->view('templates/mainFooter');
	}

} // END