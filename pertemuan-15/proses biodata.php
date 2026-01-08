<?php
session_start();
require __DIR__ . './koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('index.php#biodata');
}

#ambil dan bersihkan nilai dari form
$bnim  = bersihkan($_POST['txtNim']  ?? '');
$bnama = bersihkan($_POST['txtNmLengkap'] ?? '');
$btempat_tinggal = bersihkan($_POST['txtT4Lhr'] ?? '');
$btanggal_lahir = bersihkan($_POST['txtTglLhr'] ?? '');
$bhobi = bersihkan($_POST['txtHobi'] ?? '');
$bpekerjaan = bersihkan($_POST['txtKerja'] ?? '');
$bpasangan = bersihkan($_POST['txtPasangan'] ?? '');
$borang_tua= bersihkan($_POST['txtNmOrtu'] ?? '');
$bkakak= bersihkan($_POST['txtNmKakak'] ?? '');
$badik= bersihkan($_POST['txtNmAdik'] ?? '');
#Validasi sederhana
$errors_biodata = []; #ini array untuk menampung semua error yang ada

if ($bnim === '') {
  $errors_biodata[] = 'nim wajib diisi.';
}

if ($bnama === '') {
  $errors_biodata[] = 'nama wajib diisi.';
}

if ($btempat_tinggal === '') {
  $errors_biodata[] = 'tempat tinggal wajib diisi.';
}

if ($btanggal_lahir === '') {
  $errors_biodata[] = 'tanggal lahir wajib diisi.';
}
if ($bhobi === '') {
  $errors_biodata[] = 'hobi wajib diisi.';
}
if ($bpekerjaan === '') {
  $errors_biodata[] = 'Pekerjaan wajib diisi.';
}
if ($bpasangan=== '') {
  $errors_biodata[] = 'Pasangan wajib diisi.';
}
if ($borang_tua === '') {
  $errors_biodata[] = 'orang tua wajib diisi.';
}
if ($bkakak === '') {
  $errors_biodata[] = 'kakak wajib diisi.';
}
if ($badik === '') {
  $errors_biodata[] = 'adik wajib diisi.';
}
if (mb_strlen($nama) < 3) {
  $errors_biodata[] = 'Nama minimal 3 karakter.';
}

/*
kondisi di bawah ini hanya dikerjakan jika ada error, 
simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
*/
if (!empty($errors_biodata)) {
  $_SESSION['old_biodata'] = [
    'nim'  => $bnim,
    'nama' => $bnama,
    'tempat_tinggal' => $btempat_tinggal,
    'tanggal_lahir' => $btanggal_lahir,
    'hobi' => $bhobi,
    'pekerjaan' => $bpekerjaan,
    'pasangan' => $bpasangan,
    'kakak' => $bkakak,
    'adik' => $badik,
    
  ];

  $_SESSION['flash_error_biodata'] = implode('<br>', $errors_biodata);
  redirect_ke('index.php#biodata');
}

#menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_biodata (bnim, bnama, btempat_tinggal, btanggal_lahir, bhobi, bpekerjaan, bpasangan, bkakak, badik) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim pesan error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#biodata');
}
#bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param($stmt, "ssssssssss", $bnim, $bnama, $btempat_tinggal, $btanggal_lahir, $bhobi, $bpekerjaan, $bpasangan, $borang_tua, $bkakak, $badik);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old_biodata value, beri pesan sukses
  unset($_SESSION['old_biodata']);
  $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah tersimpan.';
  redirect_ke('index.php#biodata'); #pola PRG: kembali ke form / halaman home
} else { #jika gagal, simpan kembali old_biodata value dan tampilkan error umum
  $_SESSION['old_biodata'] = [
    'nama'  => $nama,
    'email' => $email,
    'pesan' => $pesan,
    'captcha' => $captcha,
  ];
  $_SESSION['flash_error_biodata'] = 'Data gagal disimpan. Silakan coba lagi.';
  redirect_ke('index.php#biodata');
}
#tutup statement
mysqli_stmt_close($stmt);

$arrBiodata = [
  "nim" => $_POST["txtNim"] ?? "",
  "nama" => $_POST["txtNmLengkap"] ?? "",
  "tempat" => $_POST["txtT4Lhr"] ?? "",
  "tanggal" => $_POST["txtTglLhr"] ?? "",
  "hobi" => $_POST["txtHobi"] ?? "",
  "pasangan" => $_POST["txtPasangan"] ?? "",
  "pekerjaan" => $_POST["txtKerja"] ?? "",
  "ortu" => $_POST["txtNmOrtu"] ?? "",
  "kakak" => $_POST["txtNmKakak"] ?? "",
  "adik" => $_POST["txtNmAdik"] ?? ""
];
$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about");
