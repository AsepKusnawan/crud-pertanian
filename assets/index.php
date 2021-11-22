<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Asep Kusnawan</title>
  </head>
  <body>
    <h1 class="text-center pb-5">Pengembangan Aplikasi Berbasis Web</h1>
	<div class="container">
	<?php 

// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","","pertanian") or die(mysqli_error());

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$id = time();
		$nm_tanaman = $_POST['nm_tanaman'];
		$hasil = $_POST['hasil'];
		$lama = $_POST['lama'];
		$tgl_panen = $_POST['tgl_panen'];
		
		if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
			$sql = "INSERT INTO tabel_panen (id,nama_tanaman, hasil_panen, lama_tanam, tanggal_panen) VALUES(".$id.",'".$nm_tanaman."','".$hasil."','".$lama."','".$tgl_panen."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<fieldset>
				<legend><h2>Tambah data</h2></legend>
				<label class="form-label">Nama tanaman <input type="text" name="nm_tanaman" /></label> <br>
				<label  class="form-label">Hasil panen <input type="number" name="hasil" /> kg</label><br>
				<label  class="form-label">Lama tanam <input type="number" name="lama" /> bulan</label> <br>
				<label  class="form-label">Tanggal panen <input type="date" name="tgl_panen" /></label> <br>
				<br>
				<label>
					<input class="btn btn-primary" type="submit" name="btn_simpan" value="Simpan"/>
					<input class="btn btn-danger" type="reset" name="reset" value="Besihkan"/>
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</fieldset>
		</form>
	<?php

}
// --- Tutup Fngsi tambah data


// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
	$sql = "SELECT * FROM tabel_panen";
	$query = mysqli_query($koneksi, $sql);
	
	echo "<fieldset>";
	echo "<legend><h2>Data Panen</h2></legend>";
	
	echo "<table border='1' cellpadding='10' class='table'>";
	echo "<tr>
			<th>ID</th>
			<th>Nama Tanaman</th>
			<th>Hasil Panen</th>
			<th>Lama Tanam</th>
			<th>Tanggal Panen</th>
			<th>Tindakan</th>
		  </tr>";
	
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['nama_tanaman']; ?></td>
				<td><?php echo $data['hasil_panen']; ?> Kg</td>
				<td><?php echo $data['lama_tanam']; ?> bulan</td>
				<td><?php echo $data['tanggal_panen']; ?></td>
				<td>
					<a class="btn btn-success" href="index.php?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama_tanaman']; ?>&hasil=<?php echo $data['hasil_panen']; ?>&lama=<?php echo $data['lama_tanam']; ?>&tanggal=<?php echo $data['tanggal_panen']; ?>">Ubah</a> |
					<a class="btn btn-danger" href="index.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
				</td>
			</tr>
		<?php
	}
	echo "</table>";
	echo "</fieldset>";
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($koneksi){

	// ubah data
	if(isset($_POST['btn_ubah'])){
		$id = $_POST['id'];
		$nm_tanaman = $_POST['nm_tanaman'];
		$hasil = $_POST['hasil'];
		$lama = $_POST['lama'];
		$tgl_panen = $_POST['tgl_panen'];
		
		if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
			$perubahan = "nama_tanaman='".$nm_tanaman."',hasil_panen=".$hasil.",lama_tanam=".$lama.",tanggal_panen='".$tgl_panen."'";
			$sql_update = "UPDATE tabel_panen SET ".$perubahan." WHERE id=$id";
			$update = mysqli_query($koneksi, $sql_update);
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	
	// tampilkan form ubah
	if(isset($_GET['id'])){
		?>
			<a href="index.php"> &laquo; Home</a> | 
			<a href="index.php?aksi=create"> (+) Tambah Data</a>
			<hr>
			
			<form action="" method="POST">
			<fieldset>
				<legend><h2>Ubah data</h2></legend>
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
				<label>Nama tanaman <input type="text" name="nm_tanaman" value="<?php echo $_GET['nama'] ?>"/></label> <br>
				<label>Hasil panen <input type="number" name="hasil" value="<?php echo $_GET['hasil'] ?>"/> kg</label><br>
				<label>Lama tanam <input type="number" name="lama" value="<?php echo $_GET['lama'] ?>"/> bulan</label> <br>
				<label>Tanggal panen <input type="date" name="tgl_panen" value="<?php echo $_GET['tanggal'] ?>"/></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>"> (x) Hapus data ini</a>!
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
				
			</fieldset>
			</form>
		<?php
	}
	
}
// --- Tutup Fungsi Update


// --- Fungsi Delete
function hapus($koneksi){

	if(isset($_GET['id']) && isset($_GET['aksi'])){
		$id = $_GET['id'];
		$sql_hapus = "DELETE FROM tabel_panen WHERE id=" . $id;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){
				header('location: index.php');
			}
		}
	}
	
}
// --- Tutup Fungsi Hapus


// ===================================================================

// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
	</div>
	

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>