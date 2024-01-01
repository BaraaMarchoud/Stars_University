<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
    <link rel="stylesheet" href="../stylee.css">
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
            height: 120vh;
        }
        .register-box{
            max-height: 97%;
        }
        .button{
            margin-left: 110px;
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
    <div class="register-box">
        <h2>Add Teacher</h2>
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
                <input type="text" name="profession" required>
                <label>profession</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="text" name="exp" required>
                <label>Experience Year</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            
            <button type="submit" class="button" name="add">Add</button>

        </form>
        </div>
        <?php 
        include"../connection.php";
        if(isset($_POST['add'])) {
            $id = $_POST['id'];
            $name  = $_POST['username'];
            $profession  = $_POST['profession'];
            $email  = $_POST['email'];
            $pass=$_POST['password'];
            $confpass=$_POST['confirm_password'];
            $experience_year  = $_POST['exp'];
            
            if($pass != $confpass){
                echo"<script>alert('The passwords are not matced')</script>";
                
            }else{
                $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `teacher`(`id`, `name`, `profession`, `email`, `Password` ,`experience year`) VALUES ('$id','$name','$profession','$email','$hashedPassword' , '$experience_year')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Teacher Added successfully.')</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);

            }
          }
        }
        ?>
    

</body>
</html>
