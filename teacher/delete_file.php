<!DOCTYPE html>
<html>
<head>
    <title>Delete File</title>
    <link rel="stylesheet" href="teach_style.css">
</head>
<body>
    <style>
        body {
            height: 100vh;
        }
        img {
            left: 20px;
            top: 20px;
            position: fixed;
            height: 70px;
            width: 70px;
            border-radius: 50px;
        }
        .delete-button {
            height: 35px;
            margin-left: 30px;
        }
    </style>
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM teacher where `id` =  '$_SESSION[idt]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
        header("location: logout.php");
    }
    ?>
    <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
    <?php
    include "../connection.php";

    if (isset($_POST['delete'])) {
        $selected_option = $_POST['file_name'];
        $values = explode('|', $selected_option);
        $file_name = $values[0];
        $course_id = $values[1];

        $query = "SELECT `pdf` FROM `uploaded_files` WHERE `pdf` = '$file_name' AND `course_id` = '$course_id' AND `teacher_id` = '$_SESSION[idt]'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $file_path = "files/" . $row['pdf'];

            if (unlink($file_path)) {
                $deleteQuery = "DELETE FROM `uploaded_files` WHERE `pdf` = '$row[pdf]'";
                $deleteResult = mysqli_query($conn, $deleteQuery);

                if ($deleteResult) {
                    echo "<script>alert('File removed successfully');</script>";
                } else {
                    echo "<script>alert('Failed to remove file');</script>";
                }
            } else {
                echo "<script>alert('Failed to delete file from the server');</script>";
            }
        } else {
            echo "<script>alert('File not found');</script>";
        }
    }

    $query = "SELECT * FROM `uploaded_files` WHERE `teacher_id` = '$_SESSION[idt]'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <form action="" method="POST" onsubmit="return confirmDelete();">
            <div>
                <label for="file_name"><h1>Select File: </h1></label>
                <select id="file_name" name="file_name">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $course_id = $row['course_id'];
                        $teacher_id = $row['teacher_id'];
                        $file_name = $row['pdf'];
                        echo "<option value='$file_name|$course_id'>$file_name | $course_id</option>";
                    }
                    ?>
                </select>
                <button class="]button" type="submit" name="delete">Remove</button>
            </div>
        </form>
        <?php
    } else {
        echo "<h1>No files found.</h1>";
    }
    ?>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete the selected file?");
        }
    </script>
</body>
</html>