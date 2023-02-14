<?php
    session_start();
    include_once 'database.php';
    if (!isset($_SESSION['logged'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header('LOCATION: ../admin-login.php');
        die();
    }


    $connector = new DataConnector();
    // $course_year_section = "";
    // $result = $connector->select("user", "username='" . $_SESSION['username'] . "'");
    // while ($row = $result->fetch_assoc()) {
    //     $course_year_section = $row['Course'] . "-" . $row['Year'] . $row['Section'];
    // }
    // $result = $connector->select("subjectList", "studentBody='" . $course_year_section . "'");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Schedule</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-5" href="#">UCC - VSRS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="adminDashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class='nav-link' href='adminControls.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-gears'></i></div>
                                Admin Controls
                            </a>
                            <a class='nav-link' href='classes.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-hourglass'></i></div>
                                Classes
                            </a>
                            <!-- <a class="nav-link" href="calendar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                                Calendar
                            </a> -->
                            <!-- <a class="nav-link" href="borrowing.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-box"></i></div>
                                Borrowing
                            </a> -->
                            <a class="nav-link" href="requests.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-paper-plane"></i></div>
                                Requests
                            </a>
                            <!-- <a class="nav-link" href="chats.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-message"></i></div>
                                Chats
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['logged'];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Classes</h1>
                        <br>
                        <table class="container table">
                            <thead>
                                <tr>
                                    <th>Subject Description</th>
                                    <th>Code</th>
                                    <th>Units</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Section</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subs = $connector->select("subjectlist", "1");
                                    while ($row = $subs->fetch_assoc()) {
                                        echo "<tr>";

                                        echo "<td>";
                                        echo $row['SubjDesc'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $row['SubCode'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $row['SubUnits'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $row['SubDate'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $row['SubTime'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $row['studentBody'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo "<button class='btn btn-danger' onclick='deleteSub(this)'>Remove</button>";
                                        echo "</td>";

                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <h3>Create Subject</h3>
                        <div class="row justify-content-center">
                            <div class="col">
                                <form class="justify-content-center container border border-2-secondary rounded rounded-2 py-3" action="saveSub.php" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <label>Subject Description: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="subdesc" id="subdesc" value="" required>
                                        </div>
                                        <div class="col">
                                            <label>Subject Code: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="subcode" id="subcode" value="" required>
                                        </div>
                                        <div class="col">
                                            <label>Units: </label>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" name="subunits" id="subunits" value="" required><br><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Date: </label>
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" name="subdate" min='1901-01-01' value="" required>
                                        </div>
                                        <div class="col">
                                            <label>Time: </label>
                                        </div>
                                        <div class="col">
                                            <input type="time" class="form-control" name="subtime" value="" required>
                                        </div>
                                        <div class="col">
                                            <label>Course\Year\Section: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="subsection" id="subsection" value="" placeholder="BSIS-1A" required><br><br>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        </body>
</html>
<?php include_once 'toaster.php'; ?>
<form id="deleteSubForm" action="deleteSub.php" method="post">
    <input type="hidden" id='subToDelete' name="subToDelete">
</form>

<script>
    function deleteSub(self){
        document.getElementById('subToDelete').value = self.parentNode.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML;
        document.getElementById('deleteSubForm').submit();
    }
    $('#subdesc').on('input', ()=>{
		if (/[^a-zA-Z0-9 \t]+/.test($('#subdesc').val())){
			$('#subdesc').val('');
			toastr.error("Invalid Description, Please Try Again");
			$('#subdesc').addClass('is-invalid');
			$('#subdesc').removeClass('is-valid');
		}
		else{
			$('#subdesc').removeClass('is-invalid');
			$('#subdesc').addClass('is-valid');
		}
	});
    $('#subcode').on('input', ()=>{
		if (/[^a-zA-Z0-9 \t]+/.test($('#subcode').val())){
			$('#subcode').val('');
			toastr.error("Invalid Subject Code, Please Try Again");
			$('#subcode').addClass('is-invalid');
			$('#subcode').removeClass('is-valid');
		}
		else{
			$('#subcode').removeClass('is-invalid');
			$('#subcode').addClass('is-valid');
		}
	});
    $('#subunits').on('input', (object)=>{
        if (/[1-5]{1}$/.test($('#subunits').val()) == false){
            $('#subunits').val('');
			toastr.error("Invalid Input");
			$('#subunits').addClass('is-invalid');
			$('#subunits').remove('is-valid');
		}
		else{
            $('#subunits').removeClass('is-invalid');
			$('#subunits').addClass('is-valid');
		}
	});
    $('#subsection').on('change', (object)=>{
			if (/^[a-zA-Z]{4,6}-[0-9]{1}[a-zA-Z]{1}$/.test($('#subsection').val()) == false){
			$('#subsection').val('');
			toastr.error("Please Follow the specified format");
			$('#subsection').addClass('is-invalid');
			$('#subsection').remove('is-valid');
		}
		else{
			$('#subsection').removeClass('is-invalid');
			$('#subsection').addClass('is-valid');
		}
	});
</script>
