<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="addproject.css">
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

                <ul class="menu-links">
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

    <section class="home">
      <div class="text">ADD PROJECTS HERE </div>
      <div class="container">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="addprojectform">
          <div class="input-row">
            <div class="input-box">
              <label for="title">Project Title</label>
              <input type="text" name="title" placeholder="Enter Project Title" required>
          </div>
          <div class="input-box">
              <label for="description">Project Description</label>
              <textarea id="description" placeholder="Enter description" name="description" rows="2" cols="50"></textarea>
          </div>
      </div>
      <div class="input-row">
        <div class="input-box">
          <div class="combo-box">
            <div class="input-box">
              <label for="">Team Members</label>

              <select name="team[]" class="form-control multiple-select" multiple>
                <?php
                $con = mysqli_connect("localhost", "root", "", "admin");
                $query = "SELECT * FROM users";
                $query_run = mysqli_query($con, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $rowhob) {
                        ?>
                        <option value="<?php echo $rowhob['users']; ?>"><?php echo $rowhob['users']; ?></option>
                        <?php
                    }
                } else {
                    echo "No Record Found";
                }
                ?>
            </select>



        </div>

    </div>
</div>
<div class="input-box">
    <label for="status">Status</label>
    <select id="status" name="status">
      <option value="On-Process">On-Process</option>
      <option value="Incomplete">Incomplete</option>
      <option value="Completed">Completed</option>
  </select>
</div>
</div>
<div class="input-row">
    <div class="input-box">
      <label for="startdate">Start Date</label>
      <input type="date" name="startdate" required>
  </div>
  <div class="input-box">
      <label for="enddate">End Date</label>
      <input type="date" name="enddate" required>
  </div>
</div>
<div class="submit-button">
    <button>Submit</button>
</div>
</form>
</div>

</section>

<script type="text/javascript" src="addproject.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".multiple-select").select2();
    });
</script>
</body>
</html>


<!-- PHP code -->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $teamMembers = isset($_POST['team']) ? implode(', ', (array)$_POST['team']) : null;
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    $status=$_POST['status'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projects";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO allprojects (title, teammembers, startdate, enddate,status) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("sssss", $title, $teamMembers, $startDate, $endDate,$status);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<div class="success-message">Project successfully added</div>';
    } else {
        echo "Error submitting form: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
