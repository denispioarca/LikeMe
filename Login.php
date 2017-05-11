<?php

session_start();
$connect= new mysqli("localhost","root","","LikeME") or die("ERROR:could not connect to the database!!!!");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //  verifica daca exista date transmise
    if ($_POST['login_username'] != "" && $_POST['login_password'] != '') {

        // preia datele din formular
        $username = $_POST['login_username'];
        $password = ($_POST['login_password']);

        // formeaza si executa query-ul de select din baza de date
        $query = "SELECT * FROM `users` WHERE `Email` = '" . $username . "' AND `Parola` = '" . $password . "'";
        $result = $connect->query($query) or die ("Error : " . $connect->error);
		$r = mysqli_fetch_assoc($result);
        $id = $r["id"];
        $_SESSION ['id_user'] = $id;
		
      

        $rowcount = mysqli_num_rows($result);
        // verifica daca in baza de date exista un utilizator cu email-ul si parola introduse
        if ($rowcount < 1)
		{
            // daca nu, afiseaza un mesaj de eroare
			echo "Date incorecte!!!<br>";
			header('Location: Cont_existent.php');
			           
        } 
		else {
			
			// salveaza username-ul si parola in sesiune
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            
            // afiseaza un mesaj de succes
           echo "Autentificarea reusita: ", $username, ".";
            header('Location: Acasa.php');
             die();
        }
    }
}

?>