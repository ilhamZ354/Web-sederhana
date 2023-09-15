<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/Login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
        <!-- nama web -->
        <div class="row text-center">
            <div class="col-xs-12 col-md-4 offset-md-8 mt-3">
                <span id="brand"><img src="image/LogIssue Pelabuhan.svg" alt="logo" style="width:6vw;"></span>
            </div>
        </div>
        <!-- nama web -->

        <!-- card form login -->
        <div class="row text-center">
            <div class="col-12 col-md-8 col-lg-5 offset-lg-1">

            <div class="flip-card rounded-3" id="flip">
            <div class="flip-card-inner" id="flip2">
                <!-- card depan -->
                <div id="flip-card-front" class="rounded-3">
                    
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-8 col-md-6 pt-5">
                                    <h1>Welcome</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-10 col-md-8">
                                    <span id="brand"><img src="image/LogIssue Pelabuhan.svg" alt="logo" style="width:5vw;"></span>
                                </div>
                            </div>

                            <!-- form input -->
                            <div class="row justify-content-center">
                            <div class="col-8 text-start">
                            <div class="input mt-5">
                            <form method="post" action="loginLogout.php" id="formLogin">
                            <label for="username" class="form-label">Username</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" name="addon-wrapping"><i class="bi bi-person-circle"></i></span>
                                    </div>
                                        <input type="text" name="username" class="form-control" maxlength="10" placeholder="NIP" aria-label="username" aria-describedby="addon-wrapping">
                                    
                                </div>

                                    <label for="password1" class="form-label mt-3">Password</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" name="addon-wrapping"><i class="bi bi-unlock-fill"></i></span>
                                            </div>
                                                <div class="form-group">
                                                    <input type="password" name="password1" class="pass form-control" id="FirstPass" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                                                    <i class="show-password-icon bi bi-eye-slash" id="showOne"></i>
                                                </div>
                                        </div>     
                                    </div>
                            <!-- tombol login regis -->
                            <div class="tombol mt-5 pb-5">
                                <div class="row justify-content-between">
                                    <div class="col-5">
                                        <button type="submit" name="sigin" id="btnLoginAkun" class="btn btn-success shadow">login</button>
                                    </div>
                                    </form>
                                    <div class="col-5 text-end">
                                        <button id="btnregis" class="btn btn-success shadow">Regis</button>
                                    </div>
                                </div>
                             </div>

                            </div>
                            </div>

                            
                    </div>
                </div>
                <!-- card depan -->

                <!-- card belakang -->
                <div id="flip-card-back" class="rounded-3">

                        <div class="container-fluid">
                            <div class="row justify-content-center mt-5">
                                <div class="col-10 col-md-8">
                                    <h3>Log in</h3>
                                </div>
                                <div class="col-10 col-md-8">
                                    <button id="btnBalik" onclick="goBack()" class="btnBalik btn btn-info"><i class="bi bi-arrow-left-circle text-light"></i></button>
                                </div>
                            </div>

                            <!-- form input -->
                            <form method="post" action="loginLogout.php" id="formRegis">
                            <div class="row justify-content-center">
                            <div class="col-8 text-start">
                            <div class="input mt-5">
                            <form method="post" action="loginLogout.php" id="formRegis">
                            <label for="username2" class="form-label">Username</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" name="addon-wrapping"><i class="bi bi-person-circle"></i></span>
                                    </div>
                                        <input type="text" maxlength="10" name="username2" class="form-control" id="password2" placeholder="NIP" aria-label="Username" aria-describedby="addon-wrapping">
                                    
                                </div>

                            <label for="password2" class="form-label mt-3">Admin Password</label>
                                <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" name="addon-wrapping"><i class="bi bi-unlock-fill"></i></span>
                                </div>
                                <div class="form-group">
                                        <input type="password" name="password2" class="pass form-control" id="SecondPass" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                                            <i class="show-password-icon bi bi-eye-slash" id="showSecond"></i>
                                </div>
                                </div>
                            <hr>
                            <label for="password3" class="form-label mt-3">Password &#42;</label>
                                <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" name="addon-wrapping"><i class="bi bi-lock-fill"></i></span>
                                </div>
                                    <div class="form-group">
                                        <input type="password" name="password3" class="pass form-control" id="ThridPass" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                                            <i class="show-password-icon bi bi-eye-slash" id="showThree"></i>
                                        </div>
                                
                            </div>

                            <!-- tombol login regis -->
                            </form>
                            <div class="tombol mt-5 pb-5">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" id="btnlogin" name="submitRegis" class="btn btn-success shadow-sm">Submit</button>
                                    </div>
                                </div>
                             </div>
                             <!-- tombol login regis -->

                            </div>
                            </div>


                            
                        </div>
                    </div>
                </div>
                <!-- card belakang -->
            </div>
            </div>


            </div>
        </div>
        <!-- card form login -->
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src='js/script.js'  type="text/javascript"></script>
<script src='js/script1.js'  type="text/javascript"></script>
<script>
  function goBack() {
    window.location.href="index.php";
  }
</script>
</html>
