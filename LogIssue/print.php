<?php
session_start();
include('db_func.php');

if(isset($_POST['laman'])){
    $laman = $_POST['laman'];
    $_SESSION['cabang']=$_POST['cabang'];
    $_SESSION['tanggal']=$_POST['tanggal'];
    $_SESSION['status']=$_POST['status'];
    $cabang=$_SESSION['cabang'];
    $tanggal=$_SESSION['tanggal'];
    $status=$_SESSION['status'];

    $cbg = $_POST['cabang'];
    $tgl = $_POST['tanggal'];
    $stat = $_POST['status'];

    $hasil=array();

    // HSSE ADMIN
    if($laman=='hsse-admin'){
            $tabel = select("isu","*","WHERE kategori='HSSE'");

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
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>HSSE</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/bootstrap.grid.min.css">
            <link rel="stylesheet" href="css/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/style3.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
            <style>
                *{
                    font-size:9pt;
                }
            </style>
        </head>
        <body>
        <!-- main -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mt-3">
                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-12">
                                        <h3 style="color:black">Isu List HSSE</h3>
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
                                            <td width="400px"><?=$data['deskripsi']?></td>
                                            <td width="300px" ><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?=$data['tanggapan']?></td>        
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
        </body>
        </html>
        <script>
       tampil = window.print();

       window.addEventListener('afterprint', function() {
            // Aksi yang dilakukan setelah jendela cetak ditutup
            window.location.href="/LogIssue/admin/hsse.php";
        });
    </script>
    <?php 
    } 
    // Operatioanal admin
    elseif($laman=='operational-admin'){
        $tabel = select("isu","*","WHERE kategori='operational'");

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
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Operational</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style3.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
        <style>
                *{
                    font-size:9pt;
                }
            </style>
    </head>
    <body>
    <!-- main -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        
                            <div class="row">
                                <div class="col-12">
                                    <h3 style="color:black">Isu List Operational</h3>
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
                                        <td width="400px"><?=$data['deskripsi']?></td>
                                        <td width="300px" ><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto']; ?>" alt="gambar"></td>
                                        <td><?=$data['tanggapan']?></td>        
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
    </body>
    </html>
    <script>
       tampil = window.print();

       window.addEventListener('afterprint', function() {
            // Aksi yang dilakukan setelah jendela cetak ditutup
            window.location.href="/LogIssue/admin/operational.php";
        });
    </script>
<?php 
    
    // Op Planning & Control Admin
    }elseif($laman=='opPlanning-admin'){
        $tabel = select("isu","*","WHERE kategori='Op.Planning & Control'");

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
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Op. Planning & Control</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style3.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
        <style>
                *{
                    font-size:9pt;
                }
            </style>
    </head>
    <body>
    <!-- main -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 style="color:black">Isu List Op. Planning & Control</h3>
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
                                        <td width="400px"><?=$data['deskripsi']?></td>
                                        <td width="300px" ><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto']; ?>" alt="gambar"></td>
                                        <td><?=$data['tanggapan']?></td>        
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
    </body>
    </html>
    <script>
       tampil = window.print();

       window.addEventListener('afterprint', function() {
            // Aksi yang dilakukan setelah jendela cetak ditutup
            window.location.href="/LogIssue/admin/opPlanning.php";
        });
    </script>

<?php
    }elseif($laman=='history-admin'){
        $tabel=select('riwayat');
    
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
                *{
                    font-size:9pt;
                }
            </style>
        </head>
        <body>
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h5 style="color:black">Riwayat Isu</h5>
                        </div>       
                        <div class="col-12 mt-2">
                                <div class="table-responsive">
                                <table class="table table-bordered " width="100%" id="tabelkonten">
                                    <thead  class="tabel-info text-light rounded-3 text-center">
                                                    <tr>
                                                    <!-- <th scope="col"></th> -->
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
                                                    <td><?=$k ?></td>
                                                    <td><?= $data['PIC']?></td>
                                                    <td><?= $data['tanggal']?></td>
                                                    <td><?= $data['cabang']?></td>
                                                    <td width="400px"><?= $data['deskripsi']?></td>
                                                    <td><?= $data['Status']?></td>
                                                    <td width="200px"><?= $data['tanggapan']?></td>
                                                    <td width="400px"><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto_awal']; ?>" alt="gambar"></td>
                                                    <td width="400px"><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto_akhir']; ?>" alt="gambar"></td>
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
        </body>
        </html>
        <script>
           tampil = window.print();
    
           window.addEventListener('afterprint', function() {
                // Aksi yang dilakukan setelah jendela cetak ditutup
                window.location.href="/LogIssue/admin/history.php";
            });
        </script>
        <?php
    }
    // Isu MTCC
    elseif($laman=='isu-mtcc'){
    $tabel=select('isu');

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
                *{
                    font-size:9pt;
                }
        </style>
    </head>
    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 style="color:black">Isu List</h5>
                    </div>       
                    <div class="col-12 mt-2">
                            <div class="table-responsive">
                            <table class="table table-bordered " width="100%" id="tabelkonten">
                            <thead  class="tabel-info text-light text-center rounded-3">
                                            <tr>
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
                                            </tr>
                                        </thead>
                                        <tbody class="tabel-main table-light">
                                        <?php $k=1; foreach($hasil as $data){?>
                                            <tr >
                                            <td><?=$k ?></td>
                                            <td><?= $data['PIC']?></td>
                                            <td><?= $data['cabang']?></td>
                                            <td><?= $data['tanggal']?></td>
                                            <td><?= $data['Status']?></td>
                                            <td><?= $data['kategori']?></td>
                                            <td width="400px"><?= $data['deskripsi']?></td>
                                            <td width="300px"><img class="offset-2 col-8" width="100%" height="auto" src="image/<?= $data['foto']; ?>" alt="gambar"></td>
                                            <td><?= $data['tanggapan']?></td>  
                                            <td><?= $data['komentar']?></td>            
                                         </tr>

                                        
                                            <?php $k++; } ?>
                                        </tbody>
                                </table>
                                </div>
                            </div>
                    </div>
                </div>
    </body>
    </html>
    <script>
       tampil = window.print();

       window.addEventListener('afterprint', function() {
            // Aksi yang dilakukan setelah jendela cetak ditutup
            window.location.href="/LogIssue/mtcc/isu.php";
        });
    </script>
    <?php
        }
        // history MTCC
        elseif($laman=='history-mtcc'){
            $tabel=select('riwayat');
        
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
                    *{
                        font-size:9pt;
                    }
                </style>
            </head>
            <body>
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h5 style="color:black">Riwayat Isu</h5>
                            </div>       
                            <div class="col-12 mt-2">
                                    <div class="table-responsive">
                                    <table class="table table-bordered " width="100%" id="tabelkonten">
                                        <thead  class="tabel-info text-light rounded-3 text-center">
                                                        <tr>
                                                        <!-- <th scope="col"></th> -->
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
                                                        <td><?=$k ?></td>
                                                        <td><?= $data['PIC']?></td>
                                                        <td><?= $data['tanggal']?></td>
                                                        <td><?= $data['cabang']?></td>
                                                        <td width="400px"><?= $data['deskripsi']?></td>
                                                        <td><?= $data['Status']?></td>
                                                        <td width="200px"><?= $data['tanggapan']?></td>
                                                        <td width="400px"><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto_awal']; ?>" alt="gambar"></td>
                                                        <td width="400px"><img class="col-8" height="auto" width="100%" src="image/<?= $data['foto_akhir']; ?>" alt="gambar"></td>
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
            </body>
            </html>
            <script>
               tampil = window.print();
        
               window.addEventListener('afterprint', function() {
                    // Aksi yang dilakukan setelah jendela cetak ditutup
                    window.location.href="/LogIssue/mtcc/history.php";
                });
            </script>
            <?php
        }
}else{
    echo '<script>
        window.history.back();
    </script>';
}
?>