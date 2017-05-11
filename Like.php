<?php

session_start();
$con=mysqli_connect("localhost","root","","LikeME");


if($_GET['submit']) {

    $userId = $_GET['IdUser'];
    $photoId = $_GET['photoId'];

    
    $id_Poza_Utilizator = "SELECT id_poza, id_utilizator FROM likes WHERE id_utilizator = '$userId' AND id_poza='$photoId'";
    $result = $con->query($id_Poza_Utilizator);
    $rows = $result->fetch_assoc();

    if ($photoId == $rows['id_poza']) 
	   {
          $query = "DELETE FROM likes WHERE id_poza = $photoId AND id_utilizator = $userId";
          $con->query($query);
       }

	else 
     	{
		 $interogare = "INSERT INTO likes (id_utilizator, id_poza) VALUES ('$userId', '$photoId') ";	
		 
              if ($con->query($interogare) === TRUE) 
			  {
                  echo "New record created successfully";
                  header('Location: Acasa.php');
              }
			  
			 else 
			 {
              echo "Error: " . $con->error;
             }
    mysqli_close($con);
         
        }

    header('Location: Acasa.php');
}


?>
