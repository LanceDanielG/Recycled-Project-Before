<?php
    session_start();
    include_once 'database.php';

    $connector = new DataConnector();
    $result = isset($_SESSION['logged'])? $connector->select("requests", "status = 'PENDING'") : $connector->select("requests", "username='" . $_SESSION['username'] . "'");
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
                            <?php if (isset($_SESSION['username'])): ?>
                                <a class="nav-link" href="userProfile.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                            <?php elseif (isset($_SESSION['logged'])): ?>
                                <a class="nav-link" href="adminDashboard.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['logged'])): ?>
                                    <a class='nav-link' href='adminControls.php'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-gears'></i></div>
                                    Admin Controls
                                </a>
                                <a class='nav-link' href='classes.php'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-hourglass'></i></div>
                                    Classes
                                </a>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['username'])): ?>
                                <a class="nav-link" href="calendar.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                                    Calendar
                                </a>
                                <a class="nav-link" href="borrowing.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-box"></i></div>
                                    Borrowing
                                </a>
                            <?php endif; ?>
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
                        <?= isset($_SESSION['logged'])? $_SESSION['logged'] : " " ?>
                        <?= isset($_SESSION['username'])? $_SESSION['username'] : " " ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Requests</h1>
                        <div class="row mt-4">
                            <div class="col">
                                <table class="table-secondary table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3">Requested Item</th>
                                            <th class="px-5 py-3">Date</th>
                                            <th class="px-4 py-3">Status</th>
                                            <?php if(isset($_SESSION['logged'])): ?>
                                                    <th class='px-4 py-3'> Sender </th>
                                                    <th class='px-3 py-3'> Action </th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";

                                                echo "<td class='px-4 py-3'>";
                                                echo $row['itemName'];
                                                echo "</td>";

                                                echo "<td class='px-5 py-3'>";
                                                echo $row['date'];
                                                echo "</td>";

                                                echo "<td class='px-4 py-3'>";
                                                echo $row['status'];
                                                echo "</td>";

                                                if (isset($_SESSION['logged'])){

                                                    echo "<td class='px-4 py-3'>";
                                                    echo $row['username'];
                                                    echo "</td>";

                                                    if ($row['status'] == "PENDING") {
                                                        echo "<td class='px-3 py-3'>";
                                                        echo "<Button class='mx-2 btn btn-primary' onclick='editStatus(this)' value='APPROVE'>APPROVE</Button>";
                                                        echo "<Button class='mx-2 btn btn-danger' onclick='editStatus(this)' value='REJECT'>REJECT</Button>";
                                                        echo "</td>";
                                                    }
                                                }

                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                <table>
                            </div>
                        </div>
                        <form id="approvalForm" action="approvalPush.php" method="post">
                            <input type="hidden" id="approvalFormObject" name="approvalFormObject"/>
                            <input type="hidden" id="approvalFormDate" name="approvalFormDate"/>
                            <input type="hidden" id="approvalFormStatus" name="approvalFormStatus"/>
                            <input type="hidden" id="approvalFormSender" name="approvalFormSender"/>
                            <input type="hidden" id="approvalFormAction" name="approvalFormAction"/>
                        </form>
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
        </body>
</html>

<script>
    function editStatus(self){
        var object = self.parentNode.parentNode.childNodes[0].innerHTML;
        var date = self.parentNode.parentNode.childNodes[1].innerHTML;
        var status = self.parentNode.parentNode.childNodes[2].innerHTML;
        var sender = self.parentNode.parentNode.childNodes[3].innerHTML;
        if (confirm("Are you sure you want to " + self.value + "?")) {
            document.getElementById('approvalFormAction').value = self.value;
            document.getElementById('approvalFormObject').value = object;
            document.getElementById('approvalFormDate').value = date;
            document.getElementById('approvalFormStatus').value = status;
            document.getElementById('approvalFormSender').value = sender;
            document.getElementById("approvalForm").submit();
        }
    }
</script>
