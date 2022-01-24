<?php

function viewCatchedError($message, $code, $line, $file) {
	echo '<div style="margin: 10px 20px; padding: 10px; min-height: 50px; border: 1px solid red; background-color: white;">message: '.$message.'<br/>code: '.$code.'<br/>ligne: '.$line.'<br/>fichier: '.$file.'</div>';
}

?>