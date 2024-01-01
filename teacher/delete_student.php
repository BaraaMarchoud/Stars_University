<!DOCTYPE html>
<html>
<head>
    <title>Delete from Course</title>
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM teacher where `id` =  '$_SESSION[idt]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
    <style>
        body{
            height: 100vh;
            background: linear-gradient(45deg, #413939, #080708);
            justify-content: center;
            display: flex;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .course-select {
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .checkbox-container {
            margin-top: 10px;
        }

        .delete-button {
            margin-top: 20px;
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
</head>
<body>
    <div class="container">
        <?php
        include '../connection.php';
        $teacherId = $_SESSION['idt'];

        if (isset($_POST['select'])) {
            if (!empty($_POST['selectedStudents'])) {
                $selectedStudents = $_POST['selectedStudents'];
                $courseId = $_POST['courseId'];
                foreach ($selectedStudents as $selectedStudentId) {
                    $query = "DELETE FROM enrollments_courses WHERE student_id='$selectedStudentId' AND `course_id` = '$courseId'";
                    $result = mysqli_query($conn, $query);
                }
                    if ($result) {
                        echo "<script>alert('Deleted Successfully');</script>";
                    } else {
                        echo mysqli_error($conn);
                    }
                
            } else {
                echo "<h1>You didn't select any student</h1>";
            }
        }

        $query = "SELECT `id`, `name` FROM `course` WHERE `teacher_id`= '$teacherId'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Delete Students from My Course</h1>";
            echo "<form method='POST' action=''>";
            echo "<div class='course-select'>";
            echo "<label for='course'>Select Course:</label>";
            echo "<select name='courseId' id='course'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                echo "<option value='$id'>$id | $name</option>";
            }
            echo "</select>";
            echo "<button class='select-button' name='sel' type='submit'>Select</button>";
            echo "</div>";
            echo "</form>";
            echo "<div class='grid'>";
            if (isset($_POST['sel'])) {
                $selectedCourseId = $_POST['courseId'];
                $query = "SELECT student.id, student.name FROM student
                          INNER JOIN enrollments_courses
                          ON student.id = enrollments_courses.student_id
                          WHERE enrollments_courses.course_id = '$selectedCourseId'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    echo "<h1>No students enrolled in this course</h1>";
                } else {
                    echo "<form method='POST' action='' onsubmit='return confirmDelete();'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $studentId = $row['id'];
                        $studentName = $row['name'];
                        echo "<div class='card'>";
                        echo "<h3>$studentName</h3>";
                        echo "<p>ID: $studentId</p>";
                        echo "<div class='checkbox-container'>";
                        echo "<input type='checkbox' name='selectedStudents[]' value='$studentId' id='checkbox-$studentId' class='checkbox-input'>";
                        echo "<label class='checkbox-label' for='checkbox-$studentId'>Remove</label>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<input type='hidden' name='courseId' value='$selectedCourseId'>";
                    echo "<button class='delete-button' name='select' type='submit'>Remove Selected Students</button>";
                    echo "</form>";
                }
            }
        } else {
            echo "<h1>You haven't published any courses yet.</h1>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to remove the selected students from the course?");
        }
    </script>
</body>
</html>