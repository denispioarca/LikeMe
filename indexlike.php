<?php
session_start();

$conn = mysqli_connect('localhost','root','', 'LikeME');
if (mysqli_connect_errno())
  {
  echo "Conectare la baza de date esuata " . mysqli_connect_error();
  }
  
 if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = session_id();
}

$liked = $_SESSION['liked'];
$uid = $_SESSION['user'];


if(isset($_POST['likebutton'])) 
{
    $pid  = $_POST['likebutton'];
	
	$line = mysqli_query($conn, "SELECT * FROM `likes` WHERE idpoza = '$pid' and idutilizator = '$uid'");
    if ( mysqli_num_rows($line) == 0)
	{
		$res = mysqli_query($conn,"INSERT INTO `likes` (`idpoza`,`idutilizator`) VALUES ('$pid','$uid')");
		if ($res) 
		{
			echo "Like inregistrat!";	
		}
		
	}
	else 
	{
		$res = mysqli_query($conn,"DELETE FROM `likes` WHERE idpoza = '$pid' AND idutilizator = '$uid'");
		if ($res) 
		{
			echo "Unlike inregistrat!";	
		}
	}

}
	if(isset($_POST['commbutton']))
{
	 $pid    = $_POST['commbutton'];
	 $comment = $_POST['comment'];
	 $data =  date("Y-m-d");

	 $res = mysqli_query($conn,"INSERT INTO `comentarii` (`idpoza`,`idutilizator`, `comentariu`, `datacomentariu`) VALUES ('$pid','$uid','$comment', '$data')");
	 	if ($res) 
	{
		echo $errMSG = "Comentariu adaugat cu succes.";	
	}

}


$query  = "SELECT * FROM  poze as P ORDER BY (SELECT count(*) FROM likes as L WHERE L.idpoza = P.idpoza) DESC"; 
$res    = mysqli_query($conn, $query);


$HTML = "";

while($row=mysqli_fetch_array($res))
{
	$query2 = mysqli_query($conn, "SELECT nume FROM `utilizatori` WHERE idutilizator = ".$row['idutilizator']);
	$name = mysqli_fetch_array($query2)['nume'];	  
	$picid = $row['idpoza'];
	
	$querylikesuser = mysqli_query($conn,"SELECT idlike FROM `likes` WHERE idutilizator = '$uid' AND idpoza = ".$row['idpoza']);
	$rowlikesuser =mysqli_num_rows($querylikesuser);


    $querylikes = mysqli_query($conn,"SELECT COUNT(*) as `likes` FROM `likes` WHERE idpoza = ".$row['idpoza']);
	$rowlikes=mysqli_fetch_array($querylikes);
	$nrlikes = $rowlikes['likes'];
	
	
	if ($rowlikesuser == 0)
	{
		$liked = "Like";
	}
	else 
	{
		$liked = "Unlike";
	}
	
    $HTML.='<li> <img src="pozeincarcate/'.$row['userpic'].'" class="">
			<h4 class="">Adaugata de: '.$name.'</h4>
            <h4 class="">Descriere: '.$row['descriere'].'</h4>
            
			<h4 class="">Adaugata la: '.$row['datafoto'].'</h4>
			<h4 class="">
			<form method="post"  autocomplete="off">
			<div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="likebutton" value ="'.$picid.'"> '.$liked.' </button>
            </div>
			
			<div>
				Likes: '.$nrlikes.'
			</div>
			
			</form>
			
			</h4>
			 <div class="comment_input">
			<form method="post"  autocomplete="off">
            <textarea name="comment" placeholder="Introduceti comentariul aici." style="width:300px; height:100px;"></textarea></br></br>
			<button type="submit"  name="commbutton" value ="'.$row['idpoza'].'"> Posteaza comentariu </button>       
			</form>
			
			<font color = "DarkCyan"><a href = "viewcomments.php?picid='.$picid.'" > Vizualizati toate comentariile pentru aceasta imagine </a>
        </li>';

}
?>
<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
	<b><br><center><font size = "16"> Aplicatie foto </b></br></size></center>
 <font size = "3" ><b><center> <a href = "home.php">  Inapoi la profil </a> </b></center></font>


  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <center><ul class="thumbnail-list">
            <?php echo $HTML; ?>
            </ul> </center>
        </div>
    </div>
</div>
  </body>
 
</html>