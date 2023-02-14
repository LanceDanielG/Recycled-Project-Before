<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		header('LOCATION: links/adminDashboard.php');
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<link rel="stylesheet" href="CSS/newStyle.css">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container-fluid m-0 p-0 d-flex justify-content-center align-items-center wrapper">
			<div class="p-5 rounded rounded-5 bg-light">
				<h1 class="mx-0 p-0 mb-3">Admin</h1>
				<form action="links/admin_login.php" method="POST">
					<div class="row form-floating mt-2 mx-0">
						<input type="text" name="username" id="username" class="form-control" placeholder="Username">
						<label for="username" class="form-label">Username</label>
					</div>
					<div class="row form-floating mt-2 mx-0">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
						<label for="password" class="form-label">Password</label>
					</div>
					<input type="submit" class="form-control mt-4 submit-button" value="Login" id="login-form-submit">
				</form>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	</body>
</html>
<?php include_once 'links/toaster.php'; ?>
