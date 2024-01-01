<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
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
            height: 100vh;
            justify-content: center;
            display: flex;
            flex-direction: column;
        }
        .button{
            right: 20px;
            bottom: 20px;
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
    if (isset($_POST['submit'])) {
        echo '<h2>Add New Course</h2>';
        echo '<form  action="" method="post">';
        echo '<table>';
        echo '<tr>
                <td>ID:</td>
                <td><input type="text" id="id" name="id" required></td>
            </tr>';
        echo '<tr>
                <td>Name:</td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>';
        echo '<tr>
                <td>Description:</td>
                <td><input type="text" id="description" name="description" required></td>
            </tr>';
        echo '<tr>
                <td>Credit Hour:</td>
                <td><input type="number" id="credit_hour" name="credit_hour" required></td>
            </tr>';
        echo '<tr>
                <td colspan="2"><input type="submit" class="button" value="Submit" name="submitt"></td>
            </tr>';
        echo '</table>';
        echo '</form>';
}
?>
        <form method='POST'>
        </form>
        <?php
        include '../connection.php';
        $teacherId = $_SESSION['idt'];

        if (isset($_POST['submitt'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $creditHour = $_POST['credit_hour'];
            $query = "INSERT INTO course (id, name, teacher_id, description, credit_hour) VALUES ('$id', '$name', '$teacherId', '$description', '$creditHour')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Course added successfully.')</script>";
            } else {
                echo "<script>alert('An error occurred while adding the course.')</script>";
            }
        }

        
        $query = "SELECT * FROM course where `teacher_id` = $teacherId";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if($num){
            echo "<h3>Course List</h3>";
        echo "<table border='2'>
            <tr align='center'>
                <td>Course ID</td>
                <td>Course Name</td>
                <td>Teacher ID</td>
                <td>Description</td>
                <td>Credit Hour</td>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr align='center'>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$teacherId</td>
                    <td>$row[description]</td>
                    <td>$row[credit_hour]</td>
                </tr>";
        }
        echo "</table>";
        echo"<br><br>";
    }
    echo"<br><br>";
        ?>
        <form  action="" method="post">
        <input type="submit" value="Add new Course" class="button" name="submit">

        </form>

    </div>
</body>
</html>