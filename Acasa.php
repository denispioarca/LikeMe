<!DOCTYPE html>
<html lang="en">
<head>


    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #38353D;
        }

        li {
            float: left;
            border-right:1px solid #bbb;
           }

        li:last-child
     		{
              border-right: none;
            }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }
        .but {
            font: bold 11px Arial;
            text-decoration: none;
            background-color: #EEEEEE;
            color: #333333;
            padding: 10px 6px 10px 6px;
            border-top: 1px solid #CCCCCC;
            border-right: 1px solid #333333;
            border-bottom: 1px solid #333333;
            border-left: 1px solid #CCCCCC;
        }

        #comentarii, #comentarii ul, #comentarii li{
            background-color: #FFFFFF;
            border-right: none;
        }
        #comentarii{
            width: 400px;
        }
        #comentarii li{
            padding: 5px;
            border-top: 1px solid #000000;
            margin-bottom: 10px;
            display: block;
            width: 100%;
        }
    </style>

    <title>LikeME</title>
</head>
<body>

<ul>
    <li><a  class="active" href="">Acasă</a></li>
	<li><a  class="active" href="Insert_imagine.php">Adauga poza</a></li>
    <li style="float:right"><a href ="Iesire.php" >Iesire</a></li>
    
</ul>
<?php

displayimage();
function displayimage()
{
	session_start();
    $con=mysqli_connect("localhost","root","","LikeME");
    $toateImaginile = "SELECT users.Nume as Nume, users.Prenume as Prenume, images.image as imagine , images.id as id FROM users INNER JOIN images ON users.id = images.id_user";
    $img = $con->query($toateImaginile);


    while ($rows = $img->fetch_assoc()) 
	{

        $likeUser = liked($rows['id'], $_SESSION ['id_user']);//punem in variabila aceasta 1 sau 0.
		
		$sqlimage = "Select U.Nume as Nume, U.Prenume as Prenume, C.data AS data, C.comm as comm from comentariu C, users U where C.id_user=U.id AND C.id_poza = ". $rows['id'];
        $comments = $con->query($sqlimage);

        $commentarii = [];
        $i=0;
        while ($linie = $comments->fetch_assoc())
		{
            $commentarii[$i]['data']= $linie['data'];
            $commentarii[$i]['comm']= $linie['comm'];
            $commentarii[$i]['Nume']= $linie['Nume'];
			$commentarii[$i]['Prenume']= $linie['Prenume'];
            $i++;
        }


	    echo "Postata de: " . $rows ['Nume'] ;
	    echo " " .$rows['Prenume'];
		echo '<br/>';
		echo ' <img heigh"300" width="300" src="data:image;base64, ' . $rows['imagine'] . ' "> ';
        echo '<form action="like.php" method="GET" id="form1">
              <input  type="hidden" name="photoId" value = "' . $rows['id'] . '">
              <input  type="hidden" name="IdUser" value="' . $_SESSION ['id_user'] . '">';
        echo  '<input type="submit" name="submit" value="';
        
		if ($likeUser)
			{
              echo "Unlike";
            } 
		else 
		    {
              echo "Like";
            }
		echo '"></form>';	
			
			
			
		//selectare numar de like-uri 
        $query = "SELECT id FROM likes WHERE  id_poza =" . $rows['id'];

        
        if ($result= mysqli_query($con,$query))
        {
            $rowcount=mysqli_num_rows($result);
                     printf(" %d",$rowcount);
            
            mysqli_free_result($result);
        }
		
		
		
		
		
		 // afisare comentarii
		 
		echo ' <br/> <br/> ';
        echo '<div id="comentarii"><ul>';
        foreach ($commentarii as $comment)
		        {
                 echo "<li>{$comment['comm']} &nbsp; <span>{$comment['data']}</span> &nbsp; <span>{$comment['Nume']}</span> &nbsp; <span>{$comment['Prenume']}</span></li><br />";
			    }
        echo '</ul></div>';
        echo '<form action="comment.php" method="POST" id="form2">
              <br/>           
			   <td width="208"><input type="text" name="comment" placeholder="Introduceti comentariu"/></td>
               <input  type="hidden" name="photoId" value = "' . $rows['id'] . '">
              <input  type="hidden" name="IdUser" value="' . $_SESSION ['id_user'] . '">      
              <input type="submit" name="submit" value="Comment"><br /></form>';
			  
		

        echo'<br/><br/>';		
		
        

       
    }

    mysqli_close($con);
}

			 
		  
function liked($id_imagine, $id_user)
{
    $con=mysqli_connect("localhost","root","","LikeME");
    $interogare1 = "SELECT id AS nr FROM likes WHERE id_utilizator = '".$id_user."' AND id_poza ='".$id_imagine."'";
	//var_dump($interogare1);
	$result=$con->query($interogare1);
	//var_dump($result);
    $row = $result->fetch_assoc();
    if ($row['nr'] != 0) {
        return true;
    } else {
        return false;
    }
    mysqli_close($con);
}		  
		  
?>

</body>
</html>

