<?php
include('koneksi.php');

for ($i = 33; $i < 1000; $i++) {
    $pass = md5('admin');
    $koneksi->query("DELETE FROM users WHERE id='$i'");

    echo 'Proses ke : ' . $i . '<br>';
}
echo 'Success';
