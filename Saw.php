<?php

/**
 *
 */
class Saw
{
  private $db;
  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=ai', "root", "");
  }

  public function get_data_kriteria(){
    $stmt = $this->db->prepare("SELECT*FROM kriteria_saw ORDER BY id_kriteria");
    $stmt->execute();
		return $stmt;
  }

  public function get_data_karyawan(){
    $stmt = $this->db->prepare("SELECT*FROM karyawan_saw ORDER BY id_karyawan");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_kriteria_id($id){
    $stmt = $this->db->prepare("SELECT*FROM kriteria_saw WHERE id_kriteria='$id' ORDER BY id_kriteria");
    $stmt->execute();
		return $stmt;
  }

  public function get_data_nilai_id($id){
    $stmt = $this->db->prepare("SELECT*FROM nilai_saw WHERE id_karyawan='$id' ORDER BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_max($id){
    $stmt = $this->db->prepare("SELECT id_kriteria, MAX(nilai) AS max FROM nilai_saw WHERE id_kriteria='$id' GROUP BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_min($id){
    $stmt = $this->db->prepare("SELECT id_kriteria, MIN(nilai) AS min FROM nilai_saw WHERE id_kriteria='$id' GROUP BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

}

 ?>

 
<?php
    $koneksi = mysqli_connect("localhost","root","","spk_saw");
?>
