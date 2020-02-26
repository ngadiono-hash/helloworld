<?php
//memasukkan file koneksi
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Engine</title>
</head>
<body>
 
	<h2>Pencarian</h2>
	<form action="" method="post">
		<input type="text" name="kata_kunci" placeholder="Masukkan kata kunci" />
		<input type="submit" name="submit" value="Cari" />
	</form>
	
	<?php
	//jika tombol Cari di klik akan menjalankan script berikutnya
	if(isset($_POST['submit'])){
		//membuat variabel $kata_kunci yang menyimpan data dari inputan kata kunci
		$kata_kunci = $koneksi->real_escape_string(htmlentities(trim($_POST['kata_kunci'])));
		
		//cek apakah kata kunci kurang dari 3 karakter
		if(strlen($kata_kunci)<3){
			//pesan error jika kata kunci kurang dari 3 karakter
			echo '<p>Kata kunci terlalu pendek.</p>';
		}else{
			//membuat variabel $where dengan nilai kosong
			$where = "";
			
			//membuat variabel $kata_kunci_split untuk memecah kata kunci setiap ada spasi
			$kata_kunci_split = preg_split('/[\s]+/', $kata_kunci);
			//menghitung jumlah kata kunci dari split di atas
			$total_kata_kunci = count($kata_kunci_split);
			
			//melakukan perulangan sebanyak kata kunci yang di masukkan
			foreach($kata_kunci_split as $key=>$kunci){
				//set variabel $where untuk query nanti
				$where .= "kata_kunci LIKE '%$kunci%'";
				//jika kata kunci lebih dari 1 (2 dan seterusnya) maka di tambahkan OR di perulangannya
				if($key != ($total_kata_kunci - 1)){
					$where .= " OR ";
				}
			}
			
			//melakukan query ke database dengan SELECT, dan dimana WHERE ini mengambil dari $where
			$results = $koneksi->query("SELECT judul, LEFT(deskripsi, 60) as deskripsi, url FROM artikel WHERE $where");
			//menghitung jumlah hasil query di atas
			$num = $results->num_rows;
			//jika tidak ada hasil
			if($num == 0){
				//pesan jika tidak ada hasil
				echo '<p>Pencarian dengan kata kunci <b>'.$kata_kunci.'</b> tidak ada hasil.</p>';
			}else{
				//pesan jika ada hasil pencarian
				echo '<p>Pencarian dari kata kunci <b>'.$kata_kunci.'</b> mendapatkan '.$num.' hasil:</p>';
				//perulangan untuk menampilkan data
				while($row = $results->fetch_assoc()){
					//menampilkan data
					echo '
					<p>
						<b>'.$row['judul'].'</b><br>
						'.$row['deskripsi'].'...<br>
						<a href="'.$row['url'].'">'.$row['url'].'</a>
					</p>
					';
				}
			}
		}
	}
	?>
	
</body>
</html>