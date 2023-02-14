<?php
    session_start();
    include_once 'database.php';
    if (!isset($_SESSION['username'])) {
         header('LOCATION: ../index.php');
         die();
    }


    $connector = new DataConnector();
    $result = $connector->select("messages", "link like '%" . $_SESSION['username'] . "%';");
    $msg_prev = array();
    while ($row = $result->fetch_assoc()) {
        $user = explode("-", $row['link']);
        $user = $user[0] == $_SESSION['username'] ? $user[1] : $user[0];
        $msg_prev[$user] = array($row['message']);
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
        <title>Chats</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">StudION</a>
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
                            <?php
                                if ($_SESSION['username'] == "admin"){
                                    echo "<a class='nav-link' href='adminControls.php'>
                                        <div class='sb-nav-link-icon'><i class='fas fa-gears'></i></div>
                                        Admin Controls
                                        </a>";
                                    echo "<a class='nav-link' href='classes.php'>
                                        <div class='sb-nav-link-icon'><i class='fas fa-hourglass'></i></div>
                                        Classes
                                        </a>";
                                }
                            ?>
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
                            <a class="nav-link" href="chats.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-message"></i></div>
                                Chats
                            </a>
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
                    <div class="container-fluid mt-4 mx-0 px-0">
                        <div class="row px-0 mx-0">
                            <h1>Messages</h1>
                        </div>
                        <div class="row container-fluid px-0 mx-0">
                            <?php
                                foreach ($msg_prev as $key => $value) {
                                    $sender = explode("-", $key);
                                    $sender = $sender[0] == $_SESSION['username'] ? $sender[1] : $sender[0];
                                    echo "<a class='row container-fluid border border-2 border-dark mx-0 px-0' style='text-decoration: none;' onclick='test(this)'>
                                            <div class='col-2'>
                                                <p class='my-2 text-dark'>". $sender . "</p>
                                            </div>
                                            <div class='col-7'>
                                                <p class='my-2 text-muted'>" .$value[0] ."</p>
                                            </div>
                                        </a>";
                                }
                            ?>
                        </div>
                        <br><br><br><br><br><br><br><br><br>
                    </div>
                </main>
                <form class="container" action="sendmsg.php" method="post" style="Position: absolute; bottom:5%;">
                    <div class="row">
                        <div class="col-1"></div>
                        <input class="col-2" type="text" name="receiver" placeholder="<?php echo $_SESSION['username']; ?>" required/>
                    </div>
                    <div class="row mt-2 mx-5">
                        <textarea class="col" name="messages" rows="3" cols="80" placeholder="ENTER MESSAGE HERE" ></textarea>
                    </div>
                    <div class="container row justify-content-center">
                        <button class="col-2 mt-1 btn btn-primary" onclick="">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        </body>
</html>

<form action="messages.php" method="post" id="userForm">
    <input type="hidden" id="messageUserInput" name="messageUser" >
</form>

<script>
    function test(self){
         document.getElementById('messageUserInput').value = self.childNodes[1].childNodes[1].innerHTML;
         document.getElementById('userForm').submit();
    }
</script>
