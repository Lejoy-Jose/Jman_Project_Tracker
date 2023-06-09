 <!DOCTYPE html>
 <html>
 <head>
    <title>User Login Page</title>
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="userloginstyle.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
      <div class="left-div">
        <form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="updateFormAction(event)">
          <h1>Hello User :)</h1>
          <p class="user-para"> Login with your username and password </p>
          <?php
        // Check if there is an error message
          if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="error-message">Invalid username or password.</p>';
        }
        ?>
        <div class="form-group">

            <label for="username"><i class="fa-solid fa-envelope"></i></label>
            <input type="text" name="username" placeholder="Enter Username" required="">
        </div>
        <div class="form-group">
            <label for="password"><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" placeholder="Enter Password" required="">
            <p class="error-message" id="password-error"></p>
        </div>
        <button type="submit" value="login" class="btn-userlogin">Login</button>
        <p class="newuser">New User? <a href="register.php">Click here</a></p>

    </form>
</div>
<div class="right-div">
    <img src="userloginimage.png" class="user" alt="User Image">
</div>
</div>


<?php
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "credential";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

        $SELECT = "SELECT * FROM `user register` WHERE `username` = ? AND `user password` = ?";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Set the logged-in username in the session
            $_SESSION['username'] = $username;
            header("Location: userpage.php");
            exit();
        } else {
            // Redirect back to the login page with an error message
            header("Location: userlogin.php?error=1");
            exit();
        }

        $stmt->close();
        $conn->close();
    } else {
        // Redirect back to the login page with an error message
        header("Location: userlogin.php?error=1");
        exit();
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
