<?php

session_start();
$con=mysqli_connect("localhost","root","","LikeME");


if($_POST['submit']) {

    $userId = $_POST['IdUser'];
    $photoId = $_POST['photoId'];
    $comment = $_POST['comment'];

    $date = date("Y-m-d H:i:s");

    $interograre1 = "INSERT INTO comentariu(id_poza, id_user, comm, data) VALUES('$photoId','$userId','$comment','$date')";
    $result = $con->query($interograre1);

    header('Location: Acasa.php');
}

?>