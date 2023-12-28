<?php
require "Database.php";
$db = new Database;
$conn = $db->getDB();

$id=$_GET['id'];
$sql = "DELETE FROM tasks
        WHERE id = :id ";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->execute();
header('Location:add.php');