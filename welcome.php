<?php

$dt = new DateTime("now", new DateTimeZone('Asia/Almaty')); 
$time = $dt->format('h:i:s');

if($time >= "05:00:00" && $time >= "11:00:00"){
    echo "<div class='welcome'> Доброе утро! </div>";
} elseif($time >= "11:00:00" && $time <= "16:00:00"){
    echo "<div class='welcome'>Доброе день! </div>";
}elseif($time >= "16:00:00" && $time <= "22:00:00"){
    echo "<div class='welcome'>Доброе вечер! </div>";
}else{
    echo "<div class='welcome'> Время отдыхать</div>";
}
?>