<?php

require_once 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $asal_website = mysqli_real_escape_string(
        $koneksi,
        $_POST['asal_website']
    );

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama']
    );

    $email = mysqli_real_escape_string(
        $koneksi,
        $_POST['email']
    );

    $whatsapp = mysqli_real_escape_string(
    $koneksi,
    $_POST['whatsapp']
    );

    $pesan = mysqli_real_escape_string(
        $koneksi,
        $_POST['pesan']
    );

    $query = "INSERT INTO tb_pesan_kontak
(
    asal_website,
    nama,
    email,
    whatsapp,
    pesan,
    status
)
VALUES
(
    '$asal_website',
    '$nama',
    '$email',
    '$whatsapp',
    '$pesan',
    'Belum Dibaca'
)";

    if(mysqli_query($koneksi, $query)){

        echo "
        <script>
            alert('Pesan berhasil dikirim');
            location.href=document.referrer;
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Gagal mengirim pesan');
            history.back();
        </script>
        ";

    }

}
?>