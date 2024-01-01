<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="stdd_style.css">
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM student where `id` =  '$_SESSION[ids]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
</head>
<body>
<div class="menu">
    <button><a href="student_home.php">Home</a></button>
    <button><a href="teacher.php">Teachers</a></button>
    <button><a href="courses.php">Course</a></button>
    <button><a href="enrollment_course.php">Enrollment Courses</a></button>
    <button><a href="liked_course.php">Liked Courses</a></button>
    <button><a href="uploaded_files.php">Files</a></button>
    <button><a href="../login.php">Logout</a></button>
  </div>

  <div class="content">
    <?php
    include '../connection.php';
    $query = "SELECT `id`, `name`, `profession`, `email`, `experience year` FROM `teacher`";
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