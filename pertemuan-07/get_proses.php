<?php
session_start();
$_session["nama"] = $_GET["txtnama"];
$_session["email"] = $_GET["txtemail"];
$_session["pesan"] = $_GET["txtpesan"];
header (header: "location: get.php");
?>
