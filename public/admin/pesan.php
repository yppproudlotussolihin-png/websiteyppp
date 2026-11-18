<?php

require_once 'koneksi.php';

$query = "SELECT * FROM tb_pesan_kontak ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pesan Masuk</title>

<link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 p-6">

<div class="max-w-7xl mx-auto">

<div class="bg-white rounded-xl shadow p-5 mb-5">

<h1 class="text-2xl font-bold text-emerald-700">
Pesan Masuk Website
</h1>

<p class="text-gray-500">
Daftar pesan dari website yayasan
</p>

</div>

<div class="bg-white rounded-xl shadow overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full">

<thead class="bg-emerald-50">

<tr>
<th class="p-4 text-left">No</th>
<th class="p-4 text-left">Website</th>
<th class="p-4 text-left">Nama</th>
<th class="p-4 text-left">Email</th>
<th class="p-4 text-left">Tanggal</th>
<th class="p-4 text-left">Status</th>
<th class="p-4 text-center">Aksi</th>
</tr>

</thead>

<tbody>

<?php
$no = 1;

while($row = mysqli_fetch_assoc($hasil)){
?>

<tr class="border-b hover:bg-gray-50">

<td class="p-4"><?= $no++; ?></td>

<td class="p-4">
<?= htmlspecialchars($row['asal_website']); ?>
</td>

<td class="p-4">
<?= htmlspecialchars($row['nama']); ?>
</td>

<td class="p-4">
<?= htmlspecialchars($row['email']); ?>
</td>

<td class="p-4">
<?= date('d-m-Y H:i', strtotime($row['tanggal'])); ?>
</td>

<!-- STATUS -->

<td class="p-4">

<?php if($row['status'] == 'Belum Dibaca'){ ?>

<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">

Belum Dibaca

</span>

<?php } else { ?>

<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">

Sudah Dibaca

</span>

<?php } ?>

</td>

<!-- AKSI -->

<td class="p-4 text-center">

<a href="detail_pesan.php?id=<?= $row['id']; ?>"
class="bg-blue-500 text-white px-3 py-2 rounded">

Detail

</a>

<a href="https://wa.me/<?= $row['whatsapp']; ?>"
target="_blank"
class="bg-green-500 text-white px-3 py-2 rounded">

WhatsApp

</a>

<a href="hapus_pesan.php?id=<?= $row['id']; ?>"
class="bg-red-500 text-white px-3 py-2 rounded">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>