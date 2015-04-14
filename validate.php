<?php
if (!isset($_SESSION["LOGGED"]) && $_SESSION["LOGGED"] != 1) {
	header("Location: ../index.php?msg=3");
}
?>