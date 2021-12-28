<?php 
	session_start();

	if ( isset($_SESSION["login"]) ){ 
		header("Location: app/");
		exit;
	}

	if ( isset($_SESSION["id"]) ){ 
		header("Location: app/");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Home</title>
		<link rel="stylesheet" href="style/stylehome.css" />
		<link href="https://fonts.googleapis.com/css2?family=Allerta&family=Josefin+Sans:wght@500&family=Jura:wght@700&display=swap" rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="column active">
				<div class="content">
					<h1>C</h1>
					<div class="box">
						<h2>M O T D</h2>
						<p class="paragh">"Ketika kau sedang berusaha mendekati cita-citamu, di waktu yang sama cita-citamu juga mendekatimu. Alam semesta bekerja seperti itu."<br><br>Fiersa Besari</p>
					</div>
				</div>
				<div class="bg bg1"></div>
			</div>
			<div class="column">
				<div class="content">
					<h1>A</h1>
					<div class="box">
						<h2>R O U T E S</h2>
						<div class="paragh">
							<ul>
								<li>Register and Login app <a style="display: inline-block;color: yellow;"  href="app/">here</a></li>
								<li>View and setting Profile</li>
								<li>Use the Calculator Application</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="bg bg2"></div>
			</div>
			<div class="column">
				<div class="content">
					<h1>L</h1>
					<div class="box">
						<h2>D E S C</h2>
						<p class="paragh">"Aplikasi ini dibuat oleh kelompok 6, aplikasi kalkulator ini dilengkapi dengan fitur <i>scientific calculator</i>, login & register, dan view profile "</p>
					</div>
				</div>
				<div class="bg bg3"></div>
			</div>
			<div class="column">
				<div class="content">
					<h1>C</h1>
					<div class="box">
						<h2>A B O U T</h2>
						<p class="paragh">"Created with love by Kelompok 6 <br />Aditya Raihan S.<br />Aria Pratama E.<br />Wazir Qorni A."</p>
					</div>
				</div>
				<div class="bg bg4"></div>
			</div>
		</div>
		<!-- Javascript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="script/scripthome.js"></script>
	</body>
</html>
