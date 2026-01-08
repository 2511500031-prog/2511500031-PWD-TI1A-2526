<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM tabel_biodata ORDER BY bid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses_biodata = $_SESSION['flash_sukses_biodata'] ?? ''; #jika query sukses
  $flash_error_biodata  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
  unset($_SESSION['flash_sukses_biodata'], $_SESSION['flash_error']); 
?>

<?php if (!empty($flash_sukses_biodata)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses_biodata; ?>
        </div>
<?php endif; ?>

<?php if (!empty($flash_error_biodata)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error_biodata; ?>
        </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>nim</th>
    <th>nama</th>
    <th>tempat tinggal</th>
    <th>tanggal lahir</th>
    <th>hobi</th>
    <th>pekerjaan</th>
    <th>pasangan</th>
    <th>orang tua</th>
    <th>kakak</th>
    <th>adik</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit_biodata.php?bid=<?= (int)$row['bid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['bnama']); ?>?')" href="proses_delete_biodata.php?bid=<?= (int)$row['bid']; ?>">Delete</a>
      </td>
      <td><?= $row['bid']; ?></td>
      <td><?= htmlspecialchars($row['bnim']); ?></td>
      <td><?= htmlspecialchars($row['bnama']); ?></td>
      <td><?= htmlspecialchars($row['btempat_tinggal']); ?></td>
      <td><?= htmlspecialchars($row['btanggal_lahir']); ?></td>
      <td><?= htmlspecialchars($row['bhobi']); ?></td>
      <td><?= htmlspecialchars($row['bpekerjaan']); ?></td>
      <td><?= htmlspecialchars($row['bpasangan']); ?></td>
      <td><?= htmlspecialchars($row['borang_tua']); ?></td>
      <td><?= htmlspecialchars($row['bkakak']); ?></td>
      <td><?= htmlspecialchars($row['badik']); ?></td>
    </tr>
  <?php endwhile; ?>
</table>