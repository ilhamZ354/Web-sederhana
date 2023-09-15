<?php
session_start();

if(isset($_SESSION['login'])){
    $nama = $_SESSION['nama'];
    $jabatan=$_SESSION['jabatan'];

    
include('../db_func.php');
$tabel=select('riwayat');


// Filter data berdasarkan input search
$search1='';
$search3='';

$hasil=array();
if(isset($_POST['cabang'])){
    $cbg = $_POST['cabang'];
    $tgl = $_POST['date'];
    $search1=$tgl; 
    $search3=$cbg; 

    if($cbg!==''||$tgl!==''){
        if(empty($cbg) && !empty($tgl)){
            // echo 'kosong cabang';
            foreach($tabel as $row){
    
                if(stripos($row['tanggal'],$tgl) !==false){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($tgl) && !empty($cbg) ){
            // echo 'kosong tanggal';
            foreach($tabel as $row){
    
                if(stripos($row['cabang'],$cbg) !==false){
                    $hasil[]=$row;
                }
            }
        }else{
            // echo 'tidak ada yang kosong';
            foreach($tabel as $row){
                if(stripos($row['tanggal'],$tgl) !==false &&  stripos($row['cabang'],$cbg) !==false){
                    $hasil[]=$row;
                }
            }
        }
}else{
    $hasil=$tabel;
}

}
else{
    $hasil=$tabel;
}

// Fungsi untuk memeriksa apakah semua checkbox terseleksi
function isAllSelected($tabel, $selected){
    foreach($tabel as $data){
        if(!in_array($data['id'], $selected)){
            return false;
        }
    }
    return true;
}

// Menginisialisasi variabel untuk status checkbox "Select All"
$selectAll = isAllSelected($tabel, $_POST['selected'] ?? []);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style3.css">
    <script src="/package/dist/sweetalert2.all.js"></script>
    <script src="/package/dist/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <style>
        thead{
            background-color:#0084FF;
        }
        tbody td{
            font-family:'Arial';
            color:gray;
        }
        table{
            height:550px;
        }
    </style>
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
                <li class="nav-item rounded-3">
                    <a class="nav-link" href="/LogIssue/mtcc/dashboard.php"><i class="bi bi-house-door-fill"></i> &nbsp; <span> Dashboard</span></a>
                </li>
                <li class="nav-item rounded-3">
                    <a class="nav-link" href="/LogIssue/mtcc/isu.php"><i class="bi bi-envelope-exclamation"></i> &nbsp; <span> Isu</span></a>
                </li>
                <li class="nav-item rounded-3" id="active">
                    <a class="nav-link" href="/LogIssue/mtcc/history.php"><i class="bi bi-clock-history"></i></i> &nbsp; <span> History</span></a>
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
                            <div class="col-sm-4 col-md-7">
                                <div class="search mt-3 mb-3 rounded-3">
                                    <div class="row justify-content-evenly align-items-center">
                                        <div class="col-4 text-end container">
                                        <form method="post">
                                            <input type="date" class="tanggal rounded-3 text-secondary" name="date" placeholder="tanggal" value="<?php echo $search1; ?>">
                                        </div>
                                        <div class="col-4 text-end container">
                                            <input type="text" class="kata rounded-3" name="cabang" placeholder="cabang" value="<?php echo $search3; ?>">
                                        </div>
                                        <div class="col-3 text-end container">
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

        <!-- content -->
        <div class="konten container" id="konten">
        <div class="row justify-content-end mt-3">
                    <div class="col-3 text-end mt-2">
                        <form method="post" action="../print.php">
                            <input type="hidden" name="tanggal" value="<?=$search1?>">
                            <input type="hidden" name="status" value="">
                            <input type="hidden" name="cabang" value="<?=$search3?>">
                            <input type="hidden" name="laman" value="history-mtcc">
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="bi bi-printer-fill"></i> Cetak</button>
                        </form>
                    </div>
                </div>
            
        <form method="post">
            <div class="col-12 text-end mb-3 mt-3">
            <button type="submit" name="hapus" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
            </div>
                <div class="col-12">
                        <div class="table-responsive">
                        <table class="table table-borderless" width="100%" id="tabelkonten">
                            <thead  class="tabel-info text-light rounded-3 text-center">
                                            <tr>
                                            <th scope="col">
                                                 <div class="form-check">
                                            <input type="checkbox" id="select-all" <?= $selectAll ? 'checked' : '' ?>> 
                                            <label class="form-check-label text-light" for="flexCheckChecked">
                                            All
                                        </label>
                                    </div>
                                            </th>
                                            <th scope="col">Id</th>
                                            <th scope="col">PIC</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Follow-Up</th>
                                            <th scope="col">Remark Open</th>
                                            <th scope="col">Remark Closed</th>
                                            </tr>
                                        </thead>
            
                                        <tbody class="tabel-main table-light text-center">
                                        <?php $k=1; foreach($hasil as $data){?>
                                            <?php if (!empty($data['foto_akhir'])) { ?>
                                            <tr >
                                            <td><input type="checkbox" name="selected[]" value="<?= $data['id'] ?>" <?= $selectAll ? 'checked' : '' ?>></td>
                                            <td><?=$k ?></td>
                                            <td><?= $data['PIC']?></td>
                                            <td><?= $data['tanggal']?></td>
                                            <td><?= $data['cabang']?></td>
                                            <td width="400px"><?= $data['deskripsi']?></td>
                                            <td><?= $data['Status']?></td>
                                            <td width="200px"><?= $data['tanggapan']?></td>
                                            <td width="400px"><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto_awal']; ?>" alt="gambar"></td>
                                            <td width="400px"><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto_akhir']; ?>" alt="gambar"></td>
                                        </td>            
                                         </tr>
                                        <?php } ?>
                                    <?php $k++; } ?>
                                        </tbody>
                            </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        </form>

    <footer class="p-3 text-center bg-light text-dark">
            <h6>Copyright 2023</h6>
        </footer>
  </div>

  <script src='../js/script2.js'  type="text/javascript"></script>
  <script src='../js/script3.js'  type="text/javascript"></script>
  <script src='../js/sideSticky.js'  type="text/javascript"></script>
  <script>
    // Mengatur checkbox "Select All" agar memilih/menghapus semua checkbox lainnya
    document.getElementById('select-all').addEventListener('change', function(){
        var checkboxes = document.getElementsByName('selected[]');
        for(var i = 0; i < checkboxes.length; i++){
            checkboxes[i].checked = this.checked;
        }
    });

    tampilData = document.getElementById('tampil');
    konten = document.getElementsByClassName('dataForm')[0];

    tampilData.addEventListener("click", function () {
  konten.classList.toggle("tampil");
  
});

</script>
</body>
</html>

<?php
// Cek apakah form submit telah dikirim
if(isset($_POST['hapus'])){
    // Periksa setiap checkbox yang dipilih
    if(!empty($_POST['selected'])){
        foreach($_POST['selected'] as $id){
            // Hapus data dari tabel berdasarkan ID yang dipilih
            $hapusUser = delete("riwayat", "WHERE id='$id'");
        }
        if($hapusUser){
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil dihapus',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'history.php';
                    }
                });
            </script>";
        }
    }
    else{
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak ada data yang dipilih',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}}
?>