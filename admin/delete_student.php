<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
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

        .checkbox-label {
            margin-left: 10px;
            font-size: 16px;
        }

        .submit-container {
            text-align: center;
            margin-top: 30px;
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
    
    if (isset($_POST['select'])) {
        if (!empty($_POST['selectedStudents'])) {
            $selectedStudents = $_POST['selectedStudents'];

            foreach ($selectedStudents as $studentId) {
                $query = "DELETE FROM student WHERE id = '$studentId'";
                mysqli_query($conn, $query);
            }
        } else {
            echo "<script>alert('You didn\'t select any student');</script>";
        }
    }
    
    $query = "SELECT `id`, `name`, `major`, `email` FROM student";
    $result = mysqli_query($conn, $query);
    ?>

    <div class="container">
        <h1>List of Students</h1>
        
        <form method="POST" action="" onsubmit="return confirmDelete();">
            <div class="grid">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $studentId = $row['id'];
                    $studentName = $row['name'];
                    $studentMajor = $row['major'];
                    $studentEmail = $row['email'];
                    echo "<div class='card'>";
                    echo " <h3>$studentName</h3>";
                    echo " <p>ID: $studentId</p>";
                    echo " <p>Major: $studentMajor</p>";
                    echo " <p>Email: $studentEmail</p>";
                    echo "<div class='checkbox-container'>";
                    echo " <input type='checkbox' name='selectedStudents[]' value='$studentId' id='checkbox-$studentId' class='checkbox-input'>";
                    echo " <label class='checkbox-label' for='checkbox-$studentId'>Delete</label>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="submit-container">
                <button type="submit" class="button" name="select">Delete Student</button>
            </div>
        </form>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete the selected student?");
        }
    </script>
</body>
</html>