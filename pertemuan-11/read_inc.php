<?php
require "koneksi.php";

$fieldContact = [
    "nama"  => ["label" => "Nama"],
    "email" => ["label" => "Email"],
    "pesan" => ["label" => "Pesan"]
];

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q   = mysqli_query($conn, $sql);

if (!$q) {
    echo "<p>Gagal membaca data tamu : " . htmlspecialchars(mysqli_error($conn)) . "</p>";
} elseif (mysqli_num_rows($q) == 0) {
    echo "<p>Belum ada data tamu yang tersimpan.</p>";
} else {
    while ($row = mysqli_fetch_assoc($q)) {

        $arrContact = [
            "nama"  => $row["cnama"],
            "email" => $row["cemail"],
            "pesan" => $row["cpesan"]
        ];

        echo tampilkanBiodata($fieldContact, $arrContact);
    }
}
?>