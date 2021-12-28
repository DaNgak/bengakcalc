<?php 
	session_start();

	if ( !isset($_SESSION["login"]) ){ 
		header("Location: loginregis/");
		exit;
	}

	if ( !isset($_SESSION["id"]) ){ 
		header("Location: loginregis/");
		exit;
	}

	require_once "../model/DBHelper.php";

	$id = $_SESSION["id"];
    $query = "SELECT * FROM profil WHERE id_user = $id";
    $data = querysql($query)[0];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Kalkulator</title>
		<link rel="stylesheet" href="../style/style.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-md">
				<a class="navbar-brand" href="https://dangak.github.io/index-maintance/">BengakCalc</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link active dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?= $data["nama"] ?>
							</a>
							<ul class="dropdown-menu text-center dropdown-menu-md-end" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="profile/">Profile</a></li>
								<li><a class="dropdown-item" href="changepassword/">Change Password</a></li>
								<li><a class="dropdown-item" style="cursor: pointer;" onclick="alert('Masih belum berfungsi')">Masukan dan Saran</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="logout/">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container d-flex align-items-center justify-content-center mt-4" >
			<form name="sci-calc" method="post">
				<table class="calculator" cellspacing="0" cellpadding="1">
					<tr>
						<td colspan="5"><input class="form-control" id="display" name="display" value="" size="28" maxlength="25" autocomplete="off"></td>
					</tr>
					<tr>
						<td><input type="button" class="btnTop" name="btnTop" value="C" onclick="this.form.display.value=  0 "></td>
						<td><input type="button" class="btnTop" name="btnTop" value="<-" onclick="deleteChar(this.form.display)"></td>
						<td><input type="button" class="btnTop" name="btnTop" value="=" onclick="if(checkNum(this.form.display.value)) { compute(this.form) }"></td>
						<td><input type="button" class="btnOpps" name="btnOpps" value="&#960;" onclick="addChar(this.form.display,'3.14159265359')"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="%" onclick=" percent(this.form.display)"></td>
					</tr>
					<tr>
						<td><input type="button" class="btnNum" name="btnNum" value="7" onclick="addChar(this.form.display, '7')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="8" onclick="addChar(this.form.display, '8')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="9" onclick="addChar(this.form.display, '9')"></td>
						<td><input type="button" class="btnOpps" name="btnOpps" value="x&#94;" onclick="if(checkNum(this.form.display.value)) { exp(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="/" onclick="addChar(this.form.display, '/')"></td>
					<tr>
						<td><input type="button" class="btnNum" name="btnNum" value="4" onclick="addChar(this.form.display, '4')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="5" onclick="addChar(this.form.display, '5')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="6" onclick="addChar(this.form.display, '6')"></td>
						<td><input type="button" class="btnOpps" name="btnOpps" value="ln" onclick="if(checkNum(this.form.display.value)) { ln(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="*" onclick="addChar(this.form.display, '*')"></td>
					</tr>
					<tr>
						<td><input type="button" class="btnNum" name="btnNum" value="1" onclick="addChar(this.form.display, '1')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="2" onclick="addChar(this.form.display, '2')"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="3" onclick="addChar(this.form.display, '3')"></td>
						<td><input type="button" class="btnOpps" name="btnOpps" value="&radic;" onclick="if(checkNum(this.form.display.value)) { sqrt(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="-" onclick="addChar(this.form.display, '-')"></td>
					</tr>
					<tr>
						<td><input type="button" class="btnMath" name="btnMath" value="&#177" onclick="changeSign(this.form.display)"></td>
						<td><input type="button" class="btnNum" name="btnNum" value="0" onclick="addChar(this.form.display, '0')"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="&#46;" onclick="addChar(this.form.display, '&#46;')"></td>
						<td><input type="button" class="btnOpps" name="btnOpps" value="x&#50;" onclick="if(checkNum(this.form.display.value)) { square(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="+" onclick="addChar(this.form.display, '+')"></td>
					</tr>
					<tr>
						<td><input type="button" class="btnMath" name="btnMath" value="(" onclick="addChar(this.form.display, '(')"></td>
						<td><input type="button" class="btnMath" name="btnMath" value=")" onclick="addChar(this.form.display, ')')"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="cos" onclick="if(checkNum(this.form.display.value)) { cos(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="sin" onclick="if(checkNum(this.form.display.value)) { sin(this.form) }"></td>
						<td><input type="button" class="btnMath" name="btnMath" value="tan" onclick="if(checkNum(this.form.display.value)) { tan(this.form) }"></td>
					</tr>
				</tabel>
			</form>
		</div>
		<script type="text/javascript" src="../script/script.js"></script>
		<!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>
