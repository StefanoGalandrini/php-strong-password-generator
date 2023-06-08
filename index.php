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

// Lettura dei radio buttons
$repeat = isset($_GET["repeat"]) ? $_GET["repeat"] : 0;
$rep_on = intval($repeat) === 1;

// Lettura delle checkboxes
$letters = isset($_GET["letters"]) && $_GET["letters"] === "on";
$numbers = isset($_GET["numbers"]) && $_GET["numbers"] === "on";
$symbols = isset($_GET["symbols"]) && $_GET["symbols"] === "on";

// Messaggio di errore in assenza di input validi
$message = "";

if ($pw_length === 0 && !$letters && !$numbers && !$symbols) {
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
		return [
			"message"  => "La lunghezza della password non può essere maggiore del numero di caratteri unici disponibili.",
			"password" => null,
		];
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

	return [
		"message"  => "La password scelta è " . $password,
		"password" => $password,
	];
}

// Controlla la lunghezza della password e chiama la funzione per generarla
$result = generate_random_password($characters, $pw_length, $rep_on);
if ($pw_length > 0 && $message === "") {
	$message  = $result["message"];
	$password = $result["password"];
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

				<!-- Password length -->
				<div class="form-group row mb-5">
					<div class="col-sm-6">
						<label for="pw-length">Lunghezza password:</label>
					</div>
					<div class="col-sm-6">
						<input type="number" class="form-control" id="pw-length"
							name="pw-length" value="<?= $pw_length ?>" style="width: 50%;">
					</div>
				</div>

				<!-- Radio buttons -->
				<div class="form-group row mb-5">
					<div class="col-sm-6">
						<label>Consenti ripetizioni di uno o più caratteri:</label>
					</div>
					<div class="col-sm-6">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="repeat"
								value="1" id="repeat" <?php if ($rep_on)
									echo "checked"; ?>>
							<label class="form-check-label" for="repeat">Sì</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="repeat"
								value="0" id="norepeat" <?php if (!$rep_on)
									echo "checked"; ?>>
							<label class="form-check-label" for="norepeat">No</label>
						</div>

						<!-- Checkboxes -->
						<div class="form-check mt-3">
							<input class="form-check-input" type="checkbox" id="letters"
								name="letters" <?php if ($letters)
									echo "checked"; ?>>
							<label class="form-check-label" for="letters">
								Lettere
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="numbers"
								name="numbers" <?php if ($numbers)
									echo "checked"; ?>>
							<label class="form-check-label" for="numbers">
								Numeri
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="symbols"
								name="symbols" <?php if ($symbols)
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
