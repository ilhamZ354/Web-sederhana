<?php
session_start();
ob_start();

if(isset($_SESSION['login'])){

        $nama = $_SESSION['nama'];
    $jabatan=$_SESSION['jabatan'];

include('../db_func.php');

$tabel = select('pegawai');

$query = "SHOW COLUMNS FROM pegawai WHERE Field = 'jabatan'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$enumJabatan = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));

$query2 = "SHOW COLUMNS FROM pegawai WHERE Field = 'divisi'";
$result2 = mysqli_query($koneksi, $query2);
$row2 = mysqli_fetch_assoc($result2);
$enumDivisi = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));


$search = isset($_GET['kata']) ? $_GET['kata'] : '';

// Filter data berdasarkan input search
$hasil = array();
if (!empty($search)) {
    foreach ($tabel as $row) {
        if (stripos($row['nama'], $search) !== false) {
            $hasil[] = $row;
        }
    }
} else {
    $hasil = $tabel;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style-1.css">
    <link rel="stylesheet" href="../css/style3.css">
    <script src="/package/dist/sweetalert2.all.js"></script>
    <script src="/package/dist/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="sidebar col-sm-12 col-md-1 col-lg-2 text-light" id="sidebar">
        <div class="brand mt-2">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <img src="../image/LogIssue Pelabuhan.svg" alt="logo" style="width:vvw;">
                </div>
            </div>
        </div>
    
    <div class="akun container mt-5 pb-3">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <span class="namaUser"><?=$nama?></span>
            </div>
            <div class="col-12 text-center">
                <span class="jabatanUser"><?=$jabatan?></span>
            </div>
            <div class="col-12 text-center">
                <div class="profil-dropdown rounded-3">
                    <button type="button" class="btnProfil"><i class="bi bi-chevron-down"></i></button>
                    <div class="dropdown-profil-content">
                        <ul class="dropDownProfil shadow-lg rounded-3">
                            <li><span><?=$nama?></span></li>
                            <li><a href="../logout.php" id="out">Logout</a></li>
                        </ul>
                        </div>
                </div>
                
            </div>
        </div>
    </div>
        
    <div class="side mt-5">
        <div class="row">
            <div class="col-12">
                <ul class="nav flex-column">
                <li class="nav-item rounded-3" >
                    <a class="nav-link" href="/LogIssue/admin/dashboard.php"><i class="bi bi-house-door-fill"></i> &nbsp; <span> Dashboard</span></a>
                </li>
                <li class="nav-item rounded-3" id="active">
                    <a class="nav-link" href="/LogIssue/admin/user.php"><i class="bi bi-person-lines-fill"></i> &nbsp; <span> User</span></a>
                </li>
                <li class="nav-item rounded-3">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                             <span>&nbsp;<i class="bi bi-envelope-exclamation" id="btnIsu"></i> &nbsp;&nbsp;<span>Isu</span></span>
                        </button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <li><a class="dropdown-item" href="/LogIssue/admin/hsse.php">HSSE</a></li>
                            <li><a class="dropdown-item" href="/LogIssue/admin/opPlanning.php">OP&C </a></li>
                            <li><a class="dropdown-item" href="/LogIssue/admin/operational.php">OP </a></li>
                            <li><a class="dropdown-item" href="../logout.php" id="out">Logout </a></li>
                        </ul>
                </li>
                    <li class="menuIsu"><a class="dropdown-item rounded-3" href="/LogIssue/admin/hsse.php">HSSE</a></li>
                    <li class="menuIsu" id=""><a class="dropdown-item rounded-3" href="/LogIssue/admin/opPlanning.php">Op.Planning & Control </a></li>
                    <li class="menuIsu"><a class="dropdown-item rounded-3" href="/LogIssue/admin/operational.php">Operational </a></li>
                <li class="nav-item rounded-3">
                    <a class="nav-link" href="/LogIssue/admin/history.php"><i class="bi bi-clock-history"></i></i> &nbsp; <span> History</span></a>
                </li>
                </ul>
            </div>
        </div>
    </div>
      </div>

     <!-- content -->
      <div class="main col-md-11 col-lg-10">
        <!-- navbar -->
        <div class="row shadow"  id="navbar">
            <div id="menu-button">
                    <input type="checkbox" id="menu-checkbox">
                    <label for="menu-checkbox" id="menu-label">
                        <div class="hamburger"></div>
                    </label>
                </div>
                <div class="col-12" id="back">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-sm-4 col-md-6">
                                <div class="search mt-3 mb-3 rounded-3">
                                    <div class="row justify-content-evenly align-items-center">
                                        <div class="col-8 text-end container">
                                            <form method="get">
                                           <input type="text" class="kata rounded-3" name="kata" placeholder="nama.." value="<?php echo $search; ?>">
                                        </div>
                                        <div class="col-3 text-start container">
                                                <button type="submit" id="cari" class="btnCari rounded-3"><i class="bi bi-search"></i> cari isu</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- navbar -->

        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-1 col-md-2">
                    <button type="button" class="btn btn-success rounded-3" id="tambahUser" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-person-plus-fill"></i> User</button>




<!-- tabel -->
                </div>
            </div>
            <hr class="garis">
            <div class="card">
                <div class="card-body">
                    
                <div class="table-responsive-xl">
                    <table class="table table-borderless" height="20vh">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            </tr>
                        </thead>
                        <tbody class="tabel-main table-bordered shadow-sm">
                            <?php $k=1; foreach($hasil as $data){?>
                            <tr >
                            <td><?= $k ?></td>
                            <td><?= $data['nip']?></td>
                            <td><?= $data['nama']?></td>
                            <td><?= $data['jabatan']?></td>
                            <td><?= $data['divisi']?></td>
                            <td><button type="submit" class="btn btn-warning rounded-3 me-2" id="editUser" data-bs-toggle="modal" data-bs-target="#ModalEditUser<?=$data['id']?>"><i class="bi bi-pencil-square text-light"></i></button>
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusUser<?=$data['id']?>"><i class="bi bi-trash-fill"></i></button></td>
                            </tr>   
                           <?php $k++;  } ?>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>

<!-- Modal Tambah User -->

<div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="ModalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content">
         <form method="post">
      <div class="modal-header">
        <h5 class="modal-title text-secondary" id="TambahUserLabel">INPUT DATA USER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="container border-1">
                    <div class="mb-3">
                        <label for="inputNIP" class="form-label">NIP</label>
                        <input type="text" maxlength="10" name="nip" class="form-control" id="inputNIP" placeholder="NIP">
                    </div>
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Nama..">
                    </div>
                    <div class="mb-3 row justify-content-start mt-4">
                        <label for="selectJabatan" class="col-md-3 form-label">Jabatan</label>
                        <div class="col-md-9">
                            <select class="form-select" aria-label="Default select example" name="selectJabatan" id="selectJabatan">
                                <?php
                                    foreach ($enumJabatan as $value) {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                ?>
                        </select>
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-start mt-4">
                        <label for="selectJabatan" class="col-md-3 form-label">Divisi</label>
                        <div class="col-md-9">
                            <select class="form-select" aria-label="Default select example" name="selectDivisi" id="selectDivisi">
                                <?php
                                foreach ($enumDivisi as $value) {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                ?>
                        </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
            </div>
        </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submitUser" class="btn btn-primary">Save</button>
      </div>
    </div>
    </form>
  </div>
</div>

                         <!-- Modal Edit User -->
                         <?php $i=1; foreach($tabel as $data){?>
                                <div class="modal fade" id="ModalEditUser<?=$data['id']?>" tabindex="-1" aria-labelledby="ModalEditUserLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-scrollable">
                                    <div class="modal-content">
                                    <form method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-secondary" id="EditUserLabel">EDIR DATA USER</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="container border-1">
                                                    <div class="mb-3">
                                                        <label for="inputNIP" class="form-label text-secondary">NIP</label>
                                                        <input type="text" maxlength="10" name="nip" class="form-control" id="inputNIP" placeholder="NIP" value="<?php echo $data['nip']?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputNama" class="form-label text-secondary">Nama</label>
                                                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Nama.." value="<?php echo $data['nama']?>">
                                                    </div>
                                                    <div class="mb-3 row justify-content-start mt-4">
                                                        <label for="selectJabatan" class="col-md-3 form-label text-secondary">Jabatan</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select" name="selectJabatan" aria-label="Default select example" id="selectJabatan">
                                                                <option value="<?php echo $data['jabatan']?>" selected><?=$data['jabatan']?></option>
                                                               <?php foreach ($enumJabatan as $value) {
                                                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                                                }?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row justify-content-start mt-4">
                                                        <label for="selectJabatan" class="col-md-3 form-label text-secondary">Divisi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select" name="selectDivisi" aria-label="Default select example" id="selectDivisi">
                                                            <option value="<?php echo $data['divisi']?>" selected><?=$data['divisi']?></option>
                                                               <?php foreach ($enumDivisi as $value) {
                                                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                                                }?>
                                                        </select>
                                                         </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputPassword" class="form-label">Password</label>
                                                        <input type="text" name="password" value="<?php echo $data['password']?>" class="form-control" id="inputPassword" placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" name="idUser" value="<?=$data['id']?>" id="userId" style="display:none">
                                             <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="ubahUser" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                             
                            <?php $k++; } ?>
                            

                                <!-- Delete Modal -->
                                    <?php $i=1; foreach ($tabel as $data) { ?>

                                    <div class="modal fade" id="ModalHapusUser<?= $data["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Yakin Ingin Hapus Menu Ini ?</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Batal</button>
                                                        <input type="submit" value="Hapus Data" class="btn btn-danger btn-user" name="hapus">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i++; } ?>
   </div>
    <footer class="p-3 text-center bg-light text-dark">
            <h6>Copyright 2023</h6>
        </footer>
  </div>
  </div>
    <script src='../js/script2.js'  type="text/javascript"></script>
    <script src='../js/sideSticky.js'  type="text/javascript"></script>
</body>
</html>

<?php
// input data
if(isset($_POST['submitUser'])){
    $nip=$_POST['nip'];
    $nama=$_POST['nama'];
    $jabatan=$_POST['selectJabatan'];
    $divisi=$_POST['selectDivisi'];
    $password=$_POST['password'];

    if ($nip==''||$nama==''||$jabatan==''||$divisi==''||$password==''){
        echo "<script>
       Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Terjadi Kesalahan Input',
            showConfirmButton: false,
            timer: 1200
            })
        </script>";
    }else{
    // echo $nip."".$nama."".$jabatan."".$divisi;
    
    $tambahUser = insert("pegawai","('','$nip','$nama','$jabatan','$divisi','$password')");
    if($tambahUser){
       echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dimasukan',
                confirmButtonText: 'confirm',
                preConfirm: () => {
                window.location.href = 'user.php';
                } 
                })

    </script>";
    }   
    }
}
 
// ubah data user
if(isset($_POST['ubahUser'])){
    $id=$_POST['idUser'];
    $nip=$_POST['nip'];
    $nama=$_POST['nama'];
    $jabatan=$_POST['selectJabatan'];
    $divisi=$_POST['selectDivisi'];
    $password=$_POST['password'];

    $editUser = update("pegawai","nip='$nip',nama='$nama',jabatan='$jabatan',divisi='$divisi'","WHERE id='$id'");
    if($editUser){
       echo "<script>
            Swal.fire({
                poition:'top-center',
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil Diubah',
                confirmButtonText: 'confirm',
                preConfirm: () => {
                window.location.href = 'user.php';
                } 
                })

    </script>";
    }   
}

if(isset($_POST['hapus'])){
    $id=$_POST['id'];

    $hapus = delete("pegawai","WHERE id=$id");
    if($hapus){
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Data Dihapus',
                confirmButtonText: 'confirm',
                preConfirm: () => {
                window.location.href = 'user.php';
                } 
                })

        </script>";
    }
}
}
?>