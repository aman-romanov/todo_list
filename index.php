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

$kzdate = new IntlDateFormatter(
    'ru_RU', 
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'Asia/Almaty',
    IntlDateFormatter::GREGORIAN,
    'EEEE'
);

$date = new DateTime();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>
</head>
<body>
    <!-- <ul class="bg-slideshow">
        <li class="bg-slides bg-slides-active"><img src="img/bg_1.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_2.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_3.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_4.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_5.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_6.jpg" alt="" class="bg-img"></li>
        <li class="bg-slides"><img src="img/bg_7.jpg" alt="" class="bg-img"></li>
    </ul> -->
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
            const day = "<?=date('d/m/Y');?>";
            const date = "<?= $kzdate->format($date);?>";
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
            <button type="submit" name="addTask" class="btn  btn-success"><span class="icon-chevron-left-solid-2"></span></button>
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
                    <li class="task-list-item"><?=$todo_list['task']?></li>
                    <a href="delete.php?id=<?=$todo_list['id']?>">
                        <span class="icon-circle-xmark-regular"></span>
                    </a>
                </div>
            <?php endforeach;?>
        </ul>
        <div class="bw_bg"></div>
    </div>

    <script>
        function changeBg(){
            const img = [
                'url("img/bg_1.jpg")',
                'url("img/bg_2.jpg")',
                'url("img/bg_5.jpg")',
                'url("img/bg_6.jpg")',
            ];

            const slide = document.querySelector('body');
            const bg = img[Math.floor(Math.random()*img.length)];
            document.querySelector('body').style.backgroundImage=bg;
        }

        setInterval(changeBg(), 3000);
    </script>
</body>
</html>