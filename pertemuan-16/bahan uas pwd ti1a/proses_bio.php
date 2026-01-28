<?php
session_start();
require __DIR__ . './koneksi.php';
require_once __DIR__ . '/fungsi.php';

/*
	ikuti cara penulisan proses.php untuk validasi, sanitasi, RPG, data old
	dan insert ke tbl_tamu termasuk flash message ke index.php#biodata
	bedanya, kali ini diterapkan untuk biodata dosen bukan tamu
*/

$arrBiodata = [
 
  "bnama" => $_POST["txtNmDosen"] ?? "",
  "btempat_tinggal" => $_POST["txtAlRmh"] ?? "",
  "tanggal_lahir" => $_POST["txtTglDosen"] ?? "",
  "bhobi" => $_POST["txthobi"] ?? "",
  "pekerjaan" => $_POST["txtpekerjaan"] ?? "",
];
$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about");
