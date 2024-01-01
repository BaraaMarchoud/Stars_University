<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link rel="stylesheet" href="stdd_style.css">
    <?php
    include '../connection.php';
    session_start();
    $student_id = $_SESSION['ids'];
    $sql = "SELECT * FROM student WHERE `id` = '$student_id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 0){
        header("location: logout.php");
    }
    ?>
</head>
<body>
<style>
    body {
        height: 100vh;
    }
</style>
<div class="menu">
    <button><a href="student_home.php">Home</a></button>
    <button><a href="teacher.php">Teachers</a></button>
    <button><a href="courses.php">Course</a></button>
    <button><a href="enrollment_course.php">Enrollment Courses</a></button>
    <button><a href="liked_course.php">Liked Courses</a></button>
    <button><a href="uploaded_files.php">Files</a></button>
    <button><a href="../login.php">Logout</a></button>
  </div>

<?php
include '../connection.php';

$query = "SELECT ec.course_id, c.name, uf.pdf, c.teacher_id  FROM enrollments_courses ec
          INNER JOIN course c ON ec.course_id = c.id
          INNER JOIN uploaded_files uf ON ec.course_id = uf.course_id
          WHERE ec.student_id = '$student_id'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

if ($num > 0) {
    echo "<h1>List of Uploaded Files</h1>";
    echo "<div class='grid'>"; 
    while ($row = mysqli_fetch_array($result)) {
        $t_id = $row["teacher_id"];
        $name = "Select `name` From `teacher` where id =  '$t_id'";
        $res = mysqli_query($conn,$name);
        while ($rows = mysqli_fetch_array($res)) {
        echo "<div class='card'>";
        echo "<h3>Course: " . $row["name"] . "</h3>";
        echo "<p><strong>Teacher: </strong>" . $rows["name"] . "</p>";
        echo "<p>File: <a href='../teacher/files/" . $row["pdf"] . "' target='_blank'>" . $row["pdf"] . "</a></p>";
        echo "</div>";
        }
    }
    echo "</div>";
} else {
    echo "<h1>No uploaded files available for your enrolled courses</h1>";
}

mysqli_close($conn);
?>

</body>
</html>