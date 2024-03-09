<?php
session_start();
require_once "database.php";

if(isset($_SESSION["user"])){
    header("Location: login.php");
    exit(); // Ensure that the script stops executing after redirection
}

if(isset($_POST["submit"])){
    // Get form data
    $lastName = $_POST["LastName"];
    $firstName = $_POST["FirstName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeat_password"];
    $contactNumber = $_POST["contact_number"];

    // Initialize an array to store errors
    $errors = array();

    // Validate form inputs
    if (empty($lastName) || empty($firstName) || empty($email) || empty($password) || empty($repeatPassword) || empty($contactNumber)) {
        $errors[] = "All fields are required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if (!is_numeric($contactNumber)) {
        $errors[] = "Contact number must be numeric";
    }

    if ($password != $repeatPassword) {
        $errors[] = "Passwords do not match";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database
        $sql = "INSERT INTO user(Last_Name, First_Name, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $lastName, $firstName, $email, $hashedPassword, $contactNumber);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Registration successful!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error: Failed to prepare statement</div>";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>
