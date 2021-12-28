<?php 
    
    session_start();
    
    if ( !isset($_SESSION["login"]) ){
        header("Location: ../../loginregis/");
        exit;
    }

    if ( !isset($_SESSION["id"]) ){ 
        header("Location: ../../loginregis/");
        exit;
    }

    require_once "../../model/DBHelper.php";

    $id = $_SESSION["id"];
    $query = "SELECT * FROM profil p INNER JOIN user u ON p.id_user = u.id_user WHERE p.id_user = $id";
    $dataprofile = querysql($query)[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,800");
            body {
                font-family: "Montserrat", sans-serif;
                background-color: ghostwhite;
            }
            .container-custom {
                width: 95%;
            }

            .width-100 {
                width: 100%;
            }

            .height100vh {
                height: 100vh;
            }

    </style>
</head>
<body>
    <section class="d-flex justify-content-center align-items-center height100vh" style="margin-top: -50px;">
        <div class="container-md">
            <div class="row">
                <div class="col-md my-4 text-center">
                    <h1 class="mb-4">Data Profile</h1>
                    <p>
                        <a class="btn btn-warning" href="edit/">Edit Data</a>
                        <a class="btn btn-primary mx-5" href="../">Kembali ke Home</a>
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="align-items-center my-3 text-center">
                        <span class="form-control">Foto Profile</span>
                    </div>
                    <img src="../../img/profile/<?= $dataprofile["foto_profil"] ?>" alt="Foto <?= $dataprofile["nama"] ?>"  class="rounded mx-auto d-block" width="250" height="250" />
                </div>
                <div class="col-md-8">
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">ID User</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["id_user"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Username</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["username"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Username</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["username"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Email</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["email"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Nama</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["nama"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Alamat</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $dataprofile["alamat"] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>