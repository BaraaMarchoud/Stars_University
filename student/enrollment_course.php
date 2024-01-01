<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Courses</title>
    <link rel="stylesheet" href="stdd_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-cnyrJ2KUvS5m2kFf+qDkDu8Ri8iQz6PZ6O7J5mPMd6/MFRHq5YnblLq7ng9b0BdXa3U7vX0X2j+WVbaN8/6LkA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
.icon-button {
  color: #ff2929;
  transition: color 0.3s;
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
$query = "SELECT * FROM enrollments_courses WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    echo "<h1>List of enrolled Courses</h1>";
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
            echo "<button type='submit' name='remove_course' class='icon-button'><i class='fas fa-trash-alt'> Cancel enrollment</i></button>";
            echo "</form>";
            echo "</div>";
        }
        }
    }
    echo "</div>"; 
} else {
    echo "<h1>You are not enrolled in any Course</h1>";
}

if (isset($_POST['remove_course'])) {
    $course_id = $_POST['course_id'];
    $delete_query = "DELETE FROM enrollments_courses WHERE student_id = '$student_id' AND course_id = '$course_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>";
        echo "setTimeout(function() {";
        echo "    alert('Removed Successfully!');";
        echo "    window.location.href = 'enrollment_course.php';";
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