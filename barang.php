<?php
spl_autoload_register(function($class){
  require_once $class.'.php';
});

$saw = new Saw();
 ?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rekomendasi Smartphone</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<!-- header -->
	<div class="medsos">
		<div class="container">
			<ul>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>
	<header>
		<div class="container">
			<h1><a href="index.php">Rekomendasi Smartphone</a></h1>
			<ul>
				<li><a href="index.php">HOME</a></li>
				<li><a href="kriteria.php">KRITERIA</a></li>
				<li class="active"><a href="barang.php">BARANG</a></li>
				<li><a href="perhitungan.php">PERHITUNGAN</a></li>
			</ul>
		</div>
	</header>

		<!-- label -->
		<section class="label">
		<div class="container">
			<p>Home / Barang</p>
		</div>
	</section>

<center>
<br><br><br><br><br><br><br>
<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Alamat</th>
  </tr>

<?php
$no=1;
$karyawan = $saw->get_data_karyawan();
while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
?>
  <tr>
    <td>K<?php echo $data_karyawan['id_karyawan']; ?></td>
    <td><?php echo $data_karyawan['nama_karyawan']; ?></td>
    <td><?php echo $data_karyawan['alamat']; ?></td>
  </tr>

<?php } ?>
</table>
<br><br><br><br><br><br><br>
</center>
	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2021 - Rekomendasi Smartphone. By Kelompok 10.</small>
		</div>
	</footer>
</body>
</html>