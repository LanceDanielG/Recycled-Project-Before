<?php
    include_once 'database.php';
    include_once 'violationTranslation.php';
    session_start();
    if (!isset($_SESSION['logged'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header('LOCATION: ../admin-login.php');
        die();
    }

    if (!isset($_POST['selectedUserAdmin'])) {
        header('LOCATION: adminControls.php');
        die();
    } else {
        $_SESSION['selectedUser'] = $_POST['selectedUserAdmin'];
    }
    $connector = new DataConnector();
    $result = $connector->select("user", "Username='" . $_POST['selectedUserAdmin'] . "'");
    $username = $name = $studID = $year = $section = $course = $contact = $Bday = "";
    while ($row = $result->fetch_assoc()) {
        $username = $row['Username'];
        $name = $row['StudName'];
        $contact = $row['ContactNo'];
        $studID = $row['StudID'];
        $Bday = $row['BDay'];
        $year = $row['Year'];
        $course = $row['Course'];
        $Section = $row['Section'];
    }
    $violations = $connector->select("violations", "violationUser = '". $_SESSION['selectedUser'] ."'");
    $borrowed = $connector->select('requests', "username='". $_POST['selectedUserAdmin'] ."'");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $_SESSION['logged']; ?> </title>
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
                            <a class="nav-link" href="userProfileAdmin.php">
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
                    <div class="container-fluid px-5">
                        <div class="row">
                            <div class="col">
                                <h1 style="margin-bottom: -0.2em;"  class="mt-4"><?php echo $name; ?></h1>
                                <h3 class="pl-2"><?php echo $studID; ?></h3>
                            </div>
                            <div class="col d-flex justify-content-end align-items-center">
                                <form action="pdf/generatePDF.php" method="post" target="_blank">
                                    <input type="submit" name="generate" value="Generate PDF">
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="container-fluid row border border-secondary mt-4 px-0">
                                    <div class="row border border-secondary mx-0 bg-danger">
                                        <h2>Violations</h2>
                                    </div>
                                    <div class="row mx-0 mt-2">
                                        <ol>
                                            <?php
                                                while ($row = $violations->fetch_assoc()) {
                                                    echo "<li>";
                                                    echo translate($row['violationNumber']);
                                                }
                                                echo "</li>";
                                            ?>
                                        </ol>
                                        <h5 class="text-center mb-4" >-- END OF LIST --</h5>
                                    </div>
                                </div>
                                <div class="container-fluid row border border-secondary mt-4 px-0">
                                    <div class="row border border-secondary mx-0 bg-info">
                                        <h2>Borrowing</h2>
                                    </div>
                                    <div class="row mx-0 mt-2">
                                        <ol>
                                            <?php
                                                while ($row = $borrowed->fetch_assoc()) {
                                                    echo "<li>";
                                                    echo $row['status'] . " - " . $row['itemName'];
                                                    echo "</li>";
                                                }
                                            ?>
                                        </ol>
                                        <h5 class="text-center mb-4" >-- END OF LIST --</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border border-secondary mt-4">
                                    <p class="mx-2 mt-2"><strong>Year & Section: </strong> <?php echo $year . "-". $Section?></p>
                                    <p class="mx-2 mt-0"><strong>Course: </strong> <?php echo $course?></p>
                                    <p class="mx-2 mt-0"><strong>Contact: </strong> <?php echo $contact?></p>
                                    <p class="mx-2 mt-0"><strong>Birthdate: </strong> <?php echo $Bday?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h2>Violation Input</h2>
                            <form id='violationForm' class="container" action="violationPush.php" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <input class="my-3" type="radio" name="violation" value="1">
                                        <label>Section 1. Flag Ceremony Attendance</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="2">
                                        <label>Section 2. No ID, No Entry Policy</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="3">
                                        <label>Section 3. Immoral and Obsence Conduct</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="4">
                                        <label>Section 4. Loitering, Littering and Unsanitary Acts</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="5">
                                        <label>Section 5. Libelous, Subversive, and Defamatory Acts</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="6">
                                        <label>Section 6. Theft and Damage of University Properties</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="7">
                                        <label>Section 7. Morally Offensive and Defamatory Materials</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="8">
                                        <label>Section 8. Alcohol, Smoking, and Drugs</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="my-3" type="radio" name="violation" value="9">
                                        <label>Section 9. Habitual Disobedience to Policies, Rules and Regulations</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="10">
                                        <label>Section 10. Gambling and Lottery</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="11">
                                        <label>Section 11. Deadly Weapons and Explosives</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="12">
                                        <label>Section 12. Dishonesty, Falsification, Forgery and Cheating</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="13">
                                        <label>Section 13. Obstruction of Entrances and Exits</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="14">
                                        <label>Section 14. Coercive and Oppresive Act/Conduct</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="15">
                                        <label>Section 15. Gross Misconduct and Unauthorized Mass Actions</label>
                                        <br>
                                        <input class="my-3" type="radio" name="violation" value="16">
                                        <label>Section 16. Other Improper Acts/Conduct</label>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-10">

                                    </div>
                                    <div class="col float-right">
                                        <button onclick="pushViolation()" class="btn btn-secondary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <br><br><br><br>
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
<script>
    function pushViolation(){
        if (confirm("Are you sure you want to add this violation to this student?")){
            document.getElementById('violationForm').Submit();
        }
    }
</script> 
