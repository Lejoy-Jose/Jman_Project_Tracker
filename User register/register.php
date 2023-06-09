<!DOCTYPE html>
<head>
  <title>User Register Page</title>
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="userregisterstyle.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&family=Montserrat:wght@500&display=swap" rel="stylesheet">


</head>
<body>
    <?php
    $regusername = "";
    $email = "";
    $password = "";
    $repassword = "";
    $registrationSuccess = false;
    $emailExists = false;
    $passwordmatch=false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regusername = $_POST['regusername'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        if (!empty($regusername) && !empty($email) && !empty($password) && !empty($repassword)) {
            if ($password === $repassword) {
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "credential";

                // Create connection
                $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

                if (mysqli_connect_error()) {
                    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
                } else {
                    $SELECT = "SELECT `user email` FROM `user register` WHERE `user email` = ? LIMIT 1";
                    $INSERT = "INSERT INTO `user register` (`username`, `user email`, `user password`) VALUES (?, ?, ?)";
                    $INSERT_USER = "INSERT INTO `admin`.`users` (`users`) VALUES (?)";

                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($email);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    if ($rnum === 0) {
                        $stmt->close();

                        $stmt = $conn->prepare($INSERT);
                        $stmt->bind_param("sss", $regusername, $email, $password);
                        $stmt->execute();

                    // Insert the registered user's name into the "users" table in the "admin" database
                        $stmt = $conn->prepare($INSERT_USER);
                        $stmt->bind_param("s", $regusername);
                        $stmt->execute();
                        $registrationSuccess = true;
                    } else {
                        $emailExists = true;
                    }
                    $stmt->close();
                    $conn->close();
                }
            } else {
                $passwordmatch=true;
            }
        } else {
            echo "All fields are required.";
        }
    }
    ?>

    <div class="container">
        <div class="left-div">
          <?php
          if ($registrationSuccess) {
            echo '<p style="color: green;">Registration successful!</p>';
        }elseif ($emailExists) {
            echo '<p class="error-message">Email already exists. Please use a different email.</p>';
        }elseif ($passwordmatch) {
            echo '<p class="error-message">Password do not match.</P>';
        }


        ?>
        <form name="myform2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="register-form">
            <h1>Register Here</h1>
            <div class="form-group">
                <label type="text" for="regusername"><i class="fa-regular fa-user"></i></label>
                <input type="text" name="regusername" placeholder="Enter Username" value="<?php echo $regusername; ?>" required="">
            </div>
            <div class="form-group">
                <label type="text" for="email"><i class="fa-solid fa-envelope"></i></label>
                <input type="text" name="email" placeholder="Enter Email" value="<?php echo $email; ?>" required="">
            </div>
            <div class="form-group">
                <label type="password" for="password"><i class="fa-solid fa-lock"></i></label>
                <input type="password" name="password" placeholder="Enter Password" required="">
            </div>
            <div class="form-group">
                <label type="password" for="repassword"><i class="fa-solid fa-lock"></i></label>
                <input type="password" name="repassword" placeholder="Retype Password" required="">
            </div>
            <button type="submit" value="login" class="btn-userlogin">Register</button>
            <p class="newuser">Registered User? <a href="userlogin.php">Click here</a></p>
            <p class="adminuser">Admin? <a href="adminlogin.php">Click here</a></p>
        </form>
    </div>
    <div class="right-div">
        <img src="register.png" class="user" alt="User Image">
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="adminpage.js"></script>

</body>
</html>