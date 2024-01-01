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
        <h1>Delete Course</h1>

        <form action="" method="post" onsubmit="return confirmDelete();">
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
                        <input type='radio' name='selected_courses[]' value='$id'>
                        <label>ID: $id</label>
                        <label>| Name: $name</label>
                      </div>";
                echo "<br>";
            }
            ?>

            <button type="submit" class="submit" name="select">Delete Course</button>
        </form>

        <?php
        if (isset($_POST['select'])) {
            if (!empty($_POST['selected_courses'])) {
                $selectedCourses = $_POST['selected_courses'];

                foreach ($selectedCourses as $selectedCourseId) {
                    $query = "DELETE FROM `course` WHERE id='$selectedCourseId'";
                    $result = mysqli_query($conn, $query);
                    if($result){
                        echo "<script>";
                        echo "setTimeout(function() {";
                        echo "    alert('Deleted Successfully!');";
                        echo "    window.location.href = 'delete_course.php';";
                        echo "}, 0);";;
                        echo "</script>";;
                    }
                }

            } else {
                echo "<p>No course selected for Deleting.</p>";
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