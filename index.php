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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>
</head>
<body>
    <div class="list-container">
        <div class="clock">
        <div class="clock-wrapper">
                <div id="date"></div>
                <div id="day"></div>
            </div>
            <div id="timestamp"></div>
            <?php require 'welcome.php';?>
        </div>
    <script>
        $(document).ready (function(){
            const day = "<?php echo date('d/m/y');?>";
            const date = "<?php echo date ('l');?>";
            // const timestamp = "<?php echo time();?>"
            const timestamp = setInterval(function(){$("#timestamp").load("time.php")}, 1000);

            // const time = new Date(timestamp * 1000);
            // const hours = time.getHours();
            // const minutes = time.getMinutes();
            // const seconds = time.getSeconds();


            $("#day").text(day);
            $("#date").text(date);
            $("#timestamp").text(timestamp);

            // function startTimer(){
            //     seconds + 1;

            //     if (seconds = 60){
            //         minutes + 1;
            //         seconds = 0;
            //     }

            //     if (minutes = 60){
            //         hours + 1;
            //         minutes = 0;
            //         seconds = 0;
            //     }

            //     $("#timestamp").text(hours + ":" + minutes + ":" + seconds);
            // }

            // setInterval(startTimer, 1000);

        })
        </script>
        <!-- <h1>Порешаем задачи</h1> -->
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