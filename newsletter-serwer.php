<?php

$link = mysqli_connect("localhost", "root", "", "testowa");
session_start();

//Wysłanie maila do jednej osoby
if(isset($_GET['wyslij_list']))
{
	$id = $_GET['wyslij_list'];
	$result = mysqli_query($link, "SELECT * FROM newsletter WHERE id='$id'");
	$row = mysqli_fetch_assoc($result);
	$imie = $row['imie'];
	$nazwisko = $row['nazwisko'];
	$email = $row['email'];
	
	//Wysyłanie przykładowego maila do zapisanego odbiorcy
	$tresc = "Imie: $imie \n Nazwisko: $nazwisko <br />. Dziekujemy za dodanie swojego adresu do naszego skromnego NewsLettera.";
	$header =  "From: A L \nContent-Type:".
			   ' text/plain;charset="UTF-8"'.
			  "\nContent-Transfer-Encoding: 8bit";
			
	mail($email, 'Kontakt ze strony www.newsletter.pl', $tresc, $header);
	
	//Potwierdzenie wysłania maila
	echo 'Wiadomość o uczestnictwie w programie Newsletter została wysłana. <br />';
	
	//Przekierowanie na stronę główną
	header('Refresh: 5; URL=newsletter.php');
	echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu.';

}

//Wysyłanie maila do wielu osób - według wyboru typu listu do wysłania.
if(isset($_POST['typ_maila']))
{
	$moj_wybor = $_POST['typ_maila'];
	$result = mysqli_query($link,"SELECT * FROM newsletter");
	$row = mysqli_fetch_assoc($result);
	$imie = $row['imie'];
	$nazwisko = $row['nazwisko'];
	$email = $row['email'];
	switch($moj_wybor)
	{
		//////List okolicznościowy////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 01:
		echo 'List okolicznościowy.';
		$odbiorcy = array($email);
		for ($i=0; count($odbiorcy)>$i; $i++);
		
		//Wysyłanie maila okolicznościowego do zapisanych odbiorców
		$tresc = "Imie: $imie \n Nazwisko: $nazwisko <br />. Dziekujemy za dodanie swojego adresu do naszego skromnego NewsLettera.";
		$header =  "From: A L \nContent-Type:".
				   ' text/plain;charset="UTF-8"'.
				  "\nContent-Transfer-Encoding: 8bit";
				
		mail($email, 'Kontakt ze strony www.newsletter.pl', $tresc, $header);
		
		//Potwierdzenie wysłania maila
		echo 'Wiadomość okolicznościowa odnośnie uczestnictwa w programie Newsletter została wysłana. <br />';
		
		//Przekierowanie na stronę główną
		header('Refresh: 5; URL=newsletter.php');
		echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu.';
		break;
		
		
		////////List z okazji Świąt Bożego Narodzenia///////////////////////////////////////////////////////////////////////////////////////
		case 02:
		echo 'Z okazji Świąt Bożego Narodzenia.';
		$odbiorcy = array($email);
		for ($i=0; count($odbiorcy)>$i; $i++);
		
		//Wysyłanie maila świątecznego do zapisanych odbiorców
		$tresc = "Imie: $imie \n Nazwisko: $nazwisko <br />. Wesołych Świąt Bożego Narodzenia - życzenia od Twojego ulubionego NewsLettera.";
		$header =  "From: A L \nContent-Type:".
				   ' text/plain;charset="UTF-8"'.
				  "\nContent-Transfer-Encoding: 8bit";
				
		mail($email, 'Kontakt ze strony www.newsletter.pl', $tresc, $header);
		
		//Potwierdzenie wysłania maila
		echo 'Wiadomość świąteczna została wysłana. <br />';
		
		//Przekierowanie na stronę główną
		header('Refresh: 5; URL=newsletter.php');
		echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu.';
		break;
		
		
		////////List - przypomnienie////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 03:
		echo 'List przypomnienie';
		$odbiorcy = array($email);
		for ($i=0; count($odbiorcy)>$i; $i++);
		
		//Wysyłanie maila przypominającego do zapisanych odbiorców
		$tresc = "Imie: $imie \n Nazwisko: $nazwisko <br />. Niezapomnij o moim NewsLetterze :D ";
		$header =  "From: A L \nContent-Type:".
				   ' text/plain;charset="UTF-8"'.
				  "\nContent-Transfer-Encoding: 8bit";
				
		mail($email, 'Kontakt ze strony www.newsletter.pl', $tresc, $header);
		
		//Potwierdzenie wysłania maila
		echo 'Wiadomość - przypomnienie została wysłana. <br />';
		
		//Przekierowanie na stronę główną
		header('Refresh: 5; URL=newsletter.php');
		echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu.';
		break;

		
		////////INNE/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		Default;
		echo 'List nie zostanie wysłany.';
		Break;
	}
}


//Usunięcie rekordu
if (isset($_GET['usun']))
{
	$id = $_GET['usun'];
	mysqli_query($link, "DELETE FROM newsletter WHERE id=$id");
	
	//Potwierdzenie usunięcia rekordu.
	echo 'Rekord został skasowany. <br /><br />';
	
	//Przekierowanie na stronę główną
	header('Refresh: 5; URL=newsletter.php');
	echo 'Zaraz zostaniesz przekierowany na stronę główną seriwsu.';
}

?>