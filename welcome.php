<?php

$dt = new DateTime("now", new DateTimeZone('Asia/Almaty')); 
$time = $dt->format('H');

switch($time){
    case $time > 20:
        echo "<div class='welcome'> Доброй ночи!</div>";
    break;
    case $time > 16:
        echo "<div class='welcome'> Добрый вечер!</div>";
    break;
    case $time > 12:
        echo "<div class='welcome'> Добрый день!</div>";
    break;
    case $time > 6:
        echo "<div class='welcome'> Доброе утро!</div>";
    break;
    default:
        echo "<div class='welcome'> Время отдыхать</div>";
    break;
}
?>