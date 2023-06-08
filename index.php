<!-- Milestone 1
Creare un form che invii in GET la lunghezza della password. Una nostra funzione
utilizzerà questo dato per generare una password casuale (composta da lettere,
lettere maiuscole, numeri e simboli) da restituire all’utente.
Scriviamo tutto (logica e layout) in un unico file index.php

Milestone 2
Verificato il corretto funzionamento del nostro codice, spostiamo la logica in
un file functions.php che includeremo poi nella pagina principale

Milestone 3 (BONUS)
Gestire ulteriori parametri per la password: quali caratteri usare fra numeri,
lettere e simboli. Possono essere scelti singolarmente (es. solo numeri) oppure
possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre
insieme).
Dare all’utente anche la possibilità di permettere o meno la ripetizione di
caratteri uguali. -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Strong Password Generator</title>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
		crossorigin="anonymous">
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous" defer></script>
</head>

<body style="background-color: #000033; min-height: 100vh">
	<div class="container w-50 mx-auto mt-5 p-3 text-center"
		style="height: 100vh;">
		<h1 class="text-secondary">Strong Password Generator</h1>
		<h2 class="text-light mb-5">Genera una password sicura</h2>
		<div class="alert alert-primary">
			<h5 class="alert-heading">Nessun paramentro valido inserito</h5>
		</div>
		<div class="bg-white text-secondary rounded p-3 text-start"
			style="line-height: 2.2;">
			<form>
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="inputNumber">Lunghezza password:</label>
					</div>
					<div class="col-sm-6">
						<input type="number" class="form-control" id="inputNumber"
							style="width: 50%;">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<label>Consenti ripetizioni di uno o più caratteri:</label>
					</div>
					<div class="col-sm-6">
						<div class="form-check">
							<input class="form-check-input" type="radio"
								name="flexRadioDefault" id="flexRadioDefault1">
							<label class="form-check-label" for="flexRadioDefault1">
								Default radio
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio"
								name="flexRadioDefault" id="flexRadioDefault2" checked>
							<label class="form-check-label" for="flexRadioDefault2">
								Default checked radio
							</label>
						</div>
						<div class="form-check mt-3">
							<input class="form-check-input" type="checkbox" id="check1">
							<label class="form-check-label" for="check1">
								Lettere
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="check2">
							<label class="form-check-label" for="check2">
								Numeri
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="check3">
							<label class="form-check-label" for="check3">
								Simboli
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary mr-2">Invia</button>
						<button type="reset" class="btn btn-secondary">Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
