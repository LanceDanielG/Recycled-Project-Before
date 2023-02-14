<?php 
    require_once __DIR__ . '/../../dompdf/vendor/autoload.php';
    include_once '../database.php';
    include_once '../violationTranslation.php';
    session_start();

    if (!isset($_POST['generate'])) {
        $_SESSION['error'] = "Cannot Bypass, Unauthorize Access";
        header('LOCATION: ../userProfileAdmin.php');
        die();
    }

    $connector = new DataConnector();
    $result = $connector->select('user', 'Username="' . $_SESSION['selectedUser'] . '"');
    $username = $name = $studID = $year = $section = $course = $contact = $Bday = '';
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
    $violations = $connector->select('violations', 'violationUser = "'. $_SESSION['selectedUser'] .'"');

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $html = '
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
                /* border: 1px solid red; */
            }
            .container{
                height: 100vh;
                width: 100vw;
            }
            img{
                height: 100px;
                width: auto;
            }
            .header {
                width: 100vw;
                display: grid;
                justify-content: center;
                text-align: center;
                margin-top: 5em;
                gap: 3em;
            }
            .personal{
                margin-left: 5em;
                margin-top: 5em;
            }
            .violation{
                margin-top: 3em;
                display: grid;
                justify-content: center;
            }
            .violation li{
                margin-top: 2em;
                margin-left: 10em;
            }
            .title{
                text-align: center;
            }
            .information {
                display: grid;
                gap: 5em;
            }
        </style>
        <div class="container">
            <div class="content">
                <div class="header">
                    <div class="row">
                        <h5>University of Caloocan City</h5>
                    </div>
                    <div class="row">
                        <h1>UCC Violation Sheet Record System</h1>
                    </div>
                    <div class="row">
                        <h1>Violation</h1>
                    </div>
                </div>
                <div class="information">
                    <div class="row personal">
                        Personal Information
                        <div class="col">
                            <p>
                                Student Name: 
                                <span>'.$name.'</span>
                            </p>
                            <p>
                                Student ID: 
                                <span>'.$studID.'</span>
                            </p>
                        </div>
                        <div class="col">
                            <p>Course / Year / Sec: <span>'.$course . ' ' . $year . $Section .'</span></p>
                            <p>Contact Number: <span>'.$contact.'</span></p>
                        </div>
                    </div>
                    <div class="row violation">
                        <h3 class="title">Violation List</h3>';
                        while ($row = $violations->fetch_assoc()) {
                            $html .= '<li>  
                                        '. translate($row['violationNumber']) .'
                                    </li> 
                            '; 
                        }
            $html .='</div>
                </div>
            </div>
        </div> 
    ';
    
    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);
    // $options->set("isPhpEnabled",TRUE);
    $filename = $_SESSION['selectedUser']. uniqid() . ".pdf";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'Portrait');
    $dompdf->render();
    $dompdf->stream('Violation.pdf', array('Attachment' => 0));

    $output = $dompdf->output();
    file_put_contents($filename, $output);

?>


