<?php
require_once 'koneksi.php';

$query = "SELECT * FROM tb_santri ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Lengkap PPDB</title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <style>
        @page { size: A3 landscape; margin: 5mm; }
        body { font-family: sans-serif; font-size: 8px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; padding: 2px; }
        th { background-color: #eee; text-align: center; font-weight: bold; }
        h2 { text-align: center; margin: 5px; }
    </style>
</head>
<body onload="window.print()">

    <h2>Data Lengkap Pendaftar PPDB Roudlotussolihin</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Nama Santri</th>
                <th>NIK</th>
                <th>NISY</th>
                <th>NISN</th>
                <th>TTL</th>
                <th>JK</th>
                <th>Agama</th>
                <th>Anak Ke/Jml</th>
                <th>Tinggi/Berat</th>
                <th>Hobi/Cita</th>
                <th>Jenjang</th>
                <th>Mukim/Unit</th>
                <th>Nama Ayah</th>
                <th>Status Ayah</th>
                <th>NIK Ayah</th>
                <th>Pendidikan Ayah</th>
                <th>Pekerjaan Ayah</th>
                <th>Pendapatan Ayah</th>
                <th>Nama Ibu</th>
                <th>Status Ibu</th>
                <th>NIK Ibu</th>
                <th>Pendidikan Ibu</th>
                <th>Pekerjaan Ibu</th>
                <th>Pendapatan Ibu</th>
                <th>Nomor KK</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Desa</th>
                <th>Kec</th>
                <th>Kab</th>
                <th>Prov</th>
                <th>Kode Pos</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($hasil)) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['tgl_pendaftaran']}</td>
                    <td>{$row['nama_santri']}</td>
                    <td>{$row['nik']}</td>
                    <td>{$row['nisy']}</td>
                    <td>{$row['nisn']}</td>
                    <td>{$row['tempat_lahir']}, {$row['tanggal_lahir']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['agama']}</td>
                    <td>{$row['anak_ke']}/{$row['jumlah_saudara']}</td>
                    <td>{$row['tinggi_badan']}/{$row['berat_badan']}</td>
                    <td>{$row['hobi']}/{$row['cita_cita']}</td>
                    <td>{$row['jenjang_pendidikan']}</td>
                    <td>{$row['mukim']}/{$row['unit_pesantren']}</td>
                    <td>{$row['nama_ayah']}</td>
                    <td>{$row['status_ayah']}</td>
                    <td>{$row['nik_ayah']}</td>
                    <td>{$row['pendidikan_ayah']}</td>
                    <td>{$row['pekerjaan_ayah']}</td>
                    <td>{$row['pendapatan_ayah']}</td>
                    <td>{$row['nama_ibu']}</td>
                    <td>{$row['status_ibu']}</td>
                    <td>{$row['nik_ibu']}</td>
                    <td>{$row['pendidikan_ibu']}</td>
                    <td>{$row['pekerjaan_ibu']}</td>
                    <td>{$row['pendapatan_ibu']}</td>
                    <td>{$row['nomor_kk']}</td>
                    <td>{$row['nomor_hp']}</td>
                    <td>{$row['alamat']}</td>
                    <td>{$row['rt_rw']}</td>
                    <td>{$row['desa_kelurahan']}</td>
                    <td>{$row['kecamatan']}</td>
                    <td>{$row['kabupaten']}</td>
                    <td>{$row['provinsi']}</td>
                    <td>{$row['kode_pos']}</td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>