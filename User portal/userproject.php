<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="userproject.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> 

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="user.png"></img>
                </span>

                <div class="text logo-text">
                    <span class="name">WELCOME</span>
                    <span class="profession">USER</span>
                </div>
            </div>

        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links" style="padding-left: 0px;" >
                    <li class="nav-link">
                        <a href="userpage.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="userproject.php">
                            <i class='bx bx-task icon' ></i>
                            <span class="text nav-text">Projects</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="message.php">
                            <i class='bx bx-message-rounded-dots icon'></i>
                            <span class="text nav-text">Message</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="userlogin.php">
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
        <div class="text">ASSIGNED PROJECTS </div>
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = 'projects';

        $conn = mysqli_connect($host, $user, $password, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username = $_SESSION['username'];
        $q = "SELECT title, teammembers, startdate, enddate,status FROM allprojects WHERE teammembers LIKE'%$username%'";
        $result = mysqli_query($conn, $q);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Team Members</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['teammembers'] . "</td>";
                    echo "<td>" . $row['startdate'] . "</td>";
                    echo "<td>" . $row['enddate'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="pipelineproject.js"></script>


</body>
</html>
