<?php
session_start();

$sesnama = "";
if (isset($_SESSION["sesnama"])):
  $sesnama = $_SESSION["sesnama"];
endif;

$sesemail = "";
if (isset($_SESSION["sesemail"])):
  $sesemail = $_SESSION["sesemail"];
endif;

$sespesan = "";
if (isset($_SESSION["sespesan"])):
  $sespesan = $_SESSION["sespesan"];
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>judul halaman</title>
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
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>
    
    <section id="form_profil">
      <h2>pendaftaran profil pengunjung</h2>
      <form action="form_profil_proses.php" method="POST">

      <label for="nim">
        <span>NIM : </span>
        <input type="text" id="nim" placeholder="tulis nim anda"required autocomplete="nim"></input>
</label>

  <label for="nama lengkap">
        <span>nama lengkap : </span>
        <input type="text" id="nama lengkap" placeholder=" tulis nama anda"required autocomplete="nama lengkap"></input>
</label>

<label for="tempat lahir">
        <span>tempat lahir : </span>
        <input type="text" id="tempat lahir" placeholder=" tulis tempat lahir anda"required autocomplete="tempat lahir"></input>
</label>

<label for="tanggal lahir">
        <span>tanggal lahir : </span>
        <input type="text" id="tanggal lahir" placeholder=" tulis tanggal lahir anda"required autocomplete="tanggal lahir"></input>
</label>

<label for="hobi">
        <span>hobi : </span>
        <input type="text" id="hobi" placeholder=" tulis hobi anda"required autocomplete="hobi"></input>
</label>

<label for="pasangan">
        <span>pasangan: </span>
        <input type="text" id="pasangan" placeholder=" tulis pasangan anda"required autocomplete="pasangan"></input>
</label>

<label for="pekerjaan">
        <span>pekerjaan: </span>
        <input type="text" id="pekerjaan" placeholder=" tulis pekerjaan anda"required autocomplete="pekerjaan"></input>
</label>

<label for="nama orang tua">
        <span>nama orang tua: </span>
        <input type="text" id="nama orang tua" placeholder=" tulis nama orang tua anda"required autocomplete="nama orang tua"></input>
</label>

<label for="nama kakak">
        <span>nama kakak: </span>
        <input type="text" id="nama kakak" placeholder=" tulis nama kakak anda"required autocomplete="nama kakak"></input>
</label>

<label for="nama adik">
        <span>nama adik: </span>
        <input type="text" id="nama adik" placeholder=" tulis nama adik anda"required autocomplete="nama adik"></input>
</label>
        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      <?php

      $nim = 2511500010;
      $NIM = '0344300002';
      $nama = "Say'yid Abdullah";
      $Nama = 'Al\'kautar Benyamin';
      $tempat = "Jebus";
      ?>
      <h2>Tentang Saya</h2>
      <p><strong>NIM:</strong>
        <?php
        echo $NIM;
        ?>
      </p>
      <p><strong>Nama Lengkap:</strong>
        <?php
        echo $Nama;
        ?> &#128526;
      </p>
      <p><strong>Tempat Lahir:</strong> <?php echo $tempat; ?></p>
      <p><strong>Tanggal Lahir:</strong> 1 Januari 2000</p>
      <p><strong>Hobi:</strong> Memasak, coding, dan bermain musik &#127926;</p>
      <p><strong>Pasangan:</strong> Belum ada &hearts;</p>
      <p><strong>Pekerjaan:</strong> Dosen di ISB Atma Luhur &copy; 2025</p>
      <p><strong>Nama Orang Tua:</strong> Bapak Setiawan dan Ibu Maria</p>
      <p><strong>Nama Kakak:</strong> Antonius Setiawan</p>
      <p><strong>Nama Adik:</strong> <?php echo $sespesan ?></p>
    </section>

    <section id="form_profil">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>

      <?php if (!empty($sesnama)): ?>
        <br><hr>
        <h2>Yang menghubungi kami</h2>
        <p><strong>Nama :</strong> <?php echo $sesnama ?></p>
        <p><strong>Email :</strong> <?php echo $sesemail ?></p>
        <p><strong>Pesan :</strong> <?php echo $sespesan ?></p>
      <?php endif; ?>



    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>