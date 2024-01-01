<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
    <link rel="stylesheet" href="ad_style.css">
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM `admin` where `id` =  '$_SESSION[ida]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
</head>
<style>
  img{
                left:20px;
                top: 20px;
                position: fixed;
                height: 70px;
                width: 70px;
                border-radius: 50px;
            }
        </style>
        <a href="admin_home.php"><img src="../images/logo.jpg" alt=""></a>
<body>
  <br>
<h1>Here is the List of all the teachers on the System</h1>

  <div class="content">
    <?php
    include '../connection.php';
    $query = "SELECT `id`, `name`, `profession`, `email`, `experience year` FROM `teacher` WHERE 1";
    $result = mysqli_query($conn, $query);
    echo "<div class='grid'>"; 
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class=\"card\">";
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<p>" . $row["profession"] . "</p>";
        echo "<p>" . $row["email"] . "</p>";
        echo "<p>" . $row["experience year"] . " years of experience</p>";
        echo "</div>";
        
      }
      echo "</div>";
    ?>


</body>
</html>