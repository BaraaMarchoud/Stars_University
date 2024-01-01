<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liked Courses</title>
    <link rel="stylesheet" href="stdd_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .icon-button {
            padding: 0;
            border: none;
            background: none;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
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
    <style>
        body{
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
$student_id = $_SESSION['ids'];
$query = "SELECT * FROM liked_courses WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    echo "<h1>List of liked Courses</h1>";
    echo "<div class='grid'>"; 
    while ($row = mysqli_fetch_array($result)) {
        $course_id = $row["course_id"];
        $query2 = "SELECT * FROM course WHERE id = '$course_id'";
        $result2 = mysqli_query($conn, $query2);

        while ($row = mysqli_fetch_array($result2)) {
            $courseId = $row['id'];
        $name = "Select `name` From `teacher` where id =  '$row[teacher_id]'";
        $res = mysqli_query($conn,$name);
        while ($rows = mysqli_fetch_array($res)) {
        
        echo "<div class='card' id='course-grid'>";
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<h3>" . $row["id"] . "</h3>";
        echo "<p><strong>Teacher name: </strong>" . $rows["name"] . "</p>";
        echo "<p><strong>Course Description: </strong>" . $row["description"] . "</p>";
        echo "<p><strong>Credit hours: </strong>" . $row["credit_hour"] . "</p>";
        echo "<input type='hidden' name='course_id' value='" . $courseId . "'>";
            echo "<form method='post' action='' onsubmit='return confirmDelete();'>";
            echo "<input type='hidden' name='course_id' value='" . $row["id"] . "'>";
            echo "<button type='submit' name='remove_course' class='icon-button'><i class='fas fa-heart-broken'> Unlike</i></button>";
            echo "</form>";
            echo "</div>";
        }
        }
    }
    echo "</div>"; 
    echo "<br>";
} else {
    echo "<h1>You have not liked any courses</h1>";
}

if (isset($_POST['remove_course'])) {
    $course_id = $_POST['course_id'];
    $delete_query = "DELETE FROM liked_courses WHERE student_id = '$student_id' AND course_id = '$course_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>";
                echo "setTimeout(function() {";
                echo "    alert('Removed Successfully!');";
                echo "    window.location.href = 'liked_course.php';";
                echo "}, 0);";
                echo "</script>";
    } else {
        echo "Error deleting course: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<script>
        function confirmDelete() {
            return confirm("Are you sure you want to remove this course?");
        }
    </script>

</body>
</html>