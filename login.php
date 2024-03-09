<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("Location: index.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dependent Dropdown List</title>
    <link rel="stylesheet" href="form_styles.css">
</head>
<body>

    
<div class="container col-md-5">
<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "<div class='alert alert-danger'>SQL Error: ".mysqli_error($conn)."</div>";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email); // Bind email as parameter
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result->num_rows > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user;
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email not found</div>";
            }
        }
    }
?>
    <form action="login.php" method="post">
        

            <div class="select_option col-md-12">
                <h4> Login</h4>
                
                <input type="email" class="form-control"  placeholder="Email" id="email" name="email">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            
                
                <div class="login">
                <p>Not Registered yet? <a href="registration.php">Register Here</a></p>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
