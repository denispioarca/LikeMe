
<?php
 
//mysqli connectivity
$connect= new mysqli("localhost","root","","LikeME") or die("ERROR:could not connect to the database!!!!");
 
extract($_POST);
 
if(isset($save))
{
 
	$query="insert into users values('','$Nume','$Prenume','$Email','$Parola','$NrTelefon')";
 
	if($connect->query($query))
 
	{
 
	echo 'Datele au fost salvate cu succes!';
 
	}
 
	else
 
	{
 
	echo 'Datele nu au fost salvate!!! '.$connect->error;
 
	}
 
}






//display data
if(isset($disp))
{
 
	$query="select * from users";
 
	$result=$connect->query($query);
 
	echo "<table border=1>";
 
	echo "<tr><th>Nume</th><th>Prenume</th><th>Email></th><th>Parola</th><th>NrTelefon<
/th></tr>";
 
	while($row=$result->fetch_array())
 
		{
 
		echo "<tr>";
 
		echo "<td>".$row['Nume']."</td>";
 
		echo "<td>".$row['Prenume']."</td>";
		
		echo "<td>".$row['Email']."</td>";
		
		echo "<td>".$row['Parola']."</td>";
 
		echo "<td>".$row['NrTelefon']."</td>";
 
		echo "</tr>";
 
		}
 
	echo "</table>";	
 
}

?>






<style>
 
 
input[type=submit]{width:100px}
 
</style>

<body BACKGROUND = "like.png">
</body>
 
<form method="post">
 
<table width="218" border="0">
 
  <tr>
 
    <td width="208"><input type="text" name="Nume" placeholder="Introduceti numele"/></td>
 
  </tr>
 
  <tr>
 
    <td><input type="text" name="Prenume" placeholder="Introduceti prenumele"/></td>
 
  </tr>
 
  <tr>
 
    <td><input type="text" name="Email" placeholder="Introduceti email-ul"/></td>
 
  </tr>
  
  <tr>
 
    <td><input type="text" name="Parola" placeholder="Introduceti parola"/></td>
 
  </tr>
  
  <tr>
 
    <td><input type="text" name="NrTelefon" placeholder="Introduceti numarul de telefon"/></td>
 
  </tr>
 
 
 
  <tr>
 
    <td>
 
	<input type="submit" name="save" value="Save Data"/>
 
	<input type="submit" name="disp" value="Display Data"/>
 
	</td>
 
  </tr>
 
</table>
 
</form>