<?php
session_start();
include('db_func.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi akun</title>
</head>
<body>
    
<script src="/package/dist/sweetalert2.all.js"></script>
<script src="/package/dist/sweetalert2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
if(isset($_SESSION['pesan'])){
    $pesan = $_SESSION['pesan'];
    if($pesan=='gagal'){
       ?>
       <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Tidak Ditemukan',
            text: 'Pastikan yang anda masukan benar!',
            confirmButtonText: 'confirm',
              preConfirm: () => {
              window.location.href = 'index.php';
            } // Menambahkan target laman pada tombol "Cancel"
            })
       </script><?php
       
    }else{
        $NewPass = $_SESSION['passwordBaru'];
        $Id = $_SESSION['id'];
        $nama = $_SESSION['name'];
        echo $Id;
        echo $nama;
        $update = update("admin","password='$NewPass'","WHERE id='$Id'");
        header('location:index.php');
    }
}
?>





