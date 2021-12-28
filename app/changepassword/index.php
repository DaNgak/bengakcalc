<?php 
    
    session_start();
    
    if ( !isset($_SESSION["login"]) ){
        header("Location: ../loginregis/");
        exit;
    }

    if ( !isset($_SESSION["id"]) ){ 
        header("Location: ../loginregis/");
        exit;
    }

    require_once "../../model/DBHelper.php";
    require_once "../../model/Alert.php";

    $id = $_SESSION["id"];
    $query = "SELECT * FROM user WHERE id_user = $id";
    $data = querysql($query)[0];

    if ( isset($_POST["submit"]) ){
        if ($_POST["password"] !== $data["password"]) {
            setMessage("Update gagal", " password lama anda salah", "danger");
            echo "<script>
                document.location.href = '';
            </script>";
            exit;
        }

        if ($_POST["passwordbaru"] !== $_POST["passwordbaru2"]) {
            setMessage("Update gagal", " password baru dengan konfirmasi password baru berbeda", "danger");
            echo "<script>
                document.location.href = '';
            </script>";
            exit;
        }

        if ($_POST["password"] === $_POST["passwordbaru"]) {
            setMessage("No action", " password lama sama dengan password baru", "warning");
            echo "<script>
                document.location.href = '';
            </script>";
            exit;
        }

        $affectedroweditpassword = editpassword($_POST);
        if ($affectedroweditpassword > 0 ) {
            setMessage("Update berhasil", " password anda berhasil diubah", "success");
            echo "<script>
                    document.location.href = '';
                </script>";
            exit;
        } else if ($affectedroweditpassword == 0) {
            setMessage("No action", " password lama sama dengan password baru", "warning");
            echo "<script>
                    document.location.href = '';
                </script>";
            exit;
        } else {
            setMessage("Update gagal", " terjadi kesalahan saat update password", "danger");
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
        <title>Change Password</title>
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
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data["id_user"] ?>">
                    <div class="row">
                        <div class="col-md my-4 text-center">
                            <h1 class="mb-4">Change Password</h1>
                            <p>
                                <a class="btn btn-primary" href="../">Kembali Ke Home Profile</a>
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="row align-items-center my-4">
                                <div class="col-md-4 align-items-center">
                                    <label class="input-group-text" for="password">Password Lama</label>
                                </div>
                                <div class="col-md-8 align-items-center">
                                    <input type="text" class="form-control" name="password" id="password" autofocus="" required />
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-4 align-items-center">
                                    <label class="input-group-text" for="passwordbaru">Password Baru</label>
                                </div>
                                <div class="col-md-8 align-items-center">
                                    <input type="text" class="form-control" name="passwordbaru" id="passwordbaru" required />
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-4 align-items-center">
                                    <label class="input-group-text" for="passwordbaru2">Konfirmasi Password Baru</label>
                                </div>
                                <div class="col-md-8 align-items-center">
                                    <input type="text" class="form-control" name="passwordbaru2" id="passwordbaru2" required />
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
                            <button class="btn btn-outline-primary" type="submit" name="submit">Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
            