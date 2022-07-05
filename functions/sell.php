<?php

include '../connection.php';

if (isset($_POST["submit"])) {

    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['desc']);
    $harga = mysqli_real_escape_string($conn, $_POST['price']);
    $nomor_acak = round(microtime(true));
    $nama_foto = $_FILES['image']['name'];
    $tipe_foto = strtolower($_FILES['image']['type']);
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $foto = $nomor_acak . '_' . $nama_foto;

    if ($file_size > 5000000) {
        echo "<script>alert('overweight image size');
        location.href='../';</script>";
    }

    if ($tipe_foto !== "image/jpeg" || $tipe_foto !== "image/jpg" || $tipe_foto !== "image/png") {

        @move_uploaded_file($file_tmp, "../imgs/" . $foto);

        $query = mysqli_query($conn, "INSERT INTO `products` (`product_name`, `product_image`, `product_description`, `product_price`) 
                                        VALUES ('$nama', '$foto','$deskripsi', '$harga')
                                        ");

        echo "<script>alert('Selling Item is success....!!!');
            location.href='../';</script>";
    } else {
        echo "<script>alert('Sorry only image with PNG/JPG can be upload');
            location.href='../';</script>";
    }
}
