<?php
$host = 'localhost';
$username = 'root';
$password = 'root';
$db_name = 'becode';

try {
    $db = new PDO("mysql:host=localhost;dbname=$db_name", "$username", "$password");
    $db->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("SELECT * FROM hiking");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<h1>Liste des randonnées</h1>
<table>
    <!-- Afficher la liste des randonnées -->
</table>
</body>
</html>
