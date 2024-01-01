<!DOCTYPE html>
<html>
<head>
    <title>Reset Teacher's Password</title>
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
     body{
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
<?php
    include '../connection.php';
    $query = "SELECT `id`, `name` FROM teacher";
    $result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Choose teacher</h1>
    <div class="teacher-list">
        <form action="" method="POST">
            <label for="teacher">Select a teacher:</label>
            <select name="teacher" id="teacher" required>
                <option value="">Choose a teacher</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $teacherId = $row['id'];
                    $teacherName = $row['name'];
                    echo "<option value=\"$teacherId\">$teacherName (ID: $teacherId)</option>";
                }
                ?>
            </select>
            <button type="submit" name="resetPassword" class="res">Reset Password</button>
        </form>
        <?php 
        if(isset($_POST['resetPassword'])) {
            $selectedteacherId = $_POST['teacher'];
            $query = "SELECT `id`, `name` FROM teacher WHERE `id` = $selectedteacherId";
            $result = mysqli_query($conn, $query);
            $teacher = mysqli_fetch_assoc($result);

            echo "<form action=\"\" method=\"POST\">";
            echo "<h3>Reset Password for {$teacher['name']} (ID: {$teacher['id']})</h3>";
            echo "<input type=\"hidden\" name=\"teacherId\" value=\"{$teacher['id']}\">"; 
            echo "<div class=\"user-box\">";
            echo "<input type=\"password\" name=\"password\" id=\"password\" required>";
            echo "<label for=\"password\"> New Password</label>";
            echo "</div>";
            echo"<br>";
            echo "<div class=\"user-box\">";
            echo "<input type=\"password\" name=\"confirmPassword\" id=\"confirmPassword\" required>";
            echo "<label for=\"confirmPassword\"> Confirm Password</label>";
            echo "</div>";
            echo"<br>";
            echo "<button type=\"submit\" name=\"updatePassword\">Update Password</button>";
            echo "</form>";
        }
        if(isset($_POST['updatePassword'])) {
            $selectedteacherId = $_POST['teacherId']; 
            $newPassword = $_POST['password'];
            $confirmedPassword = $_POST['confirmPassword'];

            if ($newPassword == $confirmedPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $query = "UPDATE teacher SET password = '$hashedPassword' WHERE id = $selectedteacherId";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<p>Password updated successfully!</p>";
                } else {
                    echo "<p>Failed to update password. Please try again.</p>";
                }
            } else {
                echo "<p>Passwords do not match. Please try again.</p>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>