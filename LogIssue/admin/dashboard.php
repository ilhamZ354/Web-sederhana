<?php
ob_start();
session_start();
if(isset($_SESSION['login'])){

    $nama = $_SESSION['nama'];
    $jabatan=$_SESSION['jabatan'];

    
include('../db_func.php');
    // echo $nama;
$tabel = select("isu","*","WHERE Status='open'");
$tabel2 = select("isu","*","WHERE Status='on progress'");
$tabel3 = select("isu","*","WHERE Status='closed'");

$query1=mysqli_query($koneksi,"SELECT * FROM isu WHERE Status='open' ");
$total1=mysqli_num_rows($query1);

$query2=mysqli_query($koneksi,"SELECT * FROM isu WHERE Status='on progress' ");
$total2=mysqli_num_rows($query2);

$query3=mysqli_query($koneksi,"SELECT * FROM isu WHERE Status='closed' ");
$total3=mysqli_num_rows($query3);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        /* untuk button tabel */
        tr.tb-row{
        cursor: pointer;
        }
        tr.tb-row:hover{
        background-color: #eeee;
        }
        tr.tb-rowOn{
        cursor: pointer;
        }
        tr.tb-rowOn:hover{
        background-color: #eeee;
        }
        tr.tb-rowClosed{
        cursor: pointer;
        }
        tr.tb-rowClosed:hover{
        background-color: #eeee;
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
                <li class="nav-item rounded-3" id="active">
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
                                            <form method="post">
                                            <input type="text" class="kata rounded-3" name="kata" id="kata">
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

        <!-- content -->
        <div class="content container mt-3 pb-3">
            
                <div class="row justify-content-evenly align-items-center">
                    <div class="col-4 col-lg-3 col-xl-3 text-center">
                        <div class="card rounded-3 shadow-sm" id="cardOpen">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="row justify-content-center flex-column">
                                            <div class="col">
                                                <h3>Open</h3>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btndata rounded-3" id="open-view" data-bs-toggle="modal" data-bs-target="#ModalOpen">view <i class="bi bi-arrow-right-circle"></i></button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-4">
                                            <h1 class="total"><?=$total1?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-4 col-xl-3 text-center">
                        <div class="card rounded-3 shadow-sm" id="cardOnProgress">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="row justify-content-center flex-column">
                                            <div class="col-md-12">
                                                <h4>On Progress</h4>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btndata rounded-3" id="onProgress-view" data-bs-toggle="modal" data-bs-target="#ModalonProgress">view <i class="bi bi-arrow-right-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-10 col-lg-4">
                                            <h1 class="total"><?=$total2?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-3 col-xl-3 text-center">
                        <div class="card rounded-3 shadow-sm" id="cardClosed">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="row justify-content-center flex-column">
                                            <div class="col">
                                                <h3>Closed</h3>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btndata rounded-3" id="closed-view" data-bs-toggle="modal" data-bs-target="#ModalClosed">view <i class="bi bi-arrow-right-circle"></i></button>
                                        </div>
                                    </div>
                                    </div>
                                        <div class="col-md-10 col-lg-4">
                                            <h1 class="total"><?=$total3?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- Modal Open -->
<div class="modal fade" id="ModalOpen" tabindex="-1" aria-labelledby="ModalOpenLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="ModalOpenLabel">Isu Open</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tabelModal tabel-sm table-responsive ">
                        <table class="table table-bordered pb-250">
                            <thead  class="tabel-info text-secondary rounded-3 text-center">
                                    
                                            <tr class="align-middle">
                                            <th scope="col">Id</th>
                                            <th>PIC</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Update/Follow-up</th>
                                            </tr>
                                        </thead>
                                        <?php $k=1; foreach ($tabel as $data){?>
                                        <tbody class="tabel-main text-center">   
                                        <form method="post" id="postTabelOpenrow<?=$k?>" action="dashboard.php">                                        
                                            <tr id="row<?=$k?>" class="tb-row">
                                                <input type="hidden" name="id" value="<?=$data['id']?>">
                                                <input type="hidden" name="kate" value="<?=$data['kategori']?>">
                                            <td><?=$k?></td>
                                            <td><?=$data['PIC']?></td>
                                            <td><?=$data['cabang']?></td>
                                            <td><?=$data['kategori']?></td>
                                            <td><?=$data['tanggal']?></td>
                                            <td><?=$data['deskripsi']?></td>
                                            <td width="300px" ><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?=$data['tanggapan']?></td> 
                                         </tr>
                                         </form>

                                        </tbody>
                                        <?php $k++; }?>
                            </table>
                            </div>
                        </div>
                    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


                                           
<!-- Modal onProgress -->
<div class="modal fade" id="ModalonProgress" tabindex="-1" aria-labelledby="ModalonProgressLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="ModalonProgressLabel">Isu On Progress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tabelModal tabel-sm table-responsive ">
                        <table class="table table-bordered pb-250 text-center">
                           
                                            <tr class="align-middle">
                                            <th scope="col">Id</th>
                                            <th>PIC</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Update/Follow-up</th>
                                            </tr>
                                        </thead>
                                        <?php $k=1; foreach ($tabel2 as $data){?>
                                            <tbody class="tabel-main text-center">    
                                            <form method="post" id="postTabelOnrow<?=$k?>" action="dashboard.php">                                       
                                            <tr id="row<?=$k?>" class="tb-rowOn">
                                                <input type="hidden" name="id" value="<?=$data['id']?>">
                                                <input type="hidden" name="kate" value="<?=$data['kategori']?>">
                                            <td><?=$k?></td>
                                            <td><?=$data['PIC']?></td>
                                            <td><?=$data['cabang']?></td>
                                            <td><?=$data['kategori']?></td>
                                            <td><?=$data['tanggal']?></td>
                                            <td><?=$data['deskripsi']?></td>
                                            <td width="300px" ><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?=$data['tanggapan']?></td> 
                                        
                                         </tr>
                                         </form>
                                            
                                        </tbody>
                                        <?php $k++; }?>
                            </table>
                            </div>
                        </div>
                    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


                                          
<!-- Modal Closed -->
<div class="modal fade" id="ModalClosed" tabindex="-1" aria-labelledby="ModalClosedLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="ModalClosedLabel">Isu Closed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tabelModal tabel-sm table-responsive ">
                        <table class="table table-bordered pb-250 text-center">
                           
                                            <tr class="align-middle">
                                            <th scope="col">Id</th>
                                            <th>PIC</th>
                                            <th scope="col">Cabang</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Update/Follow-up</th>
                                            </tr>
                                        </thead>
                                        <?php $k=1; foreach ($tabel3 as $data){?>
                                            <tbody class="tabel-main text-center">   
                                            <form method="post" id="postTabelClosedrow<?=$k?>" action="dashboard.php">                                        
                                            <tr id="row<?=$k?>" class="tb-rowClosed">
                                                <input type="hidden" name="id" value="<?=$data['id']?>">
                                                <input type="hidden" name="kate" value="error">
                                            <td><?=$k?></td>
                                            <td><?=$data['PIC']?></td>
                                            <td><?=$data['cabang']?></td>
                                            <td><?=$data['kategori']?></td>
                                            <td><?=$data['tanggal']?></td>
                                            <td><?=$data['deskripsi']?></td>
                                            <td width="300px" ><img class="col-8" height="auto" width="100%" src="../image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?=$data['tanggapan']?></td> 
                                         </tr>
                                         </form>
                                            
                                        </tbody>
                                        <?php $k++; }?>
                            </table>
                            </div>
                        </div>
                    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
  <script>
  var btnTabelOpen = document.querySelectorAll('.tb-row');
var btnTabelOn = document.querySelectorAll('.tb-rowOn');
var btnTabelClosed = document.querySelectorAll('.tb-rowClosed');

for (var i = 0; i < btnTabelOpen.length; i++) {
  btnTabelOpen[i].addEventListener('click', function(event) {
    var rowId = event.currentTarget.id;
    var formId = 'postTabelOpen' + rowId;
    var form = document.getElementById(formId);
    if (form) {
      form.submit();
    } else {
      console.log('Form with ID ' + formId + ' not found.');
    }
  });
}

for (var i = 0; i < btnTabelOn.length; i++) {
  btnTabelOn[i].addEventListener('click', function(event) {
    var rowId = event.currentTarget.id;
    var formId = 'postTabelOn' + rowId;
    var form = document.getElementById(formId);
    if (form) {
      form.submit();
    } else {
      console.log('Form with ID ' + formId + ' not found.');
    }
  });
}

for (var i = 0; i < btnTabelClosed.length; i++) {
  btnTabelClosed[i].addEventListener('click', function(event) {
    var rowId = event.currentTarget.id;
    var formId = 'postTabelClosed' + rowId;
    var form = document.getElementById(formId);
    if (form) {
      form.submit();
    } else {
      console.log('Form with ID ' + formId + ' not found.');
    }
  });
}

</script>
</body>
</html>

<?php

if(isset($_POST['kate'])){
    $kategori = $_POST['kate'];
    // echo $kategori;
    if($kategori=='HSSE'){
        // echo $kategori;
        header('location:hsse.php');
    }elseif($kategori=='Op.PLanning & Control'){
        header('location:opPlanning.php');
    }elseif($kategori=='Operational'){
        header('location:operational.php');
    }else{
        header('location:history.php');
    }
}
}?>