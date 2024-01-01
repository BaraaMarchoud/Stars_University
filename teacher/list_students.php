<!DOCTYPE html>
<html>
<head>
    <title>List of Students</title>
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
    .container{
        width: 900px;
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
        <?php
    $query = "SELECT `id`, `name`, `major`, `email` FROM student";
    $result = mysqli_query($conn, $query);
    ?>
    <div class="container">
        <h1>List of Students</h1>
        
            <?php
            echo"<div class='grid'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $studentId = $row['id'];
                $studentName = $row['name'];
                $studentMajor = $row['major'];
                $studentEmail = $row['email'];
                echo"<div class='card'>";
                echo" <h3>  $studentName </h3>";
                echo" <p><strong>ID: </strong> $studentId </p>";
                echo" <p><strong>Major: </strong> $studentMajor </p>";
                echo" <p><strong>Email: </strong> $studentEmail </p>";
                echo"</div>";
            }
            echo"</div>";
            ?>
        </div>
    </div>
</body>
</html>