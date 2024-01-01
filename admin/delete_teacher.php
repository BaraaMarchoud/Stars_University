<!DOCTYPE html>
<html>
<head>
    <title>Delete Teacher</title>
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
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            opacity: 0;
            animation: fade-in 0.5s ease-in-out forwards;
        }

        .checkbox-input {
            transform: scale(1);
            transition: transform 0.3s ease;
        }

        .checkbox-input:checked {
            transform: scale(1.1);
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .button{
            margin-left: 270px;
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
    <?php
    include '../connection.php';
    
    if (isset($_POST['delete'])) {
        if (!empty($_POST['selectedteachers'])) {
            $selectedteachers = $_POST['selectedteachers'];
            $teacherIds =  $_POST['selectedteachers'];
            foreach ($teacherIds as $teacherId) {
            $query = "DELETE FROM teacher WHERE id = $teacherId";
                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Teacher deleted successfully.')</script>";
                } else {
                    echo "<script>alert('An error occurred while deleting the teacher.')</script>";
            }
          }
        }

    }
    
    $query = "SELECT * FROM teacher";
    $result = mysqli_query($conn, $query);
    ?>

    <div class="container">
        <h1>List of Teachers</h1>
        
        <form action="" method="POST" onsubmit="return confirmDelete();">
            <div class="grid">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $teacherId = $row['id'];
                    $teacherName = $row['name'];
                    $teacherprofession = $row['profession'];
                    $teacherEmail = $row['email'];
                    $teacherexperience = $row['experience year'];
                    echo "<div class='card'>";
                    echo " <h3>$teacherName</h3>";
                    echo " <p>ID: $teacherId</p>";
                    echo " <p>profession: $teacherprofession</p>";
                    echo " <p>Email: $teacherEmail</p>";
                    echo " <p>Experience Year: $teacherexperience</p>";
                    echo "<div class='checkbox-container'>";
                    echo " <input type='checkbox' name='selectedteachers[]' value='$teacherId' id='checkbox-$teacherId' class='checkbox-input'>";
                    echo " <label class='checkbox-label' for='checkbox-$teacherId'>Delete</label>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <br>
            <button class="button" type="submit" name="delete">Delete Selected teachers</button>
        </form>
    </div>
    
</body>
</html>