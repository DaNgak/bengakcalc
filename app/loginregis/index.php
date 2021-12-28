<?php 
	session_start();

	if ( isset($_SESSION["login"]) ){ 
		header("Location: ../");
		exit;
	}

	if ( isset($_SESSION["id"]) ){ 
		header("Location: ../");
		exit;
	}

	require_once "../../model/DBHelper.php";
	require_once "../../model/Alert.php";

	if ( isset($_POST["login"]) ){
		$rowdata = login($_POST);
		$username = $_POST["username"];
		$password = $_POST["password"];
		if ($rowdata) {
			if ($rowdata["username"] === $username){
				if ($rowdata["password"] === $password) {
					$_SESSION["login"] = "true";
					$_SESSION["id"] = $rowdata["id_user"];
					insertdataprofil($_SESSION["id"]);
					echo "<script>
							document.location.href = '../';
						</script>";
					exit;
				} else {
					setMessage("Login gagal", " password salah", "danger", "login");
					echo "<script>
							document.location.href = '';
						</script>";
					exit;
				}
			}
		} else {
			setMessage("Login gagal", " username tidak terdaftar<br>Register dulu yah", "danger", "login");
			echo "<script>
				document.location.href = '';
			</script>";
			exit;
		}
	}

	if ( isset($_POST["register"]) ){
		if (registercekusername($_POST) > 0) {
			setMessage("Username telah digunakan", " cari username lain yah", "danger", "regis");
			echo "<script>
				document.location.href = '';
			</script>";
			exit;
		} else {
			if (registercekemail($_POST) > 0) {
				setMessage("Email telah digunakan", " gunakan email lain yah", "danger", "regis");
				echo "<script>
					document.location.href = '';
				</script>";
				exit;
			} else {
				if (insertdata($_POST) > 0) {
					setMessage("Registrasi berhasil", " silahkan <a id='signIn' style='cursor:pointer;color:blue;font-weight:bold;'>login</a>", "success", "regis");
					echo "<script>
							document.location.href = '';
						</script>";
					exit;
				} else {
					setMessage("Yah gagal", " terjadi kesalahan query", "danger", "regis");
					echo "<script>
						document.location.href = '';
					</script>";
					exit;
				}
			}
		}
	}


?>


<!DOCTYPE html>
<html>
	<head>
		<title>Login & Register Form</title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../../style/stylelogin.css" />
	</head>
	<body>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form action="" method="post">
					<h1>Sign Up</h1>
					<div class="social-container">
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-facebook"></i></a>
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-google"></i></a>
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-linkedin"></i></a>
					</div>
					<span>Form Registration</span>
					<input type="text" name="username" placeholder="Username" required/>
					<input type="email" name="email" placeholder="Email" required/>
					<input type="password" name="password" placeholder="Password" required/>
					<?php 
						printMessageRegis();
					?>	
					<button type="submit" name="register">SignUp</button>
				</form>
			</div>
			<div class="form-container sign-in-container">
				<form action="" method="post">
					<h1>Sign In</h1>
					<div class="social-container">
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-facebook"></i></a>
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-google"></i></a>
						<a onclick="alert('Belum berfungsi')" class="social"><i class="fa fa-linkedin"></i></a>
					</div>
					<span>Form Login</span>
					<input type="text" name="username" placeholder="Username" required />
					<input type="password" name="password" placeholder="Password" required />
					<?php 
						printMessageLogin();
					?>
					<a style="cursor: pointer;" onclick="alert('Autentikasi ke noreply@gmail.com belum di acc\nJadi masih belum bisa digunakan\nMaaf yah :(, coba ingat lagi passwordnya seperti mengingat mantan')">Forgot Your Password</a>
					<button type="submit" name="login">Sign In</button>
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Tips</h1>
						<p>Gunakan lah email yang valid, agar bisa digunakan pada fitur forget password. Buatlah username yang mudah diingat dan tanpa menggunakan spasi, buatlah password dengan kombinasi angka dan huruf agar sulit ditebak</p>
						<button class="ghost" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Tips</h1>
						<p>Jangan beritahukan data pribadi anda, termasuk username dan password saat menggunakan semua sistem informasi</p>
						<button class="ghost" id="signUp">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script type="text/javascript">
			const signUpButton = document.getElementById("signUp");
			const signInButton = document.getElementById("signIn");

			const container = document.getElementById("container");

			signUpButton.addEventListener("click", () => {
				container.classList.add("right-panel-active");
			});
			signInButton.addEventListener("click", () => {
				container.classList.remove("right-panel-active");
			});
		</script>
	</body>
</html>
