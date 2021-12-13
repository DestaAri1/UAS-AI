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
				<li class="active"><a href="kriteria.php">KRITERIA</a></li>
				<li><a href="barang.php">BARANG</a></li>
				<li><a href="perhitungan.php">PERHITUNGAN</a></li>
			</ul>
		</div>
	</header>

	<!-- label -->
	<section class="label">
		<div class="container">
			<p>Home / Kriteria</p>
		</div>
	</section>

	<br><br><br><br><br><br>
	<br>
<center>
	<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>No</th>
    <th>Nama Kriteria</th>
    <th>Jenis</th>
    <th>Bobot</th>
  </tr>

<?php
$no=1;
$kriteria = $saw->get_data_kriteria();
$jml_kriteria = $kriteria->rowCount();
while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
?>
  <tr>
    <td>C<?php echo $data_kriteria['id_kriteria']; ?></td>
    <td><?php echo $data_kriteria['nama_kriteria']; ?></td>
    <td><?php echo $data_kriteria['jenis']; ?></td>
    <td><?php echo $data_kriteria['bobot']; ?></td>
  </tr>

<?php } ?>
</table>

<br><br><br><br><br><br><br>
<hr>
</center>
	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2021 - Rekomendasi Smartphone. By Kelompok 10.</small>
		</div>
	</footer>
</body>
</html>