<?php

$conn = new mysqli('localhost' , 'root' , 'Qwert90!.', 'lifechoicesshop');

if ($conn->connect_error) {
    die("Connection failed ;" . $conn->connect_error);
} else {
    //echo 'Connected Successfully' ;
}

?>