<!DOCTYPE html>
<html>
<head>
    <title>Update Teachers</title>
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
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 5px;
        }
        .button{
            margin-left: 220px;
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
</head>
<body>
    <div class="container">
        <h1>Update Teachers</h1>

        <?php
        include '../connection.php';

        if (isset($_POST['select'])) {
            if (!empty($_POST['selected_teachers'])) {
                $selectedTeachers = $_POST['selected_teachers'];
                echo "<h3>Edit Teacher</h3>";
                echo "<form action='' method='post'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
                echo "<th>Profession</th>";
                echo "<th>Experience Year</th>";
                echo "</tr>";
                foreach ($selectedTeachers as $selectedTeacherId) {
                    $query = "SELECT * FROM teacher WHERE id='$selectedTeacherId'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $name = $row['name'];
                    $profession = $row['profession'];
                    $experience_year = $row['experience year'];

                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td><input type='text' name='name$id' value='$name' required></td>";
                    echo "<td><input type='text' name='profession$id' value='$profession' required></td>";
                    echo "<td><input type='number' name='experience_year$id' value='$experience_year' required></td>";
                    echo "<td><input type='hidden' name='selected_teachers[]' value='$id'></td>";

                    echo "</tr>";
                }
                echo "</table>";

                echo "<button type='submit' class='button' name='update'>Update</button>";
                echo "</form>";
            } else {
                echo "<p>No teacher selected for updating.</p>";
            }
        } elseif (isset($_POST['update'])) {
            if (!empty($_POST['selected_teachers'])) {
                $selectedTeachers = $_POST['selected_teachers'];

                foreach ($selectedTeachers as $selectedTeacherId) {
                    $name = $_POST['name' . $selectedTeacherId];
                    $profession = $_POST['profession' . $selectedTeacherId];
                    $experience_year = $_POST['experience_year' . $selectedTeacherId];

                    $query = "UPDATE teacher SET `name` ='$name', `profession`='$profession', `experience year`='$experience_year' WHERE id='$selectedTeacherId'";
                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Teacher updated successfully.')</script>";
                    } else {
                        echo "<script>alert('An error occurred while updating the teacher.')</script>";
                    }
                }
            } else {
                echo "<p>No teacher selected for updating.</p>";
            }
        }

        $query = "SELECT * FROM teacher";
        $result = mysqli_query($conn, $query);

        echo "<form action='' method='post'>";
        echo "<table>";
        echo "<tr align='center'>";
        echo "<th>Select</th>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Profession</th>";
        echo "<th>Experience Year</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $profession = $row['profession'];
            $experience_year = $row['experience year'];

            echo "<tr align='center'>";
            echo "<td><input type='checkbox' name='selected_teachers[]' value='$id'></td>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$profession</td>";
            echo "<td>$experience_year</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<button type='submit' class='button' name='select'>Select Teacher</button>";
        echo "</form>";
        ?>
    </div>
</body>
</html>