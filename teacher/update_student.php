<!DOCTYPE html>
<html>
<head>
    <title>Update Students</title>
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
      height: 125vh;
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
        <h1>Update Students</h1>

        <form action="" method="post">
            <?php
            include '../connection.php';

            $query = "SELECT * FROM student order by `name` asc";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $major = $row['major'];
                $email = $row['email'];

                echo "<div class='student-grid'>
                        <input type='checkbox' name='selected_students[]' value='$id'>
                        <label>ID: $id</label>
                        <label>| Name: $name</label>
                      </div>";
                      echo"<br>";
            }
            ?>

            <button type="submit" class="button" name="select">Select Student</button>
        </form>

        <?php
        if (isset($_POST['select'])) {
            if (!empty($_POST['selected_students'])) {
                $selectedStudents = $_POST['selected_students'];
                $selectedStudentData = [];
                foreach ($selectedStudents as $selectedStudentId) {
                    $query = "SELECT * FROM student WHERE id='$selectedStudentId'";
                    $result = mysqli_query($conn, $query);
                    $selectedStudentData[$selectedStudentId] = mysqli_fetch_assoc($result);
                }

                echo "<h3>Edit Student</h3>";
                echo "<form action='' method='post'>";
                foreach ($selectedStudentData as  $studentData) {
                    $id = $studentData['id'];;
                    $name = $studentData['name'];
                    $major = $studentData['major'];
                    $email = $studentData['email'];

                    echo "<input type='hidden' name='student_id' value='$id'>
                          <label>ID: $id</label>
                          <input type='text' name='name' value='$name' required>
                          <input type='text' name='major' value='$major' required>
                          <input type='email' name='email' value='$email' required><br>";
                }
                echo"<br>";

                echo "<button type='submit' class='button' name='update'>Update</button>";
                echo "</form>";
            } else {
                echo "<p>No student selected for updating.</p>";
            }
        }

        if (isset($_POST['update'])) {
            $studentId = $_POST['student_id'];
            $name = $_POST['name'];
            $major = $_POST['major'];
            $email = $_POST['email'];

            $query = "UPDATE student SET name='$name', major='$major', email='$email' WHERE id='$studentId'";
            if (mysqli_query($conn, $query)) {
                echo "<script>";
                echo "setTimeout(function() {";
                echo "    alert('Updated Successfully!');";
                echo "    window.location.href = 'update_student.php';";
                echo "}, 0);";;
                echo "</script>";
            } else {
                echo "<script>alert('An error occurred while updating the student.')</script>";
            }
        }
        ?>        
    </div>
    </div>
</body>
</html>