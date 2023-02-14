<?php
    session_start();
	
	foreach ($_POST as $key => $value) {
		$_SESSION['info'][$key] = $value;
	}
    if (!isset($_SESSION['info']['studentname'])) {
        header('LOCATION: register_2.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<link rel="stylesheet" href="../CSS/newStyle.css">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container-fluid m-0 p-0 d-flex justify-content-center align-items-center wrapper">
			<div class="p-5 rounded rounded-5 bg-light">
				<h1 class="mx-0 p-0 mb-3">Register</h1>
				<form action="reg_push.php" method="POST">
					<div class="row form-floating mt-2 mx-0">
						<input type="text" name="username" id="username" class="form-control" placeholder="" value="" required>
						<label for="username" class="form-label">Username</label>
					</div>
					<div class="row form-floating mt-2 mx-0">
						<input type="text" name="password" id="password" class="form-control" placeholder="" required>
						<label for="password" class="form-label">Password</label>
					</div>
					<div class="row form-floating mt-2 mx-0">
						<input type="text" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="" required>
						<label for="confirmPassword" class="form-label">Confirm Password</label>
					</div>
                    <div class="row text-center align-items-center mt-4">
                        <div class="col">
                            <a class="mx-0 mt-4 submit-button rounded" href="register_2.php">Back</a>
                        </div>
                        <div class="col">
                            <input type="submit" class="form-control m-0" id="register" value="Register" id="login-form-submit">
                        </div>
                    </div>
					<div class="text-center">
						<p class="mt-2">
							Have an account?
							<a href="../index.php">Login Here</a>
						</p>
					</div>
				</form>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	</body>
</html>
<?php include_once 'toaster.php';?>
<script>
	$('#username').on('change', ()=>{
        if (/[^a-zA-Z0-9-._@#]/.test($('#username').val())){
            $('#username').val('');
            toastr.error("Invalid Character Found in username");
            $('#username').addClass('is-invalid');
            $('#username').removeClass('is-valid');
        }
        else if($('#username').val().length < 8 || $('#username').val().length > 24){
            $('#username').val('');
            toastr.error("Username Must be 8-24 characters only");
            $('#username').addClass('is-invalid');
            $('#username').removeClass('is-valid');
        }
        else{
            $('#username').removeClass('is-invalid');
            $('#username').addClass('is-valid');
        }
    });
    $('#password').on('input', ()=>{
        if ( /^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/.test($('#password').val())){
            toastr.error("Password Must have 1 Upper Case Letter, 1 number, and 1 Special character");
            $('#password').addClass('is-invalid');
            $('#password').remove('is-valid');
            $('#confirmPassword').prop('readonly', true);
        }
        else if($('#password').val().length < 8 || $('#password').val().length > 16){
            toastr.error("password Must be 8-16 characters only");
            $('#password').addClass('is-invalid');
            $('#password').removeClass('is-valid');
            $('#confirmPassword').prop('readonly', true);
        }
        else{
            $('#password').removeClass('is-invalid');
            $('#password').addClass('is-valid');
            $('#confirmPassword').prop('readonly', false);
        }
    });
    $('#confirmPassword').on('input', ()=>{
        if(!($('#password').val() == $('#confirmPassword').val())){
            toastr.error("Confirm Password does not match");
            $('#confirmPassword').addClass('is-invalid');
            $('#confirmPassword').removeClass('is-valid');
            $('#register').addClass('d-none');
        }
        else{
            $('#confirmPassword').removeClass('is-invalid');
            $('#confirmPassword').addClass('is-valid');
            $('#register').removeClass('d-none');
        }
    });
</script>