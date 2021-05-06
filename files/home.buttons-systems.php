<!--Ανακατεύθυνση στις αντίστοιχες σελίδες μέσω πλήκτρων-->
<?php

if (isset($_POST["upload"])){
	header('Location: upload-system.php');
}
if (isset($_POST["profile"])){
	header('Location: profile.management-system.php');
}
if (isset($_POST["map"])){
	header('Location: user-map.php');
}

?>