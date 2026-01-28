<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  /*
    Ambil nilai bid dari GET dan lakukan validasi untuk 
    mengecek bid harus angka dan lebih besar dari 0 (> 0).
    'options' => ['min_range' => 1] artinya bid harus ≥ 1 
    (bukan 0, bahkan bukan negatif, bukan huruf, bukan HTML).
  */
  $bid = filter_input(INPUT_GET, 'bid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);
  /*
    Skrip di atas cara penulisan lamanya adalah:
    $bid = $_GET['bid'] ?? '';
    $bid = (int)$bid;

    Cara lama seperti di atas akan mengambil data mentah 
    kemudian validasi dilakukan secara terpisah, sehingga 
    rawan lupa validasi. Untuk input dari GET atau POST, 
    filter_input() lebih disarankan daripada $_GET atau $_POST.
  */

  /*
    Cek apakah $bid bernilai valid:
    Kalau $bid tidak valid, maka jangan lanjutkan proses, 
    kembalikan pengguna ke halaman awal (read.php) sembari 
    mengirim penanda error.
  */
  if (!$bid) {
    $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
    redirect_ke('read_biodata.php');
  }

  /*
    Ambil data lama dari DB menggunakan prepared statement, 
    jika ada kesalahan, tampilkan penanda error.
  */
  $stmt = mysqli_prepare($conn, "SELECT bid, bnma, btempat_lahir, btanggal_lahir, btanggal_lahir, bhobi, bpekerjaan
                                    FROM tabel_biodata WHERE bid = ? LIMIT 1");
  if (!$stmt) {
    $_SESSION['flash_error_biodata'] = 'Query tidak benar.';
    redirect_ke('read_biodata.php');
  }

  mysqli_stmt_bind_param($stmt, "i", $bid);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($res);
  mysqli_stmt_close($stmt);

  if (!$row) {
    $_SESSION['flash_error_biodata'] = 'Record tidak ditemukan.';
    redirect_ke('read_biodata.php');
  }

  #Nilai awal (prefill form)
  
      $bnama  = $row["bnim"]  ?? '';
      $btempat_lahir =$row["btempat_tinggal"] ?? '';
      $btanggal_lahir =$row["btanggal_lahir"] ?? '';
      $bhobi = $row["bhobi"] ?? '';
      $bpekerjaan= $row["bpekerjaan"] ?? '';
      

  #Ambil error dan nilai old input kalau ada
  $flash_error_biodata = $_SESSION['flash_error_biodata'] ?? '';
  $old_biodata = $_SESSION['old_biodata'] ?? [];
  unset($_SESSION['flash_error_biodata'], $_SESSION['old_biodata']);
  if (!empty($old_biodata)) {
    $bnama = $old_biodata['nama'] ?? $bnama;
    $btempat_lahir=$old_biodata['tempat_tinggal'] ?? $btempat_tinggal;
      $btanggal_lahir =$old_biodata['tanggal_lahir'] ?? $btanggal_lahir;
      $bhobi = $old_biodata['hobi'] ?? $bhobi;
      $bpekerjaan= $old_biodata['pekerjaan'] ?? $bpekerjaan;
    
  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1>Ini Header</h1>
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        &#9776;
      </button>
      <nav>
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </nav>
    </header>

    <main>
    <section id="biodata">
      <h2>Biodata Sederhana dosen</h2>

      <?php if (!empty($flash_sukses_biodata)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses_biodata; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($flash_error_biodata)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error_biodata; ?>
        </div>
      <?php endif; ?>

      <form action="proses_update_biodata.php" method="POST">
        <input type="text" name="bid" value="<?= (int)$bid; ?>">

        <label for="txtNmLengkap"><span>Nama Lengkap:</span>
          <input type="text" id="txtNmLengkap" name="txtNmLengkapEd" placeholder="Masukkan Nama Lengkap" required value="<?= !empty($bnama) ? $bnama : '' ?>">
        </label>

        <label for="txtT4Lhr"><span>Tempat Lahir:</span>
          <input type="text" id="txtT4Lhr" name="txtT4LhrEd" placeholder="Masukkan Tempat Lahir" required value="<?= !empty($btempat_tinggal) ? $btempat_tinggal : '' ?>">
        </label>

        <label for="txtTglLhr"><span>Tanggal Lahir:</span>
          <input type="text" id="txtTglLhr" name="txtTglLhrEd" placeholder="Masukkan Tanggal Lahir" required value="<?= !empty($btanggal_lahir) ? $btanggal_lahir : '' ?>">
        </label>

        <label for="txtHobi"><span>Hobi:</span>
          <input type="text" id="txtHobi" name="txtHobiEd" placeholder="Masukkan Hobi" required value="<?= !empty($bhobi) ? $bhobi : '' ?>">
        </label>


        <label for="txtKerja"><span>Pekerjaan:</span>
          <input type="text" id="txtKerja" name="txtKerjaEd" placeholder="Masukkan Pekerjaan" required value="<?= !empty($bpekerjaan) ? $bpekerjaan : '' ?>">
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>