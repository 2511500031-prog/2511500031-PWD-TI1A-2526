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
  $errors = []; #ini array untuk menampung semua error yang ada

  if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
  }

  if ($email === '') {
    $errors[] = 'Email wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format e-mail tidak valid.';
  }

  if ($pesan === '') {
    $errors[] = 'Pesan wajib diisi.';
  }

  if ($captcha === '') {
    $errors[] = 'Pertanyaan wajib diisi.';
  }

  if (mb_strlen($nama) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
  }

  if (mb_strlen($pesan) < 10) {
    $errors[] = 'Pesan minimal 10 karakter.';
  }

  if ($captcha!=="6") {
    $errors[] = 'Jawaban '. $captcha.' captcha salah.';
  }

  /*
  kondisi di bawah ini hanya dikerjakan jika ada error, 
  simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
  */
  if (!empty($errors)) {
    $_SESSION['old'] = [
      'nama'  => $nama,
      'email' => $email,
      'pesan' => $pesan
    ];

    $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE bid = ?)
  */
  $stmt = mysqli_prepare($conn, "UPDATE tbl_tamu 
                                SET cnama = ?, cemail = ?, cpesan = ? 
                                WHERE bid = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param($stmt, "sssi", $nama, $email, $pesan, $bid);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
    unset($_SESSION['old']);
    /*
      Redirect balik ke read_biodata.php dan tampilkan info sukses.
    */
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
    redirect_ke('read_biodata.php'); #pola PRG: kembali ke data dan exit()
  } else { #jika gagal, simpan kembali old value dan tampilkan error umum
    $_SESSION['old'] = [
      'nama'  => $nama,
      'email' => $email,
      'pesan' => $pesan,
    ];
    $_SESSION['flash_error_biodata'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata.php?bid='. (int)$bid);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  redirect_ke('edit_biodata.php?bid='. (int)$bid);