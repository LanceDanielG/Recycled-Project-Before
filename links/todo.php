<?php
    session_start();
    include_once 'database.php';
    if (!isset($_SESSION['username'])) {
        header('LOCATION: ../index.php');
        die();
    }


    $connector = new DataConnector();
    $result = $connector->select("todo", "todoUser='" . $_SESSION['username'] . "'");
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
                                <div class="sb-nav-link-icon"><i class="fas fa-message"></i></div>
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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Todo List</h1>
                        <br>
                        <ol>
                            <?php
                                while($row = $result->fetch_assoc()){
                                    if (!($row['todoStatus'] == "True")) {
                                        echo "<li class='mt-4'>";
                                        echo "<button onclick='removeTodo(this)' style='background: none; border: none;'>";
                                        echo $row['todoDesc'];
                                        echo "</button>";
                                        echo "</li>";
                                        continue;
                                    }
                                }
                            ?>
                        </ol>
                        <br><br>
                        <form class="container-fluid pt-4" action="todoPush.php" method="post">
                            <label for="todoDesc">Description: </label>
                            <input type="text" name="todoDesc" required/>
                            <input type="submit" name="submit">
                        </form>
                        <form id="removeTodoPush" action="removeTodoPush.php" method="post">
                            <input type="hidden" id="removeTodoPushText" name="removeTodoPush" value="">
                        </form>

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
        </body>
</html>


<script>
    function removeTodo(self){
        if (confirm("Are you sure you are done with " + self.innerHTML + " ?")){
            document.getElementById('removeTodoPushText').value = self.innerHTML;
            var form = document.getElementById('removeTodoPush').submit();
        }
    }
</script>
