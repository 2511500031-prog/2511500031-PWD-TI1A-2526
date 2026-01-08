<?php
require 'koneksi.php';

$fieldBiodata = [
  "nim" => ["label" => "nim:", "suffix" => ""],
  "nama" => ["label" => "nama:", "suffix" => ""],
  "tempat_tinggal" => ["label" => "tempat_tinggal:", "suffix" => ""],
  "tanggal_lahir" => ["label" => "tanggal_lahir:", "suffix" => ""],
  "hobi" => ["label" => "hobi:", "suffix" => ""],
  "pekerjaan" => ["label" => "pekerjaan:", "suffix" => ""],
  "pasangan" => ["label" => "pasangan:", "suffix" => ""],
  "orang_tua" => ["label" => "orang_tua:", "suffix" => ""],
  "kakak" => ["label" => "kakak:", "suffix" => ""],
  "adik" => ["label" => "adik:", "suffix" => ""]

];

$sql = "SELECT * FROM tabel_biodata ORDER BY bid DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
  echo "<p>Gagal membaca data tamu: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
} elseif (mysqli_num_rows($q) === 0) {
  echo "<p>Belum ada data tamu yang tersimpan.</p>";
} else {
  while ($row = mysqli_fetch_assoc($q)) {
    $arrBiodata= [
      "nim"  => $row["bnim"]  ?? "",
      "nama" => $row["bnama"] ?? "",
      "tempat_tinggal" => $row["btempat_tinggal"] ?? "",
      "tanggal_lahir" => $row["btanggal_lahir"] ?? "",
      "hobi" => $row["bhobi"] ?? "",
      "pekerjaan" => $row["bpekerjaan"] ?? "",
      "pasangan" => $row["bpasangan"] ?? "",
      "orang_tua" => $row["borang_tua"] ?? "",
      "kakak" => $row["bkakak"] ?? "",
      "adik" => $row["badik"] ?? "",


    ];
    echo tampilkanBiodata($fieldContact, $arrContact);
  }
}
?>
