<?php

require_once 'koneksi.php';

$id = (int)$_GET['id'];

mysqli_query(
    $koneksi,
    "UPDATE tb_pesan_kontak
     SET status='Sudah Dibaca'
     WHERE id='$id'"
);

$query = "SELECT * FROM tb_pesan_kontak WHERE id='$id'";

$hasil = mysqli_query($koneksi,$query);

$data = mysqli_fetch_assoc($hasil);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detail Pesan</title>
<link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto">

<div class="bg-white rounded-xl shadow p-6">

<h2 class="text-2xl font-bold mb-5 text-emerald-700">

Detail Pesan

</h2>

<p>
<b>Website :</b>
<?= htmlspecialchars($data['asal_website']); ?>
</p>

<p>
<b>Nama :</b>
<?= htmlspecialchars($data['nama']); ?>
</p>

<p>
<b>Email :</b>
<?= htmlspecialchars($data['email']); ?>
</p>

<p>
<b>WhatsApp :</b>
<?= htmlspecialchars($data['whatsapp']); ?>
</p>

<p>
<b>Tanggal :</b>
<?= $data['tanggal']; ?>
</p>

<hr class="my-5">

<h3 class="font-bold mb-2">
Isi Pesan
</h3>

<div class="bg-gray-50 p-4 rounded">

<?= nl2br(htmlspecialchars($data['pesan'])); ?>

</div>

<a href="pesan.php"
class="inline-block mt-5 bg-emerald-600 text-white px-4 py-2 rounded">

Kembali

</a>

</div>

</div>

</body>

</html>