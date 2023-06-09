<?php
session_start();

// Check if the user is not logged in  and redirect if not logged in
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
    <link rel="stylesheet" href="message.css">
    <!----======== JQUERY ======== -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

                <ul class="menu-links">
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

    <section class="home">
      <div class="text">ENGAGE AND SHARE  </div>
      <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <label for="subject">Subject:</label>
          <input type="text" id="subject" name="subject" placeholder="Enter subject" required>

          <label for="message">Message:</label>
          <textarea id="message" name="message" placeholder="Enter your message" required></textarea>

          <button type="submit">Submit</button>
      </form>
  </div>
</section>
<script type="text/javascript" src="addproject.js"></script>  
</body>
</html>


<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "admin";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $stmt = $conn->prepare("INSERT INTO feedback (subject, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $subject, $message);

        // Execute the query
    if ($stmt->execute()) {
        echo "Data stored successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

        // Close the statement
    $stmt->close();
}

    // Close the connection
$conn->close();
?>