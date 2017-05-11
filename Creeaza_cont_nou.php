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
	header('Location: Pagina1.php');
 
	}
 
	else
 
	{
 
	echo 'Datele nu au fost salvate!!! '.$connect->error;
 
	}
 
}

?>


<style>
 
 h1 {
	 color: chartreuse;
	 
 }
 

input[type=submit]{width:100px}
 
</style>

<body BACKGROUND = "electricitate.jpg">
</body>
 <div style="height: 100%; width: 100%; position: absolute">
    <div style="width: 600px" class="vertical-center center-block">
        <h1 class="text-center"  style="font-size: 40px;" >Creare cont nou</h1>
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
			 
				<input type="submit" name="save" value="Salveaza date"/>
			 
			 
				</td>
			 
			  </tr>
			 
			</table>
			 
			</form>
			
	</div>
</div>