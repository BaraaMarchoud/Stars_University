<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <style>
        body{
            height: 120vh;
        }
        .register-box{
            max-height: 100%;
        }
        .btn_logout{
            margin-left: 80px ;
        }
    </style>
    <div class="register-box">
        <h2>Add Student</h2>
        <form action="" method="POST">
            <div class="user-box">
                <input type="text" name="id" required>
                <label>ID</label>
            </div>
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="major" required>
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
            <button type="submit" class="btn_logout" name="add">Register</button>
            <button type="submit" class="btn_logout">
                <a href="login.php">Login</a>
            </button>
        </form>
    </div>

    <?php 
    include "connection.php";
    if(isset($_POST['add'])) {
        $id = $_POST['id'];
        $name  = $_POST['username'];
        $major  = $_POST['major'];
        $email  = $_POST['email'];
        $pass = $_POST['password'];
        $confpass = $_POST['confirm_password'];
        
        if($pass != $confpass){
            echo "<script>alert('The passwords do not match')</script>";
        }else{
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `student`(`id`, `name`, `major`, `email`, `Password`) VALUES ('$id','$name','$major','$email','$hashedPassword')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('You registered successfully. Login Now')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }



    ?>

</body>
</html>