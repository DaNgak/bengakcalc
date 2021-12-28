<?php 

    function setMessage($pesan, $sebab, $tipe, $untuk = null){
        $_SESSION["flash"]["pesan"] = $pesan;
        $_SESSION["flash"]["sebab"] = $sebab;
        $_SESSION["flash"]["tipe"] = $tipe;
        if (!$untuk == null) {
            $_SESSION["flash"]["untuk"] = $untuk;
        }
    }

    function printMessageBootstrap(){
        if ( isset($_SESSION["flash"]) ){
            $alert = '<div class="mb-5 alert alert-' . $_SESSION["flash"]["tipe"] .  ' alert-dismissible fade show" role="alert">
                <strong> ' . $_SESSION["flash"]["pesan"]  .  '</strong>'  . $_SESSION["flash"]["sebab"] .  '.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION["flash"]);
            echo $alert;
            return true;
        }
    }

    function printMessageLogin(){
        if ( isset($_SESSION["flash"]) ){  
            if ($_SESSION["flash"]["untuk"] == "login") {   
                $color = "";
                if ($_SESSION["flash"]["tipe"] === "danger") {
                    $color = "red";
                } else {
                    $color = "green";
                }

                $alert = '<p style="margin: 0 0 5px;  color: ' . $color . ';">' . $_SESSION["flash"]["pesan"] . ', ' . $_SESSION["flash"]["sebab"] . '</p>';
                unset($_SESSION["flash"]);
                echo $alert;
                return true;
            }
        } 
    }

    function printMessageRegis(){
        if ( isset($_SESSION["flash"]) ){     
            if (isset($_SESSION["flash"]["untuk"]) && $_SESSION["flash"]["untuk"] == "regis") {
                $color = "";
                if ($_SESSION["flash"]["tipe"] === "danger") {
                    $color = "red";
                } else {
                    $color = "green";
                }
    
                $alert = '<p style="margin: 0 0 5px;  color: ' . $color . ';">' . $_SESSION["flash"]["pesan"] . ', ' . $_SESSION["flash"]["sebab"] . '</p><script> ' . 'document.getElementById("container").classList.add("right-panel-active");' . ' </script>';
                unset($_SESSION["flash"]);
                echo $alert;
                return true;
            }
        } 
    }
?>