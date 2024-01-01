<!DOCTYPE html>
<html>
<head>
    <title>Admin Home Page</title>
</head>
<body>
<?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM `admin` where `id` =  '$_SESSION[ida]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
<link rel="stylesheet" href="ad_style.css">
    <div class="container">
        <style>
            .container img{
                left:20px;
                top: 20px;
                position: fixed;
                height: 70px;
                width: 70px;
                border-radius: 50px;
            }
        </style>
        <a href="admin_home.php"><img src="../images/logo.jpg" alt=""></a>
        
    <h1>Welcome <?php  echo$_SESSION['namea'] ?> !</h1>
        <h2>Teachers Options</h2>
        <div class="grid">
            <div class="card">
                <h3>List All Teachers</h3>
                <p>View a list of all teachers in the system.</p>
                <a href="teacher.php" class="button">View</a>
            </div>
            <div class="card">
                <h3>Update Teacher</h3>
                <p>Update the details of a teacher.</p>
                <a href="update_teacher.php" class="button">Update</a>
            </div>
            <div class="card">
                <h3>Delete Teacher</h3>
                <p>Delete a teacher from the system.</p>
                <a href="delete_teacher.php" class="button">Delete</a>
            </div>
            <div class="card">
                <h3>Add New Teacher</h3>
                <p>Add a new teacher to the system.</p>
                <a href="add_teacher.php" class="button">Add</a>
            </div>
            <div class="card">
                <h3>Reset Teacher Password</h3>
                <p>Reset the password of a teacher.</p>
                <a href="reset_teach_pass.php" class="button">Reset</a>
            </div>
        </div>
        <h2>Students Options</h2>
        <div class="grid">
            <div class="card">
                <h3>List All Students</h3>
                <p>View a list of all students in the system.</p>
                <a href="list_students.php" class="button">View</a>
            </div>
            <div class="card">
                <h3>Update Student</h3>
                <p>Update the details of a student.</p>
                <a href="update_std.php" class="button">Update</a>
            </div>
            <div class="card">
                <h3>Delete Student</h3>
                <p>Delete a student from the system.</p>
                <a href="delete_student.php" class="button">Delete</a>
            </div>
            <div class="card">
                <h3>Add New Student</h3>
                <p>Add a new student to the system.</p>
                <a href="add_student.php" class="button">Add</a>
            </div>
            <div class="card">
                <h3>Reset Student Password</h3>
                <p>Reset the password of a student.</p>
                <a href="reset_password.php" class="button">Reset</a>
            </div>
        </div>
        
        <h2>Courses Options</h2>
        <div class="grid">
            <div class="card">
                <h3>List All Courses</h3>
                <p>View a list of all courses in the system.</p>
                <a href="list_courses.php" class="button">View</a>
            </div>
            <div class="card">
                <h3>Update Course</h3>
                <p>Update the details of a course.</p>
                <a href="update_course.php" class="button">Update</a>
            </div>
            <div class="card">
                <h3>Delete Course</h3>
                <p>Delete a course from the system.</p>
                <a href="delete_course.php" class="button">Update</a>
            </div>
            </div>
            <a href="logout.php" class="button" id="log">logout</a>
    </div>
    
    
</body>
</html>
