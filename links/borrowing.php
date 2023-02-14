<?php
    include_once 'database.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header('LOCATION: ../index.php');
        die();
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Borrowing</title>
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
                        <li><a class="dropdown-item" href="../index.php">Logout</a></li>
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
                            <!-- <a class='nav-link' href='adminControls.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-gears'></i></div>
                                Admin Controls
                            </a>
                            <a class='nav-link' href='classes.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-hourglass'></i></div>
                                Classes
                            </a> -->
                            <a class="nav-link" href="calendar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                                Calendar
                            </a>
                            <?php if (isset($_SESSION['username'])): ?>
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
                        <?php echo $_SESSION['username'];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="background-color: #e2e9e6" >
                <div class="container-fluid px-4" style="background-color: #FAFAFA; border-bottom: 5px solid #3a3a3a">
                    <h1 class="mt-4">Borrowing</h1>
                    <hr class="line bg-dark">
                </div>

                <form id="borrowForm" action="borrowReqPush.php" method="post">
                    <input type="hidden" id="borrowText" name="borrowReq">
                </form>
                <div class="container p-5">
                    <!--Row1-->
                    <div class="row bg-light p-3 shadow bg-body rounded border-0">
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/projector2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Projector</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/monitor2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Monitor</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/mouse2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Mouse</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/keyboard2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Keyboard</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Row2-->
                    <div class="row bg-light p-3 shadow bg-body border-0">
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/hdmi2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>HDMI</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase mt-auto">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/vga2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>VGA</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/rcaconnector2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>RCA Connector</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/powercable2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Power Cable</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Row3-->
                    <div class="row bg-light p-3 shadow bg-body border-0">
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/wireextension2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Wire Extension</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase mt-auto">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/universalplug.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>Universal EU Plug Converter</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                            <div class="card text-center text-wrap fw-bold h-100 p-2 border-0 bg-light">
                                <img src="../img/dvi-dtovgaadpter2.jpg" alt=" ">
                                <div class="card-text p-3">
                                    <p>DVI-D to VGA Adapter</p>
                                    <button onclick="regBorrow(this)" class="btn btn-outline-dark text-uppercase">borrow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Lance Pogi-->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </body>
</html>
<?php include_once 'toaster.php'; ?>

<script>
    function regBorrow(self){
        var text = self.previousElementSibling.innerHTML;
        if (confirm("Are you sure you want to request " + text + "?")){
            document.getElementById('borrowText').value = text;
            document.getElementById('borrowForm').submit();
        }
    }
</script>
