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
				<li><a href="barang.php">BARANG</a></li>
                <li class="active"><a href="perhitungan.php">PERHITUNGAN</a></li>
                
			</ul>
		</div>
	</header>

	<!-- label -->
	<section class="label">
		<div class="container">
			<p>Home / Perhitungan</p>
		</div>
	</section>

    <br><br>
<center>
<center>

<h2>Kriteria</h2>
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

<br><br>
<hr>
<br><br>
<h2>Barang</h2>
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

<br><br>
<hr>
<br><br>
<h2>Barang Kriteria</h2>
<table border="1" cellspacing="0" height="200" width="600">

 <tr>
   <th rowspan="2">Barang</th>
   <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
 <tr>
 <?php
 $kriteria = $saw->get_data_kriteria();
 while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
 ?>
     <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

 <?php } ?>
 </tr>

 <?php
 $karyawan = $saw->get_data_karyawan();
 while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
 ?>
   <tr>
     <td><center>K<?php echo $data_karyawan['id_karyawan']; ?></center></td>
     <?php
     $nilai = $saw->get_data_nilai_id($data_karyawan['id_karyawan']);
     while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) { ?>
       <td><center><?php echo $data_nilai['nilai']; ?></center></td>

     <?php } ?>
   </tr>

 <?php } ?>

</table>

<br><br>
<hr>

<br><br>
<h2>Normalisasi</h2>

<table border="1" cellspacing="0" height="200" width="600">

 <tr>
   <th rowspan="2">Barang</th>
   <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
 </tr>

 </tr>

 <tr>
 <?php
 $hasil_ranks=array();
 $kriteria = $saw->get_data_kriteria();
 while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
 ?>
     <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

 <?php } ?>
 </tr>

 <?php
 $karyawan = $saw->get_data_karyawan();
 while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
 ?>
   <tr>
     <td><center>K<?php echo $data_karyawan['id_karyawan']; ?></center></td>
     <?php
     // tampilkan nilai dengan id_karyawan ...
     $hasil_normalisasi=0;
     $nilai = $saw->get_data_nilai_id($data_karyawan['id_karyawan']);
     while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
     //
       $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
       while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
         if ($data_kriteria['jenis']=="cost") {
           $min = $saw->nilai_min($data_nilai['id_kriteria']);
           while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
             <td>
               <center>
                 <?php
                  echo number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                     $hasil_kali = $hasil*$data_kriteria['bobot'];
                     $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                </center>
             </td>
           <?php } ?>

         <?php }elseif ($data_kriteria['jenis']=="benefit") {
           $max = $saw->nilai_max($data_nilai['id_kriteria']);
           while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
             <td>
               <center>
                 <?php
                 echo $hasil = $data_nilai['nilai']/$data_max['max'];
                   $hasil_kali = $hasil*$data_kriteria['bobot'];
                   $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                 ?>
               </center>
             </td>
           <?php } ?>
         <?php }
       ?>

       <?php } } ?>

   </tr>
 <?php } ?>

</table>

<br><br>

<hr>
<br><br>

<h2>Pembobotan</h2>

<table border="1" cellspacing="0" height="200" width="1200">

  <tr>
    <th rowspan="2">Barang</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
    <th rowspan="2">Hasil</th>
  </tr>

  </tr>

  <tr>
  <?php
  $kriteria = $saw->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

  <?php } ?>
  </tr>

  <?php
  $hasil_ranks=array();
  $karyawan = $saw->get_data_karyawan();
  while ($data_karyawan = $karyawan->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>K<?php echo $data_karyawan['id_karyawan']; ?></center></td>
      <?php
      // tampilkan nilai dengan id_karyawan ...
      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_karyawan['id_karyawan']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      //
        $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['jenis']=="cost") {
            $min = $saw->nilai_min($data_nilai['id_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      echo  $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                   ?>
                 </center>
              </td>
            <?php } ?>

          <?php }elseif ($data_kriteria['jenis']=="benefit") {
            $max = $saw->nilai_max($data_nilai['id_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
              <td>
                <center>
                  <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    echo $hasil_kali = $hasil*$data_kriteria['bobot'];
                    $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;

                  ?>
                </center>
              </td>
            <?php } ?>
          <?php }
        ?>

        <?php } } ?>

      <td><center>

        <?php

        $hasil_rank['nilai'] = $hasil_normalisasi;
        $hasil_rank['karyawan'] = $data_karyawan['nama_karyawan'];
        array_push($hasil_ranks,$hasil_rank);
        echo $hasil_normalisasi; ?>
      </<center>
      </td>
    </tr>
  <?php } ?>

</table>

<br><br>
<hr>
<br><br>

<h2>Hasil Ranking</h2>

<table border="1" cellspacing="0" height="200" width="400">
  <tr>
    <th>Ranking</th>
    <th>Nama Barang</th>
    <th>Nilai Akhir</th>
  </tr>

  <?php
   $no=1;
   rsort($hasil_ranks);
   foreach ($hasil_ranks as $rank) { ?>
  <tr>
    <td><center><?php echo $no++ ?></center></td>
    <td><center><?php echo $rank['karyawan']; ?></center></td>
    <td><center><?php echo $rank['nilai']; ?></center></td>
  </tr>
  <?php } ?>
</table>

<br><br>
</center>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2021 - Rekomendasi Smartphone. By Kelompok 10.</small>
		</div>
	</footer>
</body>
</html>