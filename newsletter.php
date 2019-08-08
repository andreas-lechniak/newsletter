<?php $link = mysqli_connect("localhost", "root", "", "testowa"); ?>
<!DOCTYPE html>
<html lang="pl-PL">
	<head>
		<meta name="keyword" content="System newsów" />
		<meta name="description" content="System newsów" />
		<title>Prosty newsletter</title>
	</head>
	<body>
		<div>
			<form action="newsletter-potwierdzenie.php" method="POST">
				<h3>Dodaj do NewsLettera</h3>
				Imię: <input type="text" name="imie" placeholder="Podaj swoje imię"><br />
				Nazwisko: <input type="text" name="nazwisko" placeholder="Podaj swoje nazwisko"><br />
				Adres e-mail: <input type="text" name="email" placeholder="Podaj adres email"><br />
				<input type="hidden" name="data"><br />
				<input type="submit" value="Zapisz"> <input type="reset" value="Wyczyść">
			</form>
		</div>
		
		<br />
		
		<div>
			<h3>Zapisani odbiorycy</h3>
			<?php
				$results = mysqli_query($link,"SELECT * FROM newsletter");
				echo '<table>
						<tr>
						<th>ID</th>
						<th>Imię</th>
						<th>Nazwisko</th>
						<th>Adres email</th>
						<th>Data dodania</th>
						<th>Działania</th>
						</tr>';
				while($row = mysqli_fetch_array($results))
				{
					echo '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['imie'].'</td>
							<td>'.$row['nazwisko'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['data'].'</td>
							<td>
								<a href="newsletter-serwer.php?wyslij_list='.$row['id'].'" title="Wyślij testowy list">Wyślij list</a> |
								<a href="newsletter-serwer.php?usun='.$row['id'].'" title="Usuń rekord z bazy">Usuń rekord</a>
							</td>
						  </tr>';
				}
					echo '</table>';
			?>
			<form action="newsletter-serwer.php" method="POST">
				<p>Wyślij list do wszystkich odbiorców 
				<select name="typ_maila">
					<option value="01">Okolicznościowy</option>
					<option value="02">Z okazji świąt BN</option>
					<option value="03">Przypominający</option>
				</select>
				<input type="submit" value="Prześlij list"></p>
			</form>
		</div>
		
		<div>		
			<?php
				$results = mysqli_query($link, "SELECT count(id) AS ilosc FROM newsletter");
				$row = mysqli_fetch_array($results);
				$ile_odbiorcow = $row['ilosc'];
				echo '<p>Wszystkich odbiorócw w bazie jest: <b>'.$ile_odbiorcow.'</b>';
			?>
		</div>
		
	</body>
</html>