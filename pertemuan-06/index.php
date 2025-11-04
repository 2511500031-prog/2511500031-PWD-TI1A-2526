<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>judul halaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Ini header</h1>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigasion">
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
            <h2>Selamat datang</h2>
            <p>Ini contoh paragraf HMTL.</p>
        </section>

        <section id="about">
            <?php 
                $nim = "2511500031";
                $NIM = "2511500000000000";
                $nama = "NUR FADILLAH";
                $NAMA = "NUYYYYY";
                $tempattanggallahir = "kapit,22 september 2006";
                $TEMPATTANGGGALLAHIR = "KETAB 5 DESEMBER";
                $hobi = "mendengarkan musik";
                $HOBI = "SUKA MASAK";
                $namaorangtua ="BAPAK ALM TASRIB DAN IBU SUYANTI";
                $NAMAORANGTUA = "BAPAK USWANTO DAN IBU SERIA";
                $alamat = "desa kapit kacamatan parittiga kabupaten bangka barat";
                $ALAMAT = "DESA SEKARBIRU ";
                $anakke = "3 dari 3 bersaudara";
                $ANAKKE = "2 DARI 2 BERSAUDARA";
                $namasuadara = "kakak pertama bernama saprudin dan kakak kedua hijasi";
                $NAMASAUDARA = "KAKAK PERTAMA MERIN DAN KAKAK KEDUA CECE";
                $namapasangan = "belum ada";
                $NAMAPASANGAN = "MASIH DICARI";
                $perkerjaan = " mahasiswa ISB ATMA LUHUR";
                $PEKERJAAN = " PENGANGGURAN";
        
                
            ?>
            <h2>Tentang saya</h2>
            <p><strong>Nama Lengkap:</strong>
                <?php
                echo$nama;
                ?>
                </p>
            <p><strong>NIM:</strong> 
                <?php
                echo$nim; 
                ?>
             </p>
            <p><strong>Tempat Tanggal Lahir:</strong>
                <?php 
                echo$tempattanggallahir;
                ?>
                </p>
            <p><strong>Hobi:</strong>
            <?php 
            echo$hobi;
            ?>
            </p>
            <p><strong>Nama Orang tua:</strong>
            <?php 
            echo$namaorangtua;
            ?>
            </p>
            <p><strong>Alamat:</strong>
            <?php 
            echo$alamat;
            ?>
             </p>
            <p><strong>Anak ke:</strong>
            <?php 
            echo$anakke;
            ?>
            </p>
            <p><strong>Nama saudara:</strong>
            <?php
             echo$namasaudara;
             ?>
             </p>
            <p><strong>Nama Pasangan:</strong>
            <?php 
            echo$namapasangan;
            ?>
            </p>
            <p><strong>Pekerjaan:</strong>
            <?php 
            echo$pekerjaan;
            ?>
            </p>
        </section>

        <section id="contact">
            <h2>Kontak kami</h2>
            <form action="" method="GET">
                <label for="txtNama">Nama:</label>
                <input type="text" id="txtNama" name="txtNama" placeholder="masukkan nama"  autocomplete="name">

                <label for="txtEmail">Email</label>
                <input type="text" id="txtEmail" placeholder="masukkan email"  autocomplete="email">

                <label for="txtPesan">Pesan</label>
                <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="tulis pesan anda..." ></textarea>
                <small id="charCount">0/200 karakter</small>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
                </label>

            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 NUR FADILLAH [2511500031] &#128525;</p>
    </footer>

    <script src="script.js"></script>
    
</body>

</html>