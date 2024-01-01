<?php
session_start();
include '../connection.php';
$sql = "SELECT * FROM teacher where `id` =  '$_SESSION[idt]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
$teacherId = $_SESSION['idt'];

$query = "SELECT `id`, `name` FROM `course` WHERE `teacher_id`= '$teacherId'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <link rel="stylesheet" href="teach_style.css">
    <style>
        body {
            height: 100vh;

        }

        .course-select {
            margin-bottom: 20px;
        }


        img {
            left: 20px;
            top: 20px;
            position: fixed;
            height: 70px;
            width: 70px;
            border-radius: 50px;
        }
        .button{
            margin-right: -500px;
        }
    </style>
    <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
</head>
<body>
    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Upload File</h1>";
            echo "<form method='POST' action=''> ";
            echo "<div class='course-select'>";
            echo "<label for='course'><strong>Select Course:  </strong></label>";
            echo "<select name='courseId' id='course'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                echo "<option value='$id'>$id | $name  </option>";
                
            }
            echo "</select>";
            echo"<br>";
            echo "<button class='button' name='sel' type='submit'>Select</button>";
            echo "</div>";
            echo "</form>";
            echo "<div class='grid'>";
            if (isset($_POST['sel'])) {
                $selectedCourseId = $_POST['courseId'];
                echo "<form method='POST' action='' enctype='multipart/form-data'>";
                echo "</div>";
                echo "<input type='hidden' name='courseId' value='$selectedCourseId'>";
                echo "<label for='pdf'><strong>Choose File: </strong></label>";
                echo "<input type='file' name='pdf' id='pdf'>";
                echo "<input type='submit' class='button' name='up' value='Upload'>";
                echo "</form>";
            }
        } else {
            echo "<h1>You haven't published any courses yet.</h1>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

<?php
include "../connection.php";
if (isset($_POST['up'])) {
    $courseId = $_POST['courseId'];
    $teacherId = $_SESSION['idt'];
    $pdf_path = $_FILES['pdf']['name'];
    $tmp_name = $_FILES['pdf']['tmp_name'];
    $error =$_FILES['pdf']['error'];

   if($error === 0){
    $pdf_ex = pathinfo($pdf_path, PATHINFO_EXTENSION);
    $allowed_exs = array("pdf","docx","txt","pptx");
    if(in_array($pdf_ex , $allowed_exs)){
        $query = "INSERT INTO `uploaded_files`(`course_id`, `teacher_id`, `pdf`) VALUES ('$courseId','$teacherId','$pdf_path')";
        $res = mysqli_query($conn, $query);
        if($res){
            move_uploaded_file($tmp_name, 'files/' .$pdf_path);

            echo"<script>alert('Uploaded Successfully');</script>";

        }else{
            echo"<script>alert('You have already uploaded this file');</script>";
        }
    }else{
        echo"<script>alert('File must be pdf, word, txt, or pptx doucument');</script>";
    }
   }
}
?>
