<?php

displayimage();


function displayimage()
{
  $con=mysql_connect("localhost","root","");
  mysql_select_db("LikeME",$con);
  
  $qry = "SELECT * FROM images";
  $result=mysql_query($qry, $con);
  
 
  
  while($row= mysql_fetch_array($result))
  {
	   
    echo ' <br/> ';	
    echo ' <img heigh"300" width="300" src="data:image;base64, ' . $row[3] . ' "> ';
	echo '<br/><br/>';
	
  }
  
  mysql_close($con);
  
}

?>