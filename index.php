<?php
// Array di lettere minuscole e maiuscole
$lett_characters = array_merge(range("a", "z"), range("A", "Z"));

// Array di numeri da 0 a 9
$nums_characters = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

// Stringa di simboli
$sym_characters = ["!", "@", "#", "$", "%", "^", "&", "*"];

// Variabile lunghezza input
$pw_length = null;
if (isset($_GET["pw-length"])) {
	$pw_length = intval($_GET["pw-length"]);
}

// Lettura dei campi di input
$rep_on  = isset($_GET["rep_on"]) ? $_GET["rep_on"] : "";
$rep_off = isset($_GET["rep_off"]) ? $_GET["rep_off"] : "";
$letters = isset($_GET["letters"]) ? $_GET["letters"] : "";
$numbers = isset($_GET["numbers"]) ? $_GET["numbers"] : "";
$symbols = isset($_GET["symbols"]) ? $_GET["symbols"] : "";

// Messaggio di errore in assenza di input validi
$message = "";

if ($pw_length === 0 && $rep_on === "" && $rep_off === "" && $letters === "" && $numbers === "" && $symbols === "") {
	$message = "Nessun parametro valido inserito";
} else {
	$message = "";
}

// Array dato dall"unione delle stringhe consentite
$characters = [];

if ($letters) {
	$characters = array_merge($characters, $lett_characters);
}

if ($numbers) {
	$characters = array_merge($characters, $nums_characters);
}

if ($symbols) {
	$characters = array_merge($characters, $sym_characters);
}

// Funzione che genera una password casuale
// chiamata solo se la lunghezza in input è > 0
function generate_random_password($characters, $pw_length, $rep_on)
{
	// Controllo iniziale sulla lunghezza della password e sui caratteri ripetuti
	if ($pw_length > count($characters) && !$rep_on) {
		$message = "La lunghezza della password non può essere maggiore del numero di caratteri unici disponibili.";
		return $message;
	}

	$password   = "";
	$used_chars = array();

	while (strlen($password) < $pw_length) {
		$randomIndex = rand(0, count($characters) - 1);
		if ($rep_on || !in_array($characters[$randomIndex], $used_chars)) {
			$password .= $characters[$randomIndex];
			$used_chars[] = $characters[$randomIndex];
		}
	}

	return $password;
}

// Controlla la lunghezza della password e chiama la funzione per generarla
if ($pw_length > 0 && $message === "") {
	$password = generate_random_password($characters, $pw_length, $rep_on);
	$message  = "La password scelta è " . $password;
} else {
	$message = "Per favore, specifica una lunghezza per la password!";
}

?>


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
	<!-- <script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous" defer></script> -->
</head>

<body style="background-color: #000033; min-height: 100vh">
	<div class="container w-50 mx-auto mt-5 p-3 text-center"
		style="height: 100vh;">
		<h1 class="text-secondary">Strong Password Generator</h1>
		<h2 class="text-light mb-5">Genera una password sicura</h2>
		<div class="alert alert-primary">
			<h5 class="alert-heading">
				<?= $message ?>
			</h5>
		</div>
		<div class="bg-white text-secondary rounded p-3 text-start">
			<form method="GET">
				<div class="form-group row mb-5">
					<div class="col-sm-6">
						<label for="pw-length">Lunghezza password:</label>
					</div>
					<div class="col-sm-6">
						<input type="number" class="form-control" id="pw-length"
							name="pw-length" value="<?= $pw_length ?>" style="width: 50%;">
					</div>
				</div>
				<div class="form-group row mb-5">
					<div class="col-sm-6">
						<label>Consenti ripetizioni di uno o più caratteri:</label>
					</div>
					<div class="col-sm-6">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="rep_on"
								id="repeat" <?php if ($rep_on === "on")
									echo "checked"; ?>>
							<label class="form-check-label" for="repeat">
								Sì
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="rep_off"
								id="norepeat" <?php if ($rep_off === "on")
									echo "checked"; ?>>
							<label class="form-check-label" for="norepeat">
								No
							</label>
						</div>
						<div class="form-check mt-3">
							<input class="form-check-input" type="checkbox" id="letters"
								name="letters" <?php if ($letters === "on")
									echo "checked"; ?>>
							<label class="form-check-label" for="letters">
								Lettere
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="numbers"
								name="numbers" <?php if ($numbers === "on")
									echo "checked"; ?>>
							<label class="form-check-label" for="numbers">
								Numeri
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="symbols"
								name="symbols" <?php if ($symbols === "on")
									echo "checked"; ?>>
							<label class="form-check-label" for="symbols">
								Simboli
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary mr-2">Invia</button>
						<a href="/php-strong-password-generator/"
							class="btn btn-secondary">Annulla</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
