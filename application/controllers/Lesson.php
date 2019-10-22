<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		reload_session();
		$this->load->model('Read_model');
	}

	public function index()
	{
		$data['title'] = 'Menu Pelajaran di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('lesson/index',$data);
		$this->load->view('templates/mainFooter',$data);		
	}

	public function html()
	{
		$meta  = $this->uri->segment(3);
		$checkMeta = $this->Read_model->checkMeta($meta);
		if($checkMeta < 1){
			not_found();
		} else {
			$query = $this->Read_model->getTutorialByMeta('1',$meta);
			if($query['publish'] == 0){
				not_found();
			} else {
				$data = [
					'id'  		=> $query['id'],
					'order' 	=> $query['order'],
					'title' 	=> $query['slug'],
					'titles' 	=> $query['judul'],
					'meta' 		=> $query['meta'],
					'content' => $query['konten'],
					'code'		=> $query['kode'],
					'update'	=> $query['update'],
					'category'=> $query['kategori'],
					'level'		=> $query['level'],
					'btn'			=> 'btn-html',
					'logo'		=> 'html_logo.png',
					'tmDark'	=> '#E44D26',
					'tmLight' => '#EE8F77',
				];
				if($data['order'] && $data['level']) {
					$data['next']	= $this->Read_model->getNextTutorial($data['order'],$data['level']);
				} else {
					$data['next'] = [];
				}
				$data['menu'] = $this->Read_model->getListMenuByLevel($data['level']);
				$this->load->view('templates/edHeader', $data);
				$this->load->view('lesson/lesson',$data);
				$this->load->view('templates/edFooter');		
			}
		}
	}	

	public function css()
	{
		$meta  = $this->uri->segment(3);
		$checkMeta = $this->Read_model->checkMeta($meta);
		if($checkMeta < 1){
			not_found();		
		} else {
			$query = $this->Read_model->getTutorialByMeta('2',$meta);
			if ($query['publish'] == 0) {
				not_found();
			} else {
				$data = [
					'id'  		=> $query['id'],
					'order' 	=> $query['order'],
					'title' 	=> $query['slug'],
					'titles' 	=> $query['judul'],
					'meta' 		=> $query['meta'],
					'content' => $query['konten'],
					'code'		=> $query['kode'],
					'update'	=> $query['update'],
					'category'=> $query['kategori'],
					'level'		=> $query['level'],
					'btn'			=> 'btn-css',
					'logo'		=> 'css_logo.png',
					'tmDark'	=> '#264DE4',
					'tmLight' => '#778FEE',
				];
				if($data['order'] && $data['level']) {
					$data['next']	= $this->Read_model->getNextTutorial($data['order'],$data['level']);
				} else {
					$data['next'] = [];
				}
				$data['menu'] = $this->Read_model->getListMenuByLevel($data['level']);
				$this->load->view('templates/edHeader', $data);
				$this->load->view('lesson/lesson',$data);
				$this->load->view('templates/edFooter');
			}
		}
	}

	public function javascript()
	{
		$meta  = $this->uri->segment(3);
		$checkMeta = $this->Read_model->checkMeta($meta);
		if($checkMeta < 1){
			not_found();		
		} else {
			$query = $this->Read_model->getTutorialByMeta('3',$meta);
			if ($query['publish'] == 0) {
				not_found();
			} else {
				$data = [
					'id'  		=> $query['id'],
					'order' 	=> $query['order'],
					'title' 	=> $query['slug'],
					'titles' 	=> $query['judul'],
					'meta' 		=> $query['meta'],
					'content' => $query['konten'],
					'code'		=> $query['kode'],
					'update'	=> $query['update'],
					'category'=> $query['kategori'],
					'level'		=> $query['level'],
					'btn'			=> 'btn-js',
					'logo'		=> 'js_logo.png',
					'tmDark'	=> '#F3BE30',
					'tmLight' => '#F7D26E',
				];
				if($data['order'] && $data['level']) {
					$data['next']	= $this->Read_model->getNextTutorial($data['order'],$data['level']);
				} else {
					$data['next'] = [];
				}
				$data['menu'] = $this->Read_model->getListMenuByLevel($data['level']);
				$this->load->view('templates/edHeader', $data);
				$this->load->view('lesson/lesson',$data);
				$this->load->view('templates/edFooter');				
			}
		}
	}	
}