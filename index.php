<?php
require "Database.php";
$db = new Database;
$conn = $db->getDB();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['task'])){
        $error = "Введите задачу";
    } else {
        $task = $_POST['task'];
        $sql = "INSERT INTO tasks(task)
                VALUES (:task)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':task', $task, PDO::PARAM_STR);
        $stmt->execute();
        $error = "";
        header('Location:add.php');
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/style.min.css">
</head>
<body>
    <div class="list-container">
        <h1>Порешаем задачи</h1>
        <?php if(!empty($error)){
            $error = 'Нужно внести задачу';
            echo $error;
        }?>
        <form class="list-form" action="" method="post">
            <input type="text" name="task" id="task" placeholder="Что поделаем?" class="form-control">
            <button type="submit" name="addTask" class="btn  btn-success">Добавить</button>
        </form>
        <?php
        $db = new Database;
        $conn = $db->getDB();
        $sql = "SELECT *
        FROM tasks
        ORDER BY id DESC";
        $results = $conn->query($sql);
        $todo_lists = $results->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul class="list-group">
            <?php foreach($todo_lists as $todo_list):?>
                <div class="task-list_wrapper">
                    <li class="list-group-item"><?=$todo_list['task']?></li>
                    <a href="delete.php?id=<?=$todo_list['id']?>">
                        <button type="button" class="btn btn-danger"> Удалить </button>
                    </a>
                </div>
            <?php endforeach;?>
        </ul>
    </div>
</body>
</html>