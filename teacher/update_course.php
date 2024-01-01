<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
    <link rel="stylesheet" href="teach_style.css">
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM teacher where `id` =  '$_SESSION[idt]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
</head>
<body>
    <style>
        body {
            height: 110vh;
        }
        img{
                left:20px;
                top: 20px;
                position: fixed;
                height: 70px;
                width: 70px;
                border-radius: 50px;
            }
        </style>
        <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
    <div class="container">
        <h2>Update Your Courses</h2>

        <form action="" method="post">
            <?php
            include '../connection.php';
            $teacherId = $_SESSION['idt'];

            $query = "SELECT * FROM course where `teacher_id` = $teacherId";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $description = $row['description'];
                $creditHour = $row['credit_hour'];

                echo "<div class='course-grid'>
                        <input type='radio' name='selected_courses[]' value='$id'>
                        <label>ID: $id</label>
                        <label>| Name: $name</label>
                      </div>";
                echo "<br>";
            }
            ?>

            <button type="submit" class="button" name="select">Select Course</button>
        </form>

        <?php
        if (isset($_POST['select'])) {
            if (!empty($_POST['selected_courses'])) {
                $selectedCourses = $_POST['selected_courses'];

                $selectedCourseData = [];
                foreach ($selectedCourses as $selectedCourseId) {
                    $query = "SELECT * FROM course WHERE id='$selectedCourseId'";
                    $result = mysqli_query($conn, $query);
                    $selectedCourseData[$selectedCourseId] = mysqli_fetch_assoc($result);
                }

                echo "<h3>Edit Course</h3>";
                echo "<form action='' method='post'>";
                foreach ($selectedCourseData as $courseId => $courseData) {
                    $name = $courseData['name'];
                    $teacherId = $courseData['teacher_id'];
                    $description = $courseData['description'];
                    $creditHour = $courseData['credit_hour'];

                    echo "<input type='hidden' name='course_id' value='$courseId'>
                          <label>ID: $courseId</label>
                          <br><br>
                          <input type='text' name='name' value='$name' required>
                          <input type='text' name='description' value='$description' required>
                          <input type='text' name='credit_hour' value='$creditHour' required><br><br>";
                          
                }

                echo "<button type='submit' class='button' name='update'>Update</button>";
                echo "</form>";
            } else {
                echo "<p>No course selected for updating.</p>";
            }
        }

        if (isset($_POST['update'])) {
            $courseId = $_POST['course_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $creditHour = $_POST['credit_hour'];

            $query = "UPDATE course SET `name`='$name', `description`='$description', `credit_hour` ='$creditHour' WHERE id='$courseId'";
            if (mysqli_query($conn, $query)) {
                echo "<script>";
                echo "setTimeout(function() {";
                echo "    alert('Updated Successfully!');";
                echo "    window.location.href = 'update_course.php';";
                echo "}, 0);";;
                echo "</script>";
            } else {
                echo "<script>alert('An error occurred while updating the course.')</script>";
            }
        }
        ?>

    </div>
</body>
</html>