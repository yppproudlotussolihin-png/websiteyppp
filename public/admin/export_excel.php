<?php
require_once 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pendaftar_PPDB_Lengkap.xls");

$query = "SELECT * FROM tb_santri ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);
?>

<table border="1">
    <thead>
        <tr style="background-color: #d1d5db; font-weight: bold;">
            <th>No</th>
            <th>Waktu Daftar</th>
            <th>Nama Santri</th>
            <th>NIK</th>
            <th>NISY (No. Induk Yayasan)</th>
            <th>NISN</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Anak Ke</th>
            <th>Jumlah Saudara</th>
            <th>Tinggi Badan</th>
            <th>Berat Badan</th>
            <th>Hobi</th>
            <th>Cita-cita</th>
            <th>Jenjang Pendidikan</th>
            <th>Status Mukim</th>
            <th>Unit Pesantren</th>  
            <th>Nomor KK</th>
            <th>Nama Kepala Keluarga</th>
            <th>Status Ayah</th>
            <th>Nama Ayah</th>
            <th>NIK Ayah</th>
            <th>Agama Ayah</th>
            <th>Tempat Lahir Ayah</th>
            <th>Tanggal Lahir Ayah</th>
            <th>Pendidikan Ayah</th>
            <th>Pekerjaan Ayah</th>
            <th>Pendapatan Ayah</th>
            <th>Status Ibu</th>
            <th>Nama Ibu</th>
            <th>Agama Ibu</th>
            <th>NIK Ibu</th>
            <th>Tempat Lahir Ibu</th>
            <th>Tanggal Lahir Ibu</th>
            <th>Pendidikan Ibu</th>
            <th>Pekerjaan Ibu</th>
            <th>Pendapatan Ibu</th>
            <th>No WhatsApp</th>
            <th>Alamat</th>
            <th>RT/RW</th>
            <th>Desa/Kelurahan</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
            <th>Provinsi</th>
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
                <td style='mso-number-format:\"\@\";'>{$row['nik']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nisy']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nisn']}</td>
                <td>{$row['tempat_lahir']}</td>
                <td>{$row['tanggal_lahir']}</td>
                <td>{$row['jenis_kelamin']}</td>
                <td>{$row['agama']}</td>
                <td>{$row['anak_ke']}</td>
                <td>{$row['jumlah_saudara']}</td>
                <td>{$row['tinggi_badan']}</td>
                <td>{$row['berat_badan']}</td>
                <td>{$row['hobi']}</td>
                <td>{$row['cita_cita']}</td>
                <td>{$row['jenjang_pendidikan']}</td>
                <td>{$row['mukim']}</td>
                <td>{$row['unit_pesantren']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nomor_kk']}</td>
                <td>{$row['nama_kepala_keluarga']}</td>
                <td>{$row['status_ayah']}</td>
                <td>{$row['nama_ayah']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nik_ayah']}</td>
                <td>{$row['agama_ayah']}</td>
                <td>{$row['tempat_lahir_ayah']}</td>
                <td>{$row['tanggal_lahir_ayah']}</td>
                <td>{$row['pendidikan_ayah']}</td>
                <td>{$row['pekerjaan_ayah']}</td>
                <td>{$row['pendapatan_ayah']}</td>
                <td>{$row['status_ibu']}</td>
                <td>{$row['nama_ibu']}</td>
                <td>{$row['agama_ibu']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nik_ibu']}</td>
                <td>{$row['tempat_lahir_ibu']}</td>
                <td>{$row['tanggal_lahir_ibu']}</td>
                <td>{$row['pendidikan_ibu']}</td>
                <td>{$row['pekerjaan_ibu']}</td>
                <td>{$row['pendapatan_ibu']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['nomor_hp']}</td>
                <td>{$row['alamat']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['rt_rw']}</td>
                <td>{$row['desa_kelurahan']}</td>
                <td>{$row['kecamatan']}</td>
                <td>{$row['kabupaten']}</td>
                <td>{$row['provinsi']}</td>
                <td style='mso-number-format:\"\@\";'>{$row['kode_pos']}</td>
            </tr>";
            $no++;
        }
        ?>
    </tbody>
</table>