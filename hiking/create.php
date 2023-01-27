<?php
    if (!session_start() || $_SESSION['user_id'] != 1) {
        echo "Unauthorized access! Please <a href='./login.php'>log in</a>!";
        return;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<a href="./read.php">Data list</a>
<h1>Add a new hike</h1>
<form action="./create.php" method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="">
    </div>

    <div>
        <label for="difficulty">Difficulty</label>
        <select name="difficulty">
            <option value="Very easy">Very easy</option>
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
            <option value="Very Hard">Very Hard</option>
        </select>
    </div>

    <div>
        <label for="distance">Distance</label>
        <input type="text" name="distance" value="">
    </div>
    <div>
        <label for="duration">Duration</label>
        <input type="time" name="duration" value="">
    </div>
    <div>
        <label for="height_difference">Height difference</label>
        <input type="text" name="height_difference" value="">
    </div>
    <button type="submit" name="button">Envoyer</button>
</form>
</body>
</html>

<?php
require_once './Core/helper.php';
include './config_db.php';

if (isset($_POST['button'])) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference);");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':difficulty', $_POST['difficulty']);
        $stmt->bindParam(':duration', $_POST['duration']);
        $stmt->bindParam(':distance', $_POST['distance']);
        $stmt->bindParam(':height_difference', $_POST['height_difference']);
        $stmt->execute();
        echo "Hike successfully added!";
    } catch (PDOException $e) {
        echo $e->getMessage();
    };
};