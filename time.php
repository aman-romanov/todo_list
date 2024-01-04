<?php 

    $dt = new DateTime("now", new DateTimeZone('Asia/Almaty')); 
    echo $dt->format('H:i:s');

?>