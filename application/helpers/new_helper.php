<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function debug($param)
	{
		var_dump($param);
		die();
	}

	function change_host($content)
	{
		$find = ["/http:\/\/localhosts\/helloworld\//"];
		# $find = ["/http:\/\/localhost\/helloworld\//"]
		$replace 		= ["".base_url().""];
		$newContent = preg_replace($find,$replace,$content);
		return $newContent;		
	}

	function getIp() 
	{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
	}
	function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
	function getRandStr($length)
	{
		$str = "";
		$codeAlphabet = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet);
		for ($i=0; $i < $length; $i++) {
			$str .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
		}
		return $str;
	}
	
	function timing()
	{
		// function ubahFormat($time){
		// 	$tgl = date('d',$time);
		// 	$bulan = date('n',$time);
		// 	$tahun = date('Y',$time);
		// 	$jam = date('H',$time);
		// 	$menit = date('i',$time);
		// 	$arrayBulan = [
		// 		1 => 'Januari',
		// 		2 => 'Februari',
		// 		3 => 'Maret',
		// 		4 => 'April',
		// 		5 => 'Mei',
		// 		6 => 'Juni',
		// 		7 => 'Juli',
		// 		8 => 'Agustus',
		// 		9 => 'September',
		// 		10 => 'Oktober',
		// 		11 => 'November',
		// 		12 => 'Desember'
		// 	];
		// 	$formatWaktu = $tgl .' '. $arrayBulan[$bulan] .' '. $tahun .' '. $jam .':'. $menit;
		// 	return $formatWaktu;      
		// }
		// $waktu_sekarang = date('Y-m-d H:i:s');
		// $waktu_sekarang = 3600;
		// echo "hari ini " . date('Y-m-d H:i:s');
		// echo "<br>";
		// echo "format waktu indonesia ". ubahFormat($waktu_sekarang);
		// echo "<br>";
		// echo "format tanggal daari timestamp : " . date("d-m-Y",$waktu_sekarang);
	}
