<?php
session_start();

if(isset($_SESSION['login'])){
include('../db_func.php');

    $nama = $_SESSION['nama'];
    $jabatan=$_SESSION['jabatan'];

$tabel = select("isu","*","WHERE kategori='Op.Planning & Control'");

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




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Op.Planning & Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
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
                            <li><span>I<?=$nama?></span></li>
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
                    <a class="nav-link" href="/LogIssue/admin/dashboard.php"><i class="bi bi-house-door-fill"></i> &nbsp; <span> Dashboard</span></a>
                </li>
                <li class="nav-item rounded-3">
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
                    <li class="menuIsu menuIsu2"><a class="dropdown-item rounded-3" href="/LogIssue/admin/hsse.php">HSSE</a></li>
                    <li class="menuIsu menuIsu2" id="active"><a class="dropdown-item rounded-3" href="/LogIssue/admin/opPlanning.php">Op.Planning & Control </a></li>
                    <li class="menuIsu menuIsu2"><a class="dropdown-item rounded-3" href="/LogIssue/admin/operational.php">Operational </a></li>
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
        <!-- navbar -->

       <!-- main -->
        <div class="container">
            <div class="row">
                <div class="row justify-content-end">
                    <div class="col-3 text-end mt-2">
                        <form method="post" action="../print.php">
                            <input type="hidden" name="tanggal" value="<?=$search1?>">
                            <input type="hidden" name="status" value="<?=$search2?>">
                            <input type="hidden" name="cabang" value="<?=$search3?>">
                            <input type="hidden" name="laman" value="opPlanning-admin">
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="bi bi-printer-fill"></i> Cetak</button>
                        </form>
                    </div>
                </div>
                <div class="col-3 col-sm-4">
                    <button class="btnIsu mt-5 rounded-3 shadow-sm" >Op.Planning & Control</button>
                </div>
            </div>
                <div class="col">
                    <div class="card mt-3 shadow-sm">
                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-12">
                                        <h3 style="color:black">Isu List</h3>
                                    </div>
                                        <div class="col-12">
                                        <div class="table-responsive-xl">
                                            <table class="table table-bordered pb-250">
                                        <thead  class="tabel-info text-secondary rounded-3 text-center">
                                        
                                            <tr class="align-middle">
                                            <th scope="col">Id</th>
                                            <th>PIC</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Tanggal</th>
                                            <th>Status</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Update/Follow-up</th>
                                            </tr>
                                        </thead>
                                        <?php $k=1; foreach ($hasil as $data){?>
                                        <tbody class="tabel-main text-center">
                                            <?php if ($data['Status']!=='closed') { ?>
                                            <tr >
                                            <td><?=$k?></td>
                                            <td><?=$data['PIC']?></td>
                                            <td><?=$data['cabang']?></td>
                                            <td><?=$data['tanggal']?></td>
                                            <td><?=$data['Status']?></td>
                                            <td><?=$data['deskripsi']?></td>
                                            <td width="300px" ><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto']; ?>" alt="gambar"></td>                                            <td><?=$data['tanggapan']?></td>        
                                         </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php $k++; }?>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
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
<?php }
