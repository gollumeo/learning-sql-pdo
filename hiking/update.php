<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$id = $_POST['id'];


include './config_db.php';

$db = null;
if (isset($_POST['update'])) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }


    $new_name = $_POST['name'];
    $new_difficulty = $_POST['difficulty'];
    $new_distance = $_POST['distance'];
    $new_duration = $_POST['duration'];
    $new_height_difference = $_POST['height_difference'];
    try {
        echo "coucou ";
        print_r($id);
        //$db = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
        $stmt = $db->prepare("UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = :id");
        $stmt->bindValue(':name', $new_name);
        $stmt->bindValue(':difficulty', $new_difficulty);
        $stmt->bindValue(':distance', $new_distance);
        $stmt->bindValue(':duration', $new_duration);
        $stmt->bindValue(':height_difference', $new_height_difference);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        echo "Hike successfully updated! <br>";
        echo "<a href='./read.php'>Back to your hikes!</a>";
    } catch
    (PDOException $e) {
        echo $e->getMessage();
    }
} else {

    if (isset($_POST)) {
        $id = $_POST['id'];

        try {
            $db = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM hiking WHERE hiking.id = $id");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Update your hike</title>
                    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
                </head>
                <body>
                <a href="./read.php">Data list</a>
                <h1>Update</h1>
                <form action="update.php" method="post">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<? echo $row['name']; ?>">
                    </div>

                    <div>
                        <label for="difficulty">Difficulty</label>
                        <select name="difficulty">
                            <option value="<? echo $row['difficulty']; ?>"><? echo $row['difficulty']; ?></option>
                            <option value="Very easy">Very easy</option>
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Hard ">Hard</option>
                            <option value="Very hard">Very hard</option>
                        </select>
                    </div>

                    <div>
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" value="<? echo $row['distance']; ?>">
                    </div>
                    <div>
                        <label for="duration">Duration</label>
                        <input type="duration" name="duration" value="<? echo $row['duration']; ?>">
                    </div>
                    <div>
                        <label for="height_difference">Height difference</label>
                        <input type="text" name="height_difference" value="<? echo $row['height_difference']; ?>">
                    </div>
                    <button type="submit" name="update">Update</button>
                </form>
                </body>
                </html>
                <?php

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}