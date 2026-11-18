<?php

require_once 'koneksi.php';

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tb_pesan_kontak
         WHERE id='$id'"
    );

}

header("Location: pesan.php");
exit;
?>