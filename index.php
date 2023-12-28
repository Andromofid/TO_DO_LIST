<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=todolist","root","");
    $sql = $db->prepare("SELECT * FROM todo");
    $sql->execute();
    $taches  = $sql->fetchAll();
    extract($_POST);
    if (isset($action)) {
        if ($action == "new") {
            $sql = $db->prepare("INSERT INTO todo(title,done)VALUES (?,0)");
            $sql->execute([$tache]);
            header("location:./index.php");
        }elseif ($action == "delete") {
            $sql = $db->prepare("DELETE FROM todo WHERE id=?");
            $sql->execute([$id]);
            header("location:./index.php");
        }else {
            $sql = $db->prepare("UPDATE todo SET done = 1-done WHERE id = ?");
            $sql->execute([$id]);
            header("location:./index.php");
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
