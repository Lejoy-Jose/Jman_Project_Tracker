<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="adminmessage.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> 

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="admin.png"></img>
                </span>

                <div class="text logo-text">
                    <span class="name">WELCOME</span>
                    <span class="profession">ADMIN</span>
                </div>
            </div>

        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links" style="padding-left: 0px;" >
                    <li class="nav-link">
                        <a href="adminpage.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="pipelineproject.php">
                            <i class='bx bx-task icon' ></i>
                            <span class="text nav-text">Projects</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="adminmessage.php">
                            <i class='bx bx-message-rounded-dots icon'></i>
                            <span class="text nav-text">Message</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="addproject.php">
                            <i class='bx bx-plus icon'></i>
                            <span class="text nav-text">Add Projects</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="adminlogin.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home" >
        <div class="text">RECEIVED MESSAGES </div>
        <table class="table">
            <tbody>
            	<?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "admin";

                $connection = new mysqli($servername, $username, $password, $dbname);
                if ($connection->connect_error) {
                    die("Connection Failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM feedback";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Subject</th>';
                    echo '<th>Message</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["subject"] . '</td>';
                        echo '<td>' . $row["message"] . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "No data found.";
                }

                $connection->close();
                ?>


            </tbody>
        </table>



    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="pipelineproject.js"></script>


</body>
</html>
