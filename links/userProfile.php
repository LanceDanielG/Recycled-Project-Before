<?php
    include_once 'database.php';
    include_once 'violationTranslation.php';
    session_start();
    unset($_SESSION['error']);

    if (!isset($_SESSION['username'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header('LOCATION: ../index.php');
        die();
    }
    $connector = new DataConnector();
    $result = $connector->select("user", "Username='" . $_SESSION['username'] . "'");
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
    $violations = $connector->select("violations", "violationUser = '". $_SESSION['username'] ."'");
    $borrowed = $connector->select("requests", "username='".$_SESSION['username']."'");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $_SESSION['username']; ?> </title>
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
                            <a class="nav-link" href="userProfile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="calendar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                                Calendar
                            </a>
                            <a class="nav-link" href="borrowing.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-box"></i></div>
                                Borrowing
                            </a>
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
                        <?php echo $_SESSION['username'];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-5">
                        <div class="row">
                            <div class="col">
                                <h1 style="margin-bottom: -0.2em;"  class="mt-4"><?php echo $_SESSION['studentName']; ?></h1>
                                <h3 class="pl-2"><?php echo $studID; ?></h3>
                            </div>
                            <div class="col d-flex justify-content-end align-items-center">
                                <form action="userPDF/userpdfgenerator.php" method="post" target="_blank">
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
                                    </div>
                                </div>
                                <div class="container-fluid row border border-secondary mt-4 px-0">
                                    <div class="row border border-secondary mx-0 bg-info">
                                        <h2>UCC Guideline</h2>
                                    </div>
                                    <div class="row mx-0 mt-2">
                                        <div class="col py-3">
                                            <ol>
                                                <li>Students with first period classes every Momnday Morning are Required to attend the Flag Ceremony as a legal and civic duty of every Filipino citizen. The University, after observing the rudiment of due process, shall impose the following penalty for this infraction and the preceding prohibitions are shall apply.</li>
                                                <li>Every student must have the UCC ID that is validated every enrollment period, and shall wear it inside the room and school premises at all times. the University strictly Observes NO ID, NO ENTRY Policy, in all Campuses. Hence, any Violation theorof shall be meted with any penalty.</li>
                                                <li>Students shall be respectful, Obedient, and well-Disciplined at all times. They should refrain from using or publishing vulgar language, commiting indecent acts and improper conduct that may cause disturbance to other students, faculty members, staffs and officials of the university, be it actual or in cyber space (text, message, images, video in the Internet). Otherwise, administrative disciplinary case shall be instituted. against them with a penalty of reprimand, suspension or discipline, after appropriate reprimand, suspension or discipline, after appropriate notice and hearing conducted by the Committee on Discipline.</li>
                                                <li>Students shall not be allowed to loiter or commit littering, unhygienic and unsanitary acts or conduct in the campuses/premises. The university, after observing due process, shall impose the penalty for those who does not following the rules of the school.</li>
                                                <li>Students shall be punctual in enrolling, securing permit, taking exam, attending classes, complying with appropriate punishment, sanctions and penalties. The University, after Observing due process, shall impose the penalty of warning, reprimand or suspension against those found guilty of habitual disobedience or disregard of the University policies, rules and regulations, subject to the application of three-strike rule.</li>
                                                <li>Students shall not write, draw nor engrave libelous, defamatory, subversive words or figures in blackboards, walls, or any place in the cmapus premises. The University, after observing due process, shall impose Penalty for the Violations.</li>
                                                <li>Students shall not steal nor cause damage to any property of the University. Otherwise, they shall be meted with the penalty of suspension or dismissal depending on the gravity of the damage caused to the University properties.</li>
                                                <li>Students shall not bring in the campus objects, pictures or Literature in any form which is morally offensive or defamatory materials, nor any objects or implements that are potentially dangerous to life or limb. The University, after observing due process, shall impose the penalty for the violation.</li>
                                                <li>Students shall not smoke in the premises and bring or take any alcoholic beverages and probihited drugs. The The University, after Observing due process, shall impose the following penalty for violation.</li>
                                                <li>Students shall not engage in gambling, unauthorized lottery and any game of chance for monetary consideration in the campus. The University, after observing due process, shall impose the penalty for violation.</li>
                                                <li>Students shall not bring in the premises explosives or deadly weapons or substance of any kind. The University After notice and hearing, shall impose the penalty of suspension or dismissal for this offense, depending on its gravity.</li>
                                                <li>Students shall not commit any form of dishonesty, including but not limited to, (a) Forgery, (b) Cheating, (c) perjury or (d) falsification of documents. the University, after complying with the rudiment of due process shall impose the penalty of suspension or dismissal for this offense, depending on its gravity.</li>
                                                <li>Students shall not disturb classes or obstruct entrances and exits in the campuses, or prevent students, faculty members or school authorities from free access to school entrances and exits. The University, after after complying with the rudiments of due process, shall impose the penalty of warning, suspension or dismissal for violation thereof, depending on tis gravity and in view of Three-strike Rule Policy.</li>
                                                <li>Students shall not involved in any form of hazing or any activity including but not limited to coercion, Threats and intimidation which may result in acutal infliction of harm and Physical Injury. The University, After complying with the rudiment of due process, shall impose the penalty of suspension or dismissal for violation thereof, depending on the grabity of offense.</li>
                                                <li>Students shall not commit any gross misconduct,immorality, assault a teacher or any school or person in authority, nor Engage in Unauthorized mass actions, strikes, rallies, boycotting of classes, compelling others to do the same. The University, after observing due process, shall impose the penalty of suspension or dismissal for this offense depending on its gravity.</li>
                                                <li>Students shall not commit any other acts or conduct not included above but are punishable by existing laws, rules and regulations. The University, after observing due process, Shall Impose the Penalty of reprimand, Suspension or dismissal for violation thereof depending on its gravity.</li>
                                            </ol>
                                        </div>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        </body>
</html>
<?php include_once 'toaster.php'; ?>
