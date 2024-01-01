<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
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
        body {
      display: block;
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
        <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
    <h1>Your Courses</h1>
    <br>
    
    <?php
        $id =$_SESSION['idt'];
        include '../connection.php';
        $query = "SELECT * FROM course where `teacher_id` = '$id' ";
        $result = mysqli_query($conn, $query);
        echo "<div class='grid'>"; 
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='card'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<h3>" . $row["id"] . "</h3>";
            echo "<p>Teacher Id: " . $row["teacher_id"] . "</p>";
            echo "<p>Course Description: " . $row["description"] . "</p>";
            echo "<p>Credit hours:" . $row["credit_hour"] . "</p>";
            echo "</div>";
        }
        echo "</div>"; 
    ?>
</body>
</html>