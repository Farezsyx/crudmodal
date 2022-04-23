<?php
include 'koneksi.php';

if($_GET['act']== 'tambahuser'){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO user VALUES('', '$nama' , '$username' , '$password' , '$alamat')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:index.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='edituser'){
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', password='$password', alamat='$alamat' WHERE id_user='$id_user' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:index.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'hapususer'){
    $id_user = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:index.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>