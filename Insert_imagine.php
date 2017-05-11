<?php

     ini_set('mysql.connect_timeout',300);
	 ini_set('default_socket_timeout',300);
?>

<html>
     <body>
	      <form method="post" enctype="multipart/form-data">
		  <br/>
		      <input type="file" name="image" />
			  <br/><br/>
			  <input type="submit" name="submit" value="Incarca" />
		       
	      </form>
	 <?php
	 
	      if(isset($_POST['submit']))
		  {
			  if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
			  {
				  echo "Please select an image.";
			  }
			  
			  else
			  {
				  $image= addslashes($_FILES['image']['tmp_name']);
				  $name= addslashes($_FILES['image']['name']);
				  $image= file_get_contents($image);
				  $image= base64_encode($image);
				  saveimage($name,$image);
			  }
		  }
		  
		
		  
		  function saveimage($name, $image)
		  {
			  session_start();
			  $con=mysql_connect("localhost","root","");
			  mysql_select_db("LikeME",$con);
			  $id = $_SESSION ['id_user'];
			  $_SESSION['imageName']=$name;
		
			  $qry="insert into images (id_user,name, image) values ('$id','$name','$image')";
			  $result=mysql_query($qry,$con);

              if($result)
			  {
				  echo "<br/>Imagine incarcata.";
				  header('Location: Acasa.php');
			  }				 

              else
              {
				  echo "<br/>Imaginea nu s-a putut incarca.";
			  }				  
		  }
		  
		  
		  
		  
     ?>	 
	 </body>
</html>	 


