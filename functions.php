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
$repeat = isset($_GET["repeat"]) ? $_GET["repeat"] : null;
$rep_on = $repeat === "1" || $repeat === null;

// Lettura delle checkboxes
$letters = isset($_GET["letters"]) && $_GET["letters"] === "on";
$numbers = isset($_GET["numbers"]) && $_GET["numbers"] === "on";
$symbols = isset($_GET["symbols"]) && $_GET["symbols"] === "on";


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

// Messaggio di errore in assenza di input validi
$message = "";

if ($pw_length > 0 && (!$letters && !$numbers && !$symbols)) {
	$message = "Nessun parametro valido inserito";
} else {
	$message = "";

	// Controlla la lunghezza della password e chiama la funzione per generarla
	if ($pw_length > 0 && $message === "" && ($letters || $numbers || $symbols)) {
		$result = generate_random_password($characters, $pw_length, $rep_on);
		var_dump($pw_length > 0 && ($letters || $numbers || $symbols));
		var_dump($numbers);
		var_dump($symbols);
		$message  = $result["message"];
		$password = $result["password"];
	} else {
		return $message = "Per favore, specifica una lunghezza per la password!";
	}
}
