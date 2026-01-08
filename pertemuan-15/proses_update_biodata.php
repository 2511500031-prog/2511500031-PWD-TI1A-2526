<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
    redirect_ke('read_biodata.php');
  }

  #validasi bid wajib angka dan > 0
  $bid = filter_input(INPUT_POST, 'bid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$bid) {
    $_SESSION['flash_error_biodata'] = 'bid Tidak Valid.';
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }

  #ambil dan bersihkan (sanitasi) nilai dari form
$bnim  = bersihkan($_POST['txtNimEd']  ?? '');
$bnama = bersihkan($_POST['txtNmLengkapEd'] ?? '');
$btempat_tinggal = bersihkan($_POST['txtT4LhrEd'] ?? '');
$btanggal_lahir = bersihkan($_POST['txtTglLhrEd'] ?? '');
$bhobi = bersihkan($_POST['txtHobiEd'] ?? '');
$bpekerjaan = bersihkan($_POST['txtKerjaEd'] ?? '');
$bpasangan = bersihkan($_POST['txtPasanganEd'] ?? '');
$borang_tua= bersihkan($_POST['txtNmOrtuEd'] ?? '');
$bkakak= bersihkan($_POST['txtNmKakakEd'] ?? '');
$badik= bersihkan($_POST['txtNmAdikEd'] ?? '');

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
if (mb_strlen($bnama) < 3) {
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
    'orang_tua' => $borang_tua,
    'kakak' => $bkakak,
    'adik' => $badik,
    ];

    $_SESSION['flash_error_biodata'] = implode('<br>', $errors_biodata);
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE bid = ?)
  */
  $stmt = mysqli_prepare($conn, "UPDATE tabel_biodata SET bnim = ?, bnama = ?, btempat_tinggal = ?, btanggal_lahir = ?, bhobi = ?, bpekerjaan = ?, bpasangan = ?, borang_tua = ?, bkakak = ?, badik = ?
                                WHERE bid = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param($stmt, "ssssssssssi", $bnim, $bnama, $btempat_tinggal, $btanggal_lahir, $bhobi, $bpekerjaan, $bpasangan, $borang_tua, $bkakak, $badik, $bid);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old_biodata value
    unset($_SESSION['old_biodata']);
    /*
      Redirect balik ke read_biodata.php dan tampilkan info sukses.
    */
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
    redirect_ke('read_biodata.php'); #pola PRG: kembali ke data dan exit()
  } else { #jika gagal, simpan kembali old_biodata value dan tampilkan error umum
    $_SESSION['old_biodata'] = [
      'nim'  => $bnim,
    'nama' => $bnama,
    'tempat_tinggal' => $btempat_tinggal,
    'tanggal_lahir' => $btanggal_lahir,
    'hobi' => $bhobi,
    'pekerjaan' => $bpekerjaan,
    'pasangan' => $bpasangan,
    'orang_tua' => $borang_tua,
    'kakak' => $bkakak,
    'adik' => $badik,
    ];
    $_SESSION['flash_error_biodata'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  redirect_ke('edit_biodata.php?bid='. (int)$bid);