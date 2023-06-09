<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="adminpagestyle.css">

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
      <div class="text">JMAN Project Tracker </div>
      <div class="container">
          <div class="box">
            <h2>Projects</h2>
            <div class="content">
              <p>To easily access and explore detailed information about each project, including description, progress, and enddate.</p>
              <p>Click to view about existing projects.</p>
          </div>
          <a href="addproject.php" class="btn-link">Let's Go</a>
      </div>

      <div class="box">
          <h2>Add Projects</h2>
          <div class="content">
            <p>To achieve specific objectives and goals within a defined timeline and budget  with a better teamwork and collective success.</p>
            <p>Click to assign projects to team.</p>
        </div>
        <a href="addproject.php" class="btn-link">Let's Go</a>
    </div>

</div>

</section>


<?php
$con= mysqli_connect("localhost","root","","admin");
$s=mysqli_query($con,"SELECT * FROM users");
?>

<select>
    <?php
    while($r=mysqli_fetch_array($s))
    {
        ?>
        <option><?php echo $r['username']; ?> </option>
        <?php
    }
    ?>
</select>


<script src="adminpage.js"></script>

</body>
</html>