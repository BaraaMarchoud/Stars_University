<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="stylee.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="user-box">
                <input type="text" name="id" required>
                <label>Your Id</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="btn">
            <button type="submit" name="submitt" class="btn_login">Log in</button>
            </button>
            </div>
        </form>
        <button type="submit" class="btn_logout" > <a href="register.php" >Register</a>
    </div>
    <?php
include 'connection.php';

if (isset($_POST['submitt'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    session_start();

    // Query for admin table
    $querya = "SELECT * FROM admin WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $querya);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resa = mysqli_stmt_get_result($stmt);
    $nbrowsa = mysqli_num_rows($resa);
    $rowa = mysqli_fetch_assoc($resa);

    // Query for teacher table
    $queryt = "SELECT * FROM teacher WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $queryt);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $rest = mysqli_stmt_get_result($stmt);
    $nbrowst = mysqli_num_rows($rest);
    $rowt = mysqli_fetch_assoc($rest);

    // Query for student table
    $querys = "SELECT * FROM student WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $querys);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $ress = mysqli_stmt_get_result($stmt);
    $nbrowss = mysqli_num_rows($ress);
    $rows = mysqli_fetch_array($ress);

    if ($nbrowsa && password_verify($password, $rowa['password'])) {
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['ida'] = $rowa['id'];
        $_SESSION['namea'] = $rowa['name'];
        header("location: admin/admin_home.php");
    } else if ($nbrowst && password_verify($password, $rowt['password'])) {
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['idt'] = $rowt['id'];
        $_SESSION['namet'] = $rowt['name'];
        header("location: teacher/teacher_home.php");
    } else if ($nbrowss && password_verify($password, $rows['Password'])) {
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['ids'] = $rows['id'];
        $_SESSION['names'] = $rows['name'];
        header("location: student/student_home.php");
    } else {
        echo "<script>alert('Username or password is incorrect. Please try again.');</script>";
    }
}
?>

    <script src="app.js"></script>
</body>
</html>