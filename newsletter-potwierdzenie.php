<?php

	$link = mysqli_connect("localhost", "root", "", "testowa");
	if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['email']))
	{
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$email = $_POST['email'];
		$data = $_POST['data'];
		$data = date('Y-m-d H:i:s');
			
		if(strlen($imie) < 3 || strlen($imie) > 25)
		{
			echo 'Nieprawidłowa długość w wartości <b>Imię</b>. <br />';
		}
		else if(strlen($nazwisko) < 3 || strlen($nazwisko) > 255)
		{
			echo 'Nieprawidłowa długość w wartości <b>Nazwisko</b>. <br />';
		}
		else if(preg_match('/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]$/', $email))
		{
			echo 'Nieprawidłowa długość w wartości <b>Email</b>. Użyto niedozwolonych znaków. <br />';
		}
		else
		{
			echo 'Zapisano rekord w bazie danych. <br /><br />';
			mysqli_query($link,"INSERT INTO newsletter (imie, nazwisko, email, data) VALUES('$imie', '$nazwisko', '$email', '$data')");
			echo 'Zapisane dane: <br />
				  Podane imię: <b>'.$imie.'</b><br />
				  Podane nazwisko: <b>'.$nazwisko.'</b><br />
				  Podany adres e-mail: <b>'.$email.'</b><br />
				  Dane zapisano z datą:<b>'.$data.'</b><br />';
			
			//Wysyłanie powitalnego maila do zapisanego odbiorcy
			$tresc = "Imie: $imie \n Nazwisko: $nazwisko <br />. Dziekujemy za dodanie swojego adresu do naszego skromnego NewsLettera.";
			$header =  "From: A L \nContent-Type:".
					   ' text/plain;charset="UTF-8"'.
					   "\nContent-Transfer-Encoding: 8bit";
			
			mail($email, 'Kontakt ze strony www.newsletter.pl', $tresc, $header);
			
			//Przekierowanie na stronę główną
			header('Refresh: 5; URL=newsletter.php');
			echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu';
		}
	}
	else
	{
		echo 'Gdzieś jest błąd';
	}
	
?>		