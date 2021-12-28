<?php 
    $conn = mysqli_connect("localhost", "root", "", "bengakcalc");
    $tabledb = "user";
    $tabledb2 = "profil";
    
    require_once "Alert.php";

    function querysql($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $tampungdatabase = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tampungdatabase[] = $row;
        }
        return $tampungdatabase;
    }

    function insertdata($data){
        global $conn, $tabledb;

        $username = htmlspecialchars($data["username"]);
        $password = htmlspecialchars($data["password"]);
        $email = htmlspecialchars($data["email"]);

        $query = "
            INSERT INTO $tabledb VALUES
            ('', '$username', '$password', '$email')
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function caridataprofil($iduser){
        global $conn, $tabledb2;

        $cekprofil = "SELECT * FROM $tabledb2 WHERE id_user=$iduser";
        $result = mysqli_query($conn, $cekprofil);
        mysqli_fetch_assoc($result);
        return mysqli_affected_rows($conn);
    }

    function registercekemail($data){
        global $conn, $tabledb;

        $email = $data["email"];
        $query = "SELECT * FROM $tabledb WHERE email='$email'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function registercekusername($data){
        global $conn, $tabledb;

        $username = $data["username"];
        $query = "SELECT * FROM $tabledb WHERE username='$username'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function insertdataprofil($iduser){
        global $conn, $tabledb2;
        if (!(caridataprofil($iduser) > 0)) {
            $query = "
            INSERT INTO $tabledb2 VALUES
                ('', 'Guest', 'guest.png', 'Jalan Kita Masih Panjang', $iduser)
            ";

            mysqli_query($conn, $query);
        } 
    }

    function login($data){
        global $conn, $tabledb;

        $username = $data["username"];
        $cekusername = "SELECT * FROM $tabledb WHERE username='$username'";
        $result = mysqli_query($conn, $cekusername);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function deletedata($id){
        global $conn, $tabledb;
        $query = "DELETE FROM $tabledb WHERE id_user = $id";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // function editdatauser($data){
    //     global $conn, $tabledb;

    //     $id = $data["id"];
    //     $username = htmlspecialchars($data["username"]);
    //     $password = htmlspecialchars($data["password"]);
    //     $email = htmlspecialchars($data["email"]);

    //     $query = "UPDATE $tabledb SET username='$username', password='$password', email='$email' WHERE id_user = $id";

    //     mysqli_query($conn, $query);
    //     return mysqli_affected_rows($conn);
    // }
    function editpassword($data){ 
        global $conn, $tabledb;
        $id = $data["id"];
        $password = htmlspecialchars($data["passwordbaru"]);

        $query = "UPDATE $tabledb SET 
                    password = '$password'
                WHERE id_user='$id'";

        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }

    function editdataprofile($data, $dir){ 
        global $conn, $tabledb2;

        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $fotoprofileuserlama = $data["foto-profile"];

        if ( $_FILES["fotoprofile"]["error"] === 4 ) {
            $fotoprofileuserbaru = $fotoprofileuserlama;
        } else {
            $fotoprofileuserbaru = uploadfotoprofil($dir);
        }

        if ($fotoprofileuserbaru == false) {
            exit;
        }

        $query = "UPDATE $tabledb2 SET 
                    nama='$nama', 
                    alamat='$alamat', 
                    foto_profil='$fotoprofileuserbaru'
                WHERE id_user='$id'";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadfotoprofil($dir){
        $namafiles = $_FILES["fotoprofile"]["name"];
        $sizefiles = $_FILES["fotoprofile"]["size"];
        $error = $_FILES["fotoprofile"]["error"];
        $tmpfiles = $_FILES["fotoprofile"]["tmp_name"];

        // Cek apakah ada gambar yang di upload
        if ( $error === 4 ) {
            setMessage("Update gagal", " masukkan gambar terlebih dahulu", "danger");
            echo "<script>
                    document.location.href = '';
                </script>";
            return false;
        }

        // Cek apakah yang di upload adalah gambar
        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = explode('.', $namafiles);
        $ekstensigambarupload = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambarupload, $ekstensigambarvalid) ){
            setMessage("Update gagal", " gambar harus berformat jpg, jpeg, png, dan jfif", "danger");
            echo "<script>
                document.location.href = '';
            </script>";
            return false;
        }

        // Cek ukuran file lebih besar dari 2 mb
        if ( $sizefiles > 2000000) {
            setMessage("Update gagal", " size gambar terlalu besar <b>MAX 2 MB</b>", "danger");
            echo "<script>
                document.location.href = '';
            </script>";
            return false;
        }
        
        move_uploaded_file($tmpfiles, $dir . $namafiles);

        return $namafiles;
    }
?>