<?php

if (isset($_POST["upload"])){
	header('Location: upload-system.php');
}
if (isset($_POST["profile"])){
	header('Location: profile.management-system.php');
}

?>