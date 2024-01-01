<!DOCTYPE html>
<html>
<head>
    <title>List of coursets</title>
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
    <?php
    include '../connection.php';
    $query = "SELECT *FROM course";
    $result = mysqli_query($conn, $query);
    ?>
    <style>
        .grid{
            width: 1100px;
            margin-left: -150px;
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
        <h1>List of Courses</h1>
        <div class="grid">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $courseId = $row['id'];
                $coursetName = $row['name'];
                $tid = $row['teacher_id'];
                $coursetdescription = $row['description'];
                $coursetcredit_hour = $row['credit_hour'];
                echo"<div class='card'>";
                echo" <h3>  $coursetName </h3>";
                echo "<p><strong>ID:</strong> $courseId</p>";
                echo" <p><strong>Teacher ID: </strong> $tid </p>";
                echo" <p><strong>Description: </strong> $coursetdescription </p>";
                echo" <p><strong>Credit Hour: </strong> $coursetcredit_hour </p>";
                echo"</div>"
                ?>

                

                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>