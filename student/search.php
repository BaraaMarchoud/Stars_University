<?php
include '../connection.php';
session_start();
$studentId = $_SESSION['ids'];

if (isset($_POST['search'])) {
    $searchValue = $_POST['search'];
    $query = "SELECT * FROM `course` WHERE lower(`name`) LIKE '%$searchValue%'";
    $result = mysqli_query($conn, $query);
    echo "<div class='grid'>";
        while ($row = mysqli_fetch_array($result)) {
        $courseId = $row['id'];
        $name = "Select `name` From `teacher` where id =  $row[teacher_id]";
        $res = mysqli_query($conn,$name);
        while ($rows = mysqli_fetch_array($res)) {
        
        echo "<div class='card' id='course-grid'>";
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<h3>" . $row["id"] . "</h3>";
        echo "<p><strong>Teacher name: </strong>" . $rows["name"] . "</p>";
        echo "<p><strong>Course Description: </strong>" . $row["description"] . "</p>";
        echo "<p><strong>Credit hours: </strong>" . $row["credit_hour"] . "</p>";
        echo "<input type='hidden' name='course_id' value='" . $courseId . "'>";


        $enrollmentQuery = "SELECT * FROM enrollments_courses WHERE student_id = '$studentId' AND course_id = '$courseId'";
        $enrollmentResult = mysqli_query($conn, $enrollmentQuery);
        $isEnrolled = mysqli_num_rows($enrollmentResult) > 0;

        $likedQuery = "SELECT * FROM liked_courses WHERE student_id = '$studentId' AND course_id = '$courseId'";
        $likedResult = mysqli_query($conn, $likedQuery);
        $isLiked = mysqli_num_rows($likedResult) > 0;

        if (!$isEnrolled) {
            echo "<button type='submit' name='enroll[$courseId]' class='icon-button'><i class='fa fa-plus'></i></button>";
        } else {
            echo "<p><i class='fa fa-check-circle'></i> Enrolled</p>";
        }

        if (!$isLiked) {
            echo "<button type='submit' name='like[$courseId]' class='icon-button'><i class='fa fa-heart'></i></button>";
        } else {
            echo "<p><i class='fa fa-heart' style='color: red;'></i> Liked</p>";
        }

        echo "</div>";
    }
    }

if (isset($_POST['enroll'])) {
    foreach ($_POST['enroll'] as $courseId => $enrollButton) {
        $enrollmentQuery = "SELECT * FROM enrollments_courses WHERE student_id = '$studentId' AND course_id = '$courseId'";
        $enrollmentResult = mysqli_query($conn, $enrollmentQuery);
        $isEnrolled = mysqli_num_rows($enrollmentResult) > 0;


        if (!$isEnrolled) {
            $credit = "SELECT * FROM course WHERE `id` = '$courseId'";
            $creditres = mysqli_query($conn, $credit);
            
            if ($creditres) {
                $row = mysqli_fetch_array($creditres);
                $credits = $row['credit_hour'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            $creditQuery = "SELECT SUM(c.credit_hour) AS total_credits
                FROM enrollments_courses ec
                JOIN course c ON c.id = ec.course_id
                WHERE ec.student_id = '$studentId'";
            $creditResult = mysqli_query($conn, $creditQuery);

            if ($creditResult) {
                $row = mysqli_fetch_array($creditResult);
                $totalCredits = $row['total_credits'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            $sum = $credits + $totalCredits;
            if($sum > 19){
                echo"<script>alert('You exceeded the maximum allowed credits, your credits $totalCredits.');</script>";
            }else{
            $enrollQuery = "INSERT INTO enrollments_courses (`student_id`, `course_id`) VALUES ('$studentId', '$courseId')";
            if (mysqli_query($conn, $enrollQuery)) {
                echo "<script>";
                echo "setTimeout(function() {";
                echo "    alert('Enrolled Successfully!');";
                echo "    window.location.href = 'courses.php';";
                echo "}, 0);";;
                echo "</script>";;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
            echo "<script>alert('You have already enrolled in this course.');</script>";
        }
    }
    }


if (isset($_POST['like'])) {
    foreach ($_POST['like'] as $courseId ) {
        $likedQuery = "SELECT * FROM liked_courses WHERE student_id = '$studentId' AND course_id = '$courseId'";
        $likedResult = mysqli_query($conn, $likedQuery);
        $isLiked = mysqli_num_rows($likedResult) > 0;

        if (!$isLiked) {
            $likeQuery = "INSERT INTO liked_courses (`student_id`, `course_id`) VALUES ('$studentId', '$courseId')";
            if (mysqli_query($conn, $likeQuery)) {
                echo "<script>";
                echo "setTimeout(function() {";
                echo "    alert('Liked Successfully!');";
                echo "    window.location.href = 'courses.php';";
                echo "}, 0);";;
                echo "</script>";;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('You have already liked this course.');</script>";
        }
    }
}
}

mysqli_close($conn);
?>