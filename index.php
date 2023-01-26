<form action="index.php" method="get">
    <label for="city">City:</label>
    <input type="text" name="city"><br>
    <label for="number">Maxima:</label>
    <input type="number" name="haut" min="-20">
    <label for="bas">Minima:</label>
    <input type="number" name="bas" min="-20">
    <input type="submit" value="Envoyer" name="submit">
</form>

<?php
if (isset($_GET['submit'])) {
    $city = $_GET['city'];
    $haut = $_GET['haut'];
    $bas = $_GET['bas'];
    try {
        $db = new PDO("mysql:host=localhost;dbname=weatherapp", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("INSERT INTO Météo (ville, haut, bas) VALUES (:city, :haut, :bas)");
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':haut', $haut);
        $stmt->bindParam(':bas', $bas);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
if (isset($_GET['delete'])) {
    $city = $_GET['delete'];
    try {
        $db = new PDO("mysql:host=localhost;dbname=weatherapp", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("DELETE FROM Météo WHERE ville = :city");
        $stmt->bindParam(':city', $city);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<table>
    <thead>
    <tr>
        <th>City</th>
        <th>Minima</th>
        <th>Maxima</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=weatherapp", "root", "root");
        $db->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->query("SELECT * FROM Météo");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['ville'] . "</td>";
            echo "<td>" . $row['bas'] . "</td>";
            echo "<td>" . $row['haut'] . "</td>";
            echo "<td><form method='get'><input type='checkbox' name='delete' value='" . $row['ville'] . "' onclick='this.form.submit()'></form></td>";
            echo "</tr>";

        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>
    </tbody>
</table>
