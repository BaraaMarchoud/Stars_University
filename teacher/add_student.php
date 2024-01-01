<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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
        .button{
            margin-left: 115px;
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
    <div class="bod">
    <div class="register-box">
        <h2>Add Student</h2>
        <form action="" method="post">
            <div class="user-box">
                <input type="id" name="id" required>
                <label>ID</label>
            </div>
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="major" name="major" required>
                <label>Major</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            <button type="submit" class="button" name="submit">Add</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $major = $_POST['major'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                echo "<script>alert('The passwords do not match.')</script>";
            } else {
                include '../connection.php';
                $query = "INSERT INTO student (id, name, major, email) VALUES ('$id', '$username', '$major', '$email')";
                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('A new student has been added to the system.')</script>";
                } else {
                    echo "<script>alert('An error occurred while adding the student.')</script>";
                }
            }
        }
        ?>
    </div>
    </div>
</body>
</html>