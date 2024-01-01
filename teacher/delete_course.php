<!DOCTYPE html>
<html>
<head>
    <title>Delete Courses</title>
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
        <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
    <div class="container">
        <h2>Delete Your Courses</h2>

        <form action="" method="post" onsubmit="return confirmDelete();">
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
                        <input type='radio' name='selected_course' value='$id'>
                        <label>ID: $id</label>
                        <label>| Name: $name</label>
                      </div>";
                echo "<br>";
            }
            ?>

            <button type="submit" class="button" name="delete">Delete Course</button>
        </form>

        <?php
        if (isset($_POST['delete'])) {
            if (!empty($_POST['selected_course'])) {
                $selectedCourseId = $_POST['selected_course'];
                $query = "DELETE FROM course WHERE id='$selectedCourseId'";
                if (mysqli_query($conn, $query)) {
                    echo "<script>";
                    echo "setTimeout(function() {";
                    echo "    alert('Deleted Successfully!');";
                    echo "    window.location.href = 'delete_course.php';";
                    echo "}, 0);";;
                    echo "</script>";
                } else {
                    echo "<script>alert('An error occurred while deleting the course.')</script>";
                }

            } else {
                echo "<p>No course selected for deletion.</p>";
            }
        }
        ?>

    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete the selected course?");
        }
    </script>
</body>
</html>