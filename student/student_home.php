<!DOCTYPE html>
<html>
<head>
  <title>Student Home Page</title>
  <link rel="stylesheet" href="stdd_style.css">
  <?php
    include '../connection.php';
    session_start();
    $sql = "SELECT * FROM student where `id` =  '$_SESSION[ids]'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
    header("location: logout.php");
    }
    ?>
</head>
<body>
    <style>
        body{
            height: 100vh;
        }
        h2{
            margin-left: 520px;
        }

    </style>
  <div class="menu">
    <button><a href="student_home.php">Home</a></button>
    <button><a href="teacher.php">Teachers</a></button>
    <button><a href="courses.php">Course</a></button>
    <button><a href="enrollment_course.php">Enrollment Courses</a></button>
    <button><a href="liked_course.php">Liked Courses</a></button>
    <button><a href="uploaded_files.php">Files</a></button>
    <button><a href="logout.php">Logout</a></button>
  </div>
  <br>
  <h1>Welcome <?php  echo$_SESSION['names'] ?> !</h1>
  <br><br><br><br>

<form method="POST" action="">
    <?php
     include '../connection.php';
     $studentId = $_SESSION['ids'];
 
     $enrolledCoursesQuery = "SELECT c.id, c.name, c.credit_hour
             FROM enrollments_courses ec
             JOIN course c ON c.id = ec.course_id
             WHERE ec.student_id = '$studentId'";
            $enrolledCoursesResult = mysqli_query($conn, $enrolledCoursesQuery);
 
     echo "<table>";
     echo "<tr><th>Course Name</th><th>Course ID</th><th>Credit Hours</th><th>Grade</th></tr>";
     while ($courseRow = mysqli_fetch_array($enrolledCoursesResult)) {
         $courseId = $courseRow['id'];
         echo "<tr>";
         echo "<td>" . $courseRow["name"] . "</td>";
         echo "<td>" . $courseRow["id"] . "</td>";
         echo "<td>" . $courseRow["credit_hour"] . "</td>";
         echo "<td><input type='text' name='grade[]' class = 'grade-button'placeholder='Enter Grade' required></td>";
         echo "<input type='hidden' name='course_id[]' value='" . $courseId . "'>";
         echo "</tr>";
     }
     echo "</table>";
 
     if (isset($_POST['calculate_gpa'])) {
        if(mysqli_num_rows($enrolledCoursesResult)==0){

            echo" <br><h1>You Are not enrolled in any course</h1> <br>";
        }else{
         $courseIds = $_POST['course_id'];
         $grades = $_POST['grade'];
 
         $totalCredits = 0;
         $totalGradePoints = 0;
 
         foreach ($courseIds as $index => $courseId) {
             $creditQuery = "SELECT credit_hour FROM course WHERE id = '$courseId'";
             $creditResult = mysqli_query($conn, $creditQuery);
 
             if ($creditResult) {
                 $row = mysqli_fetch_array($creditResult);
                 $creditHours = $row['credit_hour'];
             } else {
                 echo "Error: " . mysqli_error($conn);
             }
 
             $grade = $grades[$index];
 
             $gradePoints = calculateGradePoints($grade);
 
             $totalGradePoints += $gradePoints * $creditHours;
             $totalCredits += $creditHours;
         }
 
         $gpa = $totalGradePoints / $totalCredits;
         $letterGrade = getLetterGrade($gpa);
         $gpa = number_format($gpa, 2);
 
         echo "<div class='gpa'>";
         echo "<h2>Your GPA: " . $gpa . " (" . $letterGrade . ")</h2>";
         echo "</div>";
     }
    }
 
    function calculateGradePoints($grade)
{
    $grade = intval($grade);

    if ($grade >= 90) {
        return 4.0;
    } elseif ($grade >= 80) {
        return 3.0 + ($grade - 80) / 10;
    } elseif ($grade >= 70) {
        return 2.0 + ($grade - 70) / 10;
    } elseif ($grade >= 60) {
        return 1.0 + ($grade - 60) / 10;
    } else {
        return 0.0;
    }
}

function getLetterGrade($gpa)
{
    if ($gpa >= 4) {
        return "A - Excellent";
    } elseif ($gpa >= 3.5) {
        return "B+ - Very Good";
    } elseif ($gpa >= 3.0) {
        return "B - Good";
    } elseif ($gpa >= 2.5) {
        return "C+ - Above Average";
    } elseif ($gpa >= 2.0) {
        return "C - Average";
    } elseif ($gpa >= 1.5) {
        return "D+ - Fair";
    } elseif ($gpa >= 1.0) {
        return "D - Poor";
    } else {
        return "F - Fail";
    }
}
 
     ?>
    <input type="submit" class="button" name="calculate_gpa" id="calc" value="Calculate GPA">
</form>

</body>
</html>