// VALIDATION
	function buildSession($name,$value=null)
	{
		return (empty($_SESSION[$name])) ? $_SESSION[$name] = $value : false;	
	}
	function startSession($name)
	{
		return (!empty($_SESSION[$name])) ? true : false;
	}
	function getSession($name)
	{
		return $_SESSION[$name];
	}
	function startCookie($name)
	{
		return (!empty($_COOKIE[$name])) ? true : false;
	}
	function getCookie($name)
	{
		return $_COOKIE[$name];
	}
	function not_found()
	{
		$status = [
			'title' => '404',
			'image' => '404.gif',
			'message' => 'halaman yang kamu cari tidak tersedia'
		];
		blank_page($status);
		die();
	}
	function checkSession($result){
		if(!startSession('sess_id')) {
			$result['message'] = "<script>alertDanger('ok','server mendeteksi bahwa tidak ada sesi login, <br> silahkan login terlebih dahulu')</script>";
			echo json_encode($result);
			die();
		}
	}	
	function is_login()
	{
		$status = [
			'title' => '403',
			'image' => 'blocked.png',
			'message' => 'kamu harus <a href="'.base_url("at/sign").'">login</a> dulu untuk lanjut ke halaman ini'
		];
		if (startSession('sess_id')) {
			return true;
		} else {
			$_SESSION['reff_page'] = $_SERVER['REQUEST_URI'];
			blank_page($status);
			die();
		} 
	}

	function is_admin()
	{
		$status = [
			'title' => '403',
			'image' => 'blocked.png',
			'message' => 'kamu tidak punya hak akses ke halman ini'
		];		
		if (startSession('sess_role') && getSession('sess_role') == 1 ) {
			return true;
		} else {
			blank_page($status);
			die();
		}
	}

	function is_send_ajax(){
		(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ? true : not_found();
	}

	function reload_session(){
		$CI = get_instance();			
		if ((startSession('sess_id') == false) && (startCookie('c_user') == true)){
			$token = getCookie('c_user');
			$now   = time();
			$ip    = getIp();
			$agent = $_SERVER['HTTP_USER_AGENT'];
			$check = $CI->db->from('user_cookie')->where(['token' => $token, 'expired >' => $now])->get();
			
			if ( $check->num_rows() > 0 ){
					$check = $check->row_array();
				if ( $check['ip'] ==  $ip || $check['agent'] == $agent){
					$getData = $CI->db->get_where('users', ['u_email' => $check['email']])->row_array();
					$data = [
						'sess_id'   => $getData['u_id'],
						'sess_role' => $getData['u_role'],
						'sess_user' => $getData['u_username'],
						'sess_reg'   => $getData['u_register'],
						'sess_image' => base_url('assets/img/profile/').$getData['u_image']
					];
					$CI->session->set_userdata($data);
					return true;
				}
			} else {
				$CI->db->delete('user_cookie',['token' => $token]);
			}
		}
	}


	function whats_page($uri,$page){
		$CI = get_instance();
		$url 	 = $CI->uri->segment($uri);
		return ( in_array($url, $page) ) ? true : false;
	}

	function fetch_data(){
		$CI = get_instance();
		if ( startSession('sess_id') )
		{
			$id    = getSession('sess_id');
			$fetch = $CI->db->get_where('users',['u_id' => $id])->row_array();
			return $fetch;
		}
	}

	function _temp_admin($data=null,$title,$page){
		$CI = get_instance();
		$fet = fetch_data();		
		$data['inUser'] = [
			'register' =>  $fet['u_register'],
			'email'	=>  $fet['u_email']
		];
		$data['title']    = $title;

		$CI->load->view('templates/userHeader',$data);
		$CI->load->view('admin/'.$page,$data);
		$CI->load->view('templates/userFooter',$data);
	}

	function _temp_user($data=null,$title,$page){
		$CI = get_instance();
		$fet = fetch_data();		
		$data['inUser'] = [
			'register' =>  $fet['u_register'],
			'email'	=>  $fet['u_email']
		];
		$data['title']    = $title;

		$CI->load->view('templates/userHeader',$data);
		$CI->load->view('user/'.$page,$data);
		$CI->load->view('templates/userFooter',$data);
	}

	function append_comment($data){
		foreach ($data as $k => $v) {
			$data[$k]['create'] = time_elapsed_string('@'.$v['created']);
			if ($v['id_comm'] == $v['author']) {
				$data[$k]['side'] = 'right';
				$data[$k]['side-img'] = 'pull-right';
				$data[$k]['side-text'] = 'pull-left';
			} else {
				$data[$k]['side'] = 'left';
				$data[$k]['side-img'] = 'pull-left';
				$data[$k]['side-text'] = 'pull-right';
			}
		}
		return $data;
	}

// TIMING
	function time_elapsed_string($datetime,$full=false,$lang='id') {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		if ($lang == 'id') {
			$string = array(
					'y' => 'tahun',
					'm' => 'bulan',
					'w' => 'minggu',
					'd' => 'hari',
					'h' => 'jam',
					'i' => 'menit',
					's' => 'detik',
			);
		} else {
			$string = array(
					'y' => 'years',
					'm' => 'months',
					'w' => 'weeks',
					'd' => 'day',
					'h' => 'hours',
					'i' => 'minutes',
					's' => 'seconds',
			);
		}
		foreach ($string as $k => &$v) {
				if ($diff->$k) {
						$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
				} else {
						unset($string[$k]);
				}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		if ($lang == 'id') {
			return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
		} else {
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
}

// META CONTENT 
function getTags($string, $tagname){
  $d = new DOMDocument();
  $d->loadHTML($string);
  $return = array();
  foreach($d->getElementsByTagName($tagname) as $item){
      $return[] = $item->textContent;
  }
  return $return;
}
function readMore($string,$length){
	$delTags = strip_tags($string);
	$replaceTab = preg_replace('/\s\s+/',' ', $delTags);
	$cut = substr($replaceTab, 0,$length);
	$pieces = explode(' ', $cut);
	array_pop($pieces);
	$result = implode(' ', $pieces);
	return $result;	
}

// SLUG
function create_slug($string){
	$str = strtolower(str_replace(' ', '-', $string));
	return $str;
}
// 
function popu($str){
	$isArray = explode(',',$str);
	$ret = [];
	for ($i=0; $i < count($isArray) ; $i++) { 
		$exp[$i] = explode('.',$isArray[$i]);
		$pop[$i] = array_pop($exp[$i]);
		if(count($isArray) != 0){
			if($pop[$i] == 'css'){
				$ret[$i] = "<link rel=\"stylesheet\" href=\"".$isArray[$i]."\">\n";
			} else {
				$ret[$i] = "<script src=\"".$isArray[$i]."\"></script>\n";
			}
		} else {
			$ret[$i] = '';
		}
	}
	return implode(' ', $ret);
}