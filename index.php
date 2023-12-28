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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.css"></script>
</head>
<body>
    <nav class="nav bg-dark px-4">
        <h1 class="text-white">ToDoList</h1>
    </nav>
    <div class="container m-auto">
        <form action="#" method="POST" class="m-auto d-flex mt-3 justify-content-center ">
            <input type="text" class="form-control w-50" name="tache">
            <button type="submit" value="new" name="action" class="mx-2 btn btn-primary">Add</button>
        </form>
        <ul class="list-group my-4 ">
            <?php foreach ($taches as $tache) {
                if ($tache['done'] == 0) { ?>
                    <li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-center w-100 m-auto">
                        <p style="overflow: hidden;" class="w-50">
                            <?php echo $tache["title"] ?>
                        </p>
                        <div>
                            <form method="POST" action="#">
                                <input type="hidden" value="<?php echo $tache["id"]; ?>" name="id">
                                <button type="submit" class="btn btn-primary" name="action" value="toggle">Done</button>
                                <button type="submit" class="btn btn-danger" name="action" value="delete">✖</button>
                            </form>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center w-100 m-auto">
                        <p style="overflow: hidden;" class="w-50"><?php echo $tache["title"] ?></p>
                        <div class="form" method="POST" action="#">
                            <form method="POST" action="#">
                                <input type="hidden" value="<?php echo $tache['id'] ?>" name="id">
                                <button type="submit" class="btn btn-primary" name="action" value="toggle">Undo</button>
                                <button type="submit" class="btn btn-danger" name="action" value="delete">✖</button>
                            </form>
                        </div>
                    </li>
            <?php }
            } ?>
        </ul>
    </div>
</body>
</html>
