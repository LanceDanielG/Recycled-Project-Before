<?php
	session_start();

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
		<div class="container-fluid m-0 p-0 d-flex justify-content-center align-items-center wrapper shadow">
			<div class="row py-4 px-5 rounded rounded-5 bg-light">
				<h2 class="mb-4">Register</h2>
				<form action="register.php" method="POST">
					<div class="row">
						<div class="col">
							<label class="form-label">Name</label>
							<input type="text" name="studentname" id="studentname" class="form-control mb-2" placeholder="John Doe" value="<?= isset($_SESSION['info']['studentname']) ? $_SESSION['info']['studentname'] : '' ?>" required/>
						</div>
						<div class="col">
							<label class="form-label">Contact Number</label>
							<input name="contactNumber" id="contactNumber" class="form-control mb-2" type="text" placeholder="0917-625-6897" value="<?= isset($_SESSION['info']['contactNumber']) ? $_SESSION['info']['contactNumber'] : '' ?>" required/>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
							<label class="form-label">Student ID</label>
							<input name="studentID" id="studentID" class="form-control mb-2" type="text" placeholder="2019-0000" value="<?= isset($_SESSION['info']['studentID']) ? $_SESSION['info']['studentID'] : '' ?>" required/>
						</div>
						<div class="col">
							<label class="form-label">Year</label>
							<input name="yearlevel" id="yearlevel" class="form-control mb-2" type="number" placeholder="1-4" value="<?= isset($_SESSION['info']['yearlevel']) ? $_SESSION['info']['yearlevel'] : '' ?>" required/>
						</div>
					</div>
					<div class="row form-floating m-0">
						<input type="date" name="birthdate" id="birthdate" class="form-control mb-3" value="<?= isset($_SESSION['info']['birthdate']) ? $_SESSION['info']['birthdate'] : '' ?>" min='1901-01-01' required/>
						<label class="form-label">Birthdate</label>
					</div>
					<div class="row form-floating m-0">
						<select name="course" class="form-select mb-3 selection" id="course">
							<option value="<?= isset($_SESSION['info']['course']) ? $_SESSION['info']['course'] : '' ?>"><?= isset($_SESSION['info']['course']) ? $_SESSION['info']['course'] : '-- Select Option --' ?></option>
							<option value="BSIS" required>BSIS</option>
							<option value="BSCS" required>BSCS</option>
							<option value="BSIT" required>BSIT</option>
							<option value="BSEMC" required>BSEMC</option>
						</select>
						<label class="form-label">Course</label><br><br>
					</div>
					<div class="row form-floating m-0">
						<select name="section" class="form-select mb-3" id="section">
							<option value="<?= isset($_SESSION['info']['section']) ? $_SESSION['info']['section'] : '' ?>"><?= isset($_SESSION['info']['section']) ? $_SESSION['info']['section'] : '-- Select Option --' ?></option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
						<label class="form-label">Section</label>
					</div>
					<div class="row align-items-end m-0">
						<input type="submit" class="form-control" name="next" value="Next">
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
<?php include_once 'toaster.php'; ?>
<script>
	$('#studentname').on('input', ()=>{
		if (/[^a-zA-Z \t]+/.test($('#studentname').val())){
			$('#studentname').val('');
			toastr.error("Invalid Name, Please Try Again");
			$('#studentname').addClass('is-invalid');
			$('#studentname').removeClass('is-valid');
		}
		else{
			$('#studentname').removeClass('is-invalid');
			$('#studentname').addClass('is-valid');
		}
	});
	$('#contactNumber').on('change', (object)=>{
		if (/[0-9]{4}-[0-9]{3}-[0-9]{4}$/.test($('#contactNumber').val()) == false){
			$('#contactNumber').val('');
			toastr.error("Please Follow the specified contact number format");
			$('#contactNumber').addClass('is-invalid');
			$('#contactNumber').remove('is-valid');
		}
		else{
			$('#contactNumber').removeClass('is-invalid');
			$('#contactNumber').addClass('is-valid');
		}
	});
	$('#studentID').on('change', (object)=>{
			if (/^[0-9]{4}-[0-9]{4}$/.test($('#studentID').val()) == false){
			$('#studentID').val('');
			toastr.error("Please Follow the specified format");
			$('#studentID').addClass('is-invalid');
			$('#studentID').remove('is-valid');
		}
		else{
			$('#studentID').removeClass('is-invalid');
			$('#studentID').addClass('is-valid');
		}
	});
	$('#yearlevel').on('input', (object)=>{
		if (/[1-4]{1}$/.test($('#yearlevel').val()) == false){
			$('#yearlevel').val('');
			toastr.error("Please Follow the specified format");
			$('#yearlevel').addClass('is-invalid');
			$('#yearlevel').remove('is-valid');
		}
		else{
			$('#yearlevel').removeClass('is-invalid');
			$('#yearlevel').addClass('is-valid');
		}
	});
</script>