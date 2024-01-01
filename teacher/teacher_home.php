<!DOCTYPE html>
<html>
<head>
    <title>Teacher Home Page</title>
    <link rel="stylesheet" href="teach_style.css">
    
</head>
<body>
    <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM teacher where `id` =  '$_SESSION[idt]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
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
        <a href="teacher_home.php"><img src="../images/logo.jpg" alt=""></a>
<a href="logout.php" class="logout-button" id="log">Logout</a>

    <div class="container">
        <h1>Welcome <?php  echo$_SESSION['namet'] ?> !</h1>
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
                <a href="update_student.php" class="button">Update</a>
            </div>
            <div class="card">
                <h3>Delete Student</h3>
                <p>Delete a student from Your courses.</p>
                <a href="delete_student.php" class="button">Delete</a>
            </div>
            <div class="card">
                <h3>Add New Student</h3>
                <p>Add a new student to the system.</p>
                <a href="add_student.php" class="button">Add</a>
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
                <p>Update the details of a Course.</p>
                <a href="update_course.php" class="button">Update</a>
            </div>
            <div class="card">
                <h3>Delete Course</h3>
                <p>Delete a student from the system.</p>
                <a href="delete_course.php" class="button">Delete</a>
            </div>
            <div class="card">
                <h3>Add New Course</h3>
                <p>Add a new course to the system.</p>
                <a href="add_course.php" class="button">Add</a>
            </div>
            <div class="card">
                <h3>Upload File</h3>
                <p>Upload a pdf file for one of your courses.</p>
                <a href="upload_file.php" class="button">Upload</a>
            </div>
            <div class="card">
                <h3>Delete File</h3>
                <p>Delete from the files you uploaded.</p>
                <a href="delete_file.php" class="button">Delete</a>
            </div>
        </div>
    </div>
    
</body>
</html>
