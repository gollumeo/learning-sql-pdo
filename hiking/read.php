<?php
include './config_db.php';
require_once './Core/helper.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hikes</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<h1>Hikes list</h1>
<a href="./create.php">Create a new hike!</a>
<table>
    <!-- Afficher la liste des randonnées -->
    <?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=$db_name", "$username", "$password");
        $db->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->query("SELECT * FROM hiking");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <table style="border: 1px black solid;">
                <thead style="border: 1px black solid;">
                <tr style="border: 1px black solid;">
                    <th>Name</th>
                    <th>Difficulty</th>
                    <th>Distance</th>
                    <th>Duration</th>
                    <th>Height difference</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody style="border: 1px black solid;">
                <form action="./update.php" method="post">
                    <tr style="border: 1px black solid;">
                        <td></td>
                        <td><?php echo $row['name']; ?></a></td>
                        <td><?php echo $row['difficulty']; ?></td>
                        <td><?php echo $row['distance']; ?></td>
                        <td><?php echo $row['duration']; ?></td>
                        <td><?php echo $row['height_difference']; ?></td>


                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="update" value="Update">
                </form>
                <td>
                    <form method='post'><input type='checkbox' name='delete'
                                               value='<?php echo $row['name'] ?>'
                                               onclick='this.form.submit()'>
                    </form>
                </td>
                </tr>
                </tbody>
            </table>

            <?php
        };
    } catch (PDOException $e) {
        echo $e->getMessage();
    };

    if (isset($_POST['delete'])) {
        $name_delete = $_POST['delete'];
        try {
            $db = new PDO("mysql:host=localhost;dbname=$db_name", "$username", "$password");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("DELETE FROM hiking WHERE hiking.name = :name");
            $stmt->bindParam(':name', $name_delete);
            $stmt->execute();
            header('Location: read.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
</table>
</body>
</html>
