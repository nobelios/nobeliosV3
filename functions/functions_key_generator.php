<?php

// GENERATOR
// Générateur de chaine hexadecimal sur 32 bits
function randomHex() {
	$carHexa = 16;
	$hexa = "0123456789ABCDEF";
	$string = "";
	srand((double)microtime()*1000000);
	for($i=0; $i<$carHexa; $i++) {
		$string .= $hexa[rand(0, $carHexa - 1)%strlen($hexa)]; // carHexa - 1 car le 0 compte pour 1
	}
	return $string;
}



?>