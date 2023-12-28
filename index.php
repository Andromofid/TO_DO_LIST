<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=todolist","root","");
    $sql = $db->prepare("SELECT * FROM todo");
    $sql->execute();
    $taches  = $sql->fetchAll();
    extract($_POST);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
