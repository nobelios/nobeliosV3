<?php

// functions_anti_robot.php
// Une session doit être lancé avant l'appel de cette bibliothèque.
		
//fonction anti-robot mathématique sans image
function antiRobotQuestion() {
	//combien font 1+1 ?
	
	$operation = array('+','-','x');
	$textOperation = array('plus','moins','fois');
	$textNumber = array('zero','un','deux','trois','quatre','cinq','six','sept','huit','neuf','dix');

	$x = rand(0,10);
	$y = rand(0,2);
	$z = rand(0,10);

	$xText = rand(0,1);
	$yText = rand(0,1);
	$zText = rand(0,1);

	if ($y == 0) {
		$_SESSION['antiRobotResponse'] = $x+$z;
	} elseif ($y == 1) {
		$_SESSION['antiRobotResponse'] = $x-$z;
	} elseif ($y == 2) {
		$_SESSION['antiRobotResponse'] = $x*$z;
	}

	if ($xText == 1) $x = $textNumber[$x];
	if ($yText == 1) {
		$y = $textOperation[$y];
	} else {
		$y = $operation[$y];
	}
	if ($zText == 1) $z = $textNumber[$z];

	echo $x." ".$y." ".$z;
}

?>