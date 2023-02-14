<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    $html .= '
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
                gap: 1em;
            }
            .personal{
                margin-left: 5em;
                margin-top: 5em;
            }
            .violation{
                display: grid;
                justify-content: center;
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
                        <img src="assets/img/ucclogo.png" alt="">
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
                                        "'. translate($row['violationNumber']) .'" 
                                    </li> 
                            '; 
                        }
            $html .='</div>
                </div>
            </div>
        </div> 
        ';
</body>
</html>