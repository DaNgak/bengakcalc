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

    require_once "../../../model/DBHelper.php";
    require_once "../../../model/Alert.php";

    $id = $_SESSION["id"];
    $query = "SELECT * FROM profil p INNER JOIN user u ON p.id_user = u.id_user WHERE p.id_user = $id";
    $dataprofile = querysql($query)[0];

    if ( isset($_POST["submit"]) ){
        $affectedroweditprofil =  editdataprofile($_POST, "../../../img/profile/");
        if ($affectedroweditprofil > 0 ) {
            setMessage("Update Berhasil", " lihat data anda di <a href='../'>sini</a>", "success");
            echo "<script>
                    document.location.href = '';
                </script>";
            exit;
        } else if ($affectedroweditprofil == 0) {
            setMessage("No action", " Tidak ada data yang diedit", "warning");
            echo "<script>
                    document.location.href = '';
                </script>";
            exit;
        } else {
            setMessage("Update Gagal", " Terjadi kesalahan saat update data", "danger");
            echo "<script>
                    document.location.href = '';
                </script>";
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Edit Data</title>
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
        <section class="d-flex justify-content-center align-items-center height100vh" style="margin-top: -25px;">
            <div class="container-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $dataprofile["id_user"] ?>">
                    <input type="hidden" name="foto-profile" value="<?= $dataprofile["foto_profil"] ?>">
                    <div class="row">
                        <div class="col-md my-4 text-center">
                            <h1 class="mb-4">Edit Data</h1>
                            <p>
                                <a class="btn btn-primary" href="../">Kembali Ke Home Profile</a>
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="align-items-center text-center">
                                <span class="form-control">Foto Profile</span>
                            </div>
                            <img src="../../../img/profile/<?= $dataprofile["foto_profil"] ?>" class="rounded mx-auto my-3 d-block" alt="Profil <?= $dataprofile["nama"] ?>" width="250" height="250" />
                            <div class="input-group">
                                <label class="input-group-text" for="fotoprofile">Edit</label>
                                <input type="file" name="fotoprofile" value="<?= $dataprofile["foto_profil"] ?>" class="form-control" id="fotoprofile" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="">ID User</label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofile["id_user"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center mb-4">
                                <div class="col-md-3 align-items-center">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofile["username"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <span class="input-group-text">Email</span>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofile["email"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="nama">Nama</label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <input type="text" class="form-control" value="<?= $dataprofile["nama"] ?>" name="nama" id="nama" autofocus="" required />
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="alamat">Alamat</label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <input type="text" class="form-control" value="<?= $dataprofile["alamat"] ?>" name="alamat" id="alamat" required />
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-12">
                                    <?php 
                                        printMessageBootstrap();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center my-4">
                        <div class="col-md-12">
                            <button class="btn btn-outline-info" type="submit" name="submit">Ubah Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
            