<?php
include './config_db.php';
require_once './Core/helper.php';

// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=$db_name", "$username", "$password");
// Get the user's input
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;

// Prepare a SELECT statement to retrieve the user's credentials from the database
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

// Fetch the user's data from the database
    $user = $stmt->fetch();

// Check if the user's input matches the credentials stored in the database
    if ($user && ($password == $user['password'])) {
        // The user's input is valid, log them in
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: create.php');
        exit();
    } else {
        // The user's input is not valid, show an error message
        echo "Invalid username or password";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
</head>
<body>
<main>
    <form action="login.php" method="post">
        <div class="id">
            <label for="username">Username:</label>
            <input type="text" name="username">
        </div>
        <div class="password">
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="submit">
        </div>
    </form>
</main>
</body>
</html>
