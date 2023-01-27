<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './config_db.php';

if (isset($_POST['update'])) {
    var_dump($_POST['update']);
    echo $_POST['id'];
    $id = $_POST['id'];
    try {
        $db = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM hiking WHERE hiking.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $og_name = $row['name'];
        $og_difficulty = $row['difficulty'];
        $og_distance = $row['distance'];
        $og_duration = $row['duration'];
        $og_height_diff = $row['height_difference'];

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Update a hike</title>
            <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
        </head>
        <body>
        <a href="./read.php">Hikes data</a>
        <h1>Update</h1>
        <form action="update.php" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $og_name ?>">
            </div>

            <div>
                <label for="difficulty">Difficulty</label>
                <select name="difficulty">
                    <option value="<?php echo $og_difficulty ?>"><?php echo $og_difficulty ?></option>
                    <option value="Very easy">Very easy</option>
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Very hard">Very hard</option>
                </select>
            </div>

            <div>
                <label for="distance">Distance</label>
                <input type="text" name="distance" value="<?php echo $og_distance ?>"">
            </div>
            <div>
                <label for="duration">Duration</label>
                <input type="duration" name="duration" value="<?php echo $og_duration ?>"">
            </div>
            <div>
                <label for="height_difference">Height difference</label>
                <input type="text" name="height_difference" value="<?php echo $og_height_diff ?>">
            </div>
            <button type="submit" name="button">Update</button>
        </form>
        </body>
        </html>
        <?php
        if (isset($_POST['button'])) {
            var_dump($_POST['button']);
            $new_name = $_POST['name'];
            $new_difficulty = $_POST['difficulty'];
            $new_distance = $_POST['distance'];
            $new_duration = $_POST['duration'];
            $new_height_difference = $_POST['height_difference'];
            var_dump($id);
            try {
//                $stmt = $db->prepare("UPDATE hiking SET hiking.name = :name, hiking.difficulty = :difficulty, hiking.distance = :distance, hiking.duration = :duration, hiking.height_difference = :height_difference WHERE hiking.id = :id");
//                $stmt->bindParam(':name', $new_name);
//                $stmt->bindParam(':difficulty', $new_difficulty);
//                $stmt->bindParam(':distance', $new_distance);
//                $stmt->bindParam(':duration', $new_duration);
//                $stmt->bindParam(':height_difference', $new_height_difference);
//                $stmt->bindParam(':id', $id);
//                $stmt->execute();
//
//                echo "Hike successfully updated!";

        } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
//} else { ?>
<!--    <h2>Please go <a href="./read.php">back</a> and provide us with an actual hike.</h2>-->
<?php   }


?>
