<!DOCTYPE html>
<html>
<head>
    <title>Update Courses</title>
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
<body>
    <style>
        body {
            height: 100vh;
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
        <a href="admin_home.php"><img src="../images/logo.jpg" alt=""></a>
    <div class="container">
        <h2>Update Courses</h2>

        <form action="" method="post">
            <?php
            include '../connection.php';

            $query = "SELECT * FROM course";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $teacherId = $row['teacher_id'];
                $description = $row['description'];
                $creditHour = $row['credit_hour'];

                echo "<div class='course-grid'>
                        <input type='checkbox' name='selected_courses[]' value='$id'>
                        <label>ID: $id</label>
                        <label>| Name: $name</label>
                      </div>";
                echo "<br>";
            }
            ?>

            <button type="submit" class="submit" name="select">Select Course</button>
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
                          <input type='text' name='teacher_id' value='$teacherId' required>
                          <input type='text' name='description' value='$description' required>
                          <input type='text' name='credit_hour' value='$creditHour' required><br><br>";
                          
                }

                echo "<button type='submit' class='submit' name='update'>Update</button>";
                echo "</form>";
            } else {
                echo "<p>No course selected for updating.</p>";
            }
        }

        if (isset($_POST['update'])) {
            $courseId = $_POST['course_id'];
            $name = $_POST['name'];
            $teacherId = $_POST['teacher_id'];
            $description = $_POST['description'];
            $creditHour = $_POST['credit_hour'];

            $query = "UPDATE course SET name='$name', teacher_id='$teacherId', description='$description', credit_hour='$creditHour' WHERE id='$courseId'";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Course updated successfully.')</script>";
            } else {
                echo "<script>alert('An error occurred while updating the course.')</script>";
            }

           
        }
        ?>

    </div>
</body>
</html>