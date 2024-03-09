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
session_start();

require_once "database.php"; // Include the file with database connection details

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Check if the user is logged in and if user data is set in session
    if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"])) {
        echo "<div class='alert alert-danger'>User not logged in</div>";
        exit; // Stop further execution
    }

    // Retrieve comment from the form
    $comment = $_POST["comment"];

    // Prepare and execute SQL statement to update the user table with the comment
    $sql = "UPDATE user SET Comment = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters (comment and user id)
    $stmt->bind_param("si", $comment, $_SESSION["user"]["id"]);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Comment submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }

    // Close statement
    $stmt->close();
}

// Retrieve comments from the database for display
$sql = "SELECT first_name, last_name, Comment FROM user WHERE Comment IS NOT NULL";
$result = $conn->query($sql);

?>

<!-- Display comments in a table -->
<div class="row">
    <div class="col-md-12">
        <h2>Comments</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                        echo "<td>" . $row["Comment"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No comments yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Comment submission form -->
<form action="comment.php" method="post">
    <div class="select_option col-md-12">
        <h4> Add comments/inquiries</h4>
        
        <textarea class="form-control" placeholder="Comments/Inquiries" id="comment" name="comment"></textarea>
       
        <div class="login">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>

        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</form>

</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
