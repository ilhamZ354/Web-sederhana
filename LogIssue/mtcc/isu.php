<?php
session_start();

if(isset($_SESSION['login'])){
    $nama = $_SESSION['nama'];
    $jabatan=$_SESSION['jabatan'];

include('../db_func.php');


$tabel=select('isu');

// Filter data berdasarkan input search
$search1='';
$search2='';
$search3='';

$hasil=array();
if(isset($_POST['cabang'])){
    $cbg = $_POST['cabang'];
    $tgl = $_POST['date'];
    $stat = $_POST['status'];
    $search1=$tgl; 
    $search2=$stat; 
    $search3=$cbg; 

    if($cbg!==''||$tgl!==''||$stat!==''){
        if(empty($cbg) && !empty($stat) && !empty($tgl)){
            // echo 'kosong cabang';
            foreach($tabel as $row){
    
                if(stripos($row['Status'],$stat) !==false &&  stripos($row['tanggal'],$tgl) !==false){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($tgl) && !empty($stat) && !empty($cbg) ){
            // echo 'kosong tanggal';
            foreach($tabel as $row){
    
                if(stripos($row['Status'],$stat) !==false &&  stripos($row['cabang'],$cbg) !==false){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($stat) && !empty($tgl) && !empty($cbg) ){
            // echo 'kosong status';
            foreach($tabel as $row){
    
                if(stripos($row['cabang'],$cbg) !==false &&  stripos($row['tanggal'],$tgl) !==false){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($cbg) && empty($tgl) && !empty($stat)){
            // echo 'cuman status yang tidak kosong';
            foreach($tabel as $row){
                if(stripos($row['Status'],$stat) !==false ){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($stat)&& empty($tgl) && !empty($cbg)){
            // echo 'cuman cabang yang tidak kosong';
            foreach($tabel as $row){
                if(stripos($row['cabang'],$cbg) !==false ){
                    $hasil[]=$row;
                }
            }
        }elseif(empty($stat)&& empty($cbg) && !empty($tgl)){
            // echo 'cuman tanggal yang tidak kosong';
            foreach($tabel as $row){
                if(stripos($row['tanggal'],$tgl) !==false ){
                    $hasil[]=$row;
                }
            }
        }else{
            // echo 'tidak ada yang kosong';
            foreach($tabel as $row){
                if(stripos($row['Status'],$stat) !==false &&  stripos($row['tanggal'],$tgl) !==false &&  stripos($row['cabang'],$cbg) !==false){
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

$query = "SHOW COLUMNS FROM isu WHERE Field = 'cabang'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$enumCabang = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));

$query2 = "SHOW COLUMNS FROM isu WHERE Field = 'status'";
$result2 = mysqli_query($koneksi, $query2);
$row2 = mysqli_fetch_assoc($result2);
$enumStatus = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));

$query3 = "SHOW COLUMNS FROM isu WHERE Field = 'kategori'";
$result3 = mysqli_query($koneksi, $query3);
$row3 = mysqli_fetch_assoc($result3);
$enumKategori = explode(",", str_replace("'", "", substr($row3['Type'], 5, (strlen($row3['Type'])-6))));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isu</title>
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
         :root {
  --background-gradient: linear-gradient(30deg, #f39c12 30%, #f1c40f);
  --gray: #34495e;
  --darkgray: #2c3e50;
}
body{
  color:#ffff;
}
select {
  /* Reset Select */
  appearance: none;
  outline: 0;
  border: 0;
  box-shadow: none;
  /* Personalize */
  flex: 1;
  padding: 0 1em;
  color: #fff;
  background-image: none;
  cursor: pointer;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select wrapper */
.select {
  position: relative;
  display: flex;
  width: 100%;
  height: 2em;
  border-radius: .25em;
  overflow: hidden;
}
.select.tanggal {
  position: relative;
  display: flex;
  width: 100%;
  height: 2em;
  border-radius: .25em;
  overflow: hidden;
}
/* Arrow */
.select:not(.tanggal)::after {
  content: '\e152';
  position: absolute;
  top: 1;
  right: 0;
  padding: 0.4em;
  background-color: #0084FF;
  transition: .25s all ease;
  pointer-events: none;
}

/* Transition */
.select:hover::after {
  color: #D9D9D9;
}
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
<!DOCTYPE html>
<html>
<head>
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
                <li class="nav-item rounded-3" id="active">
                    <a class="nav-link" href="/LogIssue/mtcc/isu.php"><i class="bi bi-envelope-exclamation"></i> &nbsp; <span> Isu</span></a>
                </li>
                <li class="nav-item rounded-3">
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
                            <div class="col-sm-4 col-md-10">
                                <div class="search mt-3 mb-3 rounded-3">
                                    <div class="row justify-content-evenly align-items-center">
                                        <div class="col-3 text-end container">
                                        <form method="post">
                                            <input type="date" class="tanggal rounded-3 text-secondary" name="date" placeholder="tanggal" value="<?php echo $search1; ?>">
                                        </div>
                                        <div class="col-3 text-end container">
                                            <input type="text" class="kata rounded-3" name="status" placeholder="status" value="<?php echo $search2; ?>">
                                        </div>
                                        <div class="col-3 text-end container">
                                            <input type="text" class="kata rounded-3" name="cabang" placeholder="cabang" value="<?php echo $search3; ?>">
                                        </div>
                                        <div class="col-2 text-end container">
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

        <!-- ruang input -->
            <div class="container">
                <div class="ruang-input shadow container mt-3">
                    <form method="post" id="isuForm" enctype="multipart/form-data">
                    <div class="row justify-content-evenly container">
                        <div class="col">
                            <div class="row justify-content-center pt-3 pb-3">
                                <div class="col-12 col-lg-3">
                                    <div class="row justify-content-start">
                                        <div class="col-12 selectItem">
                                            <div class="select">
                                                <select name="selectCabang" >
                                                    <option value="" selected>Cabang</option>
                                                    <?php
                                                        foreach ($enumCabang as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                        <div class="col-12 selectItem rounded-3">
                                            <div class="select tanggal">
                                                <input class="container" type="date" name="tanggal" id="tanggal">
                                            </div>
                                        </div>
                                        <div class="col-12 selectItem">
                                             <div class="select">
                                                <select name="selectStatus">
                                                    <option value="" selected>Status</option>
                                                    <?php
                                                        foreach ($enumStatus as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                        <div class="col-12 selectItem">
                                             <div class="select">
                                                <select name="selectKategori">
                                                    <option value="" selected>Kategori</option>
                                                     <?php
                                                        foreach ($enumKategori as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div class="mb-3">
                                                <div class="labelDeskripsi container rounded-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label mt-1">Deskripsi</label>
                                                </div>
                                                <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="4" maxlength="300" placeholder="silakan isi deskripsi.." required></textarea>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <div class="container border border-1 mt-1">
                                                <div class="p-3">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 text-center text-dark">
                                                            <h6>Dokumentasi Isu</h6>
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label"></label>
                                                                <input class="form-control bg-info" name="gambar" id="formFile" type="file" type="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="hidden" name="pic" value="<?=$nama?>">
                                            <button type="submit" name="tambahIsu" class="btn btn-success mt-2" id="btnFile">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-3 text-end mt-2">
                        <form method="post" action="../print.php">
                            <input type="hidden" name="tanggal" value="<?=$search1?>">
                            <input type="hidden" name="status" value="<?=$search2?>">
                            <input type="hidden" name="cabang" value="<?=$search3?>">
                            <input type="hidden" name="laman" value="isu-mtcc">
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="bi bi-printer-fill"></i> Cetak</button>
                        </form>
                    </div>
                </div>
                <hr class="border border-2">
                <!-- navigasi -->
                <div class="aksi">
                <div class="row  align-items-center">
                    <div class="col-2">
                        <div class="form-check">
                            <input type="checkbox" id="select-all" <?= $selectAll ? 'checked' : '' ?>> 
                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                All
                            </label>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-4 offset-lg-6 text-end">
                        <form method="post">
                        <button type="submit" name="hapus" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </div>
                </div>
                </div>


                <!-- tabel -->
                <div class="row justify-content-between mt-3">
                    <div class="col-md-12 col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-borderless" width="100%">
                            <thead  class="tabel-info text-light text-center rounded-3">
                                            <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Id</th>
                                            <th>PIC</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Remark</th>
                                            <th width="200px">Follow-up</th>
                                            <th scope="col">Komentar</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="tabel-main table-light">
                                        <?php $k=1; foreach($hasil as $data){?>
                                            <tr >
                                            <td><input type="checkbox" name="selected[]" value="<?= $data['id'] ?>" <?= $selectAll ? 'checked' : '' ?>></td>
                                            <td><?=$k ?></td>
                                            <td><?= $data['PIC']?></td>
                                            <td><?= $data['cabang']?></td>
                                            <td><?= $data['tanggal']?></td>
                                            <td><?= $data['Status']?></td>
                                            <td><?= $data['kategori']?></td>
                                            <td><?= $data['deskripsi']?></td>
                                            <td width="300px"><img class="offset-2 col-8" width="100%" height="auto" src="../image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?= $data['tanggapan']?></td>  
                                            <td><?= $data['komentar']?></td> 
                                            <td><button type="button" class="btn btn-warning rounded-3 me-2" id="editIsu" data-bs-toggle="modal" data-bs-target="#ModalEditIsu<?=$data['id']?>"><i class="bi bi-pencil-square text-light"></i></button>
                                            <button type="button" class="btn btn-dark" id="CommentIsu" data-bs-toggle="modal" data-bs-target="#ModalCommentIsu<?=$data['id']?>"><i class="bi bi-chat-dots-fill"></i></button>
                                        </td>            
                                         </tr>

                                        
                                            <?php $k++; } ?>
                                        </tbody>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                    </div>
                </form>

    <?php $k=1; foreach($tabel as $data){?>

         <!-- Modal Edit -->
                <form method="post">
                                        <div class="modal fade" id="ModalEditIsu<?=$data['id']?>" tabindex="-1" role="dialog" aria-labelledby="ModalEditIsuLabel<?=$data['id']?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalEditIsuLabel<?=$data['id']?>">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 col-lg-12">
                                    <div class="row justify-content-start">
                                        <div class="col-12 selectItem">
                                            <div class="select">
                                                <select name="selectCabang" >
                                                    <option value="<?=$data['cabang']?>" selected><?=$data['cabang']?></option>
                                                    <?php
                                                        foreach ($enumCabang as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                        <div class="col-12 selectItem rounded-3">
                                            <div class="select tanggal">
                                                <input class="container" value="<?=$data['tanggal']?>" type="date" name="tanggal" id="tanggal">
                                            </div>
                                        </div>
                                        <div class="col-12 selectItem">
                                             <div class="select">
                                                <select name="selectStatus">
                                                    <option value="<?=$data['Status']?>" selected><?=$data['Status']?></option>
                                                    <?php
                                                        if($data['Status']!=='closed'){
                                                        foreach ($enumStatus as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }}
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                        <div class="col-12 selectItem">
                                             <div class="select">
                                                <select name="selectKategori">
                                                    <option value="<?=$data['kategori']?>" selected><?=$data['kategori']?></option>
                                                     <?php
                                                        foreach ($enumKategori as $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div class="mb-3">
                                                <div class="labelDeskripsi container rounded-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label mt-1">Deskripsi</label>
                                                </div>
                                                <textarea value="<?=$data['deskripsi']?>" name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="4" maxlength="300" placeholder="silakan isi deskripsi.." required><?=$data['deskripsi']?></textarea>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                            <input type="hidden" name="isuId" value="<?=$data['id']?>">
                                                            <input type="hidden" name="nama" value="<?=$data['PIC']?>">
                                                            <input type="hidden" name="foto" value="<?=$data['foto']?>">
                                                            <input type="hidden" name="tgpn" value="<?=$data['tanggapan']?>">

                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" name="editIsu" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                            <?php
                                            
    $k++; }?>
        
    <?php $k=1; foreach($tabel as $data){?>
    <!-- Modal Comment -->
    <form method="post">
          <div class="modal fade" id="ModalCommentIsu<?=$data['id']?>" tabindex="-1" role="dialog" aria-labelledby="ModalCommentIsuLabel<?=$data['id']?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalCommentIsuLabel<?=$data['id']?>">Tambah Komentar</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <div class="col-12 col-lg-12">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div class="mb-3">
                                                <input type="hidden" name="komenId" value="<?=$data['id']?>">
                                                <div class="labelkomentar container rounded-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label mt-1">komentar</label>
                                                    </div>
                                                <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" rows="4" maxlength="300" placeholder="komentar.." required></textarea>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" name="tambahKomen" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
          </div>
          </form>
<?php $k++; } ?>

    </div>
    <footer class="p-3 text-center bg-light text-dark">
            <h6>Copyright 2023</h6>
        </footer>
  </div>
  </div>
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
            $hapusUser = delete("isu", "WHERE id='$id'");
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
                        window.location.href = 'isu.php';
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
}


// penangann input isu
if(isset($_POST['tambahIsu'])){
    // Ambil nilai dari form
    $cabang = $_POST['selectCabang'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['selectStatus'];
    $kategori = $_POST['selectKategori'];
    $deskripsi = $_POST['deskripsi'];
    $pic = $_POST['pic'];

    // echo $cabang;
    // echo $status;
    // echo $tanggal;

            // Memeriksa apakah file yang diunggah adalah gambar
            $imageFileType = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array($imageFileType, $allowedTypes)) {
                // File adalah gambar, lanjutkan dengan proses pengunggahan
                $gambar = $_FILES['gambar'];
                if($gambar['error']==false){
                    move_uploaded_file(
                        $gambar['tmp_name'], //lokasi sementara
                        '../image/'.$gambar['name'] //nama foto
                    );
                $foto=$gambar['name'];
                }
            } else {
                echo "<script>
                    Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'File Tidak Valid',
                            showConfirmButton: false,
                            timer: 1200
                            })
                        </script>";
         }
        
    if($status!=='closed'){
    if ($cabang==''||$tanggal==''||$status==''||$kategori==''||$deskripsi==''||$foto==''){
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

    $inputIsu = insert("isu","('','$pic','$cabang','$status','$kategori','$tanggal','$deskripsi','$foto','','')");

    // mendapatkan indeks terakhir
        $items = select("isu");
        $lastIndex = count($items) - 1;

        foreach ($items as $key => $value) {
            // Cek apakah ini indeks terakhir
            if ($key === $lastIndex) {
                // echo "Indeks terakhir: " . $key . "<br>";
                // echo "Nilai: " . $value['id'];
                $id=$value['id'];

                // masuk ke tabel riwayat
                $masukan = insert("riwayat","('','$id','','','','','','','$foto','')");
                if($masukan){
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil dimasukan',
                            confirmButtonText: 'confirm',
                            preConfirm: () => {
                            window.location.href = 'isu.php';
                            } 
                            })

                </script>";
                }
            }
        }

}}else{
    echo "<script>
       Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Data Tidak Valid',
            showConfirmButton: false,
            timer: 1200
            })
        </script>";
}
}


// penangann edit isu
if(isset($_POST['editIsu'])){
    // Ambil nilai dari form
    $cabang = $_POST['selectCabang'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['selectStatus'];
    $kategori = $_POST['selectKategori'];
    $deskripsi = $_POST['deskripsi'];
    $tanggapan = $_POST['tgpn'];
    $id = $_POST['isuId'];
    $pic=$_POST['nama'];
    $foto_akhir=$_POST['foto'];


    if(empty($tanggapan)){
        $tanggapan='tidak ada tanggapan pada isu ini';
    }
    // echo $cabang;
    // echo $status;
    // echo $id;


    if ($cabang==''||$tanggal==''||$status==''||$kategori==''||$deskripsi==''||$status==''){
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

  
    $editIsu = update("isu","cabang='$cabang',tanggal='$tanggal',Status='$status',kategori='$kategori',deskripsi='$deskripsi'","WHERE id='$id'");

    if($status=='closed'){
        update("riwayat","PIC='$pic',cabang='$cabang',tanggal='$tanggal',deskripsi='$deskripsi',Status='$status',tanggapan='$tanggapan',foto_akhir='$foto_akhir'","WHERE isu_id='$id'");
    }

    if($editIsu){
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dimasukan',
                confirmButtonText: 'confirm',
                preConfirm: () => {
                window.location.href = 'isu.php';
                } 
                })

    </script>";
    }
}
}

if(isset($_POST['tambahKomen'])){
    $komentar=$_POST['komentar'];
    $id=$_POST['komenId'];

    $komen = update("isu","komentar='$komentar'","WHERE id='$id'");
    if($komen){
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dimasukan',
                confirmButtonText: 'confirm',
                preConfirm: () => {
                window.location.href = 'isu.php';
                } 
                })

    </script>";
    }
}}
?>
