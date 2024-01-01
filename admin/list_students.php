<!DOCTYPE html>
<html>
<head>
    <title>List of Students</title>
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
    $query = "SELECT `id`, `name`, `major`, `email` FROM student";
    $result = mysqli_query($conn, $query);
    ?>

    <div class="container">
        <h1>List of Students</h1>
        <div class="grid">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $studentId = $row['id'];
                $studentName = $row['name'];
                $studentMajor = $row['major'];
                $studentEmail = $row['email'];
                echo"<div class='card'>";
                echo" <h3>  $studentName </h3>";
                echo" <p>ID:  $studentId </p>";
                echo" <p>Major:  $studentMajor </p>";
                echo" <p>Email:  $studentEmail </p>";
                echo"</div>"
                ?>

                

                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>