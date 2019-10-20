<!DOCTYPE html>
<html>
<head>
<style>
	* { font-family: sans-serif; }
	table { border-collapse: collapse; width: 100%; }
	table th { padding: 15px; }
	table, th, td { border: 1px solid black; padding: 10px; }
  th, td { min-width: 45% }
  table tr:nth-child(even) {
    background-color: #eee;
  }
  table tr:nth-child(odd) {
    background-color: #fff;
  }	
	h2 { text-align: center; }
</style>
</head>

<body>
<?php
function get_input($name) {
	if(isset($_POST[$name])) {
		$var = $_POST[$name];
		return $var;
	} else {
		return false;
	}
}
function echoHere($name) 
{
$value = [
	'nama_user' => 'Nama kamu adalah...',
	'gender_user' => 'Kamu adalah seorang...',
	'username_user' => 'Kamu menginput username sebagai...',
	'password_user' => 'Password yang kamu masukkan...',
	'email_user' => 'Kamu menginputkan Email...',
	'lahir_user' => 'Apa benar tanggal lahir kamu adalah...',
	'hobi_user' => 'Kamu memiliki hobi...',
	'alamat_user' => 'Kamu bertempat-tinggal di...',
	'warna_user' => 'Apakah warna favoritmu adalah...',
	'url_user' => 'Apakah benar alamat website kamu...',
	'browser_user' => 'Browser favoritmu adalah...',
	'range_user' => 'Angka yang kamu kirim adalah...',
];	
	if(get_input($name)) 
	{
		echo '<tr>';
		echo '<td>' . $value[$name] . '</td>';
		echo '<td>' . get_input($name) . '</td>';
		echo '</tr>';
	}
}

$nama 		= get_input('nama_user');
$gender 	= get_input('gender_user');
$username = get_input('username_user');
$password = get_input('password_user');
$lahir 		= get_input('lahir_user');
$hobi 		= get_input('hobi_user');
$alamat 	= get_input('alamat_user');
$jawab 		= get_input('jawab_user');
$warna 		= get_input('warna_user');
$email 		= get_input('email_user');
$url 			= get_input('url_user');
$browser	= get_input('browser_user');
$range		= get_input('range_user');

if(!$nama && !$username && !$password && !$gender && !$hobi && !$alamat && !$jawab && !$warna && !$email &&!$url && !$lahir && !$browser && !$range){
	$header   = 
	'
	<h2>Halaman proses.php menangkap apa yang kamu inputkan</h2>
	<h3>Hasilnya adalah :</h3>
	<h1 style="text-align: center; color: red;">Kamu belum mengirimkan data apapun !</h1>
	';
} else {
	$header   = 
	'	
	<h2>Halaman proses.php menangkap apa yang kamu inputkan</h2>
	<h3>Hasilnya :</h3>
	';
}
echo $header;
?>

	<table>
		<thead>
		<tr>
			<th>Atribut Name</th>
			<th>Value</th>
		</tr>
		</thead>
		<tbody>
	<?php 
	echoHere('nama_user');
	echoHere('gender_user');
	echoHere('username_user');
	echoHere('password_user');
	echoHere('lahir_user');
	echoHere('hobi_user');
	echoHere('alamat_user');
	echoHere('range_user');
	echoHere('warna_user');
	echoHere('email_user');
	echoHere('url_user');
	echoHere('browser_user');	
	?>
		</tbody>
	</table>

</body>
</html>