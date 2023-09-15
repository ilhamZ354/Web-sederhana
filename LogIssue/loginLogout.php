<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="/package/dist/sweetalert2.all.js"></script>
    <script src="/package/dist/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<?php
include('db_func.php');


// untuk regis akun
if(isset($_POST['username2'])){

        
    $userRegis = $_POST['username2'];
    $passRegis1 = $_POST['password2'];
    $passRegis2 = $_POST['password3'];

    // echo $userRegis;
    // echo $passRegis1;
    // echo $passRegis2;

    $cari = select("admin","*","WHERE nip = '$userRegis'  AND admin_password='$passRegis1'");
    if(empty($cari)){
        // echo 'tidak ditemukan';
        header('location:regis.php');
        $_SESSION['pesan']='gagal';

    }else{
        // echo 'selamat datang'.$cari[0]['nama'];
        header('location:regis.php');
        $_SESSION['pesan']='berhasil';
        $_SESSION['id']=$cari[0]['id'];
        $_SESSION['name']=$cari[0]['nama'];
        $_SESSION['passwordBaru']=$passRegis2;
    }
}

// untuk login
if (isset($_POST['username'])) {
    $userLogin = $_POST['username'];
    $passLogin = $_POST['password1'];

    // echo $userLogin;

    // Cek untuk admin
    $cek = select("admin", "*", "WHERE nip='$userLogin' AND password='$passLogin'");

    // Cek untuk pegawai
    $cek2 = select("pegawai", "*", "WHERE nip='$userLogin' AND password='$passLogin'");


    if ($cek) {

    foreach ($cek as $data){
        // echo $data['nama'];
        header('location:/LogIssue/admin/dashboard.php');
        $_SESSION['login']='berhasil';
        $_SESSION['nama']=$data['nama'];
        $_SESSION['jabatan']=$data['jabatan'];
    }
    
    } else if ($cek2) {
        foreach ($cek2 as $data){
            // echo $data['nama'];
            $div = $data['divisi'];
            $nama=$data['nama'];
            if($div=='mtc'){
                header('location:/LogIssue/mtc/dashboard.php');
                $_SESSION['login']='berhasil';
                $_SESSION['nama']=$data['nama'];
                $_SESSION['jabatan']=$data['jabatan'];
            }
            if($div=='mtcc'){
                header('location:/LogIssue/mtcc/dashboard.php');
                $_SESSION['login']='berhasil';
                $_SESSION['nama']=$data['nama'];
                $_SESSION['jabatan']=$data['jabatan'];
            }

            
        }
    }
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Ditemukan',
                text: 'Pastikan yang anda masukan benar!',
                confirmButtonText: 'Confirm',
                preConfirm: () => {
                    window.location.href = 'index.php';
                } 
            });
        </script>";
    
}